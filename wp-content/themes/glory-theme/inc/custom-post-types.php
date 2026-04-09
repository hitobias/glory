<?php
/**
 * Custom Post Types
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

function glory_register_post_types(): void {
    // 課程計畫
    register_post_type('glory_program', [
        'labels' => [
            'name'               => __('課程計畫', 'glory-theme'),
            'singular_name'      => __('課程計畫', 'glory-theme'),
            'add_new'            => __('新增課程', 'glory-theme'),
            'add_new_item'       => __('新增課程計畫', 'glory-theme'),
            'edit_item'          => __('編輯課程計畫', 'glory-theme'),
            'view_item'          => __('檢視課程計畫', 'glory-theme'),
            'search_items'       => __('搜尋課程計畫', 'glory-theme'),
            'not_found'          => __('找不到課程計畫', 'glory-theme'),
            'not_found_in_trash' => __('回收桶中找不到課程計畫', 'glory-theme'),
            'all_items'          => __('所有課程計畫', 'glory-theme'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'programs', 'with_front' => false],
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 5,
        'capability_type'    => 'post',
    ]);

    // 出版品
    register_post_type('glory_publication', [
        'labels' => [
            'name'               => __('出版品', 'glory-theme'),
            'singular_name'      => __('出版品', 'glory-theme'),
            'add_new'            => __('新增出版品', 'glory-theme'),
            'add_new_item'       => __('新增出版品', 'glory-theme'),
            'edit_item'          => __('編輯出版品', 'glory-theme'),
            'view_item'          => __('檢視出版品', 'glory-theme'),
            'search_items'       => __('搜尋出版品', 'glory-theme'),
            'not_found'          => __('找不到出版品', 'glory-theme'),
            'not_found_in_trash' => __('回收桶中找不到出版品', 'glory-theme'),
            'all_items'          => __('所有出版品', 'glory-theme'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'publications', 'with_front' => false],
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 6,
        'capability_type'    => 'post',
    ]);

    // 回饋見證
    register_post_type('glory_testimonial', [
        'labels' => [
            'name'               => __('回饋見證', 'glory-theme'),
            'singular_name'      => __('回饋見證', 'glory-theme'),
            'add_new'            => __('新增見證', 'glory-theme'),
            'add_new_item'       => __('新增回饋見證', 'glory-theme'),
            'edit_item'          => __('編輯回饋見證', 'glory-theme'),
            'view_item'          => __('檢視回饋見證', 'glory-theme'),
            'search_items'       => __('搜尋回饋見證', 'glory-theme'),
            'not_found'          => __('找不到回饋見證', 'glory-theme'),
            'not_found_in_trash' => __('回收桶中找不到回饋見證', 'glory-theme'),
            'all_items'          => __('所有回饋見證', 'glory-theme'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'testimonials', 'with_front' => false],
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 7,
        'capability_type'    => 'post',
    ]);

    // 行事曆活動
    register_post_type('glory_event', [
        'labels' => [
            'name'               => __('行事曆', 'glory-theme'),
            'singular_name'      => __('活動', 'glory-theme'),
            'add_new'            => __('新增活動', 'glory-theme'),
            'add_new_item'       => __('新增活動', 'glory-theme'),
            'edit_item'          => __('編輯活動', 'glory-theme'),
            'view_item'          => __('檢視活動', 'glory-theme'),
            'search_items'       => __('搜尋活動', 'glory-theme'),
            'not_found'          => __('找不到活動', 'glory-theme'),
            'not_found_in_trash' => __('回收桶中找不到活動', 'glory-theme'),
            'all_items'          => __('所有活動', 'glory-theme'),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => false,
        'rewrite'            => false,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => ['title'],
        'show_in_rest'       => true,
        'menu_position'      => 9,
        'capability_type'    => 'post',
    ]);

    // 志工資源
    register_post_type('glory_volunteer_resource', [
        'labels' => [
            'name'               => __('志工資源', 'glory-theme'),
            'singular_name'      => __('志工資源', 'glory-theme'),
            'add_new'            => __('新增資源', 'glory-theme'),
            'add_new_item'       => __('新增志工資源', 'glory-theme'),
            'edit_item'          => __('編輯志工資源', 'glory-theme'),
            'view_item'          => __('檢視志工資源', 'glory-theme'),
            'search_items'       => __('搜尋志工資源', 'glory-theme'),
            'not_found'          => __('找不到志工資源', 'glory-theme'),
            'not_found_in_trash' => __('回收桶中找不到志工資源', 'glory-theme'),
            'all_items'          => __('所有志工資源', 'glory-theme'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'volunteer-resources', 'with_front' => false],
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 8,
        'capability_type'    => 'post',
    ]);
}
add_action('init', 'glory_register_post_types');

/**
 * Restrict volunteer resources to logged-in users with appropriate role
 */
