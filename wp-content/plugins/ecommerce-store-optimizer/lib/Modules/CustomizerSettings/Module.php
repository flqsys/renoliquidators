<?php
/**
 * Customizer Settings Module
 *
 * This module registers additional customizer settings.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerSettings;

/**
 * Register this module.
 *
 * @since 0.4.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {

	use \Genesis\EcommerceStoreOptimizer\Core\DefaultColorsTrait;

	/**
	 * Project context.
	 *
	 * @var object
	 */
	private $context;

	/**
	 * FooterSettings instance.
	 *
	 * @var FooterSettings
	 */
	private $footer_settings;

	/**
	 * ColorSettings instance.
	 *
	 * @var ColorSettings
	 */
	private $color_settings;

	/**
	 * Class constructor.
	 *
	 * @since 0.4.0
	 */
	public function __construct() {
		$this->footer_settings = new FooterSettings();
		$this->color_settings  = new ColorSettings();
	}

	/**
	 * Module activate method.
	 *
	 * @since 0.4.0
	 *
	 * @param object $context Project context.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		add_action( 'customize_register', [ $this->footer_settings, 'register_settings' ] );
		add_filter( 'storefront_credit_link', '__return_false' );
		add_filter( 'storefront_credit_links_output', [ $this->footer_settings, 'filter_credit_text' ], 20 );
		add_filter( 'storefront_copyright_text', [ $this->footer_settings, 'filter_copyright_text' ], 20 );

		add_action( 'customize_register', [ $this->color_settings, 'register_settings' ], 20 );
		add_action( 'wp_enqueue_scripts', [ $this->color_settings, 'inline_color_palette' ], 20 );
		add_action( 'enqueue_block_editor_assets', [ $this->color_settings, 'inline_color_palette' ], 20 );

		add_filter( 'storefront_theme_mods', [ $this, 'filter_sync_storefront_customizer_to_eso_palette' ] );
	}

	/**
	 * Sync Storefront theme mod colors to the ESO color palette, to reduce options thrust upon users.
	 *
	 * @since 0.4.1
	 * @param array $storefront_theme_mods The theme mods in storefront.
	 */
	public function filter_sync_storefront_customizer_to_eso_palette( $storefront_theme_mods ) {

		// Default color palette.
		$eso_default_colors = $this->get_default_colors();

		$eso_primary_color = get_option(
			'eso_primary_color',
			$eso_default_colors['primary']
		);

		$eso_primary_color_contrast = get_option(
			'eso_primary_color_contrast',
			$eso_default_colors['primary_contrast']
		);

		$eso_secondary_color = get_option(
			'eso_secondary_color',
			$eso_default_colors['secondary']
		);

		// Primary color.
		$storefront_theme_mods['header_background_color'] = $eso_primary_color;
		$storefront_theme_mods['footer_background_color'] = $eso_primary_color;

		// Primary contrast color.
		$storefront_theme_mods['header_text_color'] = $eso_primary_color_contrast;
		$storefront_theme_mods['header_link_color'] = $eso_primary_color_contrast;

		$storefront_theme_mods['footer_link_color']    = $eso_primary_color_contrast;
		$storefront_theme_mods['footer_heading_color'] = $eso_primary_color_contrast;
		$storefront_theme_mods['footer_text_color']    = $eso_primary_color_contrast;

		// Secondary color.
		$storefront_theme_mods['button_background_color']     = $eso_secondary_color;
		$storefront_theme_mods['button_alt_background_color'] = $eso_secondary_color;

		// Check if the color is light or dark using Storefront theme function.
		$secondary_contrast = is_color_light( $eso_secondary_color ) ? '#000000' : '#ffffff';

		// Secondary contrast color.
		$storefront_theme_mods['button_text_color']     = $secondary_contrast;
		$storefront_theme_mods['button_alt_text_color'] = $secondary_contrast;

		return $storefront_theme_mods;

	}

}
