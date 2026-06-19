<?php
/**
 * Genesis Blocks Returns and Exchanges section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_returns_and_exchanges',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#eeeeee\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-returns-and-exchanges\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-returns-and-exchanges gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#eeeeee\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\",\"columnVerticalAlignment\":\"top\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-top\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading -->
<h2>Returning Your Product</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Returning your product is really easy to do. We accept returns up to 30 days after your original purchase. Simply visit the contact page and fill out a return request and we'll process your return as soon as we receive the product.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Visit the Contact page and fill out the Return Request Form.</li><li>Send your product back to us.</li><li>We'll process the return asap!</li></ul>
<!-- /wp:list --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"top\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-top\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading -->
<h2>Exchanging Your Product</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Alternatively, you can exchange your product for a different product or for store credit. The process is simple. Simply visit the contact page and fill out an exchange request and we'll process your exchange as soon as we receive the product.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Visit the Contact page and fill out the Exchange Request Form.</li><li>Send your product back to us.</li><li>We'll process the return asap!</li></ul>
<!-- /wp:list --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Returns and Exchanges', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'services', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'returns', 'ecommerce-store-optimizer' ),
		esc_html__( 'terms', 'ecommerce-store-optimizer' ),
		esc_html__( 'info', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend returns and exchanges', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_returns_and_exchanges.jpg',
];
