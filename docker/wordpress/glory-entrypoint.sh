#!/bin/bash
# Glory WordPress initialization wrapper.
# Imports database if empty, replaces URLs, downloads uploads.
# No marker files — checks actual database state every boot.

echo "[glory-init] =========================================="
echo "[glory-init] Glory entrypoint starting"
echo "[glory-init] =========================================="

SEED_SQL="/opt/glory-seed/glory_wp.sql.gz"
PROD_URL="${WP_URL:-https://glory.tpech.org}"
OLD_URL="http://localhost:8080"
UPLOADS_RELEASE_TAG="uploads-v1"
REPO="hitobias/glory"

DB_HOST="${WORDPRESS_DB_HOST:-db}"
DB_USER="${WORDPRESS_DB_USER:-root}"
DB_PASS="${WORDPRESS_DB_PASSWORD:-}"
DB_NAME="${WORDPRESS_DB_NAME:-glory_wp}"

log() { echo "[glory-init] $*"; }

# ─── Create temp MySQL config (avoids exposing password in ps output) ──
MYSQL_CNF=$(mktemp)
printf "[client]\nhost=%s\nuser=%s\npassword=%s\n" "$DB_HOST" "$DB_USER" "$DB_PASS" > "$MYSQL_CNF"
chmod 600 "$MYSQL_CNF"
cleanup_cnf() { rm -f "$MYSQL_CNF"; }
trap 'cleanup_cnf' EXIT

# ─── Wait for MySQL to accept connections ─────────────────────────
log "Waiting for MySQL at $DB_HOST..."
TRIES=0
while ! mysqladmin --defaults-file="$MYSQL_CNF" ping --silent 2>/dev/null; do
    TRIES=$((TRIES + 1))
    if [ $TRIES -ge 60 ]; then
        log "ERROR: MySQL not reachable after 180s. Starting WordPress anyway."
        exec docker-entrypoint.sh "$@"
    fi
    sleep 3
done
log "MySQL is up."

# ─── Check if database has tables ─────────────────────────────────
TABLE_COUNT=$(mysql --defaults-file="$MYSQL_CNF" -N -e \
    "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='$DB_NAME';" 2>/dev/null || echo "0")
TABLE_COUNT=$(echo "$TABLE_COUNT" | tr -d '[:space:]')
log "Database '$DB_NAME' has $TABLE_COUNT tables."

# ─── Import database if empty ────────────────────────────────────
if [ "${TABLE_COUNT:-0}" -lt 5 ]; then
    log "Database is empty — importing seed data..."
    if [ -f "$SEED_SQL" ]; then
        log "  Seed file: $SEED_SQL ($(du -h "$SEED_SQL" | cut -f1))"
        if gunzip -c "$SEED_SQL" | mysql --defaults-file="$MYSQL_CNF" "$DB_NAME" 2>&1; then
            NEW_COUNT=$(mysql --defaults-file="$MYSQL_CNF" -N -e \
                "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='$DB_NAME';" 2>/dev/null)
            log "  Import complete. Tables now: $NEW_COUNT"
        else
            log "  ERROR: Import failed!"
        fi
    else
        log "  ERROR: Seed SQL not found at $SEED_SQL"
        ls -la /opt/glory-seed/ 2>/dev/null || log "  /opt/glory-seed/ does not exist!"
    fi
else
    log "Database already populated — skipping import."
fi

# ─── URL search-replace (using mysql directly — no WP-CLI needed) ──
SITEURL=$(mysql --defaults-file="$MYSQL_CNF" -N -e \
    "SELECT option_value FROM ${DB_NAME}.${WORDPRESS_TABLE_PREFIX:-glry_}options WHERE option_name='siteurl' LIMIT 1;" 2>/dev/null || echo "")

log "Current siteurl: $SITEURL"

