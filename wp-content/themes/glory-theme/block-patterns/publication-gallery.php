<?php
/**
 * Block Pattern: Publication Gallery
 */
return [
    'slug'        => 'publication-gallery',
    'title'       => __('出版品展示', 'glory-theme'),
    'description' => __('出版品封面圖展示區塊', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['publication', 'gallery', '出版品', '書籍'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">出版品</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"dark-400"} -->
    <p class="has-text-align-center has-dark-400-color has-text-color" style="margin-bottom:3rem">瀏覽我們的教材與刊物</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"style":{"border":{"radius":"12px"}},"className":"card"} -->
        <div class="wp-block-column card" style="border-radius:12px">
            <!-- wp:image {"sizeSlug":"medium","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
            <figure class="wp-block-image size-medium"><img src="" alt="出版品封面"/></figure>
            <!-- /wp:image -->
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"1rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}}} -->
            <div class="wp-block-group" style="padding:1rem 1.5rem 1.5rem">
                <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.1rem"}}} -->
                <h4 class="wp-block-heading" style="font-size:1.1rem">生命教育教材第一冊</h4>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
                <p class="has-dark-400-color has-text-color" style="font-size:0.875rem">適用國小三至六年級</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"border":{"radius":"12px"}},"className":"card"} -->
        <div class="wp-block-column card" style="border-radius:12px">
            <!-- wp:image {"sizeSlug":"medium","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
            <figure class="wp-block-image size-medium"><img src="" alt="出版品封面"/></figure>
            <!-- /wp:image -->
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"1rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}}} -->
            <div class="wp-block-group" style="padding:1rem 1.5rem 1.5rem">
                <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.1rem"}}} -->
                <h4 class="wp-block-heading" style="font-size:1.1rem">得榮月刊</h4>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
                <p class="has-dark-400-color has-text-color" style="font-size:0.875rem">每月發行</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"border":{"radius":"12px"}},"className":"card"} -->
        <div class="wp-block-column card" style="border-radius:12px">
            <!-- wp:image {"sizeSlug":"medium","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
            <figure class="wp-block-image size-medium"><img src="" alt="出版品封面"/></figure>
            <!-- /wp:image -->
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"1rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}}} -->
            <div class="wp-block-group" style="padding:1rem 1.5rem 1.5rem">
                <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1.1rem"}}} -->
                <h4 class="wp-block-heading" style="font-size:1.1rem">快樂學習手冊</h4>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
                <p class="has-dark-400-color has-text-color" style="font-size:0.875rem">志工專用教材</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
    <div class="wp-block-buttons" style="margin-top:2rem">
        <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"8px"}}} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link" style="border-radius:8px" href="/publications">查看全部出版品</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
',
];
