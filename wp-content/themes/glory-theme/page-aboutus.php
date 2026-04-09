<?php
/**
 * Page Template: 關於我們
 * Slug: aboutus (Page ID: 9)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">關於我們</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                得榮基金會本著對青少年的關懷，與提升青少年生命價值的宗旨成立。
            </p>
        </div>
    </section>

    <!-- Introduction Video -->
    <section class="section">
        <div class="container-content max-w-4xl">
            <div class="rounded-2xl overflow-hidden shadow-card-hover">
                <div class="relative" style="padding-bottom:56.25%">
                    <iframe
                        src="https://www.youtube.com/embed/ZmSpUNBDQDM"
                        class="absolute inset-0 w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        title="得榮基金會介紹影片"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header">
                <h2>基金會服務項目</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- 青少年社會福利工作 -->
                <div class="card" data-animate="fade-up">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-accent-green/10 rounded-xl flex items-center justify-center">
                                <?php echo glory_get_icon('users', 'w-6 h-6 text-accent-green'); ?>
                            </div>
                            <h3 class="text-h4 text-dark">青少年社會福利工作</h3>
                        </div>
                        <ol class="list-decimal list-inside space-y-2 text-dark-600">
                            <li>認助清寒學子，提供多元學習與公共服務</li>
                            <li>規劃社區青少年成長團體</li>
                            <li>結合社區夥伴資源，關懷輔導青少年</li>
                            <li>辦理社區服務訓練研習及認證</li>
                            <li>提供社會工作科系學生實習</li>
                            <li>舉辦國際少年服務交流活動</li>
                        </ol>
                    </div>
                </div>

                <!-- 生命教育實施與推廣工作 -->
                <div class="card" data-animate="fade-up">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                                <?php echo glory_get_icon('book', 'w-6 h-6 text-primary-500'); ?>
                            </div>
                            <h3 class="text-h4 text-dark">生命教育實施與推廣工作</h3>
                        </div>
                        <ol class="list-decimal list-inside space-y-2 text-dark-600">
                            <li>研發生命教育教材教案</li>
                            <li>舉辦教材使用及教學評估研討</li>
                            <li>進行中小學校園班級體驗課程</li>
                            <li>舉辦課後關懷延伸活動</li>
                            <li>輔導各級學校生命教育社團</li>
                            <li>開設大學通識教育課程</li>
                            <li>提供生命教育研究論文獎助</li>
                            <li>服務各界生命教育專題演講</li>
                            <li>舉辦生命教育論壇、研討及成果展</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Foundation History (沿革) -->
    <section class="section">
        <div class="container-content max-w-4xl">
            <div class="section-header">
                <h2>基金會沿革</h2>
                <span class="section-header-bar"></span>
            </div>

            <?php
            // Pull content from the 基金會沿革 page (ID 6613)
            $origin_page = get_post(6613);
            if ($origin_page && $origin_page->post_status === 'publish') :
            ?>
                <div class="prose prose-lg max-w-none">
                    <?php echo apply_filters('the_content', $origin_page->post_content); ?>
                </div>
            <?php else : ?>
                <div class="prose prose-lg max-w-none text-center">
                    <p>1998年，得榮基金會響應政府政策，邀請學者專家共同投入生命教育推廣工作，是台灣最早開始編撰生命教育教材的團隊之一。多年來持續深耕青少年關懷與生命教育，服務遍及全台。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Recognition (各界肯定) -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header">
                <h2>各界肯定</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <blockquote class="bg-white rounded-2xl p-6 md:p-8 shadow-card border-l-4 border-primary-500" data-animate="fade-up">
                    <p class="text-dark-600 italic mb-4">
                        「貴基金會歷年投入青少年生命教育工作，提升青少年生命價值，建立全人發展的環境，深獲各界佳評，深表感佩。」
                    </p>
                    <footer class="text-body-sm text-dark-400 font-semibold">
                        — 前台北市社會局 局長 許立民先生
                    </footer>
                </blockquote>

                <blockquote class="bg-white rounded-2xl p-6 md:p-8 shadow-card border-l-4 border-accent" data-animate="fade-up">
                    <p class="text-dark-600 italic mb-4">
                        「感謝得榮基金會秉持『用生命感動生命』，以『愛』為主軸的教育理念。您們的奉獻、付出，是我們社會正向進步的一大力量。」
                    </p>
                    <footer class="text-body-sm text-dark-400 font-semibold">
                        — 台北市教育局 局長 曾燦金先生
                    </footer>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-accent/10 py-14 md:py-20">
        <div class="container-content text-center" data-animate="fade-up">
            <div class="max-w-xl mx-auto">
                <h2 class="text-h3 md:text-h2 text-dark mb-4">一起守護青少年的未來</h2>
                <p class="text-dark-500 text-body-lg mb-8">
                    加入得榮基金會的行列，用生命感動生命
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/worker/')); ?>" class="btn-primary btn-lg">
                        加入志工
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/%e9%97%9c%e6%87%b7%e8%88%87%e6%8d%90%e6%ac%be-2/')); ?>" class="btn-outline btn-lg">
                        關懷與捐款
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
