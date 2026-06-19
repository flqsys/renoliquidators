<?php
/**
 * EcommerceStoreOptimizer PluginUpdates module.
 *
 * This module enables PluginUpdates functionality.
 *
 * @since 0.3.1
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\PluginUpdates;

use stdClass;

/**
 * Registers this module.
 *
 * @since 0.3.1
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
	 * @since 0.3.1
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;

		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_for_updates' ) );
		add_filter( 'plugins_api', array( $this, 'custom_plugins_api' ), 10, 3 );
		add_action( 'load-plugins.php', array( $this, 'handle_update_error_on_plugins_page' ), 0 );
		add_action( 'load-update-core.php', array( $this, 'handle_update_error_on_updates_page' ), 0 );
		add_action( 'add_option_genesis_pro_subscription_key', array( $this, 'validate_subscription_key' ) );
		add_action( 'update_option_genesis_pro_subscription_key', array( $this, 'validate_subscription_key' ) );

	}

	/**
	 * Helper function which allows us to get the directory name of this plugin, regardless of whether it was manually renamed by someone along the way.
	 *
	 * @param string $plugin_filename The main filename of the plugin in question.
	 * @return string The directory and name of the plugin separated by a slash. For example: 'akismet-directory/akismet.php'
	 */
	private function get_dir_and_filename_of_active_plugin( $plugin_filename ) {
		$plugin_dir_and_filename = false;
		$active_plugins          = get_option( 'active_plugins' );

		if ( ! is_array( $active_plugins ) ) {
			return false;
		}

		foreach ( $active_plugins as $active_plugin ) {
			if ( false !== strpos( $active_plugin, $plugin_filename ) ) {
				$plugin_dir_and_filename = $active_plugin;
				break;
			}
		}
		return $plugin_dir_and_filename;
	}

	/**
	 * Checks the WPE Product Info API for new versions of the plugin
	 * and returns the data required to update this plugin.
	 *
	 * @param object $data WordPress update object.
	 *
	 * @return object $data An updated object if an update exists, default object if not.
	 */
	public function check_for_updates( $data ) {

		// No update object exists. Return early.
		if ( empty( $data ) ) {
			return $data;
		}

		$response = $this->get_product_info();

		if ( empty( $response->requires_at_least ) || empty( $response->stable_tag ) ) {
			return $data;
		}

		$meets_wp_req = version_compare( get_bloginfo( 'version' ), (string) $response->requires_at_least, '>=' );

		// Only update the response if there's a newer version, otherwise WP shows an update notice for the same version.
		if ( $meets_wp_req && version_compare( $this->context->version, (string) $response->stable_tag, '<' ) ) {
			$data->response[ $response->plugin ] = $response;
		}

		return $data;
	}

	/**
	 * Fetches and returns the plugin info from the WPE product info API.
	 *
	 * @return stdClass
	 */
	private function get_product_info() {

		// Check for a cached response before making an API call.
		$response = get_transient( 'eso_product_info' );

		if ( false !== $response ) {
			return $response;
		}

		$sub_key = sanitize_key( get_option( 'genesis_pro_subscription_key', '' ) );

		$request_args = [
			'timeout'    => ( ( defined( 'DOING_CRON' ) && DOING_CRON ) ? 30 : 3 ),
			'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
			'body'       => [
				'version' => $this->context->version,
			],
			'headers'    => array(
				'Authorization' => 'Bearer ' . $sub_key,
			),
		];

		$response = wp_remote_get( 'https://wp-product-info.wpesvc.net/v1/plugins/ecommerce-store-optimizer', $request_args );

		if ( empty( $sub_key ) ) {
			update_option( 'eso_product_info_api_error', 'no-key', false );
			$response = new stdClass();
			set_transient( 'eso_product_info', $response, MINUTE_IN_SECONDS * 5 );
			return $response;
		}

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			// Save the error code so we can use it elsewhere to display messages.
			if ( is_wp_error( $response ) ) {
				update_option( 'eso_product_info_api_error', $response->get_error_code(), false );
			} else {
				$response_body = json_decode( wp_remote_retrieve_body( $response ), false );
				$error_code    = ! empty( $response_body->error_code ) ? $response_body->error_code : 'unknown';
				update_option( 'eso_product_info_api_error', $error_code, false );
			}

			// Cache an empty object for 5 minutes to give the product info API time to recover.
			$response = new stdClass();

			set_transient( 'eso_product_info', $response, MINUTE_IN_SECONDS * 5 );

			return $response;
		}

		// Delete any existing API error codes since we have a valid API response.
		delete_option( 'eso_product_info_api_error' );

		$response = json_decode( wp_remote_retrieve_body( $response ) );

		$response->name          = isset( $response->name ) ? $response->name : 'EcommerceStoreOptimizer';
		$response->stable_tag    = isset( $response->new_version ) ? $response->new_version : $this->context->version;
		$response->new_version   = $response->new_version;
		$response->download_link = isset( $response->download_link ) ? $response->download_link : '';
		$response->package       = $response->download_link;
		$response->slug          = 'ecommerce-store-optimizer';
		$response->plugin        = $this->get_dir_and_filename_of_active_plugin( 'ecommerce-store-optimizer.php' );

		// Format each part the way WP core needs it, as an object containing an array.
		$response->sections = (array) $response->sections;
		$response->icons    = (array) $response->icons;
		$response->banners  = (array) $response->banners;

		// Cache the response for 12 hours.
		set_transient( 'eso_product_info', $response, HOUR_IN_SECONDS * 12 );

		return $response;
	}

	/**
	 * Checks for plugin update API errors and shows
	 * a message on the Plugins page if errors exist.
	 */
	public function handle_update_error_on_plugins_page() {
		if ( empty( get_option( 'eso_product_info_api_error', false ) ) ) {
			return;
		}

		add_action(
			'admin_notices',
			function() {
				$plugin_basename = plugin_basename( ECOMMERCE_STORE_OPTIMIZER_PLUGIN_FILE );
				remove_action( "after_plugin_row_{$plugin_basename}", 'wp_plugin_update_row' );
				add_action( "after_plugin_row_{$plugin_basename}", array( $this, 'show_plugin_row_notice' ), 10, 2 );
			}
		);
	}

	/**
	 * Checks for plugin update API errors and shows
	 * a message on the Dashboard > Updates page if errors exist.
	 */
	public function handle_update_error_on_updates_page() {
		$api_error = get_option( 'eso_product_info_api_error', false );
		if ( empty( $api_error ) ) {
			return;
		}

		add_action(
			'admin_notices',
			function() use ( $api_error ) {
				echo wp_kses_post( sprintf( '<div class="error"><p>%s</p></div>', $this->api_error_notice_text( $api_error ) ) );
			}
		);
	}

	/**
	 * Validates the subscription key with the product info service endpoint.
	 *
	 * @param string $option_name The option name of the subscription key.
	 */
	public function validate_subscription_key( $option_name ) {
		unset( $option_name );

		// So get_plugin_data() is always defined.
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		delete_transient( 'eso_product_info' );
		$this->get_product_info();
	}

	/**
	 * Shows a notice on the Plugins page when there is an
	 * issue with the subscription key and/or update service.
	 *
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @param array  $plugin_data An array of plugin data.
	 */
	public function show_plugin_row_notice( $plugin_file, $plugin_data ) {

		$api_error = get_option( 'eso_product_info_api_error', false );

		if ( empty( $api_error ) ) {
			return;
		}

		echo '<tr class="plugin-update-tr active" id="ecommerce-store-optimizer-update" data-slug="ecommerce-store-optimizer" data-plugin="ecommerce-store-optimizer/ecommerce-store-optimizer.php">';
		echo '<td colspan="3" class="plugin-update">';
		echo '<div class="update-message notice inline notice-error notice-alt"><p>' . wp_kses_post( $this->api_error_notice_text( $api_error ) ) . '</p></div>';
		echo '</td>';
		echo '</tr>';
	}

	/**
	 * Returns the text to be displayed to the user based on the
	 * error code received from the Product Info Service API.
	 *
	 * @param string $reason The reason/error code received the API.
	 *
	 * @return string
	 */
	public function api_error_notice_text( $reason ) {

		switch ( $reason ) {
			case 'key-unknown':
				/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
				return sprintf( __( 'The subscription key you entered in the Genesis Blocks Settings Page settings appears to be invalid or is not associated with this product. Please verify the key you have saved there matches the key in your <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'ecommerce-store-optimizer' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'ecommerce-store-optimizer' ) );

			case 'key-invalid':
				/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
				return sprintf( __( 'The subscription key you entered in the Genesis Blocks Settings Page settings is invalid. Get your subscription key in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'ecommerce-store-optimizer' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'ecommerce-store-optimizer' ) );

			case 'key-deleted':
				/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
				return sprintf( __( 'Your subscription key was regenerated in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a> but was not updated in the Genesis Blocks Settings Page settings page. Update your subscription key in the Genesis Blocks Settings Page settings to receive updates.', 'ecommerce-store-optimizer' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'ecommerce-store-optimizer' ) );

			case 'no-key':
				return sprintf(
					/* translators: %1$s: Link to the settings page. %2$s: The settings page text that is linked. */
					__( 'There is no Genesis Pro subscription key entered. To get updates and the latest features for the eCommerce Store Optimizer plugin, please enter your subscription key in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'ecommerce-store-optimizer' ),
					esc_url(
						admin_url(
							add_query_arg(
								[ 'page' => 'genesis-blocks-settings' ],
								'admin.php'
							)
						)
					),
					esc_html__( 'Genesis Blocks settings', 'ecommerce-store-optimizer' )
				);

			case 'subscription-expired':
				/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
				return sprintf( __( 'Your eCommerce Store Optimizer subscription has expired. <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a> now.', 'ecommerce-store-optimizer' ), 'https://my.wpengine.com/modify_plan', esc_html__( 'Renew', 'ecommerce-store-optimizer' ) );

			case 'subscription-notfound':
				return __( 'A valid subscription for your subscription key was not found. Please contact support.', 'ecommerce-store-optimizer' );

			case 'product-unknown':
				return __( 'The product you requested information for is unknown. Please contact support.', 'ecommerce-store-optimizer' );

			default:
				/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
				return sprintf( __( 'There was an unknown error connecting to the update service. Please ensure the key you have saved in the Genesis Blocks Settings Page settings page matches the key in your <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>. This issue could be temporary. Please contact support if this error persists.', 'ecommerce-store-optimizer' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'ecommerce-store-optimizer' ) );
		}
	}

	/**
	 * Returns a custom API response for updating the plugin
	 * and for displaying information about it in wp-admin.
	 *
	 * The `plugins_api` filter is documented in `wp-admin/includes/plugin-install.php`.
	 *
	 * @param false|object|array $api The result object or array. Default false.
	 * @param string             $action The type of information being requested from the Plugin Installation API.
	 * @param object             $args Plugin API arguments.
	 *
	 * @return false|stdClass $api Plugin API arguments.
	 */
	public function custom_plugins_api( $api, $action, $args ) {

		if ( empty( $args->slug ) || $args->slug !== 'ecommerce-store-optimizer' ) {
			return $api;
		}

		/**
		 * Information from the product info service API.
		 *
		 * @var stdClass $product_info
		 */
		$product_info = $this->get_product_info();

		if ( empty( $product_info ) || is_wp_error( $product_info ) ) {
			return $api;
		}

		$meets_wp_req = version_compare( (string) get_bloginfo( 'version' ), (string) $product_info->requires_at_least, '>=' );

		$product_info->requires = isset( $product_info->requires_at_least ) ? $product_info->requires_at_least : '5.0';
		$product_info->sections = isset( $product_info->sections ) ? $product_info->sections : '';

		// Only pass along the update info if the requirements are met and there's actually a newer version.
		if ( $meets_wp_req && version_compare( (string) $this->context->version, (string) $product_info->stable_tag, '<' ) ) {
			$product_info->version = $product_info->stable_tag;
		}

		return $product_info;
	}

}
