<?php
/**
 * Permalink Settings Module
 *
 * This changes the permalink settings to 'Post name'.
 *
 * @since 0.6.1
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\PermalinkSettings;

use Genesis\EcommerceStoreOptimizer\Core\ModuleInterface;
use Genesis\EcommerceStoreOptimizer\Core\StaticVars;

/**
 * Registers this module.
 *
 * @since 0.6.1
 * @uses ModuleInterface
 */
final class Module implements ModuleInterface {

	/**
	 * Module activate method.
	 *
	 * @since 0.6.1
	 *
	 * @param object $context Project context.
	 */
	public function activate( $context ): void {
		unset( $context );
		add_action( StaticVars::$eso_spin_up_demo_content, [ $this, 'change_permalink_settings' ], 11 );
	}

	/**
	 * Changes the permalink settings to 'Post name' and flushes the rules.
	 *
	 * @since 0.6.1
	 */
	public function change_permalink_settings(): void {
		$GLOBALS['wp_rewrite']->set_permalink_structure( '/%postname%/' );
		$GLOBALS['wp_rewrite']->flush_rules();
	}
}
