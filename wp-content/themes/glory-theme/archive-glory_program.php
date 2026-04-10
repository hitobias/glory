<?php
/**
 * Archive Template: Programs (glory_program)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$program_types = get_terms([
    'taxonomy'   => 'program_type',
    'hide_empty' => true,
]);
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-20 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-4"><?php post_type_archive_title(); ?></h1>
            <p class="text-body-lg text-white/80 max-w-2xl mx-auto">
                探索我們多元化的教育服務計畫
            </p>
        </div>
    </section>

    <!-- Filter Tabs -->
    <?php if (!empty($program_types) && !is_wp_error($program_types)) : ?>
    <section class="border-b sticky top-[72px] bg-white z-40">
        <div class="container-content">
            <nav class="flex items-center gap-2 overflow-x-auto py-4" aria-label="<?php esc_attr_e('課程分類', 'glory-theme'); ?>">
                <a href="<?php echo esc_url(get_post_type_archive_link('glory_program')); ?>"
                   class="badge whitespace-nowrap <?php echo !is_tax() ? 'bg-primary-500 text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
                    全部
                </a>
                <?php foreach ($program_types as $type) : ?>
                    <a href="<?php echo esc_url(get_term_link($type)); ?>"
                       class="badge whitespace-nowrap <?php echo (is_tax('program_type', $type->slug)) ? 'bg-primary-500 text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
                        <?php echo esc_html($type->name); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </section>
    <?php endif; ?>

    <!-- Programs Grid -->
    <section class="section">
        <div class="container-content">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class' => 'w-full h-52 object-cover transition-transform duration-300 hover:scale-105',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <?php
                                $types = get_the_terms(get_the_ID(), 'program_type');
                                if (!empty($types)) :
                                ?>
                                    <span class="badge-primary mb-3"><?php echo esc_html($types[0]->name); ?></span>
                                <?php endif; ?>

                                <h2 class="text-h4 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="text-body-sm text-dark-400 mb-4">
                                        <?php echo esc_html(glory_truncate(get_the_excerpt(), 80)); ?>
                                    </p>
                                <?php endif; ?>

                                <?php
                                $targets = get_the_terms(get_the_ID(), 'program_target');
                                if (!empty($targets)) :
                                ?>
                                    <div class="flex flex-wrap gap-2 mt-auto">
                                        <?php foreach ($targets as $target) : ?>
                                            <span class="text-xs bg-gray-100 text-dark-500 px-2 py-1 rounded">
                                                <?php echo esc_html($target->name); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-12" aria-label="<?php esc_attr_e('課程分頁', 'glory-theme'); ?>">
                    <div class="flex justify-center">
                        <?php
                        the_posts_pagination([
                            'prev_text' => '&laquo; 上一頁',
                            'next_text' => '下一頁 &raquo;',
                            'mid_size'  => 2,
                        ]);
                        ?>
                    </div>
                </nav>
            <?php else : ?>
                <div class="text-center py-16">
                    <p class="text-dark-400 text-body-lg">目前沒有課程計畫。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
