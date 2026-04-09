<?php
/**
 * Custom Search Form
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;
?>

<form role="search" method="get" class="search-form flex gap-2" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field"><?php esc_html_e('搜尋', 'glory-theme'); ?></label>
    <input
        type="search"
        id="search-field"
        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-body-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
        placeholder="<?php esc_attr_e('輸入關鍵字搜尋...', 'glory-theme'); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
    >
    <button type="submit" class="btn-primary px-6">
        <?php esc_html_e('搜尋', 'glory-theme'); ?>
    </button>
</form>
