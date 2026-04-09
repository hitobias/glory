<?php
/**
 * Template Name: 關於我們
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-20 text-white text-center">
        <div class="container-content">
            <h1 class="text-h1 text-white mb-4"><?php the_title(); ?></h1>
            <p class="text-body-lg text-white/80 max-w-2xl mx-auto">認識得榮社會福利基金會的使命、願景與團隊</p>
        </div>
    </section>

    <?php
    while (have_posts()) :
        the_post();
    ?>
        <?php if (get_the_content()) : ?>
            <section class="section">
                <div class="container-content prose prose-lg max-w-4xl mx-auto">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php else : ?>
            <!-- Our Story -->
            <section class="section">
                <div class="container-content">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <span class="badge-primary mb-4">我們的故事</span>
                            <h2 class="text-h2 mb-6">以愛澆灌生命的種子</h2>
                            <div class="space-y-4 text-dark-500 leading-relaxed">
                                <p>得榮社會福利基金會成立以來，始終秉持「散播生命種子、培育希望未來」的信念，致力於推動生命教育、關懷弱勢兒少。</p>
                                <p>從最初的校園志工服務，到今日涵蓋生命教育、快樂學習、合唱團及青少年關懷的多元服務體系，我們一步一腳印，用愛陪伴每一個孩子成長。</p>
                            </div>
                        </div>
                        <div>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('glory-hero', ['class' => 'rounded-card shadow-card w-full']); ?>
                            <?php else : ?>
                                <div class="bg-gray-200 rounded-card aspect-video flex items-center justify-center text-gray-400">
                                    <span>關於我們圖片</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mission & Vision -->
            <section class="section bg-gray-50">
                <div class="container-content">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <div class="card p-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">🎯</span>
                            </div>
                            <h3 class="text-h4 mb-3">使命</h3>
                            <p class="text-body-sm text-dark-400">散播生命的種子，推動生命教育，關懷弱勢兒少，建造健康社會。</p>
                        </div>
                        <div class="card p-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-accent-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">👁️</span>
                            </div>
                            <h3 class="text-h4 mb-3">願景</h3>
                            <p class="text-body-sm text-dark-400">讓每一個孩子都能認識生命的價值，在愛中成長茁壯。</p>
                        </div>
                        <div class="card p-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-accent-green-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">💎</span>
                            </div>
                            <h3 class="text-h4 mb-3">核心價值</h3>
                            <p class="text-body-sm text-dark-400">愛心、專業、創新、永續，以生命影響生命。</p>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
