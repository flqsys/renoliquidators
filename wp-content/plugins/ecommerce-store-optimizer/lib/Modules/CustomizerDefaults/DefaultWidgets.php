<?php
/**
 * DefaultWidgets
 * Creates default widgets on activation.
 *
 * @since 0.3.2
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerDefaults;

/**
 * DefaultWidgets class.
 *
 * @since 0.3.2
 */
final class DefaultWidgets {

	/**
	 * Initializes the class.
	 *
	 * @param mixed $context Optional Environment data.
	 */
	public function init( $context = null ): void {
		$this->add_footer_widgets();
	}

	/**
	 * Adds widgets to the Footer Column sidebars.
	 */
	public function add_footer_widgets(): void {
		$widget_id   = '2';
		$text_widget = 'text';
		update_option(
			"widget_{$text_widget}",
			array(
				$widget_id     => array(
					'title' => __( 'Product Search', 'ecommerce-store-optimizer' ),
					'text'  => __( "Find what you're looking for using our advanced product search below.", 'ecommerce-store-optimizer' ),
				),
				'_multiwidget' => 1,
			)
		);

		$product_search_widget = 'woocommerce_product_search';
		update_option(
			"widget_{$product_search_widget}",
			array(
				$widget_id     => array(),
				'_multiwidget' => 1,
			)
		);

		$products_widget = 'woocommerce_products';
		update_option(
			"widget_{$products_widget}",
			array(
				$widget_id     => array( 'number' => 3 ),
				'_multiwidget' => 1,
			)
		);

		$categories_widget = 'woocommerce_product_categories';
		update_option(
			"widget_{$categories_widget}",
			array(
				$widget_id     => array( 'hide_empty' => 1 ),
				'_multiwidget' => 1,
			)
		);

		wp_set_sidebars_widgets(
			array_merge(
				wp_get_sidebars_widgets(),
				array(
					'footer-1' => array(
						"{$text_widget}-{$widget_id}",
						"{$product_search_widget}-{$widget_id}",
					),
					'footer-2' => array(
						"{$products_widget}-{$widget_id}",
					),
					'footer-3' => array(
						"{$categories_widget}-{$widget_id}",
					),
				)
			)
		);
	}
}
