<?php
/**
 * Template Name: 捐款
 * Used for: 關懷與捐款 (Page ID: 19)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">關懷與捐款</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                您的每一份愛心，都將化為孩子成長路上最溫暖的力量
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container-content max-w-5xl">
            <div class="grid lg:grid-cols-5 gap-10">

                <!-- Main Content -->
                <div class="lg:col-span-3 space-y-8">

                    <!-- 捐款類別 -->
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-h3 text-dark mb-4">捐款類別</h2>
                            <ul class="space-y-3 text-dark-600">
                                <li class="flex items-center gap-3">
                                    <span class="w-2 h-2 bg-accent rounded-full flex-shrink-0"></span>
                                    青少年活動營地奉獻
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-2 h-2 bg-accent rounded-full flex-shrink-0"></span>
                                    得榮少年教育專案
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-2 h-2 bg-accent rounded-full flex-shrink-0"></span>
                                    急難救助基金
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-2 h-2 bg-accent rounded-full flex-shrink-0"></span>
                                    贊助活動經費
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- 捐款方式 -->
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-h3 text-dark mb-6">捐款方式</h2>

                            <div class="space-y-6">
                                <!-- 郵政劃撥 -->
                                <div class="bg-gray-50 rounded-xl p-5">
                                    <h3 class="text-h4 text-dark mb-3">郵政劃撥</h3>
                                    <dl class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-2 text-body-sm">
                                        <dt class="text-dark-400">劃撥帳號</dt>
                                        <dd class="font-bold text-dark text-body">1919-0395</dd>
                                    </dl>
                                </div>

                                <!-- 銀行匯款 -->
                                <div class="bg-gray-50 rounded-xl p-5">
                                    <h3 class="text-h4 text-dark mb-3">銀行匯款 / ATM轉帳</h3>
                                    <dl class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-2 text-body-sm">
                                        <dt class="text-dark-400">銀行名稱</dt>
                                        <dd class="font-semibold text-dark">國泰世華銀行世貿分行</dd>
                                        <dt class="text-dark-400">銀行代號</dt>
                                        <dd class="font-bold text-dark text-body">013</dd>
                                        <dt class="text-dark-400">帳號</dt>
                                        <dd class="font-bold text-dark text-body">065-50-012-697-8</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 檔案下載 -->
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-h3 text-dark mb-4">檔案下載</h2>
                            <div class="space-y-3">
                                <a href="<?php echo esc_url(home_url('/download_file/9082/')); ?>" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-primary-50 transition-colors no-underline group">
                                    <?php echo glory_get_icon('download', 'w-5 h-5 text-primary-500'); ?>
                                    <span class="text-dark-600 group-hover:text-primary-500">捐款認捐單</span>
                                </a>
                                <a href="<?php echo esc_url(home_url('/download_file/9084/')); ?>" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-primary-50 transition-colors no-underline group">
                                    <?php echo glory_get_icon('download', 'w-5 h-5 text-primary-500'); ?>
                                    <span class="text-dark-600 group-hover:text-primary-500">信用卡認捐單</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- 工作計畫 -->
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-h4 text-dark mb-4">工作計畫</h3>
                            <a href="https://drive.google.com/file/d/1kYTc2Sp7TkBJYp52U72EQbAvap6v0QBT/view?usp=drive_link" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-primary-50 transition-colors no-underline group">
                                <?php echo glory_get_icon('download', 'w-5 h-5 text-primary-500'); ?>
                                <span class="text-dark-600 group-hover:text-primary-500">115年 工作計畫書</span>
                            </a>
                        </div>
                    </div>

                    <!-- 經費預算 -->
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-h4 text-dark mb-4">經費預算</h3>
                            <a href="https://drive.google.com/file/d/1GWlJMKj8ow0do5P10WZHBZDz_20xqNBU/view?usp=drive_link" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-primary-50 transition-colors no-underline group">
                                <?php echo glory_get_icon('download', 'w-5 h-5 text-primary-500'); ?>
                                <span class="text-dark-600 group-hover:text-primary-500">114年-115年 經費預算表</span>
                            </a>
                        </div>
                    </div>

                    <!-- 得榮少年介紹 -->
                    <div class="bg-accent-green/5 rounded-2xl p-6 border border-accent-green/20">
                        <h3 class="text-h4 text-dark mb-3">得榮少年教育專案</h3>
                        <p class="text-body-sm text-dark-500 mb-4">
                            透過獎助學金及志工關懷，幫助家庭遭遇變故的青少年完成學業。
                        </p>
                        <a href="<?php echo esc_url(home_url('/youths/')); ?>" class="btn-primary btn-sm">
                            了解更多
                            <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                        </a>
                    </div>

                    <!-- 捐款抵稅 -->
                    <div class="bg-accent/10 rounded-2xl p-6 border border-accent/20">
                        <h3 class="text-h4 text-dark mb-3">捐款抵稅說明</h3>
                        <ul class="text-body-sm text-dark-500 space-y-2 list-disc pl-4">
                            <li>捐款收據可供個人綜合所得稅申報扣除</li>
                            <li>企業捐款可列為營業費用</li>
                            <li>收據將於捐款後寄出</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header" data-animate="fade-up">
                <h2>您的捐款產生的影響</h2>
                <span class="section-header-bar"></span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 max-w-4xl mx-auto" data-stagger>
                <div class="text-center">
                    <div class="w-14 h-14 bg-accent-green/10 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <?php echo glory_get_icon('school', 'w-7 h-7 text-accent-green'); ?>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-accent-green mb-1" data-counter="200" data-counter-suffix="+">0+</p>
                    <p class="text-dark-500 text-body-sm">合作學校</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <?php echo glory_get_icon('users', 'w-7 h-7 text-accent-700'); ?>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-accent-green mb-1" data-counter="50000" data-counter-suffix="+">0+</p>
                    <p class="text-dark-500 text-body-sm">受惠學生</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <?php echo glory_get_icon('heart', 'w-7 h-7 text-primary-500'); ?>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-accent-green mb-1" data-counter="300" data-counter-suffix="+">0+</p>
                    <p class="text-dark-500 text-body-sm">志工教師</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-accent-green/10 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <?php echo glory_get_icon('star', 'w-7 h-7 text-accent-green'); ?>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-accent-green mb-1" data-counter="25" data-counter-suffix="+">0+</p>
                    <p class="text-dark-500 text-body-sm">年服務經驗</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section bg-accent/10">
        <div class="container-content text-center" data-animate="fade-up">
            <div class="max-w-xl mx-auto">
                <h2 class="text-h3 md:text-h2 text-dark mb-4">讓愛心成為改變的力量</h2>
                <p class="text-dark-500 text-body md:text-body-lg mb-8">
                    每一份捐款都是對生命教育的支持，幫助更多孩子找到生命的方向與希望
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo esc_url(home_url('/youths/')); ?>" class="btn-primary">
                        了解得榮少年
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_permalink(34)); ?>" class="btn-outline">
                        聯絡我們
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
