<?php
/**
 * Block Pattern: Info Boxes
 */
return [
    'slug'        => 'info-boxes',
    'title'       => __('服務項目方塊', 'glory-theme'),
    'description' => __('四個圖示加文字的服務項目介紹', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['info', 'boxes', 'services', '服務'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"#f8fafc"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="background-color:#f8fafc;padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:3rem">我們的服務</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"12px"}},"backgroundColor":"white"} -->
        <div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:2rem 1.5rem">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem"}}} -->
            <p class="has-text-align-center" style="font-size:2.5rem">📚</p>
            <!-- /wp:paragraph -->
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.25rem"}}} -->
            <h3 class="wp-block-heading has-text-align-center" style="font-size:1.25rem">生命教育</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.95rem">深入校園推動生命教育課程，幫助學生認識生命價值、建立正確人生觀。</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"12px"}},"backgroundColor":"white"} -->
        <div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:2rem 1.5rem">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem"}}} -->
            <p class="has-text-align-center" style="font-size:2.5rem">🎵</p>
            <!-- /wp:paragraph -->
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.25rem"}}} -->
            <h3 class="wp-block-heading has-text-align-center" style="font-size:1.25rem">快樂學習</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.95rem">提供多元課後照顧服務，讓弱勢家庭孩子也能享有優質學習資源。</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"12px"}},"backgroundColor":"white"} -->
        <div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:2rem 1.5rem">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem"}}} -->
            <p class="has-text-align-center" style="font-size:2.5rem">🎤</p>
            <!-- /wp:paragraph -->
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.25rem"}}} -->
            <h3 class="wp-block-heading has-text-align-center" style="font-size:1.25rem">合唱團</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.95rem">透過音樂培養團隊合作精神，讓孩子在歌聲中找到自信與歸屬感。</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"12px"}},"backgroundColor":"white"} -->
        <div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:2rem 1.5rem">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem"}}} -->
            <p class="has-text-align-center" style="font-size:2.5rem">🌱</p>
            <!-- /wp:paragraph -->
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.25rem"}}} -->
            <h3 class="wp-block-heading has-text-align-center" style="font-size:1.25rem">得榮少年</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}},"textColor":"dark-400"} -->
            <p class="has-text-align-center has-dark-400-color has-text-color" style="font-size:0.95rem">關懷弱勢青少年，提供獎助學金、輔導與多元發展機會。</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
',
];
