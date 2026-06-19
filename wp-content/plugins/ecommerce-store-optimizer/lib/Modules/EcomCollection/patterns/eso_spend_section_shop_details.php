<?php
/**
 * Genesis Blocks Shop Details section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_shop_details',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":3,\"paddingBottom\":3,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-shop-details\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-shop-details gb-layout-columns-1 one-column has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:5%;padding-right:3%;padding-bottom:3%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Free Shipping</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We offer free domestic shipping with orders over $99. Just select the Standard Shipping option at checkout to redeem the free shipping.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Secure Checkout</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Our checkout process is one of the most secure in the business. We offer secure checkout via Stripe and PayPal for your shopping convenience.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\">Product Warranty</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We stand behind everything we do! If you're not satisfied with our products, visit the Contact page and let us know what we can do for you.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Shop Details', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
		esc_html__( 'services', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'details', 'ecommerce-store-optimizer' ),
		esc_html__( 'text', 'ecommerce-store-optimizer' ),
		esc_html__( 'columns', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop details', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_shop_details.jpg',
];
