<?php
/**
 * Block Pattern: Testimonial Cards
 */
return [
    'slug'        => 'testimonial-cards',
    'title'       => __('回饋見證卡片', 'glory-theme'),
    'description' => __('三欄式回饋見證展示', 'glory-theme'),
    'categories'  => ['featured'],
    'keywords'    => ['testimonial', '見證', '回饋'],
    'content'     => '
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:5rem;padding-bottom:5rem">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">感動見證</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"dark-400"} -->
    <p class="has-text-align-center has-dark-400-color has-text-color" style="margin-bottom:3rem">聽聽參與者們的真實故事</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"card"} -->
        <div class="wp-block-column card has-white-background-color has-background" style="border-radius:12px;padding:2rem">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"}}} -->
            <p style="font-size:2rem">❝</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","lineHeight":"1.8"}},"textColor":"dark-500"} -->
            <p class="has-dark-500-color has-text-color" style="font-size:1rem;line-height:1.8">生命教育課程讓我學會珍惜身邊的人，也更懂得感恩。每次上課都是一次心靈的洗禮。</p>
            <!-- /wp:paragraph -->
            <!-- wp:separator {"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}},"className":"is-style-wide"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:1.5rem;margin-bottom:1.5rem"/>
            <!-- /wp:separator -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem","fontWeight":"600"}},"textColor":"dark"} -->
            <p class="has-dark-color has-text-color" style="font-size:0.95rem;font-weight:600">小明同學</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"}},"textColor":"dark-400"} -->
            <p class="has-dark-400-color has-text-color" style="font-size:0.85rem">國中二年級學生</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"card"} -->
        <div class="wp-block-column card has-white-background-color has-background" style="border-radius:12px;padding:2rem">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"}}} -->
            <p style="font-size:2rem">❝</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","lineHeight":"1.8"}},"textColor":"dark-500"} -->
            <p class="has-dark-500-color has-text-color" style="font-size:1rem;line-height:1.8">感謝得榮基金會的快樂學習計畫，讓我的孩子在課後有安全的環境學習，成績也進步了很多。</p>
            <!-- /wp:paragraph -->
            <!-- wp:separator {"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}},"className":"is-style-wide"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:1.5rem;margin-bottom:1.5rem"/>
            <!-- /wp:separator -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem","fontWeight":"600"}},"textColor":"dark"} -->
            <p class="has-dark-color has-text-color" style="font-size:0.95rem;font-weight:600">陳媽媽</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"}},"textColor":"dark-400"} -->
            <p class="has-dark-400-color has-text-color" style="font-size:0.85rem">快樂學習學生家長</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"card"} -->
        <div class="wp-block-column card has-white-background-color has-background" style="border-radius:12px;padding:2rem">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"}}} -->
            <p style="font-size:2rem">❝</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","lineHeight":"1.8"}},"textColor":"dark-500"} -->
            <p class="has-dark-500-color has-text-color" style="font-size:1rem;line-height:1.8">擔任志工的這幾年，是我人生中最有意義的時光。看到孩子們的笑容，一切付出都值得了。</p>
            <!-- /wp:paragraph -->
            <!-- wp:separator {"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}},"className":"is-style-wide"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:1.5rem;margin-bottom:1.5rem"/>
            <!-- /wp:separator -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem","fontWeight":"600"}},"textColor":"dark"} -->
            <p class="has-dark-color has-text-color" style="font-size:0.95rem;font-weight:600">林老師</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"}},"textColor":"dark-400"} -->
            <p class="has-dark-400-color has-text-color" style="font-size:0.85rem">資深志工</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
',
];
