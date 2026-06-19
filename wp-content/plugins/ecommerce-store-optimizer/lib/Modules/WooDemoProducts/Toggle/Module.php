<?php
/**
 * Demo Products Toggle
 *
 * Responsible for showing a toggle switch to enable/disable demo products.
 * This only takes an action if ecommerce_store_optimizer_demo_products_toggle_on is a URL variable.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\WooDemoProducts\Toggle;

/**
 * Demo Products Toggle class
 *
 * @since 0.4.0
 */
final class Module {

	/**
	 * Project context.
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Demo Product Manager.
	 *
	 * @var DemoProductManager
	 */
	private $demo_manager;

	/**
	 * Initialize toggle.
	 *
	 * @since 0.3.0
	 * @param object             $context Current environment information.
	 * @param DemoProductManager $demo_manager The demo manager object.
	 */
	public function activate( $context, $demo_manager ): void {
		$this->context      = $context;
		$this->demo_manager = $demo_manager;

		// Only enqueue and set up the toggle if ecommerce_store_optimizer_demo_products_toggle_on is a URL variable.
		if ( ! isset( $_GET['ecommerce_store_optimizer_demo_products_toggle_on'] ) ) { /* phpcs:ignore */
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'ecommerce_store_optimizer_enqueue_toggle' ) );
		add_filter( 'views_edit-product', array( $this, 'ecommerce_store_optimizer_show_toggle_for_demo_products' ) );
		add_action( 'wc_marketplace_suggestions_products_empty_state', array( $this, 'ecommerce_store_optimizer_show_toggle_for_demo_products_in_footer' ) );
		add_action( 'init', array( $this, 'ecommerce_store_optimizer_toggle_demo_products_endpoint' ) );
	}

	/**
	 * Add toggle switch for demo products.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function ecommerce_store_optimizer_enqueue_toggle() {
		$this_submodule_url  = $this->context->modules_url . '/WooDemoProducts/Toggle/';
		$this_submodule_path = $this->context->modules_path . '/WooDemoProducts/Toggle/';

		$dependencies = require $this_submodule_path . 'js/build/index.asset.php';

		// Include the frontend component so it can render inside Gutenberg.
		wp_enqueue_script( 'ecommerce_store_optimizer_demo_products_toggle', $this_submodule_url . 'js/build/index.js', $dependencies['dependencies'], time(), true );

		wp_localize_script(
			'ecommerce_store_optimizer_demo_products_toggle',
			'ecommerce_store_optimizer_togglevars',
			array(
				'demo_products_toggle_endpoint' => get_bloginfo( 'wpurl' ) . '?ecommerce_store_optimizer_toggle_demo_products&ecommerce_store_optimizer_demo_products_toggle_on',
				'demo_products_exist'           => $this->demo_manager->demo_products_exist(),
			)
		);
	}

	/**
	 * Output div for Toggle For Demo Products, which is rendered via react.
	 *
	 * @param array $views Collection of views.
	 *
	 * @return array
	 */
	public function ecommerce_store_optimizer_show_toggle_for_demo_products( array $views ): array {
		$views['ecommerce-store-optimizer-toggle'] = '<div id="ecommerce-store-optimizer-toggle"></div>Demo Products';
		return $views;
	}

	/**
	 * Toggle for demo products in footer
	 */
	public function ecommerce_store_optimizer_show_toggle_for_demo_products_in_footer() {
		if ( ! $this->demo_manager->demo_products_exist() ) {
			echo '<div id="ecommerce-store-optimizer-toggleblank"></div>Demo Products';
		}
	}

	/**
	 * Toggle for Demo Products endpoint
	 */
	public function ecommerce_store_optimizer_toggle_demo_products_endpoint() {
		if ( ! isset( $_GET['ecommerce_store_optimizer_toggle_demo_products'] ) ) { /* phpcs:ignore */
			return;
		}

		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		$demo_products_on = isset( $_POST['demo_products_on'] ) ? sanitize_text_field( wp_unslash( $_POST['demo_products_on'] ) ) : true; /* phpcs:ignore */
		$demo_products_on = filter_var( $demo_products_on, FILTER_VALIDATE_BOOLEAN );

		if ( $demo_products_on ) {
			$creation_succeeded = $this->demo_manager->generate_demo_products();
			echo wp_json_encode( array( 'success' => $creation_succeeded ) );
			die();
		} else {
			$deletion_succeeded = $this->demo_manager->delete_demo_products();
			echo wp_json_encode( array( 'success' => $deletion_succeeded ) );
			die();
		}

	}
}
