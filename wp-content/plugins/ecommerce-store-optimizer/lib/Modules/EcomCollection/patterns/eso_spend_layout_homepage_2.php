<?php
/**
 * Genesis Blocks Homepage 2 layout for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'layout',
	'key'        => 'eso_spend_layout_homepage_2',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => [
		'eso_spend_section_banner',
		'eso_spend_section_shop_header_two',
		'eso_spend_section_latest_products',
		'eso_spend_section_category_and_text_boxes',
		'eso_spend_section_text_boxes',
		'eso_spend_section_featured_products',
		'eso_spend_section_customer_testimonial',
	],
	'name'       => esc_html__( 'Spend Homepage 2', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend homepage 2', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_homepage_2.jpg',
];
