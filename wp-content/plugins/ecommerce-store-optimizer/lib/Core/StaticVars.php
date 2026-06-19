<?php
/**
 * Core Static Variables
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Core;

/**
 * Static Variables Class
 */
final class StaticVars {
	/**
	 * Plugin Activate Action Slug
	 *
	 * @var string
	 */
	public static $plugin_activate_action = 'ESO_PLUGIN_ACTIVATION_ACTION';

	/**
	 * Post Plugin Activate Action Slug
	 *
	 * Modules should hook into this action to execute logic to be run on the
	 * first page load after this plugin has been activated.
	 *
	 * @var string
	 */
	public static $post_plugin_activate_action = 'ESO_POST_PLUGIN_ACTIVATION_ACTION';

	/**
	 * Has Plugin Been Activated Slug
	 *
	 * WP Option Slug indicating if this plugin has ever been activated.
	 *
	 * @var string
	 */
	public static $plugin_activated_check = 'ESO_PLUGIN_HAS_BEEN_ACTIVATED_OPTION';

	/**
	 * Footer Credit Text
	 *
	 * Text to be output in the Footer Credits link.
	 *
	 * @var string
	 */
	public static $footer_credit_text = 'ESO_FOOTER_CREDIT_TEXT';

	/**
	 * Footer Credit Link
	 *
	 * Href to be linked in the Footer Credits.
	 *
	 * @var string
	 */
	public static $footer_credit_link = 'ESO_FOOTER_CREDIT_LINK';

	/**
	 * Footer Copyright Text
	 *
	 * Text to be output in the Footer Copyright.
	 *
	 * @var string
	 */
	public static $footer_copyright_text = 'ESO_FOOTER_COPYRIGHT_TEXT';

	/**
	 * Option name for whether a user has ever been redirected to the getting started page.
	 *
	 * @var string
	 */
	public static $user_has_redirected_to_gs = 'ESO_USER_HAS_REDIRECTED_TO_GS';

	/**
	 * Hook name for spinning up demo content action hook.
	 *
	 * @var string
	 */
	public static $eso_spin_up_demo_content = 'eso_spin_up_demo_content';
}
