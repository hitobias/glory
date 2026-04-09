#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"

# Load environment variables
if [ ! -f "$PROJECT_DIR/.env" ]; then
  echo "Creating .env from .env.example..."
  cp "$PROJECT_DIR/.env.example" "$PROJECT_DIR/.env"
  echo "Please edit .env with your settings, then re-run this script."
  exit 1
fi

source "$PROJECT_DIR/.env"

echo "=== 得榮社會福利基金會 WordPress Setup ==="
echo ""

# Step 1: Start Docker containers
echo "[1/6] Starting Docker containers..."
cd "$PROJECT_DIR"
docker compose up -d --build

# Step 2: Wait for WordPress to be ready
echo "[2/6] Waiting for WordPress..."
until docker exec glory-wp wp --allow-root core is-installed 2>/dev/null; do
  echo "  Waiting for WordPress to initialize..."
  sleep 5
done || true

# Check if WordPress is already installed
if docker exec glory-wp wp --allow-root core is-installed 2>/dev/null; then
  echo "  WordPress already installed. Skipping installation."
else
  # Step 3: Install WordPress
  echo "[3/6] Installing WordPress..."
  docker exec glory-wp wp --allow-root core install \
    --url="${WP_URL}" \
    --title="${WP_TITLE}" \
    --admin_user="${WP_ADMIN_USER}" \
    --admin_password="${WP_ADMIN_PASSWORD}" \
    --admin_email="${WP_ADMIN_EMAIL}" \
    --locale=zh_TW \
    --skip-email
fi

# Step 4: Configure WordPress settings
echo "[4/6] Configuring WordPress settings..."
docker exec glory-wp wp --allow-root option update timezone_string "Asia/Taipei"
docker exec glory-wp wp --allow-root option update date_format "Y年n月j日"
docker exec glory-wp wp --allow-root option update time_format "H:i"
docker exec glory-wp wp --allow-root option update blog_public 0  # No indexing in dev
docker exec glory-wp wp --allow-root option update permalink_structure "/%postname%/"
docker exec glory-wp wp --allow-root rewrite flush

# Step 5: Install and activate plugins
echo "[5/6] Installing plugins..."

PLUGINS=(
  "generatepress"
  "the-events-calendar"
  "give"
  "download-manager"
  "wordfence"
  "updraftplus"
  "wordpress-seo"
  "wpforms-lite"
  "redirection"
  "members"
  "polylang"
)

for plugin in "${PLUGINS[@]}"; do
  if docker exec glory-wp wp --allow-root plugin is-installed "$plugin" 2>/dev/null; then
    echo "  $plugin already installed, activating..."
    docker exec glory-wp wp --allow-root plugin activate "$plugin" 2>/dev/null || true
  else
    echo "  Installing $plugin..."
    docker exec glory-wp wp --allow-root plugin install "$plugin" --activate || {
      echo "  Warning: Failed to install $plugin (may require premium license)"
    }
  fi
done

# Step 6: Activate theme
echo "[6/6] Activating Glory theme..."
docker exec glory-wp wp --allow-root theme activate glory-theme 2>/dev/null || {
  echo "  Note: glory-theme not found. Make sure it's mounted in docker-compose.yml"
  echo "  Activating GeneratePress as fallback..."
  docker exec glory-wp wp --allow-root theme activate generatepress 2>/dev/null || true
}

# Remove default themes and plugins
echo ""
echo "Cleaning up defaults..."
docker exec glory-wp wp --allow-root plugin deactivate hello 2>/dev/null || true
docker exec glory-wp wp --allow-root plugin delete hello 2>/dev/null || true
docker exec glory-wp wp --allow-root plugin delete akismet 2>/dev/null || true

echo ""
echo "=== Setup Complete ==="
echo ""
echo "WordPress:   ${WP_URL}"
echo "Admin:       ${WP_URL}/wp-admin"
echo "phpMyAdmin:  http://localhost:${PMA_PORT}"
echo "Mailhog:     http://localhost:${MAILHOG_UI_PORT}"
echo ""
echo "Admin user:  ${WP_ADMIN_USER}"
echo "Admin pass:  ${WP_ADMIN_PASSWORD}"
