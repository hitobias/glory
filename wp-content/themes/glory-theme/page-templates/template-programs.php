<?php
/**
 * Template Name: 課程計畫總覽
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

// Get all program types
$program_types = get_terms([
    'taxonomy'   => 'program_type',
    'hide_empty' => false,
]);
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-20 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-4"><?php echo esc_html(get_the_title()); ?></h1>
            <p class="text-body-lg text-white/80 max-w-2xl mx-auto">
                我們提供多元化的教育服務，涵蓋生命教育、快樂學習、合唱團及青少年關懷
            </p>
        </div>
    </section>

    <!-- Program Type Filter -->
    <?php if (!empty($program_types) && !is_wp_error($program_types)) : ?>
    <section class="border-b sticky top-[72px] bg-white z-40">
        <div class="container-content">
            <nav class="flex items-center gap-2 overflow-x-auto py-4 -mx-4 px-4" aria-label="課程分類篩選">
                <a href="<?php the_permalink(); ?>"
                   class="badge whitespace-nowrap <?php echo empty($_GET['type']) ? 'bg-primary-500 text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
                    全部
                </a>
                <?php foreach ($program_types as $type) : ?>
                    <a href="<?php echo esc_url(add_query_arg('type', $type->slug)); ?>"
                       class="badge whitespace-nowrap <?php echo (isset($_GET['type']) && $_GET['type'] === $type->slug) ? 'bg-primary-500 text-white' : 'bg-gray-100 text-dark-500 hover:bg-gray-200'; ?> no-underline">
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
            <?php
            $query_args = [
                'post_type'      => 'glory_program',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
            ];

            if (!empty($_GET['type'])) {
                $query_args['tax_query'] = [[
                    'taxonomy' => 'program_type',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field(wp_unslash($_GET['type'])),
                ]];
            }

            $programs = new WP_Query($query_args);

            if ($programs->have_posts()) :
            ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while ($programs->have_posts()) : $programs->the_post(); ?>
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

                                <h3 class="text-h4 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline"><?php echo esc_html(get_the_title()); ?></a>
                                </h3>

                                <?php if (has_excerpt()) : ?>
                                    <p class="text-body-sm text-dark-400 mb-4"><?php echo esc_html(glory_truncate(get_the_excerpt(), 80)); ?></p>
                                <?php endif; ?>

                                <?php
                                $targets = get_the_terms(get_the_ID(), 'program_target');
                                if (!empty($targets)) :
                                ?>
                                    <div class="flex flex-wrap gap-2">
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
            <?php else : ?>
                <div class="text-center py-16">
                    <p class="text-dark-400 text-body-lg">目前沒有課程計畫。</p>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- Page Content -->
    <?php
    while (have_posts()) :
        the_post();
        if (get_the_content()) :
    ?>
        <section class="section bg-gray-50">
            <div class="container-content prose prose-lg max-w-4xl mx-auto">
                <?php the_content(); ?>
            </div>
        </section>
    <?php
        endif;
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
