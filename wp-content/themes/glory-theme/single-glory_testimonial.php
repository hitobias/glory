<?php
/**
 * Single Template: Testimonial (glory_testimonial)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <section class="section">
            <div class="container-content max-w-3xl">
                <!-- Back link -->
                <a href="<?php echo esc_url(get_post_type_archive_link('glory_testimonial')); ?>" class="inline-flex items-center gap-1 text-dark-400 hover:text-primary-500 no-underline text-body-sm mb-8">
                    &larr; 回到見證列表
                </a>

                <article class="card p-10">
                    <div class="text-4xl text-primary-300 mb-6">❝</div>

                    <div class="prose prose-lg max-w-none mb-8">
                        <?php the_content(); ?>
                    </div>

                    <footer class="border-t pt-6 flex items-center gap-4">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail', [
                                'class' => 'w-16 h-16 rounded-full object-cover',
                            ]); ?>
                        <?php else : ?>
                            <div class="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center text-primary-500 text-xl font-bold">
                                <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-bold text-dark text-h4 m-0"><?php the_title(); ?></p>
                            <?php
                            $types = get_the_terms(get_the_ID(), 'testimonial_type');
                            if (!empty($types)) :
                            ?>
                                <p class="text-dark-400 text-body-sm m-0"><?php echo esc_html($types[0]->name); ?></p>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
