<?php
/**
 * Page Template: 志工心得分享
 * Slug: volunteer-sharing (Page ID: 7045)
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
            <h1 class="text-h2 md:text-h1 text-white mb-4">志工心得分享</h1>
            <p class="text-white/80 text-body md:text-body-lg max-w-2xl mx-auto">
                用生命感動生命，志工們在服務中看見改變的美好故事
            </p>
        </div>
    </section>

    <!-- Featured Video + Quote -->
    <section class="section">
        <div class="container-content max-w-6xl">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <!-- YouTube embed -->
                <div data-animate="fade-up">
                    <div class="rounded-2xl overflow-hidden shadow-card-hover">
                        <div class="relative" style="padding-bottom:56.25%">
                            <iframe
                                src="https://www.youtube.com/embed/I05ROHb-els"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="志工心得分享影片"
                            ></iframe>
                        </div>
                    </div>
                </div>

                <!-- Inspiring quote -->
                <div data-animate="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-accent-green/10 rounded-xl flex items-center justify-center">
                            <?php echo glory_get_icon('heart', 'w-6 h-6 text-accent-green'); ?>
                        </div>
                        <h2 class="text-h4 text-dark">志工的話</h2>
                    </div>
                    <blockquote class="border-l-4 border-accent-green pl-5">
                        <p class="text-dark-600 leading-relaxed mb-4">
                            「擔任志工，不僅僅是為了幫助他人、回饋社會而已，更重要的是我們看見<strong class="text-accent-green">『教育是一件具有影響力、創造力，且無遠弗屆、價值深遠的工作』</strong>」
                        </p>
                        <p class="text-dark-600 leading-relaxed">
                            「在服務中，我們看見孩子及其班級、家庭改變的美好故事；在經歷中，我們自己的生命更被充實而有豐富精彩的活出。」
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Blog Posts -->
    <section class="section bg-gray-50">
        <div class="container-content">
            <div class="section-header">
                <h2>志工分享文章</h2>
                <p>來自志工夥伴們的服務心得與感動</p>
                <span class="section-header-bar"></span>
            </div>

            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $args = [
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'category_name'  => 'volunteer',
                'post_status'    => 'publish',
                'paged'          => $paged,
            ];

            $volunteer_query = new WP_Query($args);

            if ($volunteer_query->have_posts()) : ?>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger>
                    <?php while ($volunteer_query->have_posts()) : $volunteer_query->the_post(); ?>
                        <article class="card group" data-animate="fade-up">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-[3/2] overflow-hidden" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail('glory-card', [
                                        'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
                                        'alt'   => esc_attr(get_the_title()),
                                    ]); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-[3/2] overflow-hidden bg-accent-green/5 flex items-center justify-center" aria-hidden="true" tabindex="-1">
                                    <div class="flex items-center justify-center w-full h-full">
                                        <?php echo glory_get_icon('heart', 'w-12 h-12 text-accent-green/30'); ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <time class="text-body-sm text-dark-400 block mb-2" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                                    <?php echo esc_html(glory_post_date()); ?>
                                </time>
                                <h3 class="text-body font-bold text-dark mb-2">
                                    <a href="<?php the_permalink(); ?>" class="no-underline hover:text-primary-500 transition-colors">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h3>
                                <p class="text-body-sm text-dark-400">
                                    <?php echo esc_html(glory_truncate(get_the_excerpt(), 80)); ?>
                                </p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php if ($volunteer_query->max_num_pages > 1) : ?>
                    <div class="mt-10 flex justify-center">
                        <?php
                        echo paginate_links([
                            'total'     => $volunteer_query->max_num_pages,
                            'current'   => $paged,
                            'prev_text' => '&laquo; 上一頁',
                            'next_text' => '下一頁 &raquo;',
                            'type'      => 'list',
                            'class'     => 'pagination',
                        ]);
                        ?>
                    </div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <!-- Empty state -->
                <div class="bg-white rounded-2xl shadow-card p-8 md:p-12 text-center max-w-lg mx-auto">
                    <div class="w-20 h-20 bg-accent-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <?php echo glory_get_icon('heart', 'w-10 h-10 text-accent-green'); ?>
                    </div>
                    <h3 class="text-h4 text-dark mb-3">目前尚無分享文章</h3>
                    <p class="text-dark-400 mb-6">
                        志工心得分享文章即將上線，敬請期待。
                    </p>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-outline">
                        瀏覽最新消息
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-accent/10 py-14 md:py-20">
        <div class="container-content text-center" data-animate="fade-up">
            <div class="max-w-xl mx-auto">
                <h2 class="text-h3 md:text-h2 text-dark mb-4">一起加入志工行列</h2>
                <p class="text-dark-500 text-body-lg mb-8">
                    用您的時間與愛心，陪伴青少年成長，見證生命改變的力量
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/worker/')); ?>" class="btn-primary btn-lg">
                        志工專區
                        <?php echo glory_get_icon('arrow-right', 'w-5 h-5'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/volunteer-training/13424/')); ?>" class="btn-outline btn-lg">
                        報名志工培訓
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
