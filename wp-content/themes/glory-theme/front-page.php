<?php
/**
 * Front Page Template
 * 得榮社會福利基金會首頁 — 保持原有內容，現代化設計
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main">

    <!-- ========== HERO (影片背景) ========== -->
    <section class="hero-video-section">
        <!-- Video background — covers the section like object-fit:cover -->
        <div class="hero-video-wrap" aria-hidden="true">
            <iframe
                id="hero-video"
                src="https://www.youtube.com/embed/ZmSpUNBDQDM?autoplay=1&mute=1&loop=1&playlist=ZmSpUNBDQDM&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&iv_load_policy=3&disablekb=1"
                class="hero-video-iframe"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen
                title="得榮基金會影片"
            ></iframe>
        </div>

        <!-- Gradient overlay -->
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-dark/60 via-dark/40 to-dark/70"></div>

        <!-- Content -->
        <div class="relative z-20 container-content py-24 md:py-32 lg:py-40 text-center">
            <div data-animate="fade-up" class="max-w-3xl mx-auto">
                <h1 class="text-[2rem] md:text-h1 lg:text-display text-white mb-4 md:mb-6 leading-tight drop-shadow-lg">
                    得榮少年教育專案
                </h1>
                <p class="text-white/90 text-body md:text-body-lg mb-8 md:mb-10 max-w-xl mx-auto drop-shadow-md">
                    透過得榮夥伴的關心陪伴，讓兒少家庭獲得各面實際的資源，協助升學
                </p>
                <a href="<?php echo esc_url(home_url('/glory-young-regulations/')); ?>" class="btn-accent btn-lg shadow-lg hover:shadow-xl transition-shadow">
                    前往招生簡章
                    <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                </a>
            </div>
        </div>

        <!-- Decorative wave -->
        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V20C240 0 480 40 720 30C960 20 1200 0 1440 20V60H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- ========== 最新消息 ========== -->
    <section class="section bg-white">
        <div class="container-content">
            <div class="section-header" data-animate>
                <h2>最新消息</h2>
                <p>了解我們最近的活動、報導與公告</p>
                <span class="section-header-bar"></span>
            </div>

            <?php
            $news_query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'ignore_sticky_posts' => true,
            ]);

            // Collect IDs to exclude from 最新報導
            $news_post_ids = wp_list_pluck($news_query->posts, 'ID');

            if ($news_query->have_posts()) :
            ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6" data-stagger>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                        <article class="card group">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-[16/10]">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class'   => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-[16/10] bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                                    <?php echo glory_get_icon('book', 'w-10 h-10 text-primary-300'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <?php
                                $cats = get_the_category();
                                if (!empty($cats)) :
                                ?>
                                    <span class="badge-primary mb-2"><?php echo esc_html($cats[0]->name); ?></span>
                                <?php endif; ?>

                                <h3 class="text-body md:text-h4 mb-2 leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline transition-colors">
                                        <?php echo esc_html(glory_truncate(get_the_title(), 40)); ?>
                                    </a>
                                </h3>

                                <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="text-xs text-dark-400">
                                    <?php echo esc_html(glory_post_date()); ?>
                                </time>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="text-center mt-8 md:mt-10" data-animate>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-outline">
                        查看所有消息
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>
            <?php
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <!-- ========== 最新報導 ========== -->
    <section class="section bg-warm-50">
        <div class="container-content">
            <div class="section-header" data-animate>
                <h2>最新報導</h2>
                <p>來自各方的報導與分享</p>
                <span class="section-header-bar"></span>
            </div>

            <?php
            $reports_query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post__not_in'   => $news_post_ids,
                'ignore_sticky_posts' => true,
            ]);

            if ($reports_query->have_posts()) :
            ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6" data-stagger>
                    <?php while ($reports_query->have_posts()) : $reports_query->the_post(); ?>
                        <article class="card group">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-[16/10]">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class'   => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                                        'loading' => 'lazy',
                                    ]); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-[16/10] bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                                    <?php echo glory_get_icon('book', 'w-10 h-10 text-primary-300'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <?php
                                $cats = get_the_category();
                                if (!empty($cats)) :
                                ?>
                                    <span class="badge-primary mb-2"><?php echo esc_html($cats[0]->name); ?></span>
                                <?php endif; ?>

                                <h3 class="text-body md:text-h4 mb-2 leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="text-dark hover:text-primary-500 no-underline transition-colors">
                                        <?php echo esc_html(glory_truncate(get_the_title(), 40)); ?>
                                    </a>
                                </h3>

                                <p class="text-dark-400 text-body-sm mb-3 line-clamp-2">
                                    <?php echo esc_html(glory_truncate(get_the_excerpt(), 60)); ?>
                                </p>

                                <div class="flex items-center justify-between">
                                    <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="text-xs text-dark-400">
                                        <?php echo esc_html(glory_post_date()); ?>
                                    </time>
                                    <a href="<?php the_permalink(); ?>" class="text-primary-500 text-body-sm font-medium no-underline hover:text-primary-700 transition-colors inline-flex items-center gap-1">
                                        詳細內容 <?php echo glory_get_icon('arrow-right', 'w-3.5 h-3.5'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="text-center mt-8 md:mt-10" data-animate>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-outline">
                        查看更多報導
                        <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                    </a>
                </div>
            <?php
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <!-- ========== 生命教育的重要性 ========== -->
    <section class="section bg-white">
        <div class="container-content">
            <div class="section-header" data-animate>
                <h2>生命教育的重要性</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10" data-stagger>
                <div class="text-center md:text-left">
                    <div class="w-14 h-14 mx-auto md:mx-0 mb-4 rounded-2xl bg-red-50 flex items-center justify-center text-red-500">
                        <?php echo glory_get_icon('heart', 'w-7 h-7'); ?>
                    </div>
                    <h3 class="text-h4 mb-3">別等到失去了生命<br>才想起教育</h3>
                    <p class="text-dark-400 text-body-sm leading-relaxed">
                        台灣從20多年前發展生命教育至今，仍然有太多孩子失去自信、覺得自己沒價值。甚至有些人因為人際關係問題、沒辦法處理自己的情緒等……這些一時的難關卻導致最終悲劇的發生。
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <div class="w-14 h-14 mx-auto md:mx-0 mb-4 rounded-2xl bg-primary-50 flex items-center justify-center text-primary-500">
                        <?php echo glory_get_icon('school', 'w-7 h-7'); ?>
                    </div>
                    <h3 class="text-h4 mb-3">預防勝於補救的教育</h3>
                    <p class="text-dark-400 text-body-sm leading-relaxed">
                        生命中的覺知能力不是與生俱來的，必須經過適當的引導與磨練，這是一種生命價值與意義的傳遞。生命教育主張「人才培育」應以「人的培育」為基礎。相較於人才的養成，人的培育更是教育之根本。在當今過度重視競爭與功效的世局中，每個學生的內在價值尤其值得被重視。
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <div class="w-14 h-14 mx-auto md:mx-0 mb-4 rounded-2xl bg-accent-50 flex items-center justify-center text-accent-700">
                        <?php echo glory_get_icon('users', 'w-7 h-7'); ?>
                    </div>
                    <h3 class="text-h4 mb-3">改變，需要眾人的看見</h3>
                    <p class="text-dark-400 text-body-sm leading-relaxed">
                        在國小、國中、高中的教學現場中，家長志工夥伴是學校導師與輔導室的最佳助手。他們不僅提供老師各項協助，當看見班級中有經濟困難、需要協助的孩子們時，透過引進得榮基金會的社會愛心，成為這些孩子們成長路上的支持力量。
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 得榮基金會的主要服務 ========== -->
    <section class="section bg-warm-50">
        <div class="container-content">
            <div class="section-header" data-animate>
                <h2>得榮基金會的主要服務</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6" data-stagger>
                <?php
                $services = [
                    [
                        'title' => '生命教育教材研發',
                        'desc'  => '幫助學生主動去認識自我，進而尊重自己、熱愛自己。培養社會能力，提昇與他人和諧相處的能力。認識生存環境，瞭解人與環境生命共同體的關係。協助學生探索生命的意義，提升對生命的尊重與關懷。',
                        'icon'  => 'book',
                        'color' => 'primary',
                        'url'   => '/life-education-textbook/',
                    ],
                    [
                        'title' => '生命教育志工培訓',
                        'desc'  => '得榮基金會響應志願服務，依法辦理志工訓練，以增進志工從事志願服務所需之知能與心志，鼓勵志工投入生命教育、得榮少年教育專案服務，一同關心兒童及青少年之身心靈發展，落實社區關懷。',
                        'icon'  => 'users',
                        'color' => 'accent-green',
                        'url'   => '/volunteer-sharing/',
                    ],
                    [
                        'title' => '生命教育講座、論壇、成果展',
                        'desc'  => '至今已舉辦超過350場以上的講座和教師研習。講員皆是學有專精的專家學者、具實務經驗的資深的生命教育志工。連年舉辦生命教育論壇或成果展，獲台北市教育局長、社會局長、各校校長老師肯定。',
                        'icon'  => 'star',
                        'color' => 'accent',
                        'url'   => '/life-education-intro/',
                    ],
                    [
                        'title' => '得榮少年教育專案',
                        'desc'  => '為協助因家境清寒或家庭遭逢重大變故，以致影響其求學進修機會之青少年，本基金會特成立「得榮少年教育專案」，以協助具求學意願之清寒家庭少年，可以順利完成學業，其身心靈亦得以受關懷照顧而成長。',
                        'icon'  => 'heart',
                        'color' => 'red',
                        'url'   => '/youths/',
                    ],
                    [
                        'title' => '快樂學習才能發展課程',
                        'desc'  => '鑑於學習問題對青少年的影響日益嚴重，得榮與恩慈社會福利基金會合作開辦「快樂學習、才能發展」教育課程，期盼在現今的教育體制外，另闢多元學習的途徑，增進青少年的學習興趣，以順利升學、培養多元興趣。',
                        'icon'  => 'school',
                        'color' => 'blue',
                        'url'   => '/快樂學習教育專案介紹/',
                    ],
                    [
                        'title' => '跨校性的大學生命教育服務社',
                        'desc'  => '提供鄰近中小學生命教育之相關活動，並前往花蓮、南投的偏鄉國中小，舉辦生命教育暑期營隊。實踐大學生社區參與、服務人群和回饋社會之理想，也實現自我成長、領導和教學的發展。',
                        'icon'  => 'music',
                        'color' => 'purple',
                        'url'   => '/life-education-page/大學生命教育服務社/',
                    ],
                ];

                $color_map = [
                    'primary'      => ['bg' => 'bg-primary-50', 'text' => 'text-primary-500', 'bar' => 'bg-primary-500'],
                    'accent-green' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'bar' => 'bg-green-600'],
                    'accent'       => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'bar' => 'bg-amber-500'],
                    'red'          => ['bg' => 'bg-red-50', 'text' => 'text-red-500', 'bar' => 'bg-red-500'],
                    'blue'         => ['bg' => 'bg-blue-50', 'text' => 'text-blue-500', 'bar' => 'bg-blue-500'],
                    'purple'       => ['bg' => 'bg-purple-50', 'text' => 'text-purple-500', 'bar' => 'bg-purple-500'],
                ];

                foreach ($services as $s) :
                    $cm = $color_map[$s['color']];
                ?>
                    <a href="<?php echo esc_url(home_url($s['url'])); ?>" class="group card no-underline flex flex-col">
                        <div class="h-1 <?php echo esc_attr($cm['bar']); ?>"></div>
                        <div class="p-5 md:p-6 flex-1 flex flex-col">
                            <div class="w-12 h-12 mb-4 rounded-xl <?php echo esc_attr($cm['bg']); ?> flex items-center justify-center <?php echo esc_attr($cm['text']); ?> group-hover:scale-110 transition-transform duration-300">
                                <?php echo glory_get_icon($s['icon'], 'w-6 h-6'); ?>
                            </div>
                            <h3 class="text-body md:text-h4 text-dark mb-2 group-hover:text-primary-500 transition-colors"><?php echo esc_html($s['title']); ?></h3>
                            <p class="text-dark-400 text-body-sm leading-relaxed m-0 flex-1">
                                <?php echo esc_html(glory_truncate($s['desc'], 100)); ?>
                            </p>
                            <span class="inline-flex items-center gap-1 text-primary-500 text-body-sm font-medium mt-4 group-hover:gap-2 transition-all">
                                了解更多 <?php echo glory_get_icon('arrow-right', 'w-4 h-4'); ?>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========== 統計數字 ========== -->
    <section class="bg-gradient-to-br from-accent-green to-accent-green-900 py-14 md:py-20 relative overflow-hidden">
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        <div class="container-content relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-10 text-center" data-stagger>
                <?php
                $stats = [
                    ['num' => 50000, 'suffix' => '+', 'label' => '近五年學生人次'],
                    ['num' => 500, 'suffix' => '+', 'label' => '得榮少年教育專案人數'],
                    ['num' => 3000, 'suffix' => '+', 'label' => '近五年服務班級次數'],
                    ['num' => 1000, 'suffix' => '+', 'label' => '志工培訓人數'],
                ];
                foreach ($stats as $stat) :
                ?>
                    <div>
                        <div class="text-accent text-[2rem] md:text-display font-bold leading-none mb-2"
                             data-counter="<?php echo esc_attr($stat['num']); ?>"
                             data-counter-suffix="<?php echo esc_attr($stat['suffix']); ?>">
                            0<?php echo esc_html($stat['suffix']); ?>
                        </div>
                        <div class="text-white/75 text-body-sm md:text-body tracking-wide"><?php echo esc_html($stat['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========== 友善相關連結 ========== -->
    <section class="section-sm bg-warm-50">
        <div class="container-content">
            <div class="section-header" data-animate>
                <h2>友善相關連結</h2>
                <span class="section-header-bar"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5" data-stagger>
                <?php
                $links = [
                    ['name' => '教育部生命教育資訊網',       'url' => 'https://life.edu.tw/',           'icon' => 'school', 'org' => '教育部',         'color' => '#195630'],
                    ['name' => '生命教育專業發展中心',       'url' => 'https://lepdc.ntnu.edu.tw/',     'icon' => 'book',   'org' => '國立臺灣師範大學', 'color' => '#1a5ce0'],
                    ['name' => '生命教育研發育成中心',       'url' => 'https://www.lec.ntu.edu.tw/',    'icon' => 'star',   'org' => '國立臺灣大學',     'color' => '#7c3aed'],
                    ['name' => '志願服務資訊網',             'url' => 'https://vol.mohw.gov.tw/',       'icon' => 'heart',  'org' => '衛生福利部',       'color' => '#dc2626'],
                    ['name' => '志工管理整合平臺',           'url' => 'https://cv.gov.taipei/',         'icon' => 'users',  'org' => '臺北市政府',       'color' => '#0284c7'],
                    ['name' => 'FM90.9 佳音廣播電台',        'url' => 'https://www.goodnews.org.tw/',   'icon' => 'music',  'org' => '佳音廣播',         'color' => '#d97706'],
                ];
                foreach ($links as $link) :
                    $domain = wp_parse_url($link['url'], PHP_URL_HOST);
                ?>
                    <a href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener noreferrer"
                       class="flink group" style="--flink-color: <?php echo esc_attr($link['color']); ?>">
                        <span class="flink-accent" style="background: <?php echo esc_attr($link['color']); ?>;"></span>
                        <span class="flink-icon" style="color: <?php echo esc_attr($link['color']); ?>; background: <?php echo esc_attr($link['color']); ?>12;">
                            <?php echo glory_get_icon($link['icon'], 'w-5 h-5'); ?>
                        </span>
                        <span class="flink-body">
                            <span class="flink-org"><?php echo esc_html($link['org']); ?></span>
                            <span class="flink-name"><?php echo esc_html($link['name']); ?></span>
                            <span class="flink-url"><?php echo esc_html($domain); ?> <?php echo glory_get_icon('arrow-right', 'w-3 h-3 inline-block group-hover:translate-x-0.5 transition-transform'); ?></span>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
