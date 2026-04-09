<?php
/**
 * Custom Taxonomies
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

function glory_register_taxonomies(): void {
    // 課程類型
    register_taxonomy('program_type', ['glory_program'], [
        'labels' => [
            'name'          => __('課程類型', 'glory-theme'),
            'singular_name' => __('課程類型', 'glory-theme'),
            'search_items'  => __('搜尋課程類型', 'glory-theme'),
            'all_items'     => __('所有課程類型', 'glory-theme'),
            'edit_item'     => __('編輯課程類型', 'glory-theme'),
            'add_new_item'  => __('新增課程類型', 'glory-theme'),
            'new_item_name' => __('新課程類型名稱', 'glory-theme'),
            'menu_name'     => __('課程類型', 'glory-theme'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'program-type', 'with_front' => false],
    ]);

    // 對象
    register_taxonomy('program_target', ['glory_program'], [
        'labels' => [
            'name'          => __('適用對象', 'glory-theme'),
            'singular_name' => __('適用對象', 'glory-theme'),
            'search_items'  => __('搜尋適用對象', 'glory-theme'),
            'all_items'     => __('所有適用對象', 'glory-theme'),
            'edit_item'     => __('編輯適用對象', 'glory-theme'),
            'add_new_item'  => __('新增適用對象', 'glory-theme'),
            'new_item_name' => __('新適用對象名稱', 'glory-theme'),
            'menu_name'     => __('適用對象', 'glory-theme'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'program-target', 'with_front' => false],
    ]);

    // 見證類型
    register_taxonomy('testimonial_type', ['glory_testimonial'], [
        'labels' => [
            'name'          => __('見證類型', 'glory-theme'),
            'singular_name' => __('見證類型', 'glory-theme'),
            'search_items'  => __('搜尋見證類型', 'glory-theme'),
            'all_items'     => __('所有見證類型', 'glory-theme'),
            'edit_item'     => __('編輯見證類型', 'glory-theme'),
            'add_new_item'  => __('新增見證類型', 'glory-theme'),
            'new_item_name' => __('新見證類型名稱', 'glory-theme'),
            'menu_name'     => __('見證類型', 'glory-theme'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'testimonial-type', 'with_front' => false],
    ]);

    // 出版品類型
    register_taxonomy('publication_type', ['glory_publication'], [
        'labels' => [
            'name'          => __('出版品類型', 'glory-theme'),
            'singular_name' => __('出版品類型', 'glory-theme'),
            'search_items'  => __('搜尋出版品類型', 'glory-theme'),
            'all_items'     => __('所有出版品類型', 'glory-theme'),
            'edit_item'     => __('編輯出版品類型', 'glory-theme'),
            'add_new_item'  => __('新增出版品類型', 'glory-theme'),
            'new_item_name' => __('新出版品類型名稱', 'glory-theme'),
            'menu_name'     => __('出版品類型', 'glory-theme'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'publication-type', 'with_front' => false],
    ]);

    // 資源類型
    register_taxonomy('resource_type', ['glory_volunteer_resource'], [
        'labels' => [
            'name'          => __('資源類型', 'glory-theme'),
            'singular_name' => __('資源類型', 'glory-theme'),
            'search_items'  => __('搜尋資源類型', 'glory-theme'),
            'all_items'     => __('所有資源類型', 'glory-theme'),
            'edit_item'     => __('編輯資源類型', 'glory-theme'),
            'add_new_item'  => __('新增資源類型', 'glory-theme'),
            'new_item_name' => __('新資源類型名稱', 'glory-theme'),
            'menu_name'     => __('資源類型', 'glory-theme'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'resource-type', 'with_front' => false],
    ]);
}
add_action('init', 'glory_register_taxonomies');

/**
 * Pre-populate default taxonomy terms on theme activation
 */
function glory_insert_default_terms(): void {
    $defaults = [
        'program_type' => ['生命教育', '快樂學習', '合唱團', '得榮少年'],
        'program_target' => ['國小', '國中', '高中', '大學', '志工'],
        'testimonial_type' => ['學生', '家長', '志工', '教師'],
        'publication_type' => ['書籍', '月刊', '電子報', '教材'],
        'resource_type' => ['教案', '培訓教材', '活動手冊'],
    ];

    foreach ($defaults as $taxonomy => $terms) {
        foreach ($terms as $term) {
            if (!term_exists($term, $taxonomy)) {
                wp_insert_term($term, $taxonomy);
            }
        }
    }
}
add_action('after_switch_theme', 'glory_insert_default_terms');
