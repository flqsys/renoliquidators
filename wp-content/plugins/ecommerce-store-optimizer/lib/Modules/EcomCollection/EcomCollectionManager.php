<?php
/**
 * Ecom Collection Manager
 *
 * Responsible for registering the Ecommerce Collection.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\EcomCollection;

use \Genesis\PageBuilder;

/**
 * Customizer Defaults Manager class
 *
 * @since 0.4.0
 */
final class EcomCollectionManager {

	/**
	 * Register the ecommerce collection patterns.
	 *
	 * Runs on plugin install
	 *
	 * @since 1.0
	 */
	public function register_ecommerce_collection_patterns() {
		if ( ! function_exists( 'genesis_blocks_register_layout_component' ) ) {
			return;
		}

		/**
		 * Scan Patterns directory and auto require all PHP files
		 */
		$pattern_file_paths = glob( dirname( __FILE__ ) . '/patterns/*.php' );

		foreach ( $pattern_file_paths as $path ) {
			genesis_blocks_register_layout_component( require $path );
		}
	}

}
