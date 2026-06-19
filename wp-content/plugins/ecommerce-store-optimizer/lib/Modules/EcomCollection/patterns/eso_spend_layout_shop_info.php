<?php
/**
 * Genesis Blocks Shop Info layout for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'layout',
	'key'        => 'eso_spend_layout_shop_info',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => [
		'eso_spend_section_map_and_contact',
		'eso_spend_section_frequently_asked',
		'eso_spend_section_returns_and_exchanges',
		'eso_spend_section_shop_details',
	],
	'name'       => esc_html__( 'Spend Shop Info', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend shop info', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_layout_shop_info.jpg',
];
