<?php
/**
 * Page Template: 得榮少年
 * Slug: youths (Page ID: 7287)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">得榮少年教育專案</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                透過獎助學金及志工關懷，幫助家庭遭遇變故的青少年完成學業
            </p>
        </div>
    </section>

    <!-- 成立緣起 -->
    <section class="section">
        <div class="container-content max-w-5xl">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-animate="fade-up">
                    <h2 class="text-h3 text-dark mb-4">得榮少年教育專案</h2>
                    <p class="text-dark-600 mb-3">
                        <strong>【成立緣起】</strong><br>
                        1999年，得榮基金會即開始辦理「得榮少年教育專案」，以提供獎助學金的方式，實際的幫助家庭遭遇重大變故，領有中低收證明或清寒證明的青少年完成學業。
                    </p>
                    <p class="text-dark-600 mb-6">
                        未來展望：增加得榮少年專案人數，並藉關懷者加強落實對青少年及其家庭的關懷服務。
                    </p>
                    <a href="<?php echo esc_url(home_url('/glory-young-regulations/')); ?>" class="btn-primary">
                        招生簡章
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
                <div data-animate="fade-up">
                    <div class="rounded-2xl overflow-hidden shadow-card-hover">
                        <div class="relative" style="padding-bottom:56.25%">
                            <iframe
                                src="https://www.youtube.com/embed/UjwdzAKaBiM"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="得榮少年介紹影片"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 公共服務 -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header">
                <h2>公共服務</h2>
                <p>得榮少年參與多元公共服務活動，培養社會責任感</p>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid sm:grid-cols-3 gap-6 max-w-4xl mx-auto" data-stagger>
                <div class="card overflow-hidden">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="<?php echo esc_url(GLORY_THEME_URI . '/assets/images/services/beach-cleanup.jpg'); ?>" alt="萬里海邊淨灘" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    <div class="card-body">
                        <p class="text-body-sm text-dark-500 text-center">萬里海邊淨灘</p>
                    </div>
                </div>
                <div class="card overflow-hidden">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="<?php echo esc_url(GLORY_THEME_URI . '/assets/images/services/early-therapy.jpg'); ?>" alt="陪伴早療兒童" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    <div class="card-body">
                        <p class="text-body-sm text-dark-500 text-center">陪伴早療兒童與環境清潔</p>
                    </div>
                </div>
                <div class="card overflow-hidden">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="<?php echo esc_url(GLORY_THEME_URI . '/assets/images/services/elderly-care.jpg'); ?>" alt="長照中心關懷長者" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    <div class="card-body">
                        <p class="text-body-sm text-dark-500 text-center">長照中心關懷長者與環境清潔</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 寒暑假營隊 -->
    <section class="section">
        <div class="container-content max-w-5xl">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="order-2 md:order-1" data-animate="fade-up">
                    <div class="rounded-2xl overflow-hidden shadow-card-hover">
                        <div class="relative" style="padding-bottom:56.25%">
                            <iframe
                                src="https://www.youtube.com/embed/UgAVCZPYGQY"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="得榮少年寒暑假營隊"
                            ></iframe>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2" data-animate="fade-up">
                    <h2 class="text-h3 text-dark mb-4">寒暑假營隊</h2>
                    <p class="text-dark-600 mb-6">
                        基金會每年舉辦寒暑假營隊，營隊內容從過去和未來兩種不同的面向，引導青少年認識自我價值，並藉由科系體驗活動，學習建構對往後生涯的開拓，找到自己人生未來的目標。這樣的寒暑假營隊，對青少年是寶貴且有價值的！
                    </p>
                    <a href="https://youtu.be/UgAVCZPYGQY?feature=shared" target="_blank" rel="noopener" class="btn-accent">
                        觀看營隊影片
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 得榮少年月刊 -->
    <section class="section bg-gray-50">
        <div class="container-content max-w-4xl">
            <div class="section-header">
                <h2>得榮少年月刊</h2>
                <p>為方便各界朋友瞭解得榮少年們的成長與轉變，基金會精心製作得榮少年月刊</p>
                <span class="section-header-bar"></span>
            </div>

            <!-- Testimonials -->
            <div class="grid md:grid-cols-2 gap-6" data-stagger>
                <div class="bg-white rounded-2xl p-6 shadow-card border-l-4 border-accent-green">
                    <h4 class="font-bold text-dark mb-3">陳同學 · 得榮少年分享</h4>
                    <p class="text-dark-600 text-body-sm">
                        在我4歲時爸爸過世，媽媽帶著我和妹妹回越南。10歲，媽媽為了給我們更好的生活及教育，再帶我們回到台灣。但文化差距以及語言不流利，使我從小學到國中人際關係都不好，讓我內心很痛苦。國二時，我成為得榮少年，身邊多了關心我的人。
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-card border-l-4 border-primary-500">
                    <h4 class="font-bold text-dark mb-3">陳萍如 · 得榮少年家長分享</h4>
                    <p class="text-dark-600 text-body-sm">
                        感謝基金會這六年來發的獎助學金，對我們家的幫助很大，讓父母減輕重擔。我們做父母的都鼓勵孩子好好讀書，以後有機會、有能力，也要像得榮基金會一樣幫助別人。
                    </p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="<?php echo esc_url(home_url('/publication/')); ?>" class="btn-outline">
                    查看得榮少年月刊
                    <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Sub-pages -->
    <section class="section">
        <div class="container-content">
            <div class="section-header">
                <h2>更多得榮少年資源</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto" data-stagger>
                <a href="<?php echo esc_url(home_url('/glory-young-regulations/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-6">
                        <h3 class="text-body font-bold text-dark group-hover:text-primary-500 transition-colors">專案招生簡章</h3>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/%e5%be%97%e6%a6%ae%e5%b0%91%e5%b9%b4%e5%b0%88%e9%a1%8c/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-6">
                        <h3 class="text-body font-bold text-dark group-hover:text-primary-500 transition-colors">得榮少年專題</h3>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/category/%e5%ad%b8%e7%94%9f%e5%9b%9e%e9%a5%8b/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-6">
                        <h3 class="text-body font-bold text-dark group-hover:text-primary-500 transition-colors">學生回饋</h3>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/category/%e5%ae%b6%e9%95%b7%e5%9b%9e%e9%a5%8b/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-6">
                        <h3 class="text-body font-bold text-dark group-hover:text-primary-500 transition-colors">家長回饋</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
