<?php
/**
 * Genesis Blocks Call To Action section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_call_to_action',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"gb-1-col-equal\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-call-to-action \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-call-to-action gb-layout-columns-1 gb-1-col-equal has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\",\"padding\":2} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\" style=\"padding:2em\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}},\"className\":\"has-text-align-center\"} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Preview Black Friday Deals</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Black Friday is almost here! Check out our exclusive releases this year and get ready for some hot deals!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\"} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Preview Black Friday Deals</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Call To Action', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend call to action', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_call_to_action.jpg',
];
