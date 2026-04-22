<?php
/**
 * Template Name: 聯絡我們
 * Used for: 聯絡我們 (Page ID: 34)
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
            <h1 class="text-h2 md:text-h1 text-white mb-3">聯絡我們</h1>
            <p class="text-white/80 text-body md:text-body-lg">歡迎與我們聯繫，我們很樂意為您服務</p>
        </div>
    </section>

    <!-- Contact Info + Map -->
    <section class="section">
        <div class="container-content max-w-5xl">
            <div class="grid lg:grid-cols-5 gap-10">

                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-card p-6 md:p-8 space-y-6">
                        <h2 class="text-h3 text-dark">聯繫方式</h2>

                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <?php echo glory_get_icon('location', 'w-5 h-5 text-primary-500'); ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-dark text-body-sm mb-1">辦公地址</h3>
                                    <p class="text-dark-500 text-body-sm">110台北市信義路四段460號3F-1<br>(信基大樓)</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <?php echo glory_get_icon('phone', 'w-5 h-5 text-primary-500'); ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-dark text-body-sm mb-1">電話</h3>
                                    <p class="text-dark-500 text-body-sm">
                                        <a href="tel:02-87881930" class="text-dark-500 hover:text-primary-500 no-underline">(02)8788-1930</a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <?php echo glory_get_icon('fax', 'w-5 h-5 text-primary-500'); ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-dark text-body-sm mb-1">傳真</h3>
                                    <p class="text-dark-500 text-body-sm">(02)8788-3547</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <?php echo glory_get_icon('mail', 'w-5 h-5 text-primary-500'); ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-dark text-body-sm mb-1">電子信箱</h3>
                                    <p class="text-dark-500 text-body-sm">
                                        <a href="mailto:glory@glory.org.tw" class="text-dark-500 hover:text-primary-500 no-underline">glory@glory.org.tw</a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                    <?php echo glory_get_icon('download', 'w-5 h-5 text-primary-500'); ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-dark text-body-sm mb-1">郵政劃撥</h3>
                                    <p class="text-dark-500 text-body-sm">19190395</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transit Info -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Transit Info -->
                    <div class="bg-white rounded-2xl shadow-card p-6 md:p-8">
                        <h2 class="text-h3 text-dark mb-6">交通資訊</h2>

                        <div class="space-y-5">
                            <!-- MRT -->
                            <div class="bg-blue-50 rounded-xl p-5">
                                <h3 class="font-bold text-dark mb-2 flex items-center gap-2">
                                    <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold">M</span>
                                    捷運
                                </h3>
                                <p class="text-dark-600 text-body-sm">
                                    台北101/世貿站下車，從台北車站方向步行約六分鐘
                                </p>
                            </div>

                            <!-- Bus -->
                            <div class="bg-green-50 rounded-xl p-5">
                                <h3 class="font-bold text-dark mb-3 flex items-center gap-2">
                                    <span class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold">B</span>
                                    公車
                                </h3>

                                <div class="space-y-3">
                                    <div>
                                        <p class="text-body-sm font-semibold text-dark mb-1">站名：信義光復路口</p>
                                        <p class="text-body-sm text-dark-500">
                                            20、22、33、37、38、226、266、288、292、797，信義幹線，信義新幹線
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-body-sm font-semibold text-dark mb-1">站名：吳興街口</p>
                                        <p class="text-body-sm text-dark-500">
                                            1、207、284、292、292副、611、650、950、1032、1503<br>
                                            內科通勤車10，南軟通勤車雙和線，南軟通勤車中和線
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
