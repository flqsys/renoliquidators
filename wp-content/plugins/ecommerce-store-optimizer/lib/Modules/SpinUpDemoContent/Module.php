<?php
/**
 * SpinUpDemoContent Module
 *
 * EcommerceStoreOptimizer SpinUpDemoContent module.
 *
 * @since 0.6.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\SpinUpDemoContent;

use Genesis\EcommerceStoreOptimizer\Core\ModuleInterface;

use \Genesis\EcommerceStoreOptimizer\Core\StaticVars;

/**
 * Register this module.
 *
 * @since 0.3.2
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements ModuleInterface {

	/**
	 * Project context.
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Initializes.
	 *
	 * @since 0.3.2
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		add_action( 'admin_init', array( $this, 'spin_up_demo_content' ) );
	}

	/**
	 * Spin up the ESO demo content.
	 *
	 * @since 0.4.0
	 */
	public function spin_up_demo_content(): void {

		// Only spin up demo content if if "?eso_spin_up_demo_content=1" is in the URL.
		if ( filter_input( INPUT_GET, 'eso_spin_up_demo_content', FILTER_UNSAFE_RAW ) !== '1' ) {
			// Exit early.
			return;
		}

		$should_initiate_demo_content = $this->should_initiate_demo_content();

		if ( isset( $should_initiate_demo_content['error'] ) ) {
			// Output a JSON object indicating the reason for failure.
			header( 'Content-Type: application/json' );
			echo wp_json_encode(
				array(
					'error' => $should_initiate_demo_content['error'],
				)
			);
			die();
		}

		// Add a flag so we know not to do this again (like if the user refreshes this page, for example).
		update_option( 'eso_demo_content_already_initiated', true );

		// Run the eso_spin_up_demo_content functions.
		do_action( StaticVars::$eso_spin_up_demo_content, $this->context );

	}

	/**
	 * Check whether demo content should be initiated.
	 *
	 * @since 0.6.0
	 * @return array
	 */
	private function should_initiate_demo_content(): array {

		// Only spin up demo content if if "?eso_spin_up_demo_content=1" is in the URL.
		if ( filter_input( INPUT_GET, 'eso_spin_up_demo_content', FILTER_UNSAFE_RAW ) !== '1' ) {
			return array( 'error' => 'eso_spin_up_demo_content-was-not-in-the-url' );
		}

		// Check if we got a nonce in the GET data.
		$nonce = filter_input( INPUT_GET, 'eso_spin_up_demo_content_nonce', FILTER_UNSAFE_RAW );

		if ( ! wp_verify_nonce( $nonce, 'eso_spin_up_demo_content_nonce' ) ) {
			return array( 'error' => 'nonce-failure' );
		}

		// Check if eso_force_spin_up_demo_content=1 is in the GET data. This can be used over and over to regenerate demo content at any time.
		$force_regenerate_demo_content = filter_input( INPUT_GET, 'eso_force_spin_up_demo_content', FILTER_UNSAFE_RAW ) === '1' ? true : false;

		// If force is in the URL, regenerate it no matter what has already happened.
		if ( $force_regenerate_demo_content ) {
			return array( 'success' => 'eso_force_spin_up_demo_content' );
		}

		// No force? Okay, then check if the demo content was already initiated.
		if ( get_option( 'eso_demo_content_already_initiated' ) ) {
			// Do not re-initiate demo content. For example, if the page is refreshed, or a new admin logs in 2 years later for the first time (and gets redirected to Getting Started).
			return array( 'error' => 'demo-content-was-already-initiated' );
		}

		return array( 'success' => 'demo-content-generating-for-first-time' );
	}

}
