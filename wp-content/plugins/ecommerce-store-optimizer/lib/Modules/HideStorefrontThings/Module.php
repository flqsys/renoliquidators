<?php
/**
 * HideStorefrontThings Module
 *
 * EcommerceStoreOptimizer HideStorefrontThings module.
 * This module hides and unhooks things in the Storefront theme in order to make it as seamless as possible.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\HideStorefrontThings;

/**
 * Register this module.
 *
 * @since 0.3.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {
	/**
	 * Initialize frontend and admin.
	 *
	 * This is a workaround for the activate method, as ModuleInterface does not allow a return,
	 * but we need one for unit testing this setup.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		add_action( 'init', array( $this, 'unhook_storefront_things' ) );
	}

	/**
	 * Unhook Storefront things to make the experience effortless.
	 *
	 * @since 0.3.0
	 */
	public function unhook_storefront_things(): void {
		// Unhook Storefront things in the Storefront_NUX_Admin class in the Storefront theme.
		$this->remove_class_method_action( 'admin_enqueue_scripts', 'Storefront_NUX_Admin', 'enqueue_scripts' );
		$this->remove_class_method_action( 'admin_notices', 'Storefront_NUX_Admin', 'admin_notices', 99 );
		$this->remove_class_method_action( 'wp_ajax_storefront_dismiss_notice', 'Storefront_NUX_Admin', 'dismiss_nux' );
		$this->remove_class_method_action( 'admin_post_storefront_starter_content', 'Storefront_NUX_Admin', 'redirect_customizer' );
		$this->remove_class_method_action( 'init', 'Storefront_NUX_Admin', 'log_fresh_site_state' );
		$this->remove_class_method_action( 'admin_body_class', 'Storefront_NUX_Admin', 'admin_body_class' );

		// Unhook the admin page under "Appearance" > "Storefront".
		$this->remove_class_method_action( 'admin_menu', 'Storefront_Admin', 'welcome_register_menu' );
		$this->remove_class_method_action( 'admin_enqueue_scripts', 'Storefront_Admin', 'welcome_style' );

		// Remove the page templates from storefront that aren't needed.
		add_filter( 'theme_page_templates', array( $this, 'dropdown_pages' ), 10, 4 );

	}

	/**
	 * Remove the page templates from storefront that we don't want to show.
	 *
	 * @param array  $templates The templates that show themselves in the dropdown.
	 * @param string $theme The theme.
	 * @param object $post The post.
	 * @param string $post_type The post type.
	 * @return array
	 */
	public function dropdown_pages( $templates, $theme, $post, $post_type ): array {
		unset( $templates['template-homepage.php'] );
		return $templates;
	}

	/**
	 * Helper function which makes it possible to unhook methods that were added in a class.
	 *
	 * @since 0.3.0
	 * @param string $hook_name The name of the hook.
	 * @param string $class_instance The name of the class to which the method belongs.
	 * @param string $method_name The name of the method being unhooked.
	 * @param int    $priority The priority where the hook was originally set.
	 */
	private function remove_class_method_action( $hook_name, $class_instance, $method_name, $priority = 10 ): void {
		global $wp_filter;

		if ( ! $wp_filter || ! isset( $wp_filter[ $hook_name ] ) || ! isset( $wp_filter[ $hook_name ][ $priority ] ) ) {
			return;
		}

		foreach ( $wp_filter[ $hook_name ][ $priority ] as $function_key => $function_details ) {

			// Skip anonymous functions.
			if ( $function_details['function'] instanceof CLOSURE || is_a( $function_details['function'], 'Closure' ) ) {
				continue;
			}

			if ( is_a( $function_details['function'][0], $class_instance ) ) {
				if ( $method_name === $function_details['function'][1] ) {
					unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $function_key ] );
				}
			}
		}

	}

}
