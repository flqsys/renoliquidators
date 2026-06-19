<?php
/**
 * Genesis Blocks Homepage 3 layout for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'layout',
	'key'        => 'eso_spend_layout_homepage_3',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => [
		'eso_spend_section_shop_header_three',
		'eso_spend_section_featured_products',
		'eso_spend_section_featured_product_and_reviews',
		'eso_spend_section_text_and_button_columns',
		'eso_spend_section_shop_details',
	],
	'name'       => esc_html__( 'Spend Homepage 3', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend homepage 3', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_homepage_3.jpg',
];
