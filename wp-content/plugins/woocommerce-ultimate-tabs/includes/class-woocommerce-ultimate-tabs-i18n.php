<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://woocommerce.welaunch.io
 * @since      1.0.0
 *
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/includes
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class WooCommerce_Ultimate_Tabs_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$loaded = load_plugin_textdomain(
			'woocommerce-ultimate-tabs',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
