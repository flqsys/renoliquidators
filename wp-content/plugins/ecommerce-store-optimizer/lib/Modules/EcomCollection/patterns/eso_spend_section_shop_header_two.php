<?php
/**
 * Genesis Blocks Shop Header Two section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_shop_header_two',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/spend/tshirt-header.jpg\",\"backgroundDimRatio\":30,\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":14,\"paddingRight\":3,\"paddingBottom\":12,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#273533\",\"columnMaxWidth\":634,\"className\":\"eso-spend-section-shop-header-two \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-shop-header-two gb-layout-columns-1 gb-1-col-equal gb-has-background-dim gb-has-background-dim-30 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:14%;padding-right:3%;padding-bottom:12%;padding-left:3%;background-color:#273533;background-image:url(https://demo.studiopress.com/page-builder/spend/tshirt-header.jpg);background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:634px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}},\"textColor\":\"eso-white\"} -->
<h2 class=\"has-text-align-center has-eso-white-color has-text-color\" style=\"font-size:50px\">Get 25% off today only!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":20}},\"textColor\":\"eso-white\"} -->
<p class=\"has-text-align-center has-eso-white-color has-text-color\" style=\"font-size:20px\">For a limited time, our winter stock collection is 25% off for all customers. As a bonus, get free shipping on orders over $99!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link no-border-radius\">Shop the sale →</a></div>
<!-- /wp:button -->

<!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\",\"className\":\"is-style-fill\"} -->
<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Browse shirts →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Shop Header Two', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'hero', 'ecommerce-store-optimizer' ),
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop header two', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_shop_header_two.jpg',
];
