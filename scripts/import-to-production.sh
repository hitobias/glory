#!/usr/bin/env bash
set -euo pipefail

# =============================================================
# Import local data into production Dokploy deployment
# Run this AFTER the Dokploy compose stack is up and running.
#
# Usage:
#   1. SSH into your Dokploy server
#   2. scp data/export/glory_wp.sql to the server
#   3. scp -r data/export/uploads/ to the server
#   4. Run this script with the paths as arguments
#
# Example:
#   ./import-to-production.sh /path/to/glory_wp.sql /path/to/uploads
# =============================================================

SQL_FILE="${1:-glory_wp.sql}"
UPLOADS_DIR="${2:-uploads}"
WP_CONTAINER="glory-wp"
DB_CONTAINER="glory-db"
PROD_URL="https://glory.tpech.org"
OLD_URL="http://localhost:8080"

echo "=== Production Data Import ==="
echo ""

# Verify files exist
if [ ! -f "$SQL_FILE" ]; then
    echo "ERROR: SQL dump not found: $SQL_FILE"
    exit 1
fi

echo "[1/5] Importing database..."
docker exec -i "$DB_CONTAINER" mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}" < "$SQL_FILE"
echo "  Done. $(wc -c < "$SQL_FILE" | xargs) bytes imported."

echo "[2/5] Replacing URLs (localhost → production)..."
docker exec "$WP_CONTAINER" wp --allow-root search-replace \
    "$OLD_URL" "$PROD_URL" \
    --all-tables \
    --precise \
    --recurse-objects \
    --skip-columns=guid \
    --report-changed-only

echo "[3/5] Importing uploads..."
if [ -d "$UPLOADS_DIR" ]; then
    docker cp "$UPLOADS_DIR/." "$WP_CONTAINER:/var/www/html/wp-content/uploads/"
    docker exec "$WP_CONTAINER" chown -R www-data:www-data /var/www/html/wp-content/uploads/
    echo "  Done."
else
    echo "  SKIP: uploads directory not found: $UPLOADS_DIR"
fi

echo "[4/5] Flushing caches and rewrite rules..."
docker exec "$WP_CONTAINER" wp --allow-root rewrite flush
docker exec "$WP_CONTAINER" wp --allow-root cache flush 2>/dev/null || true

echo "[5/5] Verifying..."
echo ""
echo "  Site URL:     $(docker exec "$WP_CONTAINER" wp --allow-root option get siteurl)"
echo "  Home URL:     $(docker exec "$WP_CONTAINER" wp --allow-root option get home)"
echo "  Posts:        $(docker exec "$WP_CONTAINER" wp --allow-root post list --post_type=post --format=count)"
echo "  Pages:        $(docker exec "$WP_CONTAINER" wp --allow-root post list --post_type=page --format=count)"
echo "  Events:       $(docker exec "$WP_CONTAINER" wp --allow-root post list --post_type=glory_event --format=count)"
echo "  Media:        $(docker exec "$WP_CONTAINER" wp --allow-root post list --post_type=attachment --format=count)"
echo ""
echo "=== Import Complete ==="
echo ""
echo "Visit: $PROD_URL"
echo "Admin: $PROD_URL/wp-admin/"
