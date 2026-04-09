<?php
/**
 * Page Template: 志工專區
 * Slug: worker (Page ID: 23)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">志工專區</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                加入得榮志工行列，用生命感動生命
            </p>
        </div>
    </section>

    <?php if (is_user_logged_in()) : ?>

        <!-- Logged-in: Dashboard with tabs -->
        <section class="section">
            <div class="container-content max-w-5xl">
                <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 overflow-x-auto">
                        <nav class="flex min-w-max" id="volunteer-tabs">
                            <button class="volunteer-tab active px-6 py-4 text-body-sm font-semibold border-b-2 border-primary-500 text-primary-500 whitespace-nowrap" data-tab="documents">
                                申請文件
                            </button>
                            <button class="volunteer-tab px-6 py-4 text-body-sm font-semibold border-b-2 border-transparent text-dark-400 hover:text-dark-600 whitespace-nowrap" data-tab="materials">
                                專案教材
                            </button>
                            <button class="volunteer-tab px-6 py-4 text-body-sm font-semibold border-b-2 border-transparent text-dark-400 hover:text-dark-600 whitespace-nowrap" data-tab="recruitment">
                                專案招生
                            </button>
                            <button class="volunteer-tab px-6 py-4 text-body-sm font-semibold border-b-2 border-transparent text-dark-400 hover:text-dark-600 whitespace-nowrap" data-tab="results">
                                2024 成果展
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6 md:p-8">
                        <!-- 申請文件 -->
                        <div class="volunteer-panel active" id="panel-documents">
                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-h4 text-dark mb-4">文件目錄</h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <ol class="list-decimal list-inside space-y-2 text-dark-600 text-body-sm">
                                                <li>申請辦法</li>
                                                <li>申請流程與照顧架構圖</li>
                                                <li>關懷者須知</li>
                                                <li>大區照顧者與聯絡人須知</li>
                                            </ol>
                                        </div>
                                        <div>
                                            <p class="text-dark-600 text-body-sm space-y-1">
                                                附件一：招生簡章<br>
                                                附件二：關懷者名單<br>
                                                附件三：申請表（初次申請）<br>
                                                附件四：申請表（繼續申請）<br>
                                                附件五：關懷者變動申請表<br>
                                                附件六：結案通知書<br>
                                                附件七：生命教育教案申請表
                                            </p>
                                        </div>
                                    </div>
                                    <a href="https://drive.google.com/drive/folders/1VKthr45KfLAP4w3JwmXJGp05M7XHVQ3H?usp=share_link" target="_blank" rel="noopener" class="btn-primary mt-6">
                                        前往申請文件
                                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- 專案教材 -->
                        <div class="volunteer-panel hidden" id="panel-materials">
                            <h3 class="text-h4 text-dark mb-4">文件目錄</h3>
                            <ol class="list-decimal list-inside space-y-2 text-dark-600 mb-6">
                                <li>申請前8堂課教材</li>
                                <li>得榮少年月刊</li>
                                <li>得榮少年家訪課程</li>
                            </ol>
                            <a href="https://drive.google.com/drive/folders/1huW6bMoEHoW92M3LBZoT-x_XpdyME1UD?usp=share_link" target="_blank" rel="noopener" class="btn-primary">
                                前往專案教材
                                <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                            </a>
                        </div>

                        <!-- 專案招生 -->
                        <div class="volunteer-panel hidden" id="panel-recruitment">
                            <h3 class="text-h4 text-dark mb-4">文件目錄</h3>
                            <ol class="list-decimal list-inside space-y-2 text-dark-600 mb-6">
                                <li>建議清單</li>
                                <li>招生傳單</li>
                                <li>專案轉介單</li>
                            </ol>
                            <a href="https://drive.google.com/drive/folders/1huW6bMoEHoW92M3LBZoT-x_XpdyME1UD?usp=share_link" target="_blank" rel="noopener" class="btn-primary">
                                前往招生文件
                                <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                            </a>
                        </div>

                        <!-- 2024 成果展 -->
                        <div class="volunteer-panel hidden" id="panel-results">
                            <h3 class="text-h4 text-dark mb-4">2024 成果展</h3>
                            <p class="text-dark-600">成果展相關資料與回顧。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.volunteer-tab');
            const panels = document.querySelectorAll('.volunteer-panel');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    const target = this.dataset.tab;

                    tabs.forEach(function(t) {
                        t.classList.remove('active', 'border-primary-500', 'text-primary-500');
                        t.classList.add('border-transparent', 'text-dark-400');
                    });
                    this.classList.add('active', 'border-primary-500', 'text-primary-500');
                    this.classList.remove('border-transparent', 'text-dark-400');

                    panels.forEach(function(p) {
                        p.classList.add('hidden');
                        p.classList.remove('active');
                    });
                    var panel = document.getElementById('panel-' + target);
                    if (panel) {
                        panel.classList.remove('hidden');
                        panel.classList.add('active');
                    }
                });
            });
        });
        </script>

    <?php else : ?>

        <!-- Not logged in: Show login prompt + volunteer info -->
        <section class="section">
            <div class="container-content max-w-4xl">
                <div class="bg-white rounded-2xl shadow-card p-8 md:p-12 text-center">
                    <div class="w-20 h-20 bg-accent-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <?php echo glory_get_icon('users', 'w-10 h-10 text-accent-green'); ?>
                    </div>
                    <h2 class="text-h3 text-dark mb-4">登入志工專區</h2>
                    <p class="text-dark-600 mb-8 max-w-lg mx-auto">
                        登入後即可存取志工專屬資源，包含申請文件、專案教材、招生文件等。
                    </p>
                    <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="btn-primary btn-lg">
                        登入
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- Volunteer sharing link -->
        <section class="section bg-gray-50">
            <div class="container-content max-w-4xl">
                <div class="section-header">
                    <h2>志工心得分享</h2>
                    <p>看看志工們的服務心得與故事</p>
                    <span class="section-header-bar"></span>
                </div>

                <?php
                $volunteer_posts = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'category_name'  => 'volunteer',
                    'post_status'    => 'publish',
                ]);

                if ($volunteer_posts->have_posts()) : ?>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($volunteer_posts->have_posts()) : $volunteer_posts->the_post(); ?>
                            <article class="card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-[3/2] overflow-hidden">
                                        <?php the_post_thumbnail('glory-card', ['class' => 'w-full h-full object-cover']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h3 class="text-body font-bold text-dark mb-2">
                                        <a href="<?php the_permalink(); ?>" class="no-underline hover:text-primary-500">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="text-body-sm text-dark-400"><?php echo glory_truncate(get_the_excerpt(), 80); ?></p>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>

                <div class="text-center mt-8">
                    <a href="<?php echo esc_url(home_url('/volunteer-sharing/')); ?>" class="btn-outline">
                        查看更多志工心得
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
            </div>
        </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
