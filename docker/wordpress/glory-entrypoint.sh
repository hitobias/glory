#!/usr/bin/env bash
# Custom entrypoint wrapper for Glory WordPress.
# On first boot: starts the original WP entrypoint (which sets up wp-config.php
# and starts Apache), then imports database, runs URL replacement, downloads uploads.
# On subsequent boots: passes through directly to the original entrypoint.
set -euo pipefail

MARKER="/var/www/html/.glory-initialized"
SEED_SQL="/var/www/html/glory_wp.sql.gz"
PROD_URL="${WP_URL:-https://glory.tpech.org}"
OLD_URL="http://localhost:8080"
UPLOADS_RELEASE_TAG="uploads-v1"
REPO="hitobias/glory"

log() { echo "[glory-init] $*"; }

# ─── Already initialized: pass through ───────────────────────────
if [ -f "$MARKER" ]; then
    exec docker-entrypoint.sh "$@"
fi

# ─── First Boot ──────────────────────────────────────────────────
log "=== First-Boot Initialization ==="

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
    if [ $WAIT -ge 60 ]; then
        log "WARNING: wp-config.php not found after 120s — skipping init."
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
    if [ $WAIT -ge 40 ]; then
        log "WARNING: Database not ready after 120s — skipping init."
        wait $WP_PID
        exit $?
    fi
done
log "Database ready."

# ─── Step 1: Import database ─────────────────────────────────────
DB_NAME="${WORDPRESS_DB_NAME:-glory_wp}"
TABLE_COUNT=$(wp --allow-root db query \
    "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA='${DB_NAME}';" \
    --skip-column-names 2>/dev/null | tr -d '[:space:]' || echo "0")

if [ "$TABLE_COUNT" -lt 5 ]; then
    log "[1/4] Importing database seed..."
    if [ -f "$SEED_SQL" ]; then
        gunzip -c "$SEED_SQL" | wp --allow-root db import -
        log "  Database imported."
    else
        log "  WARNING: Seed SQL not found — skipping."
    fi
else
    log "[1/4] Database has $TABLE_COUNT tables — skipping import."
fi

# ─── Step 2: URL search-replace ──────────────────────────────────
log "[2/4] Replacing URLs ($OLD_URL → $PROD_URL)..."
wp --allow-root search-replace "$OLD_URL" "$PROD_URL" \
    --all-tables --precise --recurse-objects \
    --skip-columns=guid --report-changed-only 2>&1 || true

# ─── Step 3: Download and extract uploads ─────────────────────────
UPLOADS_DIR="/var/www/html/wp-content/uploads"
if [ -d "$UPLOADS_DIR/2024" ] || [ -d "$UPLOADS_DIR/2025" ]; then
    log "[3/4] Uploads already present — skipping download."
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
        else
            break
        fi
    done

    if [ $PARTS -gt 0 ]; then
        log "  Extracting ${PARTS} parts..."
        cat "${DL}"/part-* | tar -xzf - -C "$UPLOADS_DIR" --strip-components=1
        rm -rf "$DL"
        chown -R www-data:www-data "$UPLOADS_DIR"
        log "  Uploads ready."
    else
        log "  WARNING: No uploads found — images may be missing."
    fi
fi

# ─── Step 4: Flush caches ────────────────────────────────────────
log "[4/4] Flushing caches..."
wp --allow-root rewrite flush 2>/dev/null || true
wp --allow-root cache flush 2>/dev/null || true

# ─── Done ─────────────────────────────────────────────────────────
touch "$MARKER"
log "=== Initialization Complete ==="
log "Site: $PROD_URL"

# Keep running — wait for the Apache process
wait $WP_PID
