<?php
/**
 * Archive Template: Testimonials (glory_testimonial)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$testimonial_types = get_terms([
    'taxonomy'   => 'testimonial_type',
    'hide_empty' => true,
]);
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-16 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-3"><?php post_type_archive_title(); ?></h1>
            <p class="text-body-lg text-white/80">聽聽參與者們的真實故事與回饋</p>
        </div>
    </section>

    <!-- Filter -->
    <?php if (!empty($testimonial_types) && !is_wp_error($testimonial_types)) : ?>
    <section class="border-b sticky top-[72px] bg-white z-40">
        <div class="container-content">
            <nav class="flex items-center gap-2 overflow-x-auto py-4" aria-label="<?php esc_attr_e('見證分類', 'glory-theme'); ?>">
                <a href="<?php echo esc_url(get_post_type_archive_link('glory_testimonial')); ?>"
                   class="badge whitespace-nowrap <?php echo !is_tax() ? 'bg-accent-green text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
                    全部
                </a>
                <?php foreach ($testimonial_types as $type) : ?>
                    <a href="<?php echo esc_url(get_term_link($type)); ?>"
                       class="badge whitespace-nowrap <?php echo is_tax('testimonial_type', $type->slug) ? 'bg-accent-green text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
                        <?php echo esc_html($type->name); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </section>
    <?php endif; ?>

    <!-- Testimonials Grid -->
    <section class="section">
        <div class="container-content">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <blockquote class="card p-8">
                            <div class="text-3xl text-primary-300 mb-4">❝</div>
                            <p class="text-dark-500 leading-relaxed mb-6 italic">
                                <?php echo has_excerpt()
                                    ? esc_html(get_the_excerpt())
                                    : esc_html(glory_truncate(get_the_content(), 200)); ?>
                            </p>
                            <footer class="border-t pt-4 flex items-center gap-3">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail', [
                                        'class' => 'w-12 h-12 rounded-full object-cover',
                                    ]); ?>
                                <?php else : ?>
                                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-500 font-bold">
                                        <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                                <cite class="not-italic">
                                    <p class="font-semibold text-dark text-body-sm m-0"><?php the_title(); ?></p>
                                    <?php
                                    $types = get_the_terms(get_the_ID(), 'testimonial_type');
                                    if (!empty($types)) :
                                    ?>
                                        <p class="text-dark-400 text-xs m-0"><?php echo esc_html($types[0]->name); ?></p>
                                    <?php endif; ?>
                                </cite>
                            </footer>
                        </blockquote>
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
                    <p class="text-dark-400 text-body-lg">目前沒有回饋見證。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
