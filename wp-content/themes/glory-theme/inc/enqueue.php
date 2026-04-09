<?php
/**
 * Enqueue styles and scripts
 *
 * Handles loading Vite-built assets in production and Vite dev server in development.
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

/**
 * Check if Vite dev server is running
 */
function glory_is_vite_dev(): bool {
    if (defined('WP_ENV') && WP_ENV === 'production') {
        return false;
    }

    $dev_server = 'http://localhost:5173';
    $response = @file_get_contents($dev_server . '/@vite/client');
    return $response !== false;
}

/**
 * Get Vite manifest
 */
function glory_get_vite_manifest(): array {
    $manifest_path = GLORY_THEME_DIR . '/dist/.vite/manifest.json';
    if (!file_exists($manifest_path)) {
        return [];
    }

    $manifest = file_get_contents($manifest_path);
    return json_decode($manifest, true) ?: [];
}

/**
 * Enqueue frontend styles and scripts
 */
function glory_enqueue_assets(): void {
    // Google Fonts - Noto Sans TC
    wp_enqueue_style(
        'glory-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    if (glory_is_vite_dev()) {
        // Development: load from Vite dev server
        // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
        wp_enqueue_script(
            'vite-client',
            'http://localhost:5173/@vite/client',
            [],
            null,
            false
        );
        // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
        wp_enqueue_script(
            'glory-main',
            'http://localhost:5173/src/main.js',
            [],
            null,
            true
        );
    } else {
        // Production: load from built manifest
        $manifest = glory_get_vite_manifest();

        if (isset($manifest['src/main.js'])) {
            $entry = $manifest['src/main.js'];

            // Enqueue CSS files
            if (isset($entry['css'])) {
                foreach ($entry['css'] as $index => $css_file) {
                    wp_enqueue_style(
                        'glory-main-' . $index,
                        GLORY_THEME_URI . '/dist/' . $css_file,
                        ['glory-google-fonts'],
                        GLORY_THEME_VERSION
                    );
                }
            }

            // Enqueue JS
            wp_enqueue_script(
                'glory-main',
                GLORY_THEME_URI . '/dist/' . $entry['file'],
                [],
                GLORY_THEME_VERSION,
                true
            );
        }
    }

    // Parent theme style
    wp_enqueue_style(
        'generatepress-style',
        get_template_directory_uri() . '/style.css',
        [],
        GLORY_THEME_VERSION
    );
}
add_action('wp_enqueue_scripts', 'glory_enqueue_assets');

/**
 * Add type="module" to Vite script tags
 */
function glory_script_type_module(string $tag, string $handle, string $src): string {
    if (in_array($handle, ['vite-client', 'glory-main'], true)) {
        return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'glory_script_type_module', 10, 3);

/**
 * Enqueue editor styles
 */
function glory_enqueue_editor_assets(): void {
    // Google Fonts in editor
    wp_enqueue_style(
        'glory-editor-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    $manifest = glory_get_vite_manifest();
    if (isset($manifest['src/editor.js']['css'])) {
        foreach ($manifest['src/editor.js']['css'] as $index => $css_file) {
            wp_enqueue_style(
                'glory-editor-' . $index,
                GLORY_THEME_URI . '/dist/' . $css_file,
                ['glory-editor-fonts'],
                GLORY_THEME_VERSION
            );
        }
    }
}
add_action('enqueue_block_editor_assets', 'glory_enqueue_editor_assets');

/**
 * Preload Google Fonts
 */
function glory_preload_fonts(): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'glory_preload_fonts', 1);
