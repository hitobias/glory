<?php
/**
 * Block Pattern: Team Grid
 */
return [
    'slug'        => 'team-grid',
    'title'       => __('團隊成員展示', 'glory-theme'),
    'description' => __('團隊成員照片與職稱網格', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['team', 'grid', '團隊', '成員'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">我們的團隊</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"dark-400"} -->
    <p class="has-text-align-center has-dark-400-color has-text-color" style="margin-bottom:3rem">專業且充滿熱忱的夥伴們</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"style":{"spacing":{"padding":{"bottom":"1rem"}}}} -->
        <div class="wp-block-column" style="padding-bottom:1rem">
            <!-- wp:image {"align":"center","sizeSlug":"thumbnail","style":{"border":{"radius":"999px"}}} -->
            <figure class="wp-block-image aligncenter size-thumbnail" style="border-radius:999px"><img src="" alt="團隊成員"/></figure>
            <!-- /wp:image -->
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontSize":"1.1rem"},"spacing":{"margin":{"top":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="font-size:1.1rem;margin-top:1rem">董事長</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.875rem">基金會創辦人</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"bottom":"1rem"}}}} -->
        <div class="wp-block-column" style="padding-bottom:1rem">
            <!-- wp:image {"align":"center","sizeSlug":"thumbnail","style":{"border":{"radius":"999px"}}} -->
            <figure class="wp-block-image aligncenter size-thumbnail" style="border-radius:999px"><img src="" alt="團隊成員"/></figure>
            <!-- /wp:image -->
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontSize":"1.1rem"},"spacing":{"margin":{"top":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="font-size:1.1rem;margin-top:1rem">執行長</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.875rem">基金會營運管理</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"bottom":"1rem"}}}} -->
        <div class="wp-block-column" style="padding-bottom:1rem">
            <!-- wp:image {"align":"center","sizeSlug":"thumbnail","style":{"border":{"radius":"999px"}}} -->
            <figure class="wp-block-image aligncenter size-thumbnail" style="border-radius:999px"><img src="" alt="團隊成員"/></figure>
            <!-- /wp:image -->
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontSize":"1.1rem"},"spacing":{"margin":{"top":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="font-size:1.1rem;margin-top:1rem">課程總監</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.875rem">生命教育課程規劃</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"bottom":"1rem"}}}} -->
        <div class="wp-block-column" style="padding-bottom:1rem">
            <!-- wp:image {"align":"center","sizeSlug":"thumbnail","style":{"border":{"radius":"999px"}}} -->
            <figure class="wp-block-image aligncenter size-thumbnail" style="border-radius:999px"><img src="" alt="團隊成員"/></figure>
            <!-- /wp:image -->
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontSize":"1.1rem"},"spacing":{"margin":{"top":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="font-size:1.1rem;margin-top:1rem">志工主任</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.875rem">志工招募與培訓</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
',
];
