<?php
/**
 * Block Pattern: Video Embed Section
 */
return [
    'slug'        => 'video-embed-section',
    'title'       => __('影片嵌入區塊', 'glory-theme'),
    'description' => __('帶標題的影片嵌入區塊', 'glory-theme'),
    'categories'  => ['media'],
    'keywords'    => ['video', '影片', 'embed'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"#192a3d"}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group alignwide" style="background-color:#192a3d;padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"white"} -->
    <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:1rem">認識得榮基金會</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2.5rem"}}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="margin-bottom:2.5rem">透過影片了解我們的使命與服務</p>
    <!-- /wp:paragraph -->

    <!-- wp:embed {"providerNameSlug":"youtube","responsive":true,"style":{"border":{"radius":"12px"}}} -->
    <figure class="wp-block-embed is-provider-youtube" style="border-radius:12px">
        <div class="wp-block-embed__wrapper">
            https://www.youtube.com/watch?v=PLACEHOLDER
        </div>
    </figure>
    <!-- /wp:embed -->
</div>
<!-- /wp:group -->
',
];
