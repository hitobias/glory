<?php
/**
 * Security hardening
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

/**
 * Remove WordPress version from head and feeds
 */
remove_action('wp_head', 'wp_generator');

function glory_remove_version_strings(string $src): string {
    if (strpos($src, 'ver=') !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'glory_remove_version_strings', 9999);
add_filter('script_loader_src', 'glory_remove_version_strings', 9999);

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

function glory_remove_xmlrpc_methods(array $methods): array {
    return [];
}
add_filter('xmlrpc_methods', 'glory_remove_xmlrpc_methods');

/**
 * Remove unnecessary head links
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'feed_links_extra', 3);

/**
 * Disable REST API user enumeration for non-authenticated users
 */
function glory_restrict_rest_api_users(array $endpoints): array {
    if (!is_user_logged_in()) {
        unset($endpoints['/wp/v2/users']);
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
}
add_filter('rest_endpoints', 'glory_restrict_rest_api_users');

/**
 * Disable author archives (prevent user enumeration)
 */
function glory_disable_author_archives(): void {
    if (is_author()) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'glory_disable_author_archives');

/**
 * Limit login attempts error messages
 */
function glory_login_error_message(): string {
    return __('登入資訊不正確，請重試。', 'glory-theme');
}
add_filter('login_errors', 'glory_login_error_message');

/**
 * Add security headers
 */
function glory_security_headers(array $headers): array {
    $headers['X-Content-Type-Options'] = 'nosniff';
    $headers['X-Frame-Options'] = 'SAMEORIGIN';
    $headers['X-XSS-Protection'] = '1; mode=block';
    $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
    $headers['Permissions-Policy'] = 'camera=(), microphone=(), geolocation=()';
    return $headers;
}
add_filter('wp_headers', 'glory_security_headers');

/**
 * Disable file editing from admin
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}