if echo "$SITEURL" | grep -q "localhost"; then
    log "Replacing URLs: $OLD_URL → $PROD_URL"
    # Quick-fix the critical options first (siteurl + home)
    mysql --defaults-file="$MYSQL_CNF" "$DB_NAME" -e "
        UPDATE ${WORDPRESS_TABLE_PREFIX:-glry_}options
        SET option_value = REPLACE(option_value, '$OLD_URL', '$PROD_URL')
        WHERE option_name IN ('siteurl', 'home');
    " 2>&1 || true
    log "  siteurl and home updated."
    # Full search-replace via WP-CLI will run after WordPress starts
fi

# ─── Install themes into volume ───────────────────────────────────
THEMES_DIR="/var/www/html/wp-content/themes"
mkdir -p "$THEMES_DIR"
for theme in generatepress glory-theme; do
    if [ -d "/opt/themes/$theme" ]; then
        rm -rf "$THEMES_DIR/$theme"
        cp -r "/opt/themes/$theme" "$THEMES_DIR/$theme"
        chown -R www-data:www-data "$THEMES_DIR/$theme"
        log "Theme '$theme' installed."
    fi
done

# ─── Start WordPress (docker-entrypoint.sh sets up wp-config.php) ──
log "Starting WordPress..."
cleanup_cnf  # Remove temp MySQL config before handing off
docker-entrypoint.sh "$@" &
WP_PID=$!
trap 'kill $WP_PID 2>/dev/null; wait $WP_PID 2>/dev/null; exit' SIGTERM SIGINT

# Wait for wp-config.php so WP-CLI works
for i in $(seq 1 60); do
    [ -f /var/www/html/wp-config.php ] && break
    sleep 2
done


if [ -f /var/www/html/wp-config.php ]; then
    # Full WP-CLI search-replace (handles serialized data properly)
    if echo "$SITEURL" | grep -q "localhost"; then
        log "Running full WP-CLI search-replace..."
        sleep 5  # Give Apache a moment to start
        wp --allow-root search-replace "$OLD_URL" "$PROD_URL" \
            --all-tables --precise --recurse-objects \
            --skip-columns=guid --report-changed-only 2>&1 || true
        log "  WP-CLI search-replace done."
    fi

    # ─── Download uploads ─────────────────────────────────────────
    UPLOADS_DIR="/var/www/html/wp-content/uploads"
    if [ -d "$UPLOADS_DIR/2024" ] && [ -d "$UPLOADS_DIR/2025" ]; then
        log "Uploads already present — OK."
    else
        log "Downloading uploads from GitHub Release..."
        mkdir -p "$UPLOADS_DIR"
        RELEASE_URL="https://github.com/${REPO}/releases/download/${UPLOADS_RELEASE_TAG}"
        DL="/tmp/glory-uploads"
        mkdir -p "$DL"

        PARTS=0
        for SUFFIX in aa ab ac ad ae; do
            log "  Fetching part-${SUFFIX}..."
            if curl -fSL --retry 3 --retry-delay 10 \
                -o "${DL}/part-${SUFFIX}" \
                "${RELEASE_URL}/glory-uploads-part-${SUFFIX}" 2>/dev/null; then
                PARTS=$((PARTS + 1))
            else
                break
            fi
        done

        if [ "$PARTS" -gt 0 ]; then
            log "  Extracting $PARTS part(s)..."
            cat "${DL}"/part-* | tar -xzf - -C "$UPLOADS_DIR" --strip-components=1 2>&1 || true
            rm -rf "$DL"
            chown -R www-data:www-data "$UPLOADS_DIR"
            log "  Uploads extracted."
        else
            log "  WARNING: Could not download uploads."
        fi
    fi

    # Flush caches
    wp --allow-root rewrite flush 2>/dev/null || true
    wp --allow-root cache flush 2>/dev/null || true
fi

log "=========================================="
log "Initialization complete."
log "Site: $PROD_URL"
log "=========================================="

wait $WP_PID
