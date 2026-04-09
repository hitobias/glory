<?php
/**
 * Template Name: Facebook粉絲專頁
 * Used for: Facebook粉絲專頁 (Page ID: 8915)
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">

    <!-- Hero -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-14 md:py-20">
        <div class="container-content text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-6" data-animate="scale">
                <?php echo glory_get_icon('facebook', 'w-8 h-8 text-white'); ?>
            </div>
            <h1 class="text-h2 md:text-h1 text-white mb-4" data-animate="fade-up">Facebook 粉絲專頁</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto" data-animate="fade-up">
                追蹤得榮基金會 Facebook 粉絲專頁，掌握最新活動資訊與感動故事
            </p>
        </div>
    </section>

    <!-- Facebook Embed -->
    <section class="section">
        <div class="container-content">
            <div class="max-w-2xl mx-auto">

                <div class="section-header" data-animate="fade-up">
                    <h2>最新動態</h2>
                    <p>來自得榮基金會 Facebook 粉絲專頁的即時貼文</p>
                    <span class="section-header-bar"></span>
                </div>

                <!-- Facebook Page Plugin -->
                <div class="flex justify-center" data-animate="fade-up">
                    <div class="w-full max-w-[500px] rounded-2xl overflow-hidden shadow-card border border-gray-100">
                        <iframe
                            src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fglory.life.edu&tabs=timeline&width=500&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                            width="500"
                            height="800"
                            class="w-full border-0"
                            style="max-width: 500px;"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                            loading="lazy"
                            title="得榮基金會 Facebook 粉絲專頁"
                        ></iframe>
                    </div>
                </div>

                <!-- Fallback / No-JS message -->
                <noscript>
                    <div class="text-center py-8">
                        <p class="text-dark-400 mb-4">需要啟用 JavaScript 才能檢視 Facebook 嵌入內容。</p>
                        <a href="https://www.facebook.com/glory.life.edu/" target="_blank" rel="noopener noreferrer" class="btn-primary">
                            前往 Facebook 粉絲專頁
                            <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                        </a>
                    </div>
                </noscript>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section bg-accent/10">
        <div class="container-content text-center" data-animate="fade-up">
            <div class="max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-50 mb-5">
                    <?php echo glory_get_icon('facebook', 'w-7 h-7 text-primary-500'); ?>
                </div>
                <h2 class="text-h3 md:text-h2 text-dark mb-4">加入我們的 Facebook 社群</h2>
                <p class="text-dark-500 text-body md:text-body-lg mb-8">
                    按讚追蹤得榮基金會粉絲專頁，即時接收最新消息、活動花絮與生命故事分享
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a
                        href="https://www.facebook.com/glory.life.edu/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-primary"
                    >
                        <?php echo glory_get_icon('facebook', 'w-5 h-5'); ?>
                        前往粉絲專頁
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
