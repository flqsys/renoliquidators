<?php
/**
 * Customizer Defaults Manager
 *
 * Responsible for managing demo products.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerDefaults;

/**
 * Customizer Defaults Manager class
 *
 * @since 0.4.0
 */
final class CustomizerDefaultsManager {

	/**
	 * Put the contents of get_theme_mods into the theme_mods database option.
	 *
	 * Runs on plugin install
	 *
	 * @since 1.0
	 *
	 * @param mixed $context Plugin context.
	 *
	 * @return bool
	 */
	public function set_default_customizer_settings( $context = null ): bool {
		$theme = get_option( 'stylesheet' );

		// Theme mods (aka customizer settings) pulled from the demo: https://developer.wpengine.com/ecom/wp-admin/?get_theme_mods.
		$mods = json_decode( '{"0":false,"custom_css_post_id":182,"sidebars_widgets":{"time":1607967152,"data":{"wp_inactive_widgets":[],"sidebar-1":["search-2","recent-posts-2","recent-comments-2","archives-2","categories-2","meta-2"],"header-1":[],"footer-1":[],"footer-2":[],"footer-3":[],"footer-4":[]}},"storefront_header_background_color":"#2a3533","storefront_header_link_color":"#c6c6c6","storefront_header_text_color":"#c6c6c6","storefront_heading_color":"#2a3533","storefront_text_color":"#2a3533","storefront_accent_color":"#107f67","storefront_hero_heading_color":"#2a3533","storefront_hero_text_color":"#2a3533","storefront_button_background_color":"#107f67","storefront_button_text_color":"#ffffff","storefront_button_alt_background_color":"#107f67","storefront_button_alt_text_color":"#ffffff","storefront_footer_background_color":"#2a3533","storefront_footer_heading_color":"#c6c6c6","storefront_footer_text_color":"#c6c6c6","storefront_footer_link_color":"#c6c6c6"}', true );
		return update_option( "theme_mods_$theme", $mods );
	}

	/**
	 * Pass the default customizer settings to the storefront_default_customizer_settings filter.
	 *
	 * Runs on plugin install
	 *
	 * @since 1.0
	 * @param array $storefront_default_customizer_settings The default values for the Storefront Customizer.
	 * @return array
	 */
	public function filter_default_customizer_settings( $storefront_default_customizer_settings ): array {
		$args = array(
			'storefront_heading_color'               => '#2a3533',
			'storefront_text_color'                  => '#2a3533',
			'storefront_accent_color'                => '#107f67',
			'storefront_hero_heading_color'          => '#2a3533',
			'storefront_hero_text_color'             => '#2a3533',
			'storefront_header_background_color'     => '#2a3533',
			'storefront_header_text_color'           => '#c6c6c6',
			'storefront_header_link_color'           => '#c6c6c6',
			'storefront_footer_background_color'     => '#2a3533',
			'storefront_footer_heading_color'        => '#c6c6c6',
			'storefront_footer_text_color'           => '#c6c6c6',
			'storefront_footer_link_color'           => '#c6c6c6',
			'storefront_button_background_color'     => '#107f67',
			'storefront_button_text_color'           => '#ffffff',
			'storefront_button_alt_background_color' => '#107f67',
			'storefront_button_alt_text_color'       => '#ffffff',
			'storefront_layout'                      => 'right',
			'background_color'                       => 'ffffff',
		);
		return $args;
	}
}
