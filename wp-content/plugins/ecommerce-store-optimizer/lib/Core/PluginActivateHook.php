<?php
/**
 * Plugin Activate Hook
 *
 * Action Hook logic to be ran when the plugin has been activated.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Core;

/**
 * Plugin Activate Hook
 *
 * @since 0.4.0
 */
final class PluginActivateHook {
	/**
	 * Context
	 *
	 * Data about this environment.
	 *
	 * @since 0.4.0
	 *
	 * @var object
	 */
	public $context;

	/**
	 * Class Constructor.
	 *
	 * @since 0.4.0
	 *
	 * @param object $context Data about this environemtn.
	 */
	public function __construct( $context ) {
		$this->context = $context;
	}

	/**
	 * Class Initializer
	 *
	 * Runs logic at the appropriate time.
	 *
	 * @since 0.4.0
	 */
	public function init(): void {
		if ( $this->has_been_activated() ) {
			return;
		}

		// Register the post activation hook
		add_action( 'admin_init', [ $this, 'post_plugin_activated' ] );
	}

	/**
	 * Plugin Activate Hook
	 *
	 * Runs when this plugin is activated.
	 *
	 * @since 0.4.0
	 */
	public function plugin_activated(): void {
		if ( $this->has_been_activated() ) {
			return;
		}

		// Update Post Plugin Activate Action option
		update_option( StaticVars::$post_plugin_activate_action, true );

		// Run the Plugin Activate Action
		do_action( StaticVars::$plugin_activate_action, $this->context );

	}

	/**
	 * Post Plugin Activate Hook
	 *
	 * Runs on the first admin page load after this plugin is activated.
	 *
	 * @since 0.4.0
	 */
	public function post_plugin_activated(): void {
		// Return early if the plugin wasn't activated
		if ( ! get_option( StaticVars::$post_plugin_activate_action ) ) {
			return;
		}

		// Don't do this if it's WP_CLI. Wait for a real human.
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return;
		}

		// Run the post plugin activate actions
		do_action( StaticVars::$post_plugin_activate_action, $this->context );

		// Cleanup
		update_option( StaticVars::$post_plugin_activate_action, false );
		update_option( StaticVars::$plugin_activated_check, true );
	}

	/**
	 * Check if this plugin has been activated previously.
	 *
	 * The get_option property returns scalar values as strings.
	 * This method attempts a basic conversion of string true|false to
	 * a proper boolean value.
	 *
	 * @return bool
	 */
	public function has_been_activated(): bool {
		$value = get_option( StaticVars::$plugin_activated_check, false );
		return ( $value === '1' || $value === 'true' );
	}
}
