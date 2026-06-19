<?php
/**
 * EcommerceStoreOptimizer GettingStartedPage module.
 *
 * This module enables GettingStartedPage functionality.
 *
 * @since 0.3.1
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\GettingStartedPage;

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
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'load-toplevel_page_ecommerce-store-optimizer-getting-started', [ $this, 'load_admin_scripts' ] );
		add_action( 'admin_init', [ $this, 'hide_admin_notices' ] );
	}

	/**
	 * Loads admin scripts.
	 *
	 * @since 0.3.1
	 */
	public function load_admin_scripts(): void {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	/**
	 * Enqueues the Getting Started page scripts.
	 *
	 * @since 0.3.1
	 */
	public function enqueue_admin_scripts(): void {

		wp_enqueue_style(
			'eso-getting-started-style',
			$this->context->url . 'lib/Modules/GettingStartedPage/assets/style.css',
			[ 'wp-components' ],
			$this->context->version,
			'all'
		);
	}

	/**
	 * Adds the admin menu
	 *
	 * @since 0.3.1
	 */
	public function add_admin_menu(): void {

		add_menu_page(
			__( 'Getting started with your eCommerce Store', 'ecommerce-store-optimizer' ),
			__( 'eCommerce Help', 'ecommerce-store-optimizer' ),
			'manage_options',
			'ecommerce-store-optimizer-getting-started',
			[ $this, 'render' ],
			'dashicons-info-outline',
			99
		);
	}

	/**
	 * Check whether demo content should be initiated, based on the variables in the URL.
	 *
	 * @since 0.6.0
	 * @return bool
	 */
	private function should_initiate_demo_content(): bool {

		$url_nonce = filter_input( INPUT_GET, 'eso-spin-up-demo-content-nonce', FILTER_UNSAFE_RAW );

		if ( ! wp_verify_nonce( $url_nonce, 'eso_spin_up_demo_content_nonce' ) ) {
			return false;
		}

		// Check if initiate_eso_content=1 is in the URL. This only happens once.
		$initiate_demo_content = filter_input( INPUT_GET, 'eso-initiate-demo-content', FILTER_UNSAFE_RAW ) === '1' ? true : false;

		// Check if eso-force-initiate-demo-content=1 is in the url. This can be used over and over to regenerate demo content at any time.
		$force_regenerate_demo_content = filter_input( INPUT_GET, 'eso-force-regenerate-demo-content', FILTER_UNSAFE_RAW ) === '1' ? true : false;

		// Do not re-initiate demo content. For example, if the page is refreshed, or a new admin logs in 2 years later for the first time (and gets redirected to Getting Started).
		if ( get_option( 'eso_demo_content_already_initiated' ) ) {
			$initiate_demo_content = false;
		}

		// But if force is in the URL, regenerate it no matter what has already happened.
		if ( $force_regenerate_demo_content ) {
			$initiate_demo_content = true;
		}

		return $initiate_demo_content;
	}

	/**
	 * Check whether a "Regenerate Demo Content" button should be shown to the user on the Getting Started page.
	 *
	 * @since 0.6.0
	 * @return bool
	 */
	private function should_show_regenerate_demo_content_button(): bool {

		// Check if eso-regenerate-demo-content-option=1 is in the URL.
		return filter_input( INPUT_GET, 'eso-regenerate-demo-content-option', FILTER_UNSAFE_RAW ) === '1' ? true : false;
	}

	/**
	 * Get the URL for regenerating the demo content, with the nonce.
	 *
	 * @since 0.6.0
	 * @return string
	 */
	private function get_force_regenerate_demo_content_endpoint_url(): string {
		return add_query_arg(
			array(
				'post_type'                      => 'product',
				'eso_spin_up_demo_content'       => true,
				'eso_force_spin_up_demo_content' => true,
				'eso_spin_up_demo_content_nonce' => wp_create_nonce( 'eso_spin_up_demo_content_nonce' ),
			),
			admin_url( 'edit.php' )
		);
	}

	/**
	 * Check whether demo content should be initiated, based on the variables in the URL.
	 *
	 * @since 0.6.0
	 */
	private function maybe_enqueue_initiate_demo_content_js(): void {
		$url_nonce = filter_input( INPUT_GET, 'eso-spin-up-demo-content-nonce', FILTER_UNSAFE_RAW );

		// If initiate_eso_content is in the URL, send a call via javascript to eso_spin_up_demo_content. This has to happen here because the WP Engine platform appears to be caching database results until after the first wp-admin page load.
		if ( $this->should_initiate_demo_content() ) {
			wp_enqueue_script( 'eso_initiate_demo_content', $this->context->url . 'lib/Modules/GettingStartedPage/assets/initiate-demo-content.js', array(), $this->context->version, true );
			wp_localize_script(
				'eso_initiate_demo_content',
				'eso_initiate_demo_content',
				array(
					// Note that this URL intentionally happening on the Woo product edit screen, because that's where the right hooks fire to work with ElasticPress's syncing.
					'spin_up_demo_content_endpoint_url' => add_query_arg(
						array(
							'post_type'                => 'product',
							'eso_spin_up_demo_content' => true,
							'eso_spin_up_demo_content_nonce' => $url_nonce,
						),
						admin_url( 'edit.php' )
					),
				)
			);
		}
	}

	/**
	 * Renders the admin page.
	 *
	 * @since 0.3.1
	 */
	public function render(): void {
		$this->maybe_enqueue_initiate_demo_content_js();
		require $this->context->path . 'lib/Modules/GettingStartedPage/views/admin/getting-started-page.php';
	}

	/**
	 * Hide admin notices on getting started page.
	 *
	 * @since 0.5.0
	 */
	public function hide_admin_notices() {
		if ( filter_input( INPUT_GET, 'page', FILTER_UNSAFE_RAW ) !== 'ecommerce-store-optimizer-getting-started' ) {
			return;
		}

		// We don't want to show any admin notices on this page.
		remove_all_actions( 'admin_notices' );
	}

}
