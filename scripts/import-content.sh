#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
DATA_DIR="$PROJECT_DIR/data/migration"

source "$PROJECT_DIR/.env"

echo "=== Content Migration ==="
echo ""

# Step 1: Import WP XML export
if ls "$DATA_DIR"/*.xml 1>/dev/null 2>&1; then
    echo "[1/5] Importing WordPress XML files..."
    for xml_file in "$DATA_DIR"/*.xml; do
        echo "  Importing: $(basename "$xml_file")"
        docker exec glory-wp wp --allow-root import "$xml_file" \
            --authors=mapping.csv 2>/dev/null || \
        docker exec glory-wp wp --allow-root import "$xml_file" \
            --authors=create 2>/dev/null || {
            echo "  Note: WordPress Importer plugin may be needed."
            echo "  Installing..."
            docker exec glory-wp wp --allow-root plugin install wordpress-importer --activate
            docker exec glory-wp wp --allow-root import "$xml_file" --authors=create
        }
    done
else
    echo "[1/5] No XML files found in $DATA_DIR. Skipping import."
    echo "  Place your WordPress XML export files in: $DATA_DIR/"
fi

# Step 2: Search and replace URLs
echo "[2/5] Updating internal URLs..."
OLD_URL="${OLD_SITE_URL:-https://glory.org.tw}"
NEW_URL="${WP_URL:-http://localhost:8080}"

docker exec glory-wp wp --allow-root search-replace \
    "$OLD_URL" "$NEW_URL" \
    --all-tables \
    --precise \
    --recurse-objects \
    --skip-columns=guid \
    --report-changed-only

# Step 3: Regenerate thumbnails
echo "[3/5] Regenerating thumbnails..."
docker exec glory-wp wp --allow-root media regenerate --yes 2>/dev/null || {
    echo "  Skipping thumbnail regeneration (no media files found)"
}

# Step 4: Flush rewrite rules
echo "[4/5] Flushing rewrite rules..."
docker exec glory-wp wp --allow-root rewrite flush

# Step 5: Verify
echo "[5/5] Verifying import..."
echo ""
echo "  Posts:        $(docker exec glory-wp wp --allow-root post list --post_type=post --format=count 2>/dev/null || echo 'N/A')"
echo "  Pages:        $(docker exec glory-wp wp --allow-root post list --post_type=page --format=count 2>/dev/null || echo 'N/A')"
echo "  Programs:     $(docker exec glory-wp wp --allow-root post list --post_type=glory_program --format=count 2>/dev/null || echo 'N/A')"
echo "  Publications: $(docker exec glory-wp wp --allow-root post list --post_type=glory_publication --format=count 2>/dev/null || echo 'N/A')"
echo "  Categories:   $(docker exec glory-wp wp --allow-root term list category --format=count 2>/dev/null || echo 'N/A')"
echo "  Media:        $(docker exec glory-wp wp --allow-root post list --post_type=attachment --format=count 2>/dev/null || echo 'N/A')"
echo ""
echo "=== Import Complete ==="
echo ""
echo "Next steps:"
echo "  1. Verify pages and posts in wp-admin"
echo "  2. Check media files are properly linked"
echo "  3. Set up URL redirections in Redirection plugin"
echo "  4. Rebuild Qubely/Elementor pages as Gutenberg blocks"
