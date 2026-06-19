<?php
/**
 * EcommerceStoreOptimizer ThemeColorPalette module.
 *
 * This module sets up the theme support for editor-color-palette, which defines the colors used in blocks by default.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\ThemeColorPalette;

/**
 * Registers this module.
 *
 * @since 0.3.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {

	use \Genesis\EcommerceStoreOptimizer\Core\DefaultColorsTrait;

	/**
	 * Project Context
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Initializes.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		// Default color palette.
		$eso_default_colors = $this->get_default_colors();

		$eso_primary_color = get_option(
			'eso_primary_color',
			$eso_default_colors['primary']
		);

		$eso_secondary_color = get_option(
			'eso_secondary_color',
			$eso_default_colors['secondary']
		);

		$theme_name = get_template();
		if ( $theme_name === 'storefront' ) {
			add_theme_support(
				'editor-color-palette',
				array(
					array(
						'name'  => __( 'Primary', 'ecommerce-store-optimizer' ),
						'slug'  => 'eso-primary',
						'color' => $eso_primary_color,
					),
					array(
						'name'  => __( 'Secondary', 'ecommerce-store-optimizer' ),
						'slug'  => 'eso-secondary',
						'color' => $eso_secondary_color,
					),
					array(
						'name'  => __( 'White', 'ecommerce-store-optimizer' ),
						'slug'  => 'eso-white',
						'color' => '#ffffff',
					),
					array(
						'name'  => __( 'Gray', 'ecommerce-store-optimizer' ),
						'slug'  => 'eso-gray',
						'color' => '#c6c6c6',
					),
					array(
						'name'  => __( 'Black', 'ecommerce-store-optimizer' ),
						'slug'  => 'eso-black',
						'color' => '#000000',
					),
				)
			);
		}
	}

}
