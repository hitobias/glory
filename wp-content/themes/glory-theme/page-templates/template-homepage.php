<?php
/**
 * Template Name: 首頁
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>

    <?php
    // If page content is empty, show default homepage layout
    if (empty(get_the_content())) :
    ?>
        <!-- Hero Section -->
        <section class="relative bg-dark text-white overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-500/90 to-dark/95"></div>
            <div class="relative container-content py-24 md:py-32 text-center">
                <h1 class="text-display text-white mb-6">散播生命的種子<br>培育希望的未來</h1>
                <p class="text-body-lg text-white/90 max-w-2xl mx-auto mb-10">
                    得榮社會福利基金會致力於生命教育、快樂學習與青少年關懷，為社會注入正向力量。
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/about" class="btn-accent">認識我們</a>
                    <a href="/donate" class="btn-white">支持捐款</a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="section bg-gray-50">
            <div class="container-content">
                <h2 class="text-h2 text-center mb-4">我們的服務</h2>
                <p class="text-center text-dark-400 mb-12 max-w-xl mx-auto">
                    以愛與關懷為核心，提供多元化的教育和社會服務
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php
                    $services = [
                        ['title' => '生命教育', 'desc' => '深入校園推動生命教育課程，幫助學生認識生命價值。', 'icon' => '📚'],
                        ['title' => '快樂學習', 'desc' => '提供多元課後照顧服務，讓弱勢孩子享有優質學習資源。', 'icon' => '🎵'],
                        ['title' => '合唱團', 'desc' => '透過音樂培養團隊合作精神，讓孩子在歌聲中找到自信。', 'icon' => '🎤'],
                        ['title' => '得榮少年', 'desc' => '關懷弱勢青少年，提供獎助學金、輔導與多元發展機會。', 'icon' => '🌱'],
                    ];
                    foreach ($services as $service) :
                    ?>
                        <div class="card text-center p-8">
                            <div class="text-4xl mb-4"><?php echo $service['icon']; ?></div>
                            <h3 class="text-h4 mb-3"><?php echo esc_html($service['title']); ?></h3>
                            <p class="text-body-sm text-dark-400"><?php echo esc_html($service['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Latest News -->
        <section class="section">
            <div class="container-content">
                <h2 class="text-h2 text-center mb-4">最新消息</h2>
                <p class="text-center text-dark-400 mb-12">關注得榮基金會的最新活動與公告</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php
                    $news = new WP_Query([
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                    ]);
                    if ($news->have_posts()) :
                        while ($news->have_posts()) :
                            $news->the_post();
                            get_template_part('template-parts/content/content', 'card');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <div class="text-center mt-10">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn-outline">查看全部消息</a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section bg-primary-500 text-white text-center">
            <div class="container-content max-w-3xl">
                <h2 class="text-h2 text-white mb-4">一起為下一代的未來努力</h2>
                <p class="text-body-lg text-white/90 mb-10">
                    您的每一份支持，都是孩子成長路上最溫暖的力量。
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/donate" class="btn-accent">立即捐款</a>
                    <a href="/volunteer" class="btn-white">加入志工</a>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
