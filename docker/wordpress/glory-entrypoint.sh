#!/usr/bin/env bash
# Custom entrypoint wrapper for Glory WordPress.
# On first boot: starts the original WP entrypoint (which sets up wp-config.php
# and starts Apache), then imports database, runs URL replacement, downloads uploads.
# Each step has its own idempotency check — safe to re-run on every restart.
set -euo pipefail

SEED_SQL="/opt/glory-seed/glory_wp.sql.gz"
PROD_URL="${WP_URL:-https://glory.tpech.org}"
OLD_URL="http://localhost:8080"
UPLOADS_RELEASE_TAG="uploads-v1"
REPO="hitobias/glory"
INIT_DONE="/var/www/html/.glory-init-done"

log() { echo "[glory-init] $*"; }

# ─── If fully initialized, pass through immediately ──────────────
if [ -f "$INIT_DONE" ]; then
    exec docker-entrypoint.sh "$@"
fi

# ─── First Boot (or recovery from partial init) ──────────────────
log "=== Glory Initialization ==="

# Start the real WordPress entrypoint in background
# (it creates wp-config.php, copies WP core files, starts Apache)
docker-entrypoint.sh "$@" &
WP_PID=$!

# Forward signals to the child process
trap 'kill -TERM $WP_PID 2>/dev/null; wait $WP_PID; exit' SIGTERM SIGINT

# Wait for wp-config.php (created by docker-entrypoint.sh)
log "Waiting for WordPress setup..."
WAIT=0
while [ ! -f /var/www/html/wp-config.php ]; do
    sleep 2
    WAIT=$((WAIT + 1))
    if [ $WAIT -ge 90 ]; then
        log "ERROR: wp-config.php not found after 180s — giving up init."
        wait $WP_PID
        exit $?
    fi
done
log "wp-config.php ready."

# Wait for database
log "Waiting for database..."
WAIT=0
while ! wp --allow-root db check >/dev/null 2>&1; do
    sleep 3
    WAIT=$((WAIT + 1))
    if [ $WAIT -ge 60 ]; then
        log "ERROR: Database not ready after 180s — giving up init."
        wait $WP_PID
        exit $?
    fi
done
log "Database ready."

# ─── Step 1: Import database (skip if tables already exist) ──────
DB_NAME="${WORDPRESS_DB_NAME:-glory_wp}"
TABLE_COUNT=$(wp --allow-root db query \
    "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='${DB_NAME}';" \
    --skip-column-names 2>/dev/null | tr -d '[:space:]' || echo "0")

if [ "$TABLE_COUNT" -lt 5 ]; then
    log "[1/4] Importing database seed..."
    if [ -f "$SEED_SQL" ]; then
        gunzip -c "$SEED_SQL" | wp --allow-root db import -
        TABLE_COUNT=$(wp --allow-root db query \
            "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='${DB_NAME}';" \
            --skip-column-names 2>/dev/null | tr -d '[:space:]' || echo "0")
        log "  Database imported ($TABLE_COUNT tables)."
    else
        log "  ERROR: Seed SQL not found at $SEED_SQL!"
        log "  Container will show WordPress install screen."
        log "  This is a build error — the SQL should be at /opt/glory-seed/"
        wait $WP_PID
        exit 1
    fi
else
    log "[1/4] Database already has $TABLE_COUNT tables — OK."
fi

# ─── Step 2: URL search-replace (idempotent) ─────────────────────
log "[2/4] Checking/replacing URLs..."
LOCALHOST_COUNT=$(wp --allow-root db query \
    "SELECT COUNT(*) FROM ${DB_NAME}.${WORDPRESS_TABLE_PREFIX:-glry_}options WHERE option_value LIKE '%${OLD_URL}%';" \
    --skip-column-names 2>/dev/null | tr -d '[:space:]' || echo "0")

if [ "$LOCALHOST_COUNT" -gt 0 ]; then
    log "  Found $LOCALHOST_COUNT localhost references — replacing..."
    wp --allow-root search-replace "$OLD_URL" "$PROD_URL" \
        --all-tables --precise --recurse-objects \
        --skip-columns=guid --report-changed-only 2>&1 || true
    log "  URL replacement done."
else
    log "  No localhost URLs found — OK."
fi

# ─── Step 3: Download uploads (skip if already present) ──────────
UPLOADS_DIR="/var/www/html/wp-content/uploads"
if [ -d "$UPLOADS_DIR/2024" ] && [ -d "$UPLOADS_DIR/2025" ]; then
    log "[3/4] Uploads already present — OK."
else
    log "[3/4] Downloading uploads from GitHub Release..."
    mkdir -p "$UPLOADS_DIR"

    RELEASE_URL="https://github.com/${REPO}/releases/download/${UPLOADS_RELEASE_TAG}"
    DL="/tmp/glory-uploads"
    mkdir -p "$DL"

    PARTS=0
    for SUFFIX in aa ab ac ad ae; do
        URL="${RELEASE_URL}/glory-uploads-part-${SUFFIX}"
        FILE="${DL}/part-${SUFFIX}"
        log "  Downloading part ${SUFFIX}..."
        if curl -fSL --retry 3 --retry-delay 10 -o "$FILE" "$URL" 2>/dev/null; then
            PARTS=$((PARTS + 1))
            SIZE=$(du -h "$FILE" | cut -f1)
            log "  Part ${SUFFIX} downloaded (${SIZE})."
        else
            log "  Part ${SUFFIX} not available — done downloading."
            break
        fi
    done

    if [ $PARTS -gt 0 ]; then
        log "  Extracting ${PARTS} parts to $UPLOADS_DIR..."
        cat "${DL}"/part-* | tar -xzf - -C "$UPLOADS_DIR" --strip-components=1
        rm -rf "$DL"
        chown -R www-data:www-data "$UPLOADS_DIR"
        UPLOAD_SIZE=$(du -sh "$UPLOADS_DIR" | cut -f1)
        log "  Uploads ready (${UPLOAD_SIZE})."
    else
        log "  WARNING: No upload archives found at $RELEASE_URL"
        log "  Site will work but images may be missing."
    fi
fi

# ─── Step 4: Flush caches ────────────────────────────────────────
log "[4/4] Flushing caches..."
wp --allow-root rewrite flush 2>/dev/null || true
wp --allow-root cache flush 2>/dev/null || true

# ─── Mark fully initialized ──────────────────────────────────────
touch "$INIT_DONE"
log "=== Initialization Complete ==="
log "Site: $PROD_URL"
log "Admin: $PROD_URL/wp-admin/"

# Keep running — wait for the Apache process
wait $WP_PID
