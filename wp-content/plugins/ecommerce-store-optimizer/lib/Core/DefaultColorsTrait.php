<?php
/**
 * Default Colors Trait
 *
 * Helpful methods for working with default colors.
 *
 * @since 0.4.1
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Core;

trait DefaultColorsTrait {
	/**
	 * Get the default color values.
	 *
	 * @return array
	 */
	private function get_default_colors() {

		return [
			'primary'          => '#2a3533',
			'primary_contrast' => '#c6c6c6',
			'secondary'        => '#107f67',
		];
	}
}
