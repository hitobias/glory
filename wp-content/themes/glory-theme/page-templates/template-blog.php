<?php
/**
 * Template Name: 部落格
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$blog_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
]);
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-16 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-3">最新消息</h1>
            <p class="text-body-lg text-white/80">關注得榮基金會的最新活動、公告與故事分享</p>
        </div>
    </section>

    <section class="section">
        <div class="container-content">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <?php if ($blog_query->have_posts()) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <?php
                            while ($blog_query->have_posts()) :
                                $blog_query->the_post();
                                get_template_part('template-parts/content/content', 'card');
                            endwhile;
                            ?>
                        </div>

                        <!-- Pagination -->
                        <nav class="mt-12" aria-label="<?php esc_attr_e('文章分頁', 'glory-theme'); ?>">
                            <div class="flex justify-center gap-2">
                                <?php
                                echo paginate_links([
                                    'total'     => $blog_query->max_num_pages,
                                    'current'   => $paged,
                                    'prev_text' => '&laquo; 上一頁',
                                    'next_text' => '下一頁 &raquo;',
                                    'type'      => 'list',
                                ]);
                                ?>
                            </div>
                        </nav>
                    <?php else : ?>
                        <div class="text-center py-16">
                            <p class="text-dark-400 text-body-lg">目前沒有文章。</p>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <?php if (is_active_sidebar('blog-sidebar')) : ?>
                        <?php dynamic_sidebar('blog-sidebar'); ?>
                    <?php else : ?>
                        <!-- Search -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-dark mb-4">搜尋</h3>
                            <?php get_search_form(); ?>
                        </div>

                        <!-- Categories -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-dark mb-4">文章分類</h3>
                            <ul class="list-none p-0 space-y-2">
                                <?php
                                wp_list_categories([
                                    'title_li'  => '',
                                    'show_count' => true,
                                ]);
                                ?>
                            </ul>
                        </div>

                        <!-- Recent Posts -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-dark mb-4">近期文章</h3>
                            <ul class="list-none p-0 space-y-3">
                                <?php
                                $recent = new WP_Query(['posts_per_page' => 5, 'post_status' => 'publish']);
                                while ($recent->have_posts()) :
                                    $recent->the_post();
                                ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="text-dark-500 hover:text-primary-500 no-underline text-body-sm">
                                            <?php the_title(); ?>
                                        </a>
                                        <span class="block text-dark-400 text-xs mt-0.5"><?php echo esc_html(glory_post_date()); ?></span>
                                    </li>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
