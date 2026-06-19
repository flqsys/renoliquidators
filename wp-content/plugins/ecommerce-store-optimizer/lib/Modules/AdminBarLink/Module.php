<?php
/**
 * Admin Bar Link Module
 *
 * EcommerceStoreOptimizer AdminBarLink module.
 * Add a menu item to the WordPress admin bar
 *
 * @since 0.3.2
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\AdminBarLink;

use Genesis\EcommerceStoreOptimizer\Core\ModuleInterface;

/**
 * Register this module.
 *
 * @since 0.3.2
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements ModuleInterface {

	/**
	 * Initializes.
	 *
	 * @since 0.3.2
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_link' ), 500 );
	}

	/**
	 * Add an eCommerce Help link to the admin bar with sub-links.
	 *
	 * @since 0.3.2
	 * @param string $admin_bar Admin bar parameters.
	 * @return string Admin bar parameters.
	 */
	public function admin_bar_link( $admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$admin_bar->add_menu(
			array(
				'id'    => 'eso-help-link',
				'title' => '<span class="ab-icon dashicons dashicons-info-outline"></span>' . __( 'eCommerce Help', 'ecommerce-store-optimizer' ),
				'href'  => admin_url( 'admin.php?page=ecommerce-store-optimizer-getting-started' ),
				'meta'  => array(
					'title' => __( 'eCommerce Help', 'ecommerce-store-optimizer' ),
				),
			)
		);
		$admin_bar->add_menu(
			array(
				'id'     => 'eso-getting-started',
				'parent' => 'eso-help-link',
				'title'  => __( 'Getting Started', 'ecommerce-store-optimizer' ),
				'href'   => admin_url( 'admin.php?page=ecommerce-store-optimizer-getting-started' ),
				'meta'   => array(
					'title' => __( 'Getting Started', 'ecommerce-store-optimizer' ),
				),
			)
		);
		$admin_bar->add_menu(
			array(
				'id'     => 'eso-view-website',
				'parent' => 'eso-help-link',
				'title'  => __( 'View Your Website', 'ecommerce-store-optimizer' ),
				'href'   => home_url( '/' ),
				'meta'   => array(
					'title' => __( 'View Your Website', 'ecommerce-store-optimizer' ),
				),
			)
		);
	}
}
