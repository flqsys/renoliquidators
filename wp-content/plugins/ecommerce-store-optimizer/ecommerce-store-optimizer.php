<?php
/**
 * Plugin Name: eCommerce Store Optimizer
 * Description: Boost sales on your eCommerce store with performance enhancements, beautiful page layouts, and an effortless setup experience.
 * Version: 0.6.3
 * Author: WP Engine
 * Text Domain: ecommerce-store-optimizer
 *
 * @package ecommerce-store-optimizer
 */

// Include Composer Autoloader.
require __DIR__ . '/vendor/autoload.php';

/**
 * Dynamic Version
 *
 * Use some clever logic to get an appropriate version.
 *
 * @access private
 * @since 0.4.0
 * @return string
 */
function get_plugin_version(): string {
	$ecommerce_store_optimizer_version = get_file_data( __FILE__, [ 'Version' ] )[0];

	// If SCRIPT_DEBUG is enabled, break the browser cache.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return $ecommerce_store_optimizer_version . '-' . time();
	} else {
		return $ecommerce_store_optimizer_version;
	}
}

/**
 * Setup plugin constants.
 *
 * @access private
 * @since 1.0
 * @return void
 */
function ecommerce_store_optimizer_setup_constants() {

	// Plugin version.
	if ( ! defined( 'ECOMMERCE_STORE_OPTIMIZER_VERSION' ) ) {
		define( 'ECOMMERCE_STORE_OPTIMIZER_VERSION', get_plugin_version() );
	}

	// Plugin Folder Path.
	if ( ! defined( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_DIR' ) ) {
		define( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}

	// Plugin Folder URL.
	if ( ! defined( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_URL' ) ) {
		define( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

	// Plugin Root File.
	if ( ! defined( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_FILE' ) ) {
		define( 'ECOMMERCE_STORE_OPTIMIZER_PLUGIN_FILE', __FILE__ );
	}

}
ecommerce_store_optimizer_setup_constants();

/**
 * Create Context
 *
 * Create the context object.
 *
 * @since 0.4.0
 *
 * @return object
 */
function ecommerce_store_optimizer_create_context() {
	return (object) [
		'url'          => plugin_dir_url( __FILE__ ),
		'path'         => plugin_dir_path( __FILE__ ),
		'version'      => get_plugin_version(),
		'modules_path' => plugin_dir_path( __FILE__ ) . 'lib/Modules',
		'modules_url'  => plugin_dir_url( __FILE__ ) . 'lib/Modules',
	];
}

/**
 * Load plugin textdomain for translations.
 *
 * @since 0.6.3
 */
function ecommerce_store_optimizer_load_textdomain(): void {
	load_plugin_textdomain(
		'ecommerce-store-optimizer',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'ecommerce_store_optimizer_load_textdomain' );


/**
 * Instantiate EcommerceStoreOptimizer Plugin.
 *
 * @since 0.1.0
 */
function ecommerce_store_optimizer_load(): void {
	$context = ecommerce_store_optimizer_create_context();

	// Module Loader
	( new \Genesis\EcommerceStoreOptimizer\ModuleLoader( $context ) )->init();

	// Plugin Activate Hook
	( new \Genesis\EcommerceStoreOptimizer\Core\PluginActivateHook( $context ) )->init();
}
ecommerce_store_optimizer_load();

/**
 * Register Plugin Activation Hook.
 *
 * This action is being setup here because register_activation_hook was not
 * working when attempting to contain the logic inside of another class. It
 * seems it works best when being called from the plugins initial PHP file.
 *
 * @since 0.4.0
 */
function ecommerce_store_optimizer_register_activation_hook(): void {
	$context = ecommerce_store_optimizer_create_context();
	( new \Genesis\EcommerceStoreOptimizer\Core\PluginActivateHook( $context ) )->plugin_activated();
}
register_activation_hook( __FILE__, 'ecommerce_store_optimizer_register_activation_hook' );
