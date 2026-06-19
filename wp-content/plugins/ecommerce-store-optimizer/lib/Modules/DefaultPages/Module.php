<?php
/**
 * DefaultPages Module
 *
 * EcommerceStoreOptimizer DefaultPages module.
 * This module enables DefaultPages functionality.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\DefaultPages;

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
	 * @var DefaultPagesManager
	 */
	private $default_pages_manager;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->default_pages_manager = new DefaultPagesManager();
	}

	/**
	 * Activate the module. Currently the Module itself does nothing.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		// This has to be hooked to priority 12 or later, because GB loads the files on priority 11.
		// See: https://github.com/studiopress/genesis-page-builder/blob/98970b93ac42d3c01503c498ca1d710124fd4f8a/genesis-page-builder.php#L108
		add_action( 'plugins_loaded', [ $this, 'hook_create_default_pages' ], 12 );
	}

	/**
	 * Hook the default page creation method until plugins_loaded, priority 12, to ensure that Genesis Blocks exists.
	 *
	 * @since 0.3.0
	 */
	public function hook_create_default_pages(): void {
		if ( ! function_exists( 'genesis_blocks_register_layout_component' ) ) {
			return;
		}

		// Hook in the eso_spin_up_demo_content functions.
		add_action( StaticVars::$eso_spin_up_demo_content, [ $this->default_pages_manager, 'create_default_pages' ], 4 );
	}

}
