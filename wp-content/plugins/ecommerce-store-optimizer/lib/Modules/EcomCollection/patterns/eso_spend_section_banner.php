<?php
/**
 * Genesis Blocks Banner section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_banner',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":1,\"paddingRight\":3,\"paddingBottom\":1,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-banner\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-banner gb-layout-columns-1 one-column has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:1%;padding-right:3%;padding-bottom:1%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Our winter sale starts today! Use BUTTONUP at checkout to save 25%!!</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Banner', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'sale', 'ecommerce-store-optimizer' ),
		esc_html__( 'banner', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend banner', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_banner.jpg',
];
