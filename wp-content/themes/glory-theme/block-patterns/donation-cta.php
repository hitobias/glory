<?php
/**
 * Block Pattern: Donation CTA
 */
return [
    'slug'        => 'donation-cta',
    'title'       => __('捐款呼籲區塊', 'glory-theme'),
    'description' => __('帶統計數字和多種捐款方式的區塊', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['donation', 'cta', '捐款'],
    'content'     => '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"gradient":"linear-gradient(135deg,#2872fa 0%,#195630 100%)"}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group alignfull has-background" style="background:linear-gradient(135deg,#2872fa 0%,#195630 100%);padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.25rem"}},"textColor":"white"} -->
    <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:2.25rem">您的愛心，是孩子最好的禮物</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2.5rem"}},"typography":{"fontSize":"1.1rem"}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="font-size:1.1rem;margin-bottom:2.5rem">每一筆捐款都直接用於支持弱勢孩子的教育與成長</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
    <div class="wp-block-columns" style="margin-bottom:3rem">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"}},"textColor":"accent"} -->
            <h3 class="wp-block-heading has-text-align-center has-accent-color has-text-color" style="font-size:2.5rem;font-weight:700">200+</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","textColor":"white","style":{"typography":{"fontSize":"0.95rem"}}} -->
            <p class="has-text-align-center has-white-color has-text-color" style="font-size:0.95rem">合作學校</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"}},"textColor":"accent"} -->
            <h3 class="wp-block-heading has-text-align-center has-accent-color has-text-color" style="font-size:2.5rem;font-weight:700">50,000+</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","textColor":"white","style":{"typography":{"fontSize":"0.95rem"}}} -->
            <p class="has-text-align-center has-white-color has-text-color" style="font-size:0.95rem">受惠學生</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"}},"textColor":"accent"} -->
            <h3 class="wp-block-heading has-text-align-center has-accent-color has-text-color" style="font-size:2.5rem;font-weight:700">300+</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","textColor":"white","style":{"typography":{"fontSize":"0.95rem"}}} -->
            <p class="has-text-align-center has-white-color has-text-color" style="font-size:0.95rem">志工教師</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"backgroundColor":"accent","textColor":"dark","style":{"border":{"radius":"8px"},"typography":{"fontWeight":"700","fontSize":"1.125rem"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-dark-color has-accent-background-color has-text-color has-background" style="border-radius:8px;font-weight:700;font-size:1.125rem;padding:1rem 2.5rem">我要捐款</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1.5rem"}},"typography":{"fontSize":"0.875rem"}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="font-size:0.875rem;margin-top:1.5rem">捐款收據可供抵稅 | 郵政劃撥、銀行轉帳、線上捐款皆可</p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
',
];
