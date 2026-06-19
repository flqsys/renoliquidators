<?php
/**
 * Genesis Blocks Digital Products section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_digital_products',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"gb-1-col-equal\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#eeeeee\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-digital-products\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-digital-products gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#eeeeee\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Digital eBook Resources</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We’ve put together a super valuable collection of eBooks for creators.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-product /--></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-product /--></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-product /--></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Digital Products', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'Products', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend digital products', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_digital_products.jpg',
];