function glory_restrict_volunteer_resources(): void {
    if (!is_singular('glory_volunteer_resource') && !is_post_type_archive('glory_volunteer_resource')) {
        return;
    }

    if (!glory_can_access_volunteer_area()) {
        wp_safe_redirect(wp_login_url(get_permalink()));
        exit;
    }
}
add_action('template_redirect', 'glory_restrict_volunteer_resources');

/**
 * Flush rewrite rules on theme activation
 */
function glory_flush_rewrite_rules(): void {
    glory_register_post_types();
    glory_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'glory_flush_rewrite_rules');

/* ======================================================================
   行事曆活動 — Meta Box (event date)
   ====================================================================== */

/**
 * Register event date meta box
 */
function glory_event_meta_boxes(): void {
    add_meta_box(
        'glory_event_date_box',
        __('活動日期', 'glory-theme'),
        'glory_event_date_render',
        'glory_event',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'glory_event_meta_boxes');

/**
 * Render date picker field
 */
function glory_event_date_render(\WP_Post $post): void {
    $date = get_post_meta($post->ID, '_glory_event_date', true);
    wp_nonce_field('glory_event_date_nonce', '_glory_event_date_nonce');
    ?>
    <p>
        <label for="glory_event_date" style="display:block;margin-bottom:4px;font-weight:600;">
            <?php esc_html_e('日期 (YYYY-MM-DD)', 'glory-theme'); ?>
        </label>
        <input
            type="date"
            id="glory_event_date"
            name="glory_event_date"
            value="<?php echo esc_attr($date); ?>"
            style="width:100%;"
            required
        />
    </p>
    <p class="description"><?php esc_html_e('選擇此活動的日期，例如 2025-03-15', 'glory-theme'); ?></p>
    <?php
}

/**
 * Save event date meta
 */
function glory_event_date_save(int $post_id): void {
    if (!isset($_POST['_glory_event_date_nonce'])) {
        return;
    }
    if (!wp_verify_nonce(sanitize_text_field($_POST['_glory_event_date_nonce']), 'glory_event_date_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['glory_event_date'])) {
        $date = sanitize_text_field($_POST['glory_event_date']);
        // Validate YYYY-MM-DD format
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            update_post_meta($post_id, '_glory_event_date', $date);
        }
    }
}
add_action('save_post_glory_event', 'glory_event_date_save');

/**
 * Add date column to admin list table
 */
function glory_event_admin_columns(array $columns): array {
    $new = [];
    foreach ($columns as $key => $label) {
        $new[$key] = $label;
        if ($key === 'title') {
            $new['event_date'] = __('活動日期', 'glory-theme');
        }
    }
    return $new;
}
add_filter('manage_glory_event_posts_columns', 'glory_event_admin_columns');

/**
 * Render date column value
 */
function glory_event_admin_column_content(string $column, int $post_id): void {
    if ($column === 'event_date') {
        $date = get_post_meta($post_id, '_glory_event_date', true);
        echo $date ? esc_html($date) : '—';
    }
}
add_action('manage_glory_event_posts_custom_column', 'glory_event_admin_column_content', 10, 2);

/**
 * Make date column sortable
 */
function glory_event_sortable_columns(array $columns): array {
    $columns['event_date'] = 'event_date';
    return $columns;
}
add_filter('manage_edit-glory_event_sortable_columns', 'glory_event_sortable_columns');

/**
 * Handle sorting by event date
 */
function glory_event_sort_by_date(\WP_Query $query): void {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->get('post_type') !== 'glory_event') {
        return;
    }
    $orderby = $query->get('orderby');
    if ($orderby === 'event_date' || $orderby === '') {
        $query->set('meta_key', '_glory_event_date');
        $query->set('orderby', 'meta_value');
        if ($orderby === '') {
            $query->set('order', 'DESC');
        }
    }
}
add_action('pre_get_posts', 'glory_event_sort_by_date');
