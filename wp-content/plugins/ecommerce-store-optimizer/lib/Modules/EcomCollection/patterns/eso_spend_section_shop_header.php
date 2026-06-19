<?php
/**
 * Genesis Blocks Shop Header section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_shop_header',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/spend/tshirt-header.jpg\",\"backgroundDimRatio\":30,\"columns\":2,\"layout\":\"gb-2-col-wideleft\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#273533\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-shop-header\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-shop-header gb-layout-columns-2 gb-2-col-wideleft gb-has-background-dim gb-has-background-dim-30 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#273533;background-image:url(https://demo.studiopress.com/page-builder/spend/tshirt-header.jpg)\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"backgroundColor\":\"eso-white\",\"paddingSync\":true,\"paddingUnit\":\"em\",\"padding\":2} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner has-eso-white-background-color\" style=\"padding:2em\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 style=\"font-size:50px\">Shop smart, save cash.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For a limited time, our winter stock collection is 25% off for all customers. As a bonus, get free shipping on orders over $99!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":0} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link no-border-radius\">Shop the sale →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Shop Header', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop header', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_shop_header.jpg',
];
