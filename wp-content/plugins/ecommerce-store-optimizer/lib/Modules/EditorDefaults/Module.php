<?php
/**
 * EditorDefaults Module
 *
 * Module that sets editor configurations.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\EditorDefaults;

/**
 * Register this module.
 *
 * @since 0.4.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {
	/**
	 * Activate module.
	 *
	 * @since 0.4.0
	 * @param object $context Current environment info.
	 */
	public function activate( $context ): void {
		add_action( 'enqueue_block_editor_assets', [ $this, 'disable_editor_fullscreen' ] );
	}

	/**
	 * Disable Fullscreen in the WP Editor.
	 *
	 * @since 0.4.0
	 */
	public function disable_editor_fullscreen(): void {
		$script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
		wp_add_inline_script( 'wp-blocks', $script );
	}
}
