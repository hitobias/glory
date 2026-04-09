<?php
/**
 * Page Template: 生命教育
 * Slug: life-education-page (Page ID: 11)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">生命教育</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                生命教育志工招募邀請 -- 用生命感動生命，一起走入校園關懷下一代
            </p>
        </div>
    </section>

    <!-- YouTube Video + Introduction -->
    <section class="section">
        <div class="container-content max-w-5xl">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-animate="fade-up">
                    <div class="rounded-2xl overflow-hidden shadow-card-hover">
                        <div class="relative" style="padding-bottom:56.25%">
                            <iframe
                                src="https://www.youtube.com/embed/h_j5yCwbwxs"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="生命教育介紹影片"
                            ></iframe>
                        </div>
                    </div>
                </div>
                <div data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('school', 'w-6 h-6 text-primary-500'); ?>
                        </div>
                        <h2 class="text-h3 text-dark">生命教育志工招募邀請</h2>
                    </div>
                    <div class="space-y-3 text-dark-600">
                        <p>
                            得榮基金會自1998年成立以來，致力於生命教育的推廣與實踐。我們深信每一個生命都有其獨特的價值與意義，透過生命教育，幫助學生認識自我、尊重生命。
                        </p>
                        <p>
                            多年來，已培訓超過五千位志工夥伴，服務超過二十萬名學生，在全台各地的校園中，用生命感動生命。我們誠摯邀請您加入志工行列，一起走入校園，關懷下一代的生命成長。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-12 md:py-16">
        <div class="container-content">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 text-center" data-stagger>
                <?php
                $stats = [
                    ['num' => 5000,   'suffix' => '+', 'label' => '培訓志工'],
                    ['num' => 200000, 'suffix' => '+', 'label' => '受惠學生'],
                    ['num' => 300,    'suffix' => '+', 'label' => '講座研習'],
                    ['num' => 20,     'suffix' => '+', 'label' => '年服務經驗'],
                ];
                foreach ($stats as $stat) :
                ?>
                    <div>
                        <div class="text-accent text-[2rem] md:text-display font-bold leading-none mb-1"
                             data-counter="<?php echo esc_attr($stat['num']); ?>"
                             data-counter-suffix="<?php echo esc_attr($stat['suffix']); ?>">
                            0<?php echo esc_html($stat['suffix']); ?>
                        </div>
                        <div class="text-white/80 text-body-sm md:text-body"><?php echo esc_html($stat['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 講座與研習 -->
    <section class="section bg-gray-50">
        <div class="container-content max-w-4xl">
            <div class="grid md:grid-cols-5 gap-8 items-center">
                <div class="md:col-span-3" data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('star', 'w-6 h-6 text-accent-700'); ?>
                        </div>
                        <h2 class="text-h3 text-dark">講座與研習</h2>
                    </div>
                    <div class="space-y-3 text-dark-600">
                        <p>
                            至今已舉辦超過三百場以上的講座和教師研習。講員皆是學有專精的專家學者、具實務經驗的資深生命教育志工。
                        </p>
                        <p>
                            連年舉辦生命教育論壇或成果展，獲台北市社會局長、教育局長、及各校校長、師長肯定，是推動校園生命教育的重要力量。
                        </p>
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center justify-center" data-animate="scale">
                    <div class="w-40 h-40 md:w-48 md:h-48 rounded-full bg-accent/10 flex items-center justify-center">
                        <?php echo glory_get_icon('star', 'w-20 h-20 text-accent-700/60'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 教材介紹 -->
    <section class="section">
        <div class="container-content max-w-4xl">
            <div class="grid md:grid-cols-5 gap-8 items-center">
                <div class="md:col-span-2 flex items-center justify-center order-2 md:order-1" data-animate="scale">
                    <div class="w-40 h-40 md:w-48 md:h-48 rounded-full bg-primary-50 flex items-center justify-center">
                        <?php echo glory_get_icon('book', 'w-20 h-20 text-primary-500/60'); ?>
                    </div>
                </div>
                <div class="md:col-span-3 order-1 md:order-2" data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('book', 'w-6 h-6 text-primary-500'); ?>
                        </div>
                        <h2 class="text-h3 text-dark">基金會教材</h2>
                    </div>
                    <div class="space-y-3 text-dark-600 mb-6">
                        <p>
                            得榮基金會自1998年起即響應政府政策，邀請學者專家與青少年實務工作者共同研編國小、國中、高中生命教育教材，是台灣最早開始編撰生命教育教材的團隊之一。
                        </p>
                        <p>
                            教材內容涵蓋認識自我、人際關係、生命價值等主題，幫助學生探索生命的意義，提升對生命的尊重與關懷。
                        </p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/life-education-textbook/')); ?>" class="btn-primary">
                        查看教材介紹
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
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
                <a href="<?php echo esc_url(home_url('/life-education-textbook/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-100 transition-colors">
                            <?php echo glory_get_icon('book', 'w-7 h-7 text-primary-500'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">教材教案</h3>
                        <p class="text-body-sm text-dark-400 mt-2">各年級生命教育教材資源</p>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/volunteer-training/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-accent-green/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-green/20 transition-colors">
                            <?php echo glory_get_icon('users', 'w-7 h-7 text-accent-green'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">志工培訓</h3>
                        <p class="text-body-sm text-dark-400 mt-2">報名志工培訓課程</p>
                    </div>
                </a>

                <a href="<?php echo esc_url(home_url('/volunteer-sharing/')); ?>" class="card group no-underline">
                    <div class="card-body text-center py-8">
                        <div class="w-14 h-14 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-accent/30 transition-colors">
                            <?php echo glory_get_icon('heart', 'w-7 h-7 text-accent-700'); ?>
                        </div>
                        <h3 class="text-h4 text-dark group-hover:text-primary-500 transition-colors">志工心得</h3>
                        <p class="text-body-sm text-dark-400 mt-2">志工服務心得分享</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
