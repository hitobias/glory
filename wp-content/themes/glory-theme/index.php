<?php
/**
 * Blog Index / Archive Fallback
 * Mobile-first post listing
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-12 md:py-16">
        <div class="container-content text-center">
            <h1 class="text-h2 md:text-h1 text-white mb-2">最新消息</h1>
            <p class="text-white/70 text-body-sm md:text-body">了解我們最近的活動、報導與公告</p>
        </div>
    </section>

    <section class="section bg-warm-50">
        <div class="container-content">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card group">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-[16/10]">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class'   => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-[16/10] bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                                    <?php echo glory_get_icon('book', 'w-10 h-10 text-primary-300'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <?php
                                $cats = get_the_category();
                                if (!empty($cats)) :
                                ?>
                                    <span class="badge-primary mb-2"><?php echo esc_html($cats[0]->name); ?></span>
                                <?php endif; ?>

                                <h2 class="text-body md:text-h4 mb-2 leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline transition-colors">
                                        <?php echo esc_html(glory_truncate(get_the_title(), 40)); ?>
                                    </a>
                                </h2>

                                <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="text-xs text-dark-400">
                                    <?php echo esc_html(glory_post_date()); ?>
                                </time>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-10 md:mt-12" aria-label="文章分頁">
                    <div class="flex justify-center">
                        <?php the_posts_pagination([
                            'prev_text' => '&laquo; 上一頁',
                            'next_text' => '下一頁 &raquo;',
                            'mid_size'  => 1,
                            'class'     => 'pagination',
                        ]); ?>
                    </div>
                </nav>
            <?php else : ?>
                <div class="text-center py-16">
                    <p class="text-dark-400 text-body-lg mb-6">目前沒有文章。</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">回到首頁</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
