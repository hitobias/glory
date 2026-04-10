<?php
/**
 * Single Post Template (blog posts)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero -->
        <section class="bg-gradient-to-br from-accent-green to-dark py-16 text-white">
            <div class="container-content max-w-4xl">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                    <span class="badge bg-accent text-dark mb-4"><?php echo esc_html($categories[0]->name); ?></span>
                <?php endif; ?>

                <h1 class="text-h1 text-white mb-4"><?php echo esc_html(get_the_title()); ?></h1>

                <div class="flex items-center gap-4 text-white/70 text-body-sm">
                    <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                        <?php echo esc_html(glory_post_date()); ?>
                    </time>
                    <span>&middot;</span>
                    <span><?php echo esc_html(glory_reading_time()); ?></span>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="section">
            <div class="container-content max-w-4xl">
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="mb-10 -mt-8">
                        <?php the_post_thumbnail('glory-hero', [
                            'class' => 'w-full rounded-card shadow-card',
                        ]); ?>
                    </figure>
                <?php endif; ?>

                <div class="prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if (!empty($tags)) :
                ?>
                    <div class="mt-10 pt-6 border-t flex flex-wrap items-center gap-2">
                        <span class="text-body-sm font-semibold text-dark">標籤：</span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="text-xs bg-gray-100 text-dark-500 px-3 py-1 rounded-full hover:bg-primary-50 hover:text-primary-500 no-underline transition-colors">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <nav class="mt-10 pt-6 border-t grid grid-cols-1 md:grid-cols-2 gap-6" aria-label="<?php esc_attr_e('文章導覽', 'glory-theme'); ?>">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    ?>
                    <?php if ($prev) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="group no-underline">
                            <span class="text-body-sm text-dark-400">&larr; 上一篇</span>
                            <p class="text-dark font-semibold group-hover:text-primary-500 transition-colors m-0 mt-1">
                                <?php echo esc_html($prev->post_title); ?>
                            </p>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ($next) : ?>
                        <a href="<?php echo esc_url(get_permalink($next)); ?>" class="group no-underline text-right">
                            <span class="text-body-sm text-dark-400">下一篇 &rarr;</span>
                            <p class="text-dark font-semibold group-hover:text-primary-500 transition-colors m-0 mt-1">
                                <?php echo esc_html($next->post_title); ?>
                            </p>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
