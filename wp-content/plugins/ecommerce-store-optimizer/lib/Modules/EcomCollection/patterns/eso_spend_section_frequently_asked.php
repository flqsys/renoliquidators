<?php
/**
 * Genesis Blocks Frequently Asked section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_frequently_asked',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-white\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-frequently-asked \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-frequently-asked gb-layout-columns-1 one-column has-eso-white-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}},\"className\":\"has-text-align-center\"} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Frequently Asked Questions</h2>
<!-- /wp:heading --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"columnsGap\":4,\"marginBottom\":3,\"marginUnit\":\"%\",\"columnMaxWidth\":1200} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal gb-columns-center\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-4 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":24}}} -->
<h3 style=\"font-size:24px\">1. Are you currently hiring?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We are currently hiring for design and development roles. Please reach out to us at jobs@theawesomecreative.com for info!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":24}}} -->
<h3 style=\"font-size:24px\">2. What are your working hours?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We work 9am-6pm, Monday through Friday. Our support reps are available throughout the whole weekend.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":24}}} -->
<h3 style=\"font-size:24px\">3. Are you accepting new clients?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We’re always looking for the opportunity to work on new and exciting products. Send us your project today!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":24}}} -->
<h3 style=\"font-size:24px\">4. Do you provide discounts?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our work is priced according to the amount of work and value we provide on delivery. Discounts aren’t necessary.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Frequently Asked', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'services', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'faq', 'ecommerce-store-optimizer' ),
		esc_html__( 'questions', 'ecommerce-store-optimizer' ),
		esc_html__( 'details', 'ecommerce-store-optimizer' ),
		esc_html__( 'text', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend frequently asked', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_frequently_asked.jpg',
];
