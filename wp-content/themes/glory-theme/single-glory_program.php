<?php
/**
 * Single Template: Program (glory_program)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero -->
        <section class="relative">
            <?php if (has_post_thumbnail()) : ?>
                <div class="h-[400px] overflow-hidden">
                    <?php the_post_thumbnail('glory-hero', [
                        'class' => 'w-full h-full object-cover',
                    ]); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                </div>
            <?php else : ?>
                <div class="h-[300px] bg-gradient-to-br from-accent-green to-dark"></div>
            <?php endif; ?>

            <div class="absolute bottom-0 left-0 right-0 pb-10">
                <div class="container-content text-white">
                    <?php
                    $types = get_the_terms(get_the_ID(), 'program_type');
                    if (!empty($types)) :
                    ?>
                        <span class="badge bg-accent text-dark mb-4"><?php echo esc_html($types[0]->name); ?></span>
                    <?php endif; ?>
                    <h1 class="text-h1 text-white"><?php the_title(); ?></h1>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="section">
            <div class="container-content">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-1">
                        <!-- Program Info -->
                        <div class="card p-6 mb-6 sticky top-[100px]">
                            <h3 class="text-h4 mb-4">課程資訊</h3>

                            <?php
                            $targets = get_the_terms(get_the_ID(), 'program_target');
                            if (!empty($targets)) :
                            ?>
                                <div class="mb-4">
                                    <p class="text-body-sm font-semibold text-dark mb-2">適用對象</p>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach ($targets as $target) : ?>
                                            <span class="badge bg-gray-100 text-dark-500"><?php echo esc_html($target->name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="border-t pt-4 mt-4">
                                <a href="/contact" class="btn-primary w-full text-center">
                                    申請參與
                                </a>
                            </div>

                            <div class="mt-4">
                                <a href="/donate" class="btn-outline w-full text-center">
                                    <?php echo glory_get_icon('heart', 'w-4 h-4 mr-1'); ?>
                                    支持此計畫
                                </a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- Related Testimonials -->
        <?php
        $testimonials = new WP_Query([
            'post_type'      => 'glory_testimonial',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        ]);
        if ($testimonials->have_posts()) :
        ?>
        <section class="section bg-gray-50">
            <div class="container-content">
                <h2 class="text-h2 text-center mb-10">相關見證</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                        <blockquote class="card p-6">
                            <p class="text-dark-500 leading-relaxed mb-4 italic">
                                "<?php echo esc_html(glory_truncate(get_the_excerpt(), 120)); ?>"
                            </p>
                            <footer class="border-t pt-4">
                                <cite class="not-italic">
                                    <p class="font-semibold text-dark text-body-sm"><?php the_title(); ?></p>
                                    <?php
                                    $t_types = get_the_terms(get_the_ID(), 'testimonial_type');
                                    if (!empty($t_types)) :
                                    ?>
                                        <p class="text-dark-400 text-xs"><?php echo esc_html($t_types[0]->name); ?></p>
                                    <?php endif; ?>
                                </cite>
                            </footer>
                        </blockquote>
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
