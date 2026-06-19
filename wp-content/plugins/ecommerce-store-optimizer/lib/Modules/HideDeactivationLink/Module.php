<?php
/**
 * HideDeactivationLink Module
 *
 * EcommerceStoreOptimizer HideDeactivationLink module.
 * This module hides and unhooks things in the Storefront theme in order to make it as seamless as possible.
 *
 * @since 0.3.2
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\HideDeactivationLink;

/**
 * Register this module.
 *
 * @since 0.3.2
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
	 * Initialize frontend and admin.
	 *
	 * This is a workaround for the activate method, as ModuleInterface does not allow a return,
	 * but we need one for unit testing this setup.
	 *
	 * @since 0.3.2
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		add_action( 'init', array( $this, 'hide_deactivation_link' ) );
	}

	/**
	 * Hide the plugin deactivation link.
	 *
	 * @since 0.3.2
	 */
	public function hide_deactivation_link(): void {

		// Remove the plugin deactivation link for the eCommerceStoreOptimizer plugin.
		add_filter( 'plugin_action_links_ecommerce-store-optimizer/ecommerce-store-optimizer.php', array( $this, 'disable_plugin_deactivation' ) );

		// Add eCommerceStoreOptimizer plugin row styles to plugins page. May be removed if we decide not to style the row in the future.
		// add_action( 'admin_print_styles-plugins.php', array( $this, 'plugin_table_row_style' ) );
	}

	/**
	 * Add settings link to plugin actions
	 *
	 * @param string[] $actions An array of plugin action links. By default this can include 'activate',
	 *                          'deactivate', and 'delete'.
	 * @since  0.3.2
	 * @return array
	 */
	public function disable_plugin_deactivation( $actions ) {

		if ( isset( $actions['deactivate'] ) ) {
			unset( $actions['deactivate'] );
		}

		return $actions;

	}

	/**
	 * Enqueue eCommerceStoreOptimizer plugin row styles.
	 *
	 * @since 0.3.2
	 */
	public function plugin_table_row_style() {

		wp_enqueue_style( 'eso-plugin-row', $this->context->modules_url . '/HideDeactivationLink/styles.css', array(), ECOMMERCE_STORE_OPTIMIZER_VERSION );

	}

}
