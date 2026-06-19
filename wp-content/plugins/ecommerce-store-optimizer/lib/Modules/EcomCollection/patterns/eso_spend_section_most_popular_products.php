<?php
/**
 * Genesis Blocks Most Popular Products section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_most_popular_products',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"gb-1-col-equal\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#eeeeee\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-most-popular-products \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-most-popular-products gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#eeeeee\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}},\"className\":\"has-text-align-center\"} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Shop our most popular products</h2>
<!-- /wp:heading -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:woocommerce/product-best-sellers {\"rows\":2} /--></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Most Popular Products', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'Products', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend most popular products', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_most_popular_products.jpg',
];
