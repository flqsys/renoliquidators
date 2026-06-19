<?php
/**
 * EcommerceStoreOptimizer WooDefaultSettings module.
 *
 * This module enables WooDefaultSettings functionality.
 *
 * @since 0.6.2
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\WooDefaultSettings;

/**
 * Registers this module.
 *
 * @since 0.3.1
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {
	/**
	 * Project Context
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Initializes.
	 *
	 * @since 0.3.1
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		add_action( 'plugins_loaded', [ $this, 'complete_wc_onboarding' ] );
	}

	/**
	 * Mark Onboarding as complete.
	 */
	public function complete_wc_onboarding() {
		$onboarding_data = get_option( 'woocommerce_onboarding_profile', array() );
		// Don't make updates if the profiler is completed, but task list is potentially incomplete.
		if ( isset( $onboarding_data['completed'] ) && $onboarding_data['completed'] ) {
			return;
		}

		$onboarding_data['completed'] = true;
		update_option( 'woocommerce_onboarding_profile', $onboarding_data );
		update_option( 'woocommerce_task_list_hidden', 'yes' );

		// Also complete Storefront setup
		update_option( 'storefront_nux_dismissed', true );
	}

}
