<?php
/**
 * EcommerceStoreOptimizer WooDemoProducts module.
 *
 * This module enables WooDemoProducts functionality.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\WooDemoProducts;

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
	 * Demo Product Manager.
	 *
	 * @var Manager\Module
	 */
	private $demo_manager;

	/**
	 * Demo Products Indicator.
	 *
	 * @var Indicator\Module
	 */
	private $indicator;

	/**
	 * Demo Product Toggle.
	 *
	 * @var Toggle\Module
	 */
	private $toggle;

	/**
	 * Demo Product Deletion Modal.
	 *
	 * @var DeletionModal\Module
	 */
	private $modal;

	/**
	 * Initialize.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		add_action( 'plugins_loaded', array( $this, 'activate_upon_plugins_loaded' ) );
	}

	/**
	 * Initialize frontend and admin.
	 *
	 * @since 0.3.0
	 */
	public function activate_upon_plugins_loaded(): void {

		// If WooCommerce is not active, do not activate this module.
		if ( ! class_exists( 'woocommerce' ) ) {
			return;
		}

		$this->demo_manager = new Manager\Module();
		$this->indicator    = new Indicator\Module();
		$this->toggle       = new Toggle\Module();
		$this->modal        = new DeletionModal\Module();

		// Demo Product Manager.
		$this->demo_manager->activate( $this->context );

		// Demo Products Indicator.
		$this->indicator->activate( $this->context, $this->demo_manager );

		// Demo Products Toggle.
		$this->toggle->activate( $this->context, $this->demo_manager );

		// Demo Products Deletion Modal.
		$this->modal->activate( $this->context, $this->demo_manager );
	}

}
