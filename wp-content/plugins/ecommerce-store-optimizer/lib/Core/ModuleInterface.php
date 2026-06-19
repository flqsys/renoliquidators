<?php
/**
 * Module Interface
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Core;

/**
 * Module Interface
 *
 * Set methods required for all module Register classes.
 */
interface ModuleInterface {
	/**
	 * Activate Module
	 *
	 * Method to Activate this module.
	 *
	 * @since 0.4.0
	 * @param object $context Current environment information.
	 *
	 * @return void
	 */
	public function activate( $context ) : void;
}
