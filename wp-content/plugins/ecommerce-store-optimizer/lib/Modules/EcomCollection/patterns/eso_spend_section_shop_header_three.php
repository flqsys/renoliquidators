<?php
/**
 * Genesis Blocks Shop Header Three section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_shop_header_three',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1198,\"className\":\"eso-spend-section-shop-header-three\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-shop-header-three gb-layout-columns-2 gb-2-col-equal has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1198px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 style=\"font-size:50px\">Shop our latest shirt collection.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For a limited time, our winter stock collection is 25% off for all customers. As a bonus, get free shipping on orders over $99!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"eso-white\",\"textColor\":\"eso-secondary\",\"className\":\"is-style-fill\"} -->
<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-eso-secondary-color has-eso-white-background-color has-text-color has-background no-border-radius\">Shop the sale →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/spend/gpb_spend_shop_header_columns.jpg\" alt=\"\"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Shop Header Three', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'hero', 'ecommerce-store-optimizer' ),
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
		esc_html__( 'cta', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop header three', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_shop_header_three.jpg',
];
