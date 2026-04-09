#!/usr/bin/env bash
# Glory WordPress first-boot wrapper.
# DB import is handled by MySQL's /docker-entrypoint-initdb.d/ mechanism.
# This script only handles: URL replacement + uploads download.

PROD_URL="${WP_URL:-https://glory.tpech.org}"
OLD_URL="http://localhost:8080"
UPLOADS_RELEASE_TAG="uploads-v1"
REPO="hitobias/glory"
INIT_MARKER="/var/www/html/.glory-init-done"

log() { echo "[glory-init] $(date '+%H:%M:%S') $*"; }

# ─── Already initialized → pass through ──────────────────────────
if [ -f "$INIT_MARKER" ]; then
    log "Already initialized. Starting WordPress."
    exec docker-entrypoint.sh "$@"
fi

log "=== First-Boot Initialization ==="
log "Starting WordPress in background..."

# Start WordPress normally in background (sets up wp-config.php + Apache)
docker-entrypoint.sh "$@" &
WP_PID=$!
trap 'kill $WP_PID 2>/dev/null; wait $WP_PID 2>/dev/null; exit' SIGTERM SIGINT

# ─── Wait for WordPress + Database ────────────────────────────────
log "Waiting for wp-config.php..."
for i in $(seq 1 90); do
    [ -f /var/www/html/wp-config.php ] && break
    sleep 2
done
if [ ! -f /var/www/html/wp-config.php ]; then
    log "ERROR: wp-config.php not created after 180s. Check docker-entrypoint.sh logs."
    wait $WP_PID; exit 1
fi
log "wp-config.php found."

log "Waiting for database tables (MySQL initdb imports SQL seed)..."
for i in $(seq 1 120); do
    # Check if our tables exist (MySQL initdb should have imported them)
    if wp --allow-root db check >/dev/null 2>&1; then
        TABLE_COUNT=$(wp --allow-root db query \
            "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='${WORDPRESS_DB_NAME:-glory_wp}';" \
            --skip-column-names 2>/dev/null | tr -d '[:space:]')
        if [ "${TABLE_COUNT:-0}" -ge 5 ]; then
            log "Database ready with $TABLE_COUNT tables."
            break
        fi
    fi
    sleep 3
done

TABLE_COUNT=$(wp --allow-root db query \
    "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='${WORDPRESS_DB_NAME:-glory_wp}';" \
    --skip-column-names 2>/dev/null | tr -d '[:space:]' || echo "0")

if [ "${TABLE_COUNT:-0}" -lt 5 ]; then
    log "WARNING: Database has only ${TABLE_COUNT:-0} tables after 360s."
    log "MySQL may still be importing. Check MySQL container logs."
    log "Continuing without URL replacement — site may show install screen."
    wait $WP_PID; exit 0
fi

# ─── URL search-replace ──────────────────────────────────────────
log "[1/3] Checking for localhost URLs..."
HAS_LOCALHOST=$(wp --allow-root db query \
    "SELECT option_value FROM ${WORDPRESS_TABLE_PREFIX:-glry_}options WHERE option_name='siteurl';" \
    --skip-column-names 2>/dev/null || echo "")

if echo "$HAS_LOCALHOST" | grep -q "localhost"; then
    log "  Replacing $OLD_URL → $PROD_URL ..."
    wp --allow-root search-replace "$OLD_URL" "$PROD_URL" \
        --all-tables --precise --recurse-objects \
        --skip-columns=guid --report-changed-only 2>&1 || true
    log "  Done."
else
    log "  No localhost URLs found — OK."
fi

# ─── Download uploads ─────────────────────────────────────────────
UPLOADS_DIR="/var/www/html/wp-content/uploads"
if [ -d "$UPLOADS_DIR/2024" ] && [ -d "$UPLOADS_DIR/2025" ]; then
    log "[2/3] Uploads already present — OK."
else
    log "[2/3] Downloading uploads from GitHub Release..."
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
        log "  WARNING: Could not download uploads. Images may be missing."
    fi
fi

# ─── Flush caches ─────────────────────────────────────────────────
log "[3/3] Flushing caches..."
wp --allow-root rewrite flush 2>/dev/null || true
wp --allow-root cache flush 2>/dev/null || true

# ─── Done ─────────────────────────────────────────────────────────
touch "$INIT_MARKER"
log "=== Initialization Complete ==="
log "Site: $PROD_URL"

wait $WP_PID
