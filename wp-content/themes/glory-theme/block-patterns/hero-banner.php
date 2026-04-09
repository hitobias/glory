<?php
/**
 * Block Pattern: Hero Banner
 */
return [
    'slug'        => 'hero-banner',
    'title'       => __('首頁大圖橫幅', 'glory-theme'),
    'description' => __('全幅背景圖片搭配標題、說明文字和行動按鈕', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['hero', 'banner', '橫幅', '首頁'],
    'content'     => '
<!-- wp:cover {"dimRatio":60,"overlayColor":"dark","minHeight":600,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:600px">
    <span aria-hidden="true" class="wp-block-cover__background has-dark-background-color has-background-dim-60 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3rem"}},"textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:3rem">散播生命的種子，培育希望的未來</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"}},"textColor":"white"} -->
            <p class="has-text-align-center has-white-color has-text-color" style="font-size:1.25rem">得榮社會福利基金會致力於生命教育、快樂學習與青少年關懷，為社會注入正向力量。</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
            <div class="wp-block-buttons" style="margin-top:2rem">
                <!-- wp:button {"backgroundColor":"accent","textColor":"dark","style":{"border":{"radius":"8px"},"typography":{"fontWeight":"600"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-dark-color has-accent-background-color has-text-color has-background" style="border-radius:8px;font-weight:600">認識我們</a></div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"8px"},"typography":{"fontWeight":"600"}}} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link" style="border-radius:8px;font-weight:600">支持捐款</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->
',
];
