<?php
/**
 * Block Pattern: News Grid
 */
return [
    'slug'        => 'news-grid',
    'title'       => __('最新消息列表', 'glory-theme'),
    'description' => __('三欄式最新消息卡片網格', 'glory-theme'),
    'categories'  => ['posts'],
    'keywords'    => ['news', 'grid', '新聞', '消息'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">最新消息</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"dark-400"} -->
    <p class="has-text-align-center has-dark-400-color has-text-color" style="margin-bottom:3rem">關注得榮基金會的最新活動與公告</p>
    <!-- /wp:paragraph -->

    <!-- wp:query {"queryId":1,"query":{"perPage":3,"postType":"post","order":"desc","orderBy":"date"},"displayLayout":{"type":"flex","columns":3}} -->
    <div class="wp-block-query">
        <!-- wp:post-template -->
            <!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"card"} -->
            <div class="wp-block-group card" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                <!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} /-->
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}}} -->
                <div class="wp-block-group" style="padding:1.5rem">
                    <!-- wp:post-date {"style":{"typography":{"fontSize":"0.875rem"}},"textColor":"dark-400"} /-->
                    <!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"600"}},"textColor":"dark"} /-->
                    <!-- wp:post-excerpt {"moreText":"閱讀更多 →","excerptLength":30} /-->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        <!-- /wp:post-template -->

        <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">目前沒有最新消息。</p>
            <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:query -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
    <div class="wp-block-buttons" style="margin-top:2rem">
        <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"8px"}}} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link" style="border-radius:8px" href="/blog">查看全部消息</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
',
];
