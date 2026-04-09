<?php
/**
 * Template Part: Site Footer
 * Mobile-first responsive footer
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

$social_links = glory_get_social_links();
?>

<footer class="bg-gradient-to-br from-accent-green to-dark text-white">
    <!-- Main Footer -->
    <div class="container-content py-12 md:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
            <!-- Column 1: About -->
            <div class="sm:col-span-2 lg:col-span-1">
                <img src="<?php echo esc_url(GLORY_THEME_URI . '/assets/images/logo.png'); ?>" alt="得榮基金會" class="h-12 w-auto mb-3 brightness-0 invert">
                <h3 class="text-lg font-bold text-white mb-3">財團法人台北市私立得榮社會福利基金會</h3>
                <p class="text-dark-300 text-body-sm leading-relaxed mb-5">
                    致力於生命教育推廣、弱勢兒少關懷及社會公益服務，為台灣社會注入正向力量。
                </p>
                <div class="flex items-center gap-2">
                    <?php if (!empty($social_links['facebook'])) : ?>
                        <a href="<?php echo esc_url($social_links['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="footer-social footer-social--fb" aria-label="Facebook">
                            <?php echo glory_get_icon('facebook', 'w-4 h-4'); ?>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($social_links['youtube'])) : ?>
                        <a href="<?php echo esc_url($social_links['youtube']); ?>" target="_blank" rel="noopener noreferrer" class="footer-social footer-social--yt" aria-label="YouTube">
                            <?php echo glory_get_icon('youtube', 'w-4 h-4'); ?>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($social_links['instagram'])) : ?>
                        <a href="<?php echo esc_url($social_links['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="footer-social footer-social--ig" aria-label="Instagram">
                            <?php echo glory_get_icon('instagram', 'w-4 h-4'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Column 2: Services -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">服務項目</h4>
                <ul class="list-none m-0 p-0 space-y-2.5">
                    <li><a href="<?php echo esc_url(get_permalink(7823)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">生命教育</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(7259)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">快樂學習</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(7329)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">PHL 合唱團</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(7287)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">得榮少年</a></li>
                </ul>
            </div>

            <!-- Column 3: Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">快速連結</h4>
                <ul class="list-none m-0 p-0 space-y-2.5">
                    <li><a href="<?php echo esc_url(home_url('/aboutus/')); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">關於我們</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">最新消息</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(19)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">關懷與捐款</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(34)); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">聯絡我們</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">隱私權政策</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">聯絡資訊</h4>
                <ul class="list-none m-0 p-0 space-y-3">
                    <li class="flex items-start gap-2">
                        <?php echo glory_get_icon('location', 'w-4 h-4 mt-1 flex-shrink-0 text-accent'); ?>
                        <span class="text-dark-300 text-body-sm">台北市信義路四段460號3F-1</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php echo glory_get_icon('phone', 'w-4 h-4 flex-shrink-0 text-accent'); ?>
                        <a href="tel:02-87881930" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">(02)8788-1930</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php echo glory_get_icon('fax', 'w-4 h-4 flex-shrink-0 text-accent'); ?>
                        <span class="text-dark-300 text-body-sm">傳真：(02)8788-3547</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php echo glory_get_icon('mail', 'w-4 h-4 flex-shrink-0 text-accent'); ?>
                        <a href="mailto:service@glory.org.tw" class="text-dark-300 hover:text-accent transition-colors no-underline text-body-sm">service@glory.org.tw</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-dark-800">
        <div class="container-content py-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-center sm:text-left">
            <p class="text-dark-400 text-xs m-0">
                &copy; <?php echo esc_html(date('Y')); ?> All rights Reserved. 財團法人台北市私立得榮社會福利基金會
            </p>
        </div>
    </div>

</footer>
