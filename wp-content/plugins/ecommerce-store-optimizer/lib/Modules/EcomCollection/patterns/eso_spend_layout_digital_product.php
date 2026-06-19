<?php
/**
 * Genesis Blocks Digital Product layout for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'layout',
	'key'        => 'eso_spend_layout_digital_product',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_homepage.jpg',
		'allowThemeColorPalette' => true,
	],
	'content'    => [
		'eso_spend_section_digital_download_header',
		'eso_spend_section_digital_products',
		'eso_spend_section_text_columns',
	],
	'name'       => esc_html__( 'Spend Digital Product', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'uncategorized', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend digital product', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_digital_product.jpg',
];
