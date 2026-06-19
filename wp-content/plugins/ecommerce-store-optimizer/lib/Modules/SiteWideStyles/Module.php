<?php
/**
 * EcommerceStoreOptimizer SiteWideStyles module.
 *
 * This module enables SiteWideStyles functionality.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\SiteWideStyles;

/**
 * Registers this module.
 *
 * @since 0.3.0
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
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		$theme_name    = get_template();
		if ( $theme_name === 'storefront' ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_editor_styles' ) );
		}
	}

	/**
	 * Enqueues Frontend Styles.
	 *
	 * @since  0.3.0
	 */
	public function enqueue_frontend_styles() {
		$url = $this->context->modules_url . '/SiteWideStyles/styles.css';
		wp_enqueue_style(
			'ecommerce_store_optimizer_frontend_styles',
			$url,
			[ 'storefront-style' ],
			$this->context->version
		);
	}

	/**
	 * Adds styles to post editor.
	 *
	 * NOTE that this is not yet working. The styles are not loading into the block editor...
	 *
	 * @since  0.3.1
	 */
	public function enqueue_editor_styles() {
		$url  = $this->context->modules_url . '/SiteWideStyles/editor-styles.css';
		$path = $this->context->modules_path . '/SiteWideStyles/editor-styles.css';
		wp_enqueue_style(
			'ecommerce_store_optimizer_editor_styles',
			$url,
			[],
			filemtime( plugin_dir_path( $path ) )
		);
	}

}
