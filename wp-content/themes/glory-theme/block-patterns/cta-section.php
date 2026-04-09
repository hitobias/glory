<?php
/**
 * Block Pattern: Call to Action Section
 */
return [
    'slug'        => 'cta-section',
    'title'       => __('行動呼籲區塊', 'glory-theme'),
    'description' => __('醒目背景色搭配標語和按鈕', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['cta', 'call to action', '行動', '呼籲'],
    'content'     => '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"#2872fa"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group alignfull" style="background-color:#2872fa;padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2rem"}},"textColor":"white"} -->
    <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:2rem">一起為下一代的未來努力</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem"},"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="font-size:1.125rem;margin-bottom:2rem">您的每一份支持，都是孩子成長路上最溫暖的力量。無論是捐款、擔任志工或分享我們的故事，都能帶來改變。</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"backgroundColor":"accent","textColor":"dark","style":{"border":{"radius":"8px"},"typography":{"fontWeight":"600","fontSize":"1.1rem"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-dark-color has-accent-background-color has-text-color has-background" style="border-radius:8px;font-weight:600;font-size:1.1rem;padding:0.875rem 2rem">立即捐款</a></div>
        <!-- /wp:button -->

        <!-- wp:button {"style":{"border":{"radius":"8px","width":"2px","color":"#ffffff"},"typography":{"fontWeight":"600","fontSize":"1.1rem"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}},"color":{"text":"#ffffff"}},"className":"is-style-outline"} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color" style="border-radius:8px;border-width:2px;border-color:#ffffff;font-weight:600;font-size:1.1rem;padding:0.875rem 2rem;color:#ffffff">加入志工</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
',
];
