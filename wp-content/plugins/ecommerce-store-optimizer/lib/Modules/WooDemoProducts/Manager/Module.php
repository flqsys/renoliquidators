<?php
/**
 * Demo Products Manager
 *
 * Responsible for managing demo products.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\WooDemoProducts\Manager;

use \Genesis\EcommerceStoreOptimizer\Core\StaticVars;

/**
 * Demo Products Manager class
 *
 * @since 0.4.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\CSVTrait
 */
final class Module {
	// Traits.
	use \Genesis\EcommerceStoreOptimizer\Core\CSVTrait;

	/**
	 * Project context.
	 *
	 * @var object
	 */
	private $context;

	/**
	 * Initialize submodule.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		// Hook in the eso_spin_up_demo_content function.
		add_action( StaticVars::$eso_spin_up_demo_content, array( $this, 'generate_demo_products' ), 3 );

		add_action( 'save_post', array( $this, 'ecommerce_store_optimizer_remove_demo_product_flag' ), 10, 3 );

	}

	/**
	 * Instead of letting the Woo CSV importer handle image imports from a URL, this function pre-imports the image attachments from the local plugin.
	 *
	 * @since 0.6.0
	 * @param object $context Current environment information.
	 */
	private function import_image_attachments( $context ) {

		global $wp_filesystem;

		// Get the WP Filesystem API going.
		if ( ! function_exists( 'request_filesystem_credentials' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		if ( false === ( $creds = request_filesystem_credentials( admin_url(), '', false, false, null ) ) ) { // phpcs:ignore
			return false;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( null, '', true, false, null );
			return;
		}

		// Now that we have the filesystem set up, let's use it to copy the images files from the plugin to the uploads directory.
		$this_submodule_path = $this->context->modules_path . '/WooDemoProducts/Manager/';
		$images_path         = $this_submodule_path . 'sample-data/images/';
		$wp_upload_dir       = wp_upload_dir();

		// The array key here is the name of the file located in our local plugin, and the value is the URL in the CSV file.
		$images_to_import = array(
			'hat-1.jpg'           => 'https://image-will-be-imported-locally/hat-1.jpg',
			'hat-2.jpg'           => 'https://image-will-be-imported-locally/hat-2.jpg',
			'hat-3.jpg'           => 'https://image-will-be-imported-locally/hat-3.jpg',
			'hoodie-blue.jpg'     => 'https://image-will-be-imported-locally/hoodie-blue.jpg',
			'hoodie-charcoal.jpg' => 'https://image-will-be-imported-locally/hoodie-charcoal.jpg',
			'hoodie-gray.jpg'     => 'https://image-will-be-imported-locally/hoodie-gray.jpg',
			'hoodie-purple.jpg'   => 'https://image-will-be-imported-locally/hoodie-purple.jpg',
			'hoodie-red.jpg'      => 'https://image-will-be-imported-locally/hoodie-red.jpg',
			'shirt-angles.jpg'    => 'https://image-will-be-imported-locally/shirt-angles.jpg',
			'shirt-blue.jpg'      => 'https://image-will-be-imported-locally/shirt-blue.jpg',
			'shirt-charcoal.jpg'  => 'https://image-will-be-imported-locally/shirt-charcoal.jpg',
			'shirt-gray.jpg'      => 'https://image-will-be-imported-locally/shirt-gray.jpg',
			'shirt-green.jpg'     => 'https://image-will-be-imported-locally/shirt-green.jpg',
			'shirt-red.jpg'       => 'https://image-will-be-imported-locally/shirt-red.jpg',
		);

		// Loop through each image, copy it to the uploads directory, and make it an attachment.
		foreach ( $images_to_import as $filename => $url_in_csv ) {
			$image_path         = $images_path . $filename;
			$move_image_to      = $wp_upload_dir['path'] . '/' . $filename;
			$image_file_content = $wp_filesystem->get_contents( $image_path );

			// Copy the image from the local plugin to the uploads directory.
			$wp_filesystem->put_contents(
				$move_image_to,
				$image_file_content,
				FS_CHMOD_FILE
			);

			$wp_filetype = wp_check_filetype( $filename );

			// Now that the image is copied to the uploads directory, make it an attachment in the media library.
			$attach_id = wp_insert_attachment(
				array(
					'guid'           => $wp_upload_dir['url'] . '/' . $filename,
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => $filename,
					'post_content'   => '',
					'post_status'    => 'inherit',
				),
				$move_image_to
			);

			// This tells WooCommerce not to import the image from the URL if it already exists in the media library.
			update_post_meta( $attach_id, '_wc_attachment_source', $url_in_csv );
			update_post_meta( $attach_id, 'image_path_was', $image_path );

			// Make the thumbnail versions of this image.
			if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
			}
			wp_generate_attachment_metadata( $attach_id, $move_image_to );

		}

	}

	/**
	 * Get the first post ID in a woo product category.
	 *
	 * @param string $term_slug The term slug.
	 * @return bool
	 */
	private function get_first_post_in_woo_product_cat( $term_slug ) {
		$posts = get_posts(
			array(
				'posts_per_page' => 1,
				'post_type'      => 'product',
				'product_cat'    => $term_slug,
				'post_status'    => 'publish',
			)
		);

		return isset( $posts[0] ) ? $posts[0] : null;
	}

	/**
	 * Remove Demo Product Flag
	 *
	 * Hook to post save to remove the demo product meta key if the user ever saves a demo product.
	 *
	 * @param string $post_id Post ID.
	 *
	 * @return void
	 */
	public function ecommerce_store_optimizer_remove_demo_product_flag( $post_id ): void {

		$is_demo_product = get_post_meta( $post_id, 'wpe_demoproduct_slug', true );

		if ( empty( $is_demo_product ) ) {
			return;
		}

		// Delete the flag since the user has saved/modified this demo product, and won't want it wiped out with other demo products.
		delete_post_meta( $post_id, 'wpe_demoproduct_slug' );
	}

	/**
	 * Get Demo Product IDs
	 */
	public function get_demo_product_ids() {
		global $wpdb;

		$posts_table_name     = $wpdb->posts;
		$posts_post_id        = $wpdb->posts . '.ID';
		$posts_post_status    = $wpdb->posts . '.post_status';
		$post_meta_table_name = $wpdb->postmeta;
		$post_meta_post_id    = $wpdb->postmeta . '.post_id';
		$post_meta_meta_key   = $wpdb->postmeta . '.meta_key';

		// Check if a product exists, but one that does NOT have a wpe_demoproduct_slug.
		$query   = "SELECT ID
		FROM $posts_table_name
		INNER JOIN $post_meta_table_name ON $posts_post_id = $post_meta_post_id
		WHERE post_type = %s
		AND $posts_post_status = %s
		AND EXISTS (
			SELECT *
			FROM $post_meta_table_name
			WHERE $post_meta_post_id = $posts_post_id
			AND $post_meta_meta_key = %s
		)";
		$prep    = $wpdb->prepare( $query, 'product', 'publish', 'wpe_demoproduct_slug' ); /* phpcs:ignore */
		$results = $wpdb->get_results( $prep ); /* phpcs:ignore */

		return $results;
	}

	/**
	 * Check if Demo Products exists
	 *
	 * @return bool
	 */
	public function demo_products_exist(): bool {
		global $wpdb;

		$demo_products = $this->get_demo_products();

		$post_meta_table_name = $wpdb->postmeta;

		foreach ( $demo_products as $demo_product ) {

			$slug = sanitize_title( $demo_product['Name'] );

			// Set the post type to be a wpe_demoproduct
			$demo_product['post_type'] = 'product';

			// Check if this demoproduct already has a post set up.
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $post_meta_table_name WHERE meta_key = %s AND meta_value = %s", 'wpe_demoproduct_slug', $slug ) ); /* phpcs:ignore */
			if ( ! isset( $results[0] ) ) {
				continue;
			}
			$post_id = $results[0]->post_id;

			if ( $post_id ) {
				$post = get_post( $post_id );
				if ( $post ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Delete all demoproducts in WordPress.
	 *
	 * @since 1.0
	 * @return bool
	 */
	public function delete_demo_products() {
		global $wpdb;

		$demo_products = $this->get_demo_products();

		$post_meta_table_name = $wpdb->postmeta;

		foreach ( $demo_products as $demo_product ) {

			$slug = sanitize_title( $demo_product['Name'] );

			// Set the post type to be a wpe_demoproduct
			$demo_product['post_type'] = 'product';

			// Check if this demoproduct already has a post set up.
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $post_meta_table_name WHERE meta_key = %s AND meta_value = %s", 'wpe_demoproduct_slug', $slug ) ); /* phpcs:ignore */

			if ( ! isset( $results[0] ) ) {
				continue;
			}

			$post_id = $results[0]->post_id;

			if ( $post_id ) {
				$post = get_post( $post_id );
				if ( $post ) {
					// Delete this post
					wp_delete_post( $post_id );
				}
			}
		}

		return true;
	}

	/**
	 * Get Demo Products
	 *
	 * @access private
	 * @uses \Genesis\EcommerceStoreOptimizer\Traits\CSVTrait::csv_to_array
	 *
	 * @return mixed
	 */
	public function get_demo_products() {
		return $this->csv_to_array( dirname( __FILE__ ) . '/sample-data/wc-product-export-11-12-2020-1607710738067.csv' );
	}

	/**
	 * Get Demo Products
	 *
	 * @access private
	 * @uses \Genesis\EcommerceStoreOptimizer\Traits\CSVTrait::csv_to_array
	 *
	 * @return mixed
	 */
	public function generate_demo_products() {

		$this->import_image_attachments( $this->context );

		include_once WC_ABSPATH . 'includes/admin/importers/class-wc-product-csv-importer-controller.php';
		include_once WC_ABSPATH . 'includes/import/class-wc-product-csv-importer.php';

		$file     = wc_clean( wp_unslash( dirname( __FILE__ ) . '/sample-data/wc-product-export-11-12-2020-1607710738067.csv' ) );
		$params   = $this->get_importer_params();
		$importer = \WC_Product_CSV_Importer_Controller::get_importer( $file, $params );
		$results  = $importer->import();

		$this->add_meta_to_products( $results );

		return true;
	}

	/**
	 * Add meta data to newly created products.
	 *
	 * @param array $results WC Product CSV Importer results.
	 */
	private function add_meta_to_products( array $results ): void {
		// Get the demo products file again.
		$demo_products = $this->get_demo_products();

		$counter = 0;

		$imported_categories = array();

		// Loop through each product that was created, in order to add additional info to each.
		foreach ( $results['imported'] as $product_id ) {

			// Get the demo product details from the CSV file that correspond to this already-imported product.
			$demo_product = $demo_products[ $counter ];

			$post = get_post( $product_id );
			$slug = sanitize_title( $post->post_title );

			update_post_meta( $product_id, 'wpe_demoproduct_slug', $slug );

			// Get the list of categries this post is assigned to.
			$terms = get_the_terms( $post, 'product_cat' );

			if ( $terms ) {
				$term_ids = wp_list_pluck( $terms, 'term_id' );
			}

			foreach ( $term_ids as $term_id ) {
				$imported_categories[] = $term_id;
			}

			$counter++;
		}

		$imported_categories = array_unique( $imported_categories );

		// Loop through each product category and assign its image.
		foreach ( $imported_categories as $imported_category_id ) {
			// Get the term info.
			$term_data = get_term( $imported_category_id );

			// Get the first post in this category, and set its featured image as the featured image for this category.
			$first_post_id_in_cat = $this->get_first_post_in_woo_product_cat( $term_data->slug );
			update_term_meta( $imported_category_id, 'thumbnail_id', get_post_thumbnail_id( $first_post_id_in_cat ) );

			// Also give it a slug so we know it's a demo category.
			update_term_meta( $imported_category_id, 'wpe_democat_slug', $term_data->slug );
		}
	}

	/**
	 * Get WC CSV Importer params.
	 *
	 * @return array
	 */
	private function get_importer_params(): array {
		return array(
			'delimiter'        => ',',
			'start_pos'        => 0,
			'update_existing'  => false,
			'lines'            => 99,
			'parse'            => true,
			'prevent_timeouts' => false,
			'mapping'          => array(
				'from' => array(
					0  => 'ID',
					1  => 'Type',
					2  => 'SKU',
					3  => 'Name',
					4  => 'Published',
					5  => 'Is featured?',
					6  => 'Visibility in catalog',
					7  => 'Short description',
					8  => 'Description',
					9  => 'Date sale price starts',
					10 => 'Date sale price ends',
					11 => 'Tax status',
					12 => 'Tax class',
					13 => 'In stock?',
					14 => 'Stock',
					15 => 'Low stock amount',
					16 => 'Backorders allowed?',
					17 => 'Sold individually?',
					18 => 'Weight (lbs)',
					19 => 'Length (in)',
					20 => 'Width (in)',
					21 => 'Height (in)',
					22 => 'Allow customer reviews?',
					23 => 'Purchase note',
					24 => 'Sale price',
					25 => 'Regular price',
					26 => 'Categories',
					27 => 'Tags',
					28 => 'Shipping class',
					29 => 'Images',
					30 => 'Download limit',
					31 => 'Download expiry days',
					32 => 'Parent',
					33 => 'Grouped products',
					34 => 'Upsells',
					35 => 'Cross-sells',
					36 => 'External URL',
					37 => 'Button text',
					38 => 'Position',
					39 => 'Attribute 1 name',
					40 => 'Attribute 1 value(s)',
					41 => 'Attribute 1 visible',
					42 => 'Attribute 1 global',
					43 => 'Meta: _min_variation_price',
					44 => 'Meta: _max_variation_price',
					45 => 'Meta: _min_price_variation_id',
					46 => 'Meta: _max_price_variation_id',
					47 => 'Meta: _min_variation_regular_price',
					48 => 'Meta: _max_variation_regular_price',
					49 => 'Meta: _min_regular_price_variation_id',
					50 => 'Meta: _max_regular_price_variation_id',
					51 => 'Meta: _min_variation_sale_price',
					52 => 'Meta: _max_variation_sale_price',
					53 => 'Meta: _min_sale_price_variation_id',
					54 => 'Meta: _max_sale_price_variation_id',
					55 => 'Meta: _download_type',
				),
				'to'   => array(
					0  => 'id',
					1  => 'type',
					2  => 'sku',
					3  => 'name',
					4  => 'published',
					5  => 'featured',
					6  => 'catalog_visibility',
					7  => 'short_description',
					8  => 'description',
					9  => 'date_on_sale_from',
					10 => 'date_on_sale_to',
					11 => 'tax_status',
					12 => 'tax_class',
					13 => 'stock_status',
					14 => 'stock_quantity',
					15 => 'low_stock_amount',
					16 => 'backorders',
					17 => 'sold_individually',
					18 => '',
					19 => '',
					20 => '',
					21 => '',
					22 => 'reviews_allowed',
					23 => 'purchase_note',
					24 => 'sale_price',
					25 => 'regular_price',
					26 => 'category_ids',
					27 => 'tag_ids',
					28 => 'shipping_class_id',
					29 => 'images', // This was 'images', but is now set to "disabled" so that images don't import.
					30 => 'download_limit',
					31 => 'download_expiry',
					32 => 'parent_id',
					33 => 'grouped_products',
					34 => 'upsell_ids',
					35 => 'cross_sell_ids',
					36 => 'product_url',
					37 => 'button_text',
					38 => 'menu_order',
					39 => 'attributes:name1',
					40 => 'attributes:value1',
					41 => 'attributes:visible1',
					42 => 'attributes:taxonomy1',
					43 => 'meta:_min_variation_price',
					44 => 'meta:_max_variation_price',
					45 => 'meta:_min_price_variation_id',
					46 => 'meta:_max_price_variation_id',
					47 => 'meta:_min_variation_regular_price',
					48 => 'meta:_max_variation_regular_price',
					49 => 'meta:_min_regular_price_variation_id',
					50 => 'meta:_max_regular_price_variation_id',
					51 => 'meta:_min_variation_sale_price',
					52 => 'meta:_max_variation_sale_price',
					53 => 'meta:_min_sale_price_variation_id',
					54 => 'meta:_max_sale_price_variation_id',
					55 => 'meta:_download_type',
				),
			),
		);
	}

}
