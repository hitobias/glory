<?php
/**
 * Template Part: Site Header
 * Transparent → solid on scroll, animated hamburger, mobile accordion
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

$social_links = glory_get_social_links();
$logo_url = GLORY_THEME_URI . '/assets/images/logo.png';
?>

<!-- Fixed Header Wrapper (topbar + nav together) -->
<div class="header-wrap" id="site-header">

    <!-- Main Header -->
    <header class="site-header">
        <div class="container-content flex items-center justify-between h-14 lg:h-20">

            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <img src="<?php echo esc_url($logo_url); ?>" alt="得榮基金會" class="h-9 lg:h-[3.25rem] w-auto">
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden lg:block" aria-label="<?php esc_attr_e('主選單', 'glory-theme'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'glory-nav',
                    'fallback_cb'    => 'glory_fallback_menu',
                    'depth'          => 2,
                ]);
                ?>
            </nav>

            <!-- Mobile: just the hamburger -->
            <button class="hamburger lg:hidden" data-drawer-toggle aria-label="<?php esc_attr_e('開啟選單', 'glory-theme'); ?>" aria-expanded="false">
                <span class="hamburger-box">
                    <span class="hamburger-line hamburger-line--top"></span>
                    <span class="hamburger-line hamburger-line--mid"></span>
                    <span class="hamburger-line hamburger-line--bot"></span>
                </span>
            </button>
        </div>
    </header>
</div>

<!-- Mobile Drawer Overlay -->
<div data-drawer-overlay class="drawer-overlay" aria-hidden="true"></div>

<!-- Mobile Drawer Panel (full-screen on phones) -->
<nav data-drawer-panel class="drawer-panel" aria-label="<?php esc_attr_e('行動裝置選單', 'glory-theme'); ?>">
    <!-- Drawer Header -->
    <div class="drawer-header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="no-underline">
            <img src="<?php echo esc_url($logo_url); ?>" alt="得榮基金會" class="h-9 w-auto">
        </a>
        <button data-drawer-close class="hamburger is-active" aria-label="<?php esc_attr_e('關閉選單', 'glory-theme'); ?>">
            <span class="hamburger-box">
                <span class="hamburger-line hamburger-line--top"></span>
                <span class="hamburger-line hamburger-line--mid"></span>
                <span class="hamburger-line hamburger-line--bot"></span>
            </span>
        </button>
    </div>

    <!-- Drawer Body -->
    <div class="drawer-body">
        <?php
        wp_nav_menu([
            'theme_location' => 'mobile',
            'container'      => false,
            'menu_class'     => 'mobile-nav',
            'fallback_cb'    => function () {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'mobile-nav',
                    'fallback_cb'    => 'glory_fallback_menu',
                ]);
            },
            'depth' => 2,
        ]);
        ?>

        <!-- Drawer Contact -->
        <div class="drawer-contact">
            <a href="tel:02-87881930" class="drawer-contact-item">
                <?php echo glory_get_icon('phone', 'w-4 h-4 flex-shrink-0'); ?>
                (02)8788-1930
            </a>
            <a href="mailto:service@glory.org.tw" class="drawer-contact-item">
                <?php echo glory_get_icon('mail', 'w-4 h-4 flex-shrink-0'); ?>
                service@glory.org.tw
            </a>
            <div class="drawer-contact-item">
                <?php echo glory_get_icon('location', 'w-4 h-4 flex-shrink-0 mt-0.5'); ?>
                <span>台北市信義路四段460號3F-1</span>
            </div>
        </div>
    </div>
</nav>
