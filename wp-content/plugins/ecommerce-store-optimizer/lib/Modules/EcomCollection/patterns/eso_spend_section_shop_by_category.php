<?php
/**
 * Genesis Blocks Shop By Category section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_shop_by_category',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"gb-1-col-equal\",\"align\":\"full\",\"marginUnit\":\"%\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-white\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-shop-by-category \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-shop-by-category gb-layout-columns-1 gb-1-col-equal has-eso-white-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}},\"className\":\"has-text-align-center\"} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Shop by category</h2>
<!-- /wp:heading -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-category /--></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-category /--></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-category /--></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Shop By Category', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'Products', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop by category', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_shop_by_category.jpg',
];
