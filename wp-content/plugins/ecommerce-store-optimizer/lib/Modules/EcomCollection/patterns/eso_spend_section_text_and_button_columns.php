<?php
/**
 * Genesis Blocks Text and Button Columns section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_text_and_button_columns',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-white\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-text-and-button-columns \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-text-and-button-columns gb-layout-columns-1 one-column has-eso-white-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":700} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:700px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Shop With Confidence</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Customer happiness is our top priority. Shop with confidence knowing our products are backed by a 100% money back guarantee!</p>
<!-- /wp:paragraph --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Top Notch Support</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We're here to help! Our team of support experts is on call 24/7 to help answer any questions you have about our products or services.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Easy Returns</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Returning products is simple. We offer a super easy return program to help you return products or exchange them for one you like.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Affiliate Program</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Join our affiliate program to earn cash for every sale you send our way. We offer some of the best affiliate referral rates in the business.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Text and Button Columns', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
		esc_html__( 'services', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'columns', 'ecommerce-store-optimizer' ),
		esc_html__( 'text', 'ecommerce-store-optimizer' ),
		esc_html__( 'services', 'ecommerce-store-optimizer' ),
		esc_html__( 'button', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend text and button columns', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_text_and_button_columns.jpg',
];
