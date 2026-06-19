<?php
/**
 * Genesis Blocks Text Boxes section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_text_boxes',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-text-boxes \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-text-boxes gb-layout-columns-1 one-column has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"columnMaxWidth\":840} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:840px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Shop small and save big!</h2>
<!-- /wp:heading -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":30}}} -->
<h3 class=\"has-text-align-center\" style=\"font-size:30px\">Top Notch Support</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Need help? Our customer support specialists are available to assist you seven days a week, 24 hours a day.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\"} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":30}}} -->
<h3 class=\"has-text-align-center\" style=\"font-size:30px\">Easy Returns</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Our return policy is simple – if you are not 100% satisfied with your purchase, you can return it within 30 days.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\"} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":30}}} -->
<h3 class=\"has-text-align-center\" style=\"font-size:30px\">Affiliate Program</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Start promoting our products and earn commissions and bonuses through our affiliate program.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\"} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Text Boxes', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'button', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend text boxes', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_text_boxes.jpg',
];
