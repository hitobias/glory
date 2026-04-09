<?php
/**
 * Page Template: 生命教育服務
 * Slug: life-education-intro (Page ID: 7823)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">生命教育相關服務</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                用生命感動生命，培養青少年認識自我、尊重生命的能力
            </p>
        </div>
    </section>

    <!-- 生命教育教材研發 -->
    <section class="section">
        <div class="container-content">
            <div class="grid md:grid-cols-2 gap-10 items-center max-w-6xl mx-auto">
                <div data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('book', 'w-6 h-6 text-primary-500'); ?>
                        </div>
                        <h2 class="text-h3 text-dark">生命教育教材研發</h2>
                    </div>
                    <div class="space-y-3 text-dark-600 mb-6">
                        <p><strong>【教學目的】</strong></p>
                        <ul class="list-disc list-inside space-y-1.5">
                            <li>幫助學生主動去認識自我，進而尊重自己、熱愛自己。</li>
                            <li>培養社會能力，提昇與他人和諧相處的能力。</li>
                            <li>認識生存環境，瞭解人與環境生命共同體的關係。</li>
                            <li>協助學生探索生命的意義，提升對生命的尊重與關懷。</li>
                        </ul>
                    </div>
                    <a href="<?php echo esc_url(home_url('/life-education-textbook/')); ?>" class="btn-primary">
                        點我看教材
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
                <div data-animate="fade-up" class="space-y-4">
                    <!-- Timeline cards -->
                    <div class="bg-gray-50 rounded-xl p-5 border-l-4 border-primary-500">
                        <h4 class="font-bold text-dark mb-1">教材編輯出版歷程(一) 1998年</h4>
                        <p class="text-body-sm text-dark-500">當時台灣教育當局頒布生命教育綱目後，得榮基金會便響應政府政策，邀請學者專家與青少年實務工作者，共同研編國高中教材，是台灣最早開始編撰生命教育教材的團隊之一。</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-5 border-l-4 border-accent">
                        <h4 class="font-bold text-dark mb-1">教材編輯出版歷程(二) 2006年～2012年</h4>
                        <p class="text-body-sm text-dark-500">隨著社會與校園對生命教育的重視不斷擴大，得榮於此時期開始投入志工服務國小校園，並完成研編國小共六冊的生命教育教材。</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-5 border-l-4 border-accent-green">
                        <h4 class="font-bold text-dark mb-1">教材編輯出版歷程(三) 2018年至今</h4>
                        <p class="text-body-sm text-dark-500">隨著社群網路的蓬勃發展，兒童與青少年所面對的問題情境也比過往變化得更為劇烈。因此得榮將過往編撰的各冊教材教案翻修審編，不僅僅是一般的資料補充，更在使用上貼近當今兒少的實際需求。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 生命教育志工培訓 -->
    <section class="section bg-gray-50">
        <div class="container-content max-w-4xl">
            <div class="grid md:grid-cols-5 gap-8 items-center">
                <div class="md:col-span-3" data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-accent-green/10 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('users', 'w-6 h-6 text-accent-green'); ?>
                        </div>
                        <h2 class="text-h3 text-dark">生命教育志工培訓</h2>
                    </div>
                    <p class="text-dark-600 mb-6">
                        得榮基金會響應志願服務，依法辦理志工訓練，以增進志工從事志願服務所需之知能與心志，鼓勵志工投入生命教育、得榮少年教育專案服務，一同關心兒童及青少年之身心靈發展，落實社區關懷。
                    </p>
                    <a href="<?php echo esc_url(home_url('/volunteer-training/13424/')); ?>" class="btn-accent">
                        報名志工培訓
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
                <div class="md:col-span-2 flex items-center justify-center" data-animate="scale">
                    <div class="w-40 h-40 md:w-48 md:h-48 rounded-full bg-accent-green/10 flex items-center justify-center">
                        <?php echo glory_get_icon('users', 'w-20 h-20 text-accent-green/60'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 各類講座、論壇、成果展 -->
    <section class="section">
        <div class="container-content max-w-4xl">
            <div class="text-center mb-10" data-animate="fade-up">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center">
                        <?php echo glory_get_icon('star', 'w-6 h-6 text-accent-700'); ?>
                    </div>
                    <h2 class="text-h3 text-dark">各類講座、論壇、成果展</h2>
                </div>
                <p class="text-dark-600 max-w-2xl mx-auto mb-2">
                    至今已舉辦超過350場以上的講座和教師研習。講員皆是學有專精的專家學者、具實務經驗的資深的生命教育志工。
                </p>
                <p class="text-dark-600 max-w-2xl mx-auto">
                    連年舉辦生命教育論壇或成果展，獲台北市社會局長、教育局長、及各校校長、師長肯定。
                </p>
            </div>

            <div class="text-center mb-10">
                <a href="<?php echo esc_url(home_url('/%e7%94%9f%e5%91%bd%e6%95%99%e8%82%b2%e6%88%90%e6%9e%9c%e5%b1%95/13724/')); ?>" class="btn-primary btn-lg">
                    由此申請講座
                    <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                </a>
            </div>

            <!-- Testimonials from officials -->
            <div class="grid md:grid-cols-2 gap-6" data-stagger>
                <blockquote class="bg-white rounded-2xl p-6 shadow-card border-l-4 border-primary-500">
                    <p class="text-dark-600 italic mb-4">
                        「貴基金會歷年投入青少年生命教育工作，提升青少年生命價值，建立全人發展的環境，深獲各界佳評，深表感佩。」
                    </p>
                    <footer class="text-body-sm text-dark-400 font-semibold">
                        — 前台北市社會局 局長 許立民先生
                    </footer>
                </blockquote>

                <blockquote class="bg-white rounded-2xl p-6 shadow-card border-l-4 border-accent">
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

    <!-- Sub-pages navigation -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header">
                <h2>更多生命教育資源</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto" data-stagger>
                <a href="<?php echo esc_url(home_url('/life-education-page/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-100 transition-colors">
                            <?php echo glory_get_icon('school', 'w-7 h-7 text-primary-500'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">生命教育</h3>
                        <p class="text-body-sm text-dark-400 mt-2">校園生命教育服務介紹</p>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/life-education-textbook/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-accent/30 transition-colors">
                            <?php echo glory_get_icon('book', 'w-7 h-7 text-accent-700'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">教材教案</h3>
                        <p class="text-body-sm text-dark-400 mt-2">各年級教材資源</p>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/volunteer-training/13424/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-accent-green/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-green/20 transition-colors">
                            <?php echo glory_get_icon('users', 'w-7 h-7 text-accent-green'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">志工培訓</h3>
                        <p class="text-body-sm text-dark-400 mt-2">報名志工培訓課程</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
