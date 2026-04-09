<?php
/**
 * Default Page Template
 * Mobile-first layout for standard WordPress pages
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <!-- Page Header -->
        <section class="bg-gradient-to-br from-accent-green to-dark py-12 md:py-16">
            <div class="container-content text-center">
                <h1 class="text-h2 md:text-h1 text-white"><?php the_title(); ?></h1>
            </div>
        </section>

        <!-- Page Content -->
        <section class="section">
            <div class="container-content max-w-4xl">
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="mb-8 md:mb-10 -mt-6 md:-mt-8">
                        <?php the_post_thumbnail('glory-hero', [
                            'class' => 'w-full rounded-card shadow-card',
                        ]); ?>
                    </figure>
                <?php endif; ?>

                <div class="prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
