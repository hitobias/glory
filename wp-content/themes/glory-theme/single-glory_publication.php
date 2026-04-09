<?php
/**
 * Single Template: Publication (glory_publication)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <!-- Header -->
        <section class="bg-gradient-to-br from-accent-green to-dark py-16 text-white">
            <div class="container-content">
                <?php
                $types = get_the_terms(get_the_ID(), 'publication_type');
                if (!empty($types)) :
                ?>
                    <span class="badge bg-accent text-dark mb-4"><?php echo esc_html($types[0]->name); ?></span>
                <?php endif; ?>
                <h1 class="text-h1 text-white mb-4"><?php the_title(); ?></h1>
                <p class="text-white/70 text-body-sm">
                    <?php echo esc_html(glory_post_date()); ?>
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="section">
            <div class="container-content">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Cover Image -->
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="lg:col-span-1">
                        <div class="sticky top-[100px]">
                            <?php the_post_thumbnail('large', [
                                'class' => 'w-full rounded-card shadow-card',
                            ]); ?>

                            <div class="mt-6 space-y-3">
                                <a href="/contact" class="btn-primary w-full text-center block">
                                    索取出版品
                                </a>
                                <a href="<?php echo esc_url(get_post_type_archive_link('glory_publication')); ?>" class="btn-outline w-full text-center block">
                                    查看全部出版品
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Text Content -->
                    <div class="<?php echo has_post_thumbnail() ? 'lg:col-span-2' : 'lg:col-span-3 max-w-3xl'; ?> prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Publications -->
        <?php
        $related = new WP_Query([
            'post_type'      => 'glory_publication',
            'posts_per_page' => 4,
            'post__not_in'   => [get_the_ID()],
            'post_status'    => 'publish',
        ]);
        if ($related->have_posts()) :
        ?>
        <section class="section bg-gray-50">
            <div class="container-content">
                <h2 class="text-h2 text-center mb-10">其他出版品</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <?php while ($related->have_posts()) : $related->the_post(); ?>
                        <article class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class' => 'w-full h-48 object-cover',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php endif; ?>
                            <div class="p-4">
                                <h3 class="text-body font-semibold">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline"><?php the_title(); ?></a>
                                </h3>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
        endif;
        wp_reset_postdata();
        ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
