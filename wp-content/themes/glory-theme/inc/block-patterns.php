<?php
/**
 * Block Patterns Registration
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

function glory_register_block_patterns(): void {
    // Register pattern category
    register_block_pattern_category('glory', [
        'label' => __('得榮基金會', 'glory-theme'),
    ]);

    // Load all pattern files
    $pattern_dir = GLORY_THEME_DIR . '/block-patterns';
    $patterns = glob($pattern_dir . '/*.php');

    foreach ($patterns as $pattern_file) {
        $pattern = require $pattern_file;
        if (is_array($pattern) && isset($pattern['slug'], $pattern['content'])) {
            register_block_pattern('glory/' . $pattern['slug'], [
                'title'       => $pattern['title'] ?? $pattern['slug'],
                'description' => $pattern['description'] ?? '',
                'content'     => $pattern['content'],
                'categories'  => array_merge(['glory'], $pattern['categories'] ?? []),
                'keywords'    => $pattern['keywords'] ?? [],
            ]);
        }
    }
}
add_action('init', 'glory_register_block_patterns');
