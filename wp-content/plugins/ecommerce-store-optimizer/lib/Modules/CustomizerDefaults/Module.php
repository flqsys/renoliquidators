<?php
/**
 * CustomizerDefaults Module
 *
 * EcommerceStoreOptimizer CustomizerDefaults module.
 * This module enables CustomizerDefaults functionality.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerDefaults;

use \Genesis\EcommerceStoreOptimizer\Core\StaticVars;

/**
 * Register this module.
 *
 * @since 0.3.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {

	/**
	 * Project context.
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Customizer Defaults Manager.
	 *
	 * @var CustomizerDefaultsManager
	 */
	private $customizer_defaults_manager;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->customizer_defaults_manager = new CustomizerDefaultsManager();
	}

	/**
	 * Activate the module. Currently the Module itself does nothing.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		// Hook in the storefront default values.
		add_filter( 'storefront_setting_default_values', array( $this->customizer_defaults_manager, 'filter_default_customizer_settings' ) );
		add_filter( 'storefront_customizer_more', '__return_false' );

		// Hook in the eso_spin_up_demo_content functions.
		add_action( StaticVars::$eso_spin_up_demo_content, array( $this->customizer_defaults_manager, 'set_default_customizer_settings' ), 2 );
		add_action( StaticVars::$eso_spin_up_demo_content, array( new DefaultWidgets(), 'init' ), 2 );
	}

}
