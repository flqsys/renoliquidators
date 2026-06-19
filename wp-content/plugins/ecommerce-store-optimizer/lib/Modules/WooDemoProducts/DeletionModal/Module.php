<?php
/**
 * Demo Products Deletion Modal
 *
 * Responsible for showing a toggle switch to enable/disable demo products.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\WooDemoProducts\DeletionModal;

/**
 * Demo Products Deletion Modal class
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
		add_action( 'admin_enqueue_scripts', array( $this, 'ecommerce_store_optimizer_enqueue_modal' ) );
		add_action( 'init', array( $this, 'ecommerce_store_optimizer_delete_demo_products_endpoint' ) );
		add_filter( 'post_row_actions', array( $this, 'modify_list_row_actions' ), 10, 2 );
	}

	/**
	 * Replace the "trash" button on demo products with a div we'll replace with react.
	 *
	 * @since  1.0.0
	 * @param string[] $actions An array of row action links. Defaults are
	 *                          'Edit', 'Quick Edit', 'Restore', 'Trash',
	 *                          'Delete Permanently', 'Preview', and 'View'.
	 * @param WP_Post  $post    The post object.
	 * @return array
	 */
	public function modify_list_row_actions( $actions, $post ) {

		$is_demo_product = get_post_meta( $post->ID, 'wpe_demoproduct_slug', true );

		if ( empty( $is_demo_product ) ) {
			return $actions;
		}

		$actions['ecommerce_store_optimizer_delete_all_demo_products'] = '<div style="display: inline-block;" class="ecommerce-store-optimizer-deletedemoproductsmodal"></div>';
		return $actions;
	}

	/**
	 * Add deletion modal for demo products.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function ecommerce_store_optimizer_enqueue_modal() {
		$this_submodule_url  = $this->context->modules_url . '/WooDemoProducts/DeletionModal/';
		$this_submodule_path = $this->context->modules_path . '/WooDemoProducts/DeletionModal/';

		$dependencies = require $this_submodule_path . 'js/build/index.asset.php';

		wp_enqueue_script( 'ecommerce_store_optimizer_demo_products_deletion_modal', $this_submodule_url . 'js/build/index.js', $dependencies['dependencies'], $dependencies['version'], true );

		wp_localize_script(
			'ecommerce_store_optimizer_demo_products_deletion_modal',
			'ecommerce_store_optimizer_demoproductdeletionmodalvars',
			array(
				'demo_products_modal_endpoint' => add_query_arg( array( 'ecommerce_store_optimizer_delete_demo_products' => 1 ), get_bloginfo( 'wpurl' ) ),
				'demo_products_exist'          => $this->demo_manager->demo_products_exist(),
			)
		);
	}

	/**
	 * Delete Demo Products endpoint
	 */
	public function ecommerce_store_optimizer_delete_demo_products_endpoint() {
		if ( ! isset( $_GET['ecommerce_store_optimizer_delete_demo_products'] ) ) { /* phpcs:ignore */
			return;
		}

		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		$deletion_succeeded = $this->demo_manager->delete_demo_products();
		echo wp_json_encode( array( 'success' => $deletion_succeeded ) );
		die();

	}
}
