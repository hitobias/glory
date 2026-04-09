<?php
/**
 * Template Part: Content Card
 *
 * Used in archive pages and grids.
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;
?>

<article <?php post_class('card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
            <?php the_post_thumbnail('glory-card', [
                'class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105',
                'loading' => 'lazy',
            ]); ?>
        </a>
    <?php endif; ?>

    <div class="card-body">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) :
        ?>
            <span class="badge-primary mb-3">
                <?php echo esc_html($categories[0]->name); ?>
            </span>
        <?php endif; ?>

        <h3 class="text-h4 mb-2">
            <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>

        <p class="text-body-sm text-dark-400 mb-4">
            <?php echo esc_html(glory_truncate(get_the_excerpt(), 80)); ?>
        </p>

        <div class="flex items-center justify-between text-body-sm text-dark-400">
            <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                <?php echo esc_html(glory_post_date()); ?>
            </time>
            <a href="<?php the_permalink(); ?>" class="text-primary-500 font-medium hover:text-primary-700 no-underline inline-flex items-center gap-1">
                閱讀更多
                <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
            </a>
        </div>
    </div>
</article>
