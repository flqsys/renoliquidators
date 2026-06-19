<?php
/**
 * Demo Products Indicator
 *
 * Responsible for making demo products have the "Demo Product" indicator in wp-admin.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\WooDemoProducts\Indicator;

/**
 * Demo Products Indicator class
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
	 * Initialize indicator.
	 *
	 * @since 0.3.0
	 * @param object             $context Current environment information.
	 * @param DemoProductManager $demo_manager The demo manager object.
	 */
	public function activate( $context, $demo_manager ): void {
		$this->context      = $context;
		$this->demo_manager = $demo_manager;
		add_filter( 'display_post_states', array( $this, 'add_demo_product_indicator' ), 10, 2 );
	}

	/**
	 * Add demo product indicator.
	 *
	 * @since  1.0.0
	 * @param string[] $post_states An array of post display states.
	 * @param WP_Post  $post        The current post object.
	 * @return string
	 */
	public function add_demo_product_indicator( $post_states, $post ) {

		$is_demo_product = get_post_meta( $post->ID, 'wpe_demoproduct_slug', true );

		if ( empty( $is_demo_product ) ) {
			return $post_states;
		}

		$new_post_states = array( '<span style="background-color: #fdeaea; padding: 3px 6px; color: #ce716f; white-space: nowrap; border-radius: 3px; font-size: 12px;">' . __( 'Demo Product', 'ecommerce-store-optimizer' ) . '</span>' );

		// Add the other statuses back. This makes it so that "Demo Product" is always the first status shown.
		foreach ( $post_states as $post_state ) {
			$new_post_states[] = $post_state;
		}

		return $new_post_states;
	}
}
