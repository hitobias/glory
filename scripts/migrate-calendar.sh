#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
PHP_SCRIPT="$SCRIPT_DIR/migrate-calendar.php"
CONTAINER="glory-wp"
CONTAINER_SCRIPT="/tmp/migrate-calendar.php"

source "$PROJECT_DIR/.env"

echo "=== Qubely Calendar → glory_event CPT Migration ==="
echo ""

# Check container is running
if ! docker ps --format '{{.Names}}' | grep -q "^${CONTAINER}$"; then
    echo "ERROR: Container '${CONTAINER}' is not running."
    echo "  Run: docker compose up -d"
    exit 1
fi

# Copy the PHP script into the container
docker cp "$PHP_SCRIPT" "${CONTAINER}:${CONTAINER_SCRIPT}"

# Pass through --dry-run flag if provided
EXTRA_ARGS=""
if [[ "${1:-}" == "--dry-run" ]]; then
    EXTRA_ARGS="-- --dry-run"
    echo "Mode: DRY RUN (no changes will be made)"
else
    echo "Mode: LIVE (events will be created)"
fi
echo ""

# Run the migration
docker exec "$CONTAINER" wp --allow-root eval-file "$CONTAINER_SCRIPT" $EXTRA_ARGS

# Clean up
docker exec "$CONTAINER" rm -f "$CONTAINER_SCRIPT"

echo ""
echo "To verify, visit: ${WP_URL:-http://localhost:8080}/wp-admin/edit.php?post_type=glory_event"
