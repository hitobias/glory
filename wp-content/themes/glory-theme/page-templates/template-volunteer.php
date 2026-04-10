<?php
/**
 * Template Name: 志工專區
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$is_logged_in = is_user_logged_in();
$has_access = glory_can_access_volunteer_area();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-16 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-3"><?php echo esc_html(get_the_title()); ?></h1>
            <p class="text-body-lg text-white/80">感謝您加入得榮志工行列</p>
        </div>
    </section>

    <section class="section">
        <div class="container-content">
            <?php if (!$is_logged_in) : ?>
                <!-- Login Prompt -->
                <div class="max-w-lg mx-auto text-center">
                    <div class="card p-10">
                        <div class="w-20 h-20 rounded-full bg-accent-green-100 flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl">🔐</span>
                        </div>
                        <h2 class="text-h3 mb-4">志工專屬資源</h2>
                        <p class="text-dark-400 mb-8">請登入您的志工帳號以存取教案、培訓教材及活動手冊等資源。</p>
                        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="btn-primary">
                            登入帳號
                        </a>
                        <p class="text-body-sm text-dark-400 mt-4">
                            還不是志工？
                            <a href="/contact" class="text-primary-500">聯絡我們</a>了解如何加入。
                        </p>
                    </div>
                </div>

            <?php elseif (!$has_access) : ?>
                <!-- Access Denied -->
                <div class="max-w-lg mx-auto text-center">
                    <div class="card p-10">
                        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl">⚠️</span>
                        </div>
                        <h2 class="text-h3 mb-4">權限不足</h2>
                        <p class="text-dark-400 mb-6">您的帳號尚未開通志工資源存取權限。</p>
                        <p class="text-body-sm text-dark-400">
                            請<a href="/contact" class="text-primary-500">聯絡我們</a>以取得存取權限。
                        </p>
                    </div>
                </div>

            <?php else : ?>
                <!-- Volunteer Dashboard -->
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h2 class="text-h3">歡迎回來，<?php echo esc_html(wp_get_current_user()->display_name); ?></h2>
                        <p class="text-dark-400">以下是您可使用的志工資源</p>
                    </div>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="btn-outline text-body-sm">登出</a>
                </div>

                <?php
                // Resource categories
                $resource_types = get_terms([
                    'taxonomy'   => 'resource_type',
                    'hide_empty' => false,
                ]);
                ?>

                <?php if (!empty($resource_types) && !is_wp_error($resource_types)) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <?php foreach ($resource_types as $type) : ?>
                            <div class="card p-6">
                                <h3 class="text-h4 mb-4"><?php echo esc_html($type->name); ?></h3>
                                <?php
                                $resources = new WP_Query([
                                    'post_type'      => 'glory_volunteer_resource',
                                    'posts_per_page' => 5,
                                    'tax_query'      => [[
                                        'taxonomy' => 'resource_type',
                                        'field'    => 'term_id',
                                        'terms'    => $type->term_id,
                                    ]],
                                ]);
                                if ($resources->have_posts()) :
                                ?>
                                    <ul class="space-y-3 list-none p-0">
                                        <?php while ($resources->have_posts()) : $resources->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>" class="flex items-center gap-2 text-dark-500 hover:text-primary-500 no-underline text-body-sm">
                                                    <?php echo glory_get_icon('download', 'w-4 h-4 flex-shrink-0'); ?>
                                                    <?php echo esc_html(get_the_title()); ?>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php else : ?>
                                    <p class="text-dark-400 text-body-sm">尚無資源。</p>
                                <?php endif; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Page Content (for additional info via Gutenberg) -->
                <?php
                while (have_posts()) :
                    the_post();
                    if (get_the_content()) :
                ?>
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                <?php
                    endif;
                endwhile;
                ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
