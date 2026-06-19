<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              http://www.welaunch.io
 * @since             1.0.
 * @package           WooCommerce_Ultimate_Tabs
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Ultimate Tabs
 * Plugin URI:        https://welaunch.io/plugins/woocommerce-ultimate-tabs/
 * Description:       Reorder, Rename, Disable or add custom Tabs to your WooCommerce Store.
 * Version:           1.3.9
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-ultimate-tabs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-ultimate-tabs-activator.php
 */
function activate_woocommerce_ultimate_tabs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-ultimate-tabs-activator.php';
	WooCommerce_Ultimate_Tabs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-ultimate-tabs-deactivator.php
 */
function deactivate_woocommerce_ultimate_tabs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-ultimate-tabs-deactivator.php';
	WooCommerce_Ultimate_Tabs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_ultimate_tabs' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_ultimate_tabs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-ultimate-tabs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_ultimate_tabs() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new WooCommerce_Ultimate_Tabs($version);
	$plugin->run();

	return $plugin;

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('redux-dev-master/redux-framework.php') || is_plugin_active('redux-framework/redux-framework.php') ||  is_plugin_active('welaunch-framework/welaunch-framework.php') ) ){
	$WooCommerce_Ultimate_Tabs = run_woocommerce_ultimate_tabs();
} else {
	add_action( 'admin_notices', 'woocommerce_ultimate_tabs_installed_notice' );
}

function woocommerce_ultimate_tabs_installed_notice()
{
	?>
    <div class="error">
      <p><?php _e( 'WooCommerce Ultimate Tabs requires the WooCommerce and weLaunch Framework plugin. Please install or activate them before: https://www.welaunch.io/updates/welaunch-framework.zip', 'woocommerce-ultimate-tabs'); ?></p>
    </div>
    <?php
}