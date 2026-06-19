<?php
/**
 * EcomCollection Module
 *
 * EcommerceStoreOptimizer EcomCollection module.
 * This module enables EcomCollection functionality.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\EcomCollection;

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
	 * @var EcomCollectionManager
	 */
	private $ecom_collection_manager;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->ecom_collection_manager = new EcomCollectionManager();
	}

	/**
	 * Activate the module. Currently the Module itself does nothing.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		add_action( 'plugins_loaded', array( $this, 'hook_in_register_layouts' ), 12 );
	}

	/**
	 * Register the ecommerce patterns in the admin_init hook.
	 *
	 * @since 0.3.0
	 */
	public function hook_in_register_layouts() {
		// Register the patterns.
		$this->ecom_collection_manager->register_ecommerce_collection_patterns();
	}

}
