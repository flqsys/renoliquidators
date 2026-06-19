<?php
/**
 * Genesis Blocks Homepage layout for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'layout',
	'key'        => 'eso_spend_layout_homepage',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => [
		'eso_spend_section_banner',
		'eso_spend_section_shop_header',
		'eso_spend_section_shop_by_category',
		'eso_spend_section_latest_products',
		'eso_spend_section_customer_testimonials',
		'eso_spend_section_most_popular_products',
		'eso_spend_section_call_to_action',
	],
	'name'       => esc_html__( 'Spend Homepage', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend homepage', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_homepage.jpg',
];
