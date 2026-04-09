#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
THEME_DIR="$PROJECT_DIR/wp-content/themes/glory-theme"

echo "=== Glory Foundation - Deploy ==="
echo ""

# Step 1: Build theme assets
echo "[1/5] Building theme assets..."
cd "$THEME_DIR"
if [ ! -d "node_modules" ]; then
    echo "  Installing dependencies..."
    npm install
fi
npm run build
echo "  Build complete. Output in dist/"

# Step 2: Create theme zip
echo "[2/5] Creating theme archive..."
cd "$PROJECT_DIR/wp-content/themes"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
ZIP_NAME="glory-theme-${TIMESTAMP}.zip"

# Exclude dev files from the zip
zip -r "$PROJECT_DIR/$ZIP_NAME" glory-theme/ \
    -x "glory-theme/node_modules/*" \
    -x "glory-theme/src/*" \
    -x "glory-theme/package.json" \
    -x "glory-theme/package-lock.json" \
    -x "glory-theme/tailwind.config.js" \
    -x "glory-theme/postcss.config.js" \
    -x "glory-theme/vite.config.js" \
    -x "glory-theme/.gitignore"

echo "  Archive: $PROJECT_DIR/$ZIP_NAME"

# Step 3: Production checklist
echo ""
echo "[3/5] Pre-deployment checklist:"
echo "  [ ] Backup production database"
echo "  [ ] Backup production wp-content"
echo "  [ ] Test theme on staging environment"
echo "  [ ] Verify all pages load correctly"
echo "  [ ] Test forms and donations"
echo "  [ ] Check responsive design"
echo "  [ ] Verify SSL certificate"

# Step 4: Cloudways deployment instructions
echo ""
echo "[4/5] Cloudways Deployment Steps:"
echo "  1. Upload $ZIP_NAME to Cloudways via SFTP"
echo "  2. Extract to wp-content/themes/"
echo "  3. Install and activate required plugins via WP-CLI"
echo "  4. Activate glory-theme"
echo "  5. Import content and run search-replace:"
echo "     wp search-replace 'localhost:8080' 'glory.org.tw' --all-tables"
echo "  6. Set up SSL via Cloudways panel"
echo "  7. Configure CDN (Cloudflare or Cloudways CDN)"
echo "  8. Lower DNS TTL to 300 before switching"
echo "  9. Update DNS A record to Cloudways IP"
echo "  10. Monitor for 24-48 hours"

# Step 5: Post-deploy
echo ""
echo "[5/5] Post-deployment:"
echo "  - Submit sitemap to Google Search Console"
echo "  - Set up Redirection plugin for old URLs"
echo "  - Configure Wordfence firewall"
echo "  - Set up UpdraftPlus backups"
echo "  - Run Lighthouse performance check"
echo "  - Verify WCAG 2.1 AA compliance"
echo ""
echo "=== Deploy Package Ready ==="
echo "Theme archive: $PROJECT_DIR/$ZIP_NAME"
