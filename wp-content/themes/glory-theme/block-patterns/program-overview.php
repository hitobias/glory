<?php
/**
 * Block Pattern: Program Overview
 */
return [
    'slug'        => 'program-overview',
    'title'       => __('課程計畫概覽', 'glory-theme'),
    'description' => __('圖文並排的課程計畫介紹區塊', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['program', 'overview', '課程', '計畫'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:5rem;padding-bottom:5rem">
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns are-vertically-aligned-center alignwide">
        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"12px"}}} -->
            <figure class="wp-block-image size-large" style="border-radius:12px"><img src="" alt="課程計畫"/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"left":"2rem"}}}} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%;padding-left:2rem">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.1em"}},"textColor":"primary-500"} -->
            <p class="has-primary-500-color has-text-color" style="font-size:0.875rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em">課程計畫</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"1rem"}}}} -->
            <h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:1rem">生命教育課程</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.8"}},"textColor":"dark-500"} -->
            <p class="has-dark-500-color has-text-color" style="line-height:1.8">我們深入全台各級學校，透過互動式教學、繪本導讀、影片討論等多元方式，引導學生探索生命的意義與價值，培養正向的人生態度。</p>
            <!-- /wp:paragraph -->

            <!-- wp:list {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
            <ul style="margin-top:1.5rem">
                <li>覆蓋全台超過 200 所學校</li>
                <li>累計服務超過 50,000 名學生</li>
                <li>300+ 位專業志工教師</li>
            </ul>
            <!-- /wp:list -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
            <div class="wp-block-buttons" style="margin-top:2rem">
                <!-- wp:button {"style":{"border":{"radius":"8px"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link" style="border-radius:8px">了解更多</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
',
];
