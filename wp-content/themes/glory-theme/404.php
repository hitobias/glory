<?php
/**
 * 404 Page Template
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <section class="section">
        <div class="container-content text-center max-w-xl mx-auto py-16">
            <p class="text-8xl font-bold text-primary-200 mb-6">404</p>
            <h1 class="text-h2 mb-4">找不到此頁面</h1>
            <p class="text-dark-400 text-body-lg mb-10">
                很抱歉，您要找的頁面不存在或已被移動。
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">回到首頁</a>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn-outline">瀏覽文章</a>
            </div>

            <div class="mt-12">
                <?php get_search_form(); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
