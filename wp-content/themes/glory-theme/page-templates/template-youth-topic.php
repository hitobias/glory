<?php
/**
 * Template Name: 得榮少年專題
 * Used for: 得榮少年專題 (Page ID: 8946)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$youth_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'cat'            => 15,
    'posts_per_page' => 12,
    'paged'          => $paged,
]);
?>

<main id="main-content" class="site-main">

    <!-- Hero -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-14 md:py-20">
        <div class="container-content text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-6" data-animate="scale">
                <?php echo glory_get_icon('users', 'w-8 h-8 text-white'); ?>
            </div>
            <h1 class="text-h2 md:text-h1 text-white mb-4" data-animate="fade-up">得榮少年專題</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto" data-animate="fade-up">
                得榮基金會青少年關懷專題報導
            </p>
        </div>
    </section>

    <!-- Post Grid -->
    <section class="section">
        <div class="container-content">

            <?php if ($youth_query->have_posts()) : ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8" data-stagger>
                    <?php while ($youth_query->have_posts()) : $youth_query->the_post(); ?>
                        <article <?php post_class('card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class'   => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <div class="w-full h-48 bg-accent-green-100 flex items-center justify-center">
                                        <?php echo glory_get_icon('users', 'w-10 h-10 text-accent-green/40'); ?>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="badge-green">得榮少年</span>
                                    <time
                                        datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"
                                        class="text-xs text-dark-400"
                                    >
                                        <?php echo esc_html(glory_post_date()); ?>
                                    </time>
                                </div>

                                <h3 class="text-h4 mb-2 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-accent-green no-underline transition-colors">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h3>

                                <p class="text-body-sm text-dark-400 mb-4 line-clamp-3">
                                    <?php echo esc_html(glory_truncate(get_the_excerpt(), 80)); ?>
                                </p>

                                <a href="<?php the_permalink(); ?>" class="text-accent-green font-medium hover:text-accent-green-700 no-underline inline-flex items-center gap-1 text-body-sm">
                                    閱讀更多
                                    <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-12" aria-label="<?php esc_attr_e('專題文章分頁', 'glory-theme'); ?>">
                    <?php
                    the_posts_pagination([
                        'total'     => $youth_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '&laquo; 上一頁',
                        'next_text' => '下一頁 &raquo;',
                        'mid_size'  => 2,
                    ]);
                    ?>
                </nav>

            <?php else : ?>

                <div class="text-center py-16" data-animate="fade-up">
                    <div class="w-20 h-20 rounded-full bg-accent-green-100 flex items-center justify-center mx-auto mb-6">
                        <?php echo glory_get_icon('users', 'w-10 h-10 text-accent-green/40'); ?>
                    </div>
                    <h2 class="text-h3 mb-3">目前沒有相關文章</h2>
                    <p class="text-dark-400 text-body-lg mb-6">得榮少年專題報導即將上線，敬請期待。</p>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-primary">
                        瀏覽最新消息
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>

            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- Related CTA -->
    <section class="section bg-accent-green/5 border-t border-accent-green/10">
        <div class="container-content" data-animate="fade-up">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-h3 md:text-h2 mb-4">關懷得榮少年</h2>
                <p class="text-dark-500 text-body md:text-body-lg mb-8">
                    透過獎助學金及志工關懷，幫助家庭遭遇變故的青少年完成學業、重建信心。您的支持是他們最大的力量。
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo esc_url(home_url('/youths/')); ?>" class="btn-primary">
                        了解得榮少年
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/關懷與捐款-2/')); ?>" class="btn-outline">
                        <?php echo glory_get_icon('heart', 'w-4 h-4'); ?>
                        支持捐款
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
