<?php
/**
 * Glory Foundation Theme - Functions
 *
 * Module loader for the glory-theme child theme.
 * Each module is a focused file in the inc/ directory.
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

define('GLORY_THEME_VERSION', '1.0.0');
define('GLORY_THEME_DIR', get_stylesheet_directory());
define('GLORY_THEME_URI', get_stylesheet_directory_uri());

// Core modules
$glory_modules = [
    'inc/enqueue.php',            // CSS/JS loading
    'inc/custom-post-types.php',  // CPT registration
    'inc/custom-taxonomies.php',  // Taxonomy registration
    'inc/block-patterns.php',     // Gutenberg block patterns
    'inc/security.php',           // Security hardening
    'inc/helpers.php',            // Utility functions
];

foreach ($glory_modules as $module) {
    $module_path = GLORY_THEME_DIR . '/' . $module;
    if (file_exists($module_path)) {
        require_once $module_path;
    }
}

/**
 * Theme setup - runs after parent theme setup
 */
function glory_theme_setup(): void {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Custom image sizes
    add_image_size('glory-hero', 1920, 800, true);
    add_image_size('glory-card', 640, 400, true);
    add_image_size('glory-thumbnail', 300, 200, true);

    // Register navigation menus
    register_nav_menus([
        'primary'   => __('主選單', 'glory-theme'),
        'footer'    => __('頁尾選單', 'glory-theme'),
        'mobile'    => __('行動裝置選單', 'glory-theme'),
    ]);

    // Load text domain
    load_child_theme_textdomain('glory-theme', GLORY_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'glory_theme_setup');

/**
 * Register widget areas
 */
function glory_widgets_init(): void {
    register_sidebar([
        'name'          => __('部落格側邊欄', 'glory-theme'),
        'id'            => 'blog-sidebar',
        'description'   => __('顯示在部落格頁面的側邊欄', 'glory-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-bold text-dark mb-4">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('頁尾欄位 1', 'glory-theme'),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-base font-semibold text-white mb-3">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('頁尾欄位 2', 'glory-theme'),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-base font-semibold text-white mb-3">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('頁尾欄位 3', 'glory-theme'),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-base font-semibold text-white mb-3">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'glory_widgets_init');

/**
 * Register fallback shortcode handlers for old plugins (Qubely, VC, etc.)
 * These return the inner content so pages render cleanly without the plugins.
 */
function glory_register_fallback_shortcodes(): void {
    $passthrough = [
        'vc_row', 'vc_column', 'vc_column_text', 'vc_row_inner', 'vc_column_inner',
        'vc_section', 'vc_basic_grid', 'vc_media_grid', 'vc_masonry_grid',
        'vc_separator', 'vc_empty_space', 'vc_tta_tabs', 'vc_tta_section',
        'vc_tta_accordion', 'vc_tour', 'vc_toggle',
    ];

    foreach ($passthrough as $tag) {
        if (!shortcode_exists($tag)) {
            add_shortcode($tag, function ($atts, $content = '') {
                return do_shortcode((string) $content);
            });
        }
    }

    // vc_video → render as responsive YouTube/Vimeo embed
    if (!shortcode_exists('vc_video')) {
        add_shortcode('vc_video', function ($atts) {
            $atts = shortcode_atts(['link' => ''], $atts);
            if (empty($atts['link'])) {
                return '';
            }
            return '<div class="aspect-video rounded-xl overflow-hidden my-4">' . wp_oembed_get($atts['link']) . '</div>';
        });
    }

    // Strip these shortcodes entirely (output nothing)
    $strip = ['envira-gallery', 'custom-facebook-feed', 'wordpress_file_upload_browser'];
    foreach ($strip as $tag) {
        if (!shortcode_exists($tag)) {
            add_shortcode($tag, '__return_empty_string');
        }
    }
}
add_action('init', 'glory_register_fallback_shortcodes');

/**
 * Rewrite image URLs: replace old glory.org.tw URLs with local,
 * and fix broken localhost references in the_content.
 */
function glory_fix_content_image_urls(string $content): string {
    // Replace any remaining references to glory.org.tw with local
    $content = str_replace(
        'https://www.glory.org.tw/wp-content/uploads/',
        home_url('/wp-content/uploads/'),
        $content
    );
    $content = str_replace(
        'http://www.glory.org.tw/wp-content/uploads/',
        home_url('/wp-content/uploads/'),
        $content
    );

    // Fix lazy-load data-src patterns (old theme used lazyload)
    $content = preg_replace(
        '/(<img[^>]*?)src="data:image\/gif[^"]*"([^>]*?)data-src="([^"]*)"/',
        '$1src="$3"$2',
        $content
    );

    return $content;
}
add_filter('the_content', 'glory_fix_content_image_urls', 5);

/**
 * Custom favicon from theme assets (overrides WP site icon)
 */
function glory_custom_favicon(): void {
    $favicon_url = GLORY_THEME_URI . '/assets/images/favicon.png';
    echo '<link rel="icon" href="' . esc_url($favicon_url) . '" sizes="32x32" />' . "\n";
    echo '<link rel="icon" href="' . esc_url($favicon_url) . '" sizes="192x192" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_url) . '" />' . "\n";
}
add_action('wp_head', 'glory_custom_favicon', 1);

/**
 * Remove default WP site icon to avoid duplicates
 */
remove_action('wp_head', 'wp_site_icon', 99);

/**
 * Force full-width layout — remove GP's sidebar body classes
 * GP adds 'right-sidebar', 'separate-containers' etc. which cause
 * content-area: 70% and white gaps on the right side.
 */
function glory_force_fullwidth_body_class(array $classes): array {
    $remove = [
        'right-sidebar',
        'left-sidebar',
        'both-sidebars',
        'separate-containers',
    ];
    $classes = array_diff($classes, $remove);
    $classes[] = 'no-sidebar';
    $classes[] = 'full-width-content';
    $classes[] = 'one-container';
    return $classes;
}
add_filter('body_class', 'glory_force_fullwidth_body_class', 999);
