<?php
/**
 * Search Results Template
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Header -->
    <section class="bg-gray-50 py-12">
        <div class="container-content text-center">
            <h1 class="text-h2 mb-4">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__('「%s」的搜尋結果', 'glory-theme'),
                    '<span class="text-primary-500">' . esc_html(get_search_query()) . '</span>'
                );
                ?>
            </h1>
            <p class="text-dark-400">
                <?php
                printf(
                    /* translators: %d: number of results */
                    esc_html__('找到 %d 筆結果', 'glory-theme'),
                    (int) $wp_query->found_posts
                );
                ?>
            </p>
            <div class="max-w-lg mx-auto mt-6">
                <?php get_search_form(); ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-content max-w-4xl">
            <?php if (have_posts()) : ?>
                <div class="space-y-6">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card p-6 flex gap-6">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="flex-shrink-0 hidden sm:block">
                                    <?php the_post_thumbnail('glory-thumbnail', [
                                        'class' => 'w-32 h-24 object-cover rounded-lg',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php endif; ?>
                            <div>
                                <span class="text-xs text-primary-500 font-semibold uppercase tracking-wide">
                                    <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
                                </span>
                                <h2 class="text-h4 mt-1 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h2>
                                <p class="text-body-sm text-dark-400 m-0">
                                    <?php echo esc_html(glory_truncate(get_the_excerpt(), 120)); ?>
                                </p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <nav class="mt-12">
                    <div class="flex justify-center">
                        <?php the_posts_pagination([
                            'prev_text' => '&laquo; 上一頁',
                            'next_text' => '下一頁 &raquo;',
                        ]); ?>
                    </div>
                </nav>
            <?php else : ?>
                <div class="text-center py-16">
                    <p class="text-dark-400 text-body-lg mb-6">找不到符合的結果，請嘗試其他關鍵字。</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">回到首頁</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
