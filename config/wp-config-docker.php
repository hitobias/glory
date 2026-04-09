<?php
/**
 * Glory Foundation - Docker WordPress Configuration
 *
 * Security-hardened settings for the Docker development environment.
 * This file is mounted read-only into the container.
 */

// Disable file editing from admin panel
define('DISALLOW_FILE_EDIT', true);

// Force SSL in admin (enable in production)
// define('FORCE_SSL_ADMIN', true);

// Limit post revisions
define('WP_POST_REVISIONS', 5);

// Auto-save interval (seconds)
define('AUTOSAVE_INTERVAL', 120);

// Empty trash after 14 days
define('EMPTY_TRASH_DAYS', 14);

// Disable WordPress cron (use system cron in production)
// define('DISABLE_WP_CRON', true);

// Memory limits
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Cookie settings
define('COOKIE_DOMAIN', false);
define('COOKIEPATH', '/');

// Disable XML-RPC (security measure)
add_filter('xmlrpc_enabled', '__return_false');
