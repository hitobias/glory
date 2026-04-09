<?php
/**
 * Template Name: Youtube頻道
 * Used for: Youtube頻道 (Page ID: 8896)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

$featured_video_id = 'nsMbSpZaRUM';
$featured_title    = '服務內容';

$videos = [
    ['id' => 'PZLpcQsStu4', 'title' => '2021暑假得榮生命教育線上體驗營'],
    ['id' => 'BdEkU_frRbE', 'title' => '2021快樂學習'],
    ['id' => '2aY0OUexLdA', 'title' => '得榮基金會影片'],
    ['id' => 'Ow72wIjYh3o', 'title' => '得榮基金會影片'],
    ['id' => 'bigPfuahb64', 'title' => '得榮基金會影片'],
    ['id' => 'oPrxJ25yZx8', 'title' => '得榮基金會影片'],
    ['id' => 'myMGGrhnED0', 'title' => '得榮基金會影片'],
    ['id' => 'I05ROHb-els', 'title' => '得榮基金會影片'],
];
?>

<main id="main-content" class="site-main">

    <!-- Hero -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-14 md:py-20">
        <div class="container-content text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-6" data-animate="scale">
                <?php echo glory_get_icon('youtube', 'w-8 h-8 text-white'); ?>
            </div>
            <h1 class="text-h2 md:text-h1 text-white mb-4" data-animate="fade-up">Youtube 頻道</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto" data-animate="fade-up">
                觀賞得榮基金會精彩影片，認識生命教育的感動故事
            </p>
        </div>
    </section>

    <!-- Featured Video -->
    <section class="section">
        <div class="container-content">
            <div class="max-w-4xl mx-auto">

                <div class="section-header" data-animate="fade-up">
                    <h2>精選影片</h2>
                    <p><?php echo esc_html($featured_title); ?></p>
                    <span class="section-header-bar"></span>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-card" data-animate="fade-up">
                    <div class="aspect-video">
                        <iframe
                            src="<?php echo esc_url('https://www.youtube.com/embed/' . $featured_video_id); ?>"
                            width="100%"
                            height="100%"
                            class="w-full h-full border-0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            loading="lazy"
                            title="<?php echo esc_attr($featured_title); ?>"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Grid -->
    <section class="section bg-gray-50">
        <div class="container-content">

            <div class="section-header" data-animate="fade-up">
                <h2>更多精彩影片</h2>
                <p>探索得榮基金會的活動紀錄與生命教育內容</p>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" data-stagger>
                <?php foreach ($videos as $video) : ?>
                    <div class="rounded-2xl overflow-hidden shadow-card bg-white transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                        <div class="aspect-video">
                            <iframe
                                src="<?php echo esc_url('https://www.youtube.com/embed/' . $video['id']); ?>"
                                width="100%"
                                height="100%"
                                class="w-full h-full border-0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy"
                                title="<?php echo esc_attr($video['title']); ?>"
                            ></iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="text-body-sm font-semibold text-dark line-clamp-2">
                                <?php echo esc_html($video['title']); ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section bg-accent/10">
        <div class="container-content text-center" data-animate="fade-up">
            <div class="max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-red-50 mb-5">
                    <?php echo glory_get_icon('youtube', 'w-7 h-7 text-red-600'); ?>
                </div>
                <h2 class="text-h3 md:text-h2 text-dark mb-4">訂閱我們的 Youtube 頻道</h2>
                <p class="text-dark-500 text-body md:text-body-lg mb-8">
                    訂閱得榮基金會 Youtube 頻道，第一時間觀看最新影片與活動紀錄
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a
                        href="https://www.youtube.com/channel/UC0vKfx5BEyn29fYP4FZ_jmw"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-primary"
                    >
                        <?php echo glory_get_icon('youtube', 'w-5 h-5'); ?>
                        前往 Youtube 頻道
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-outline">
                        瀏覽最新消息
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
