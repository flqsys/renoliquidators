<?php
/**
 * The Getting Started page.
 *
 * @package Genesis\EcommerceStoreOptimizer\Modules\GettingStartedPage
 * @since   0.3.1
 */

/**
 * The Getting Started page.
 *
 * @package Genesis\EcommerceStoreOptimizer\Modules\GettingStartedPage
 * @since   0.3.1
 * @author  WP Engine
 * @license GPL-2.0-or-later
 * @link    https://wpengine.com
 */

require_once __DIR__ . '/demo-content-importer.php';

if ( function_exists( 'wpe_site' ) ) {
	$install                       = wpe_site();
	$enable_payments               = 'https://my.wpengine.com/installs/' . $install . '#:~:text=Stripe%20features';
	$golive_url                    = 'https://my.wpengine.com/installs/' . $install . '/go_live_checklist';
	$activate_performance_features = 'https://my.wpengine.com/installs/' . $install . '#:~:text=EverCache';
} else {
	$enable_payments               = '#';
	$golive_url                    = '#';
	$activate_performance_features = '#';
}

// Check whether we should initiate the demo content.
$initiate_demo_content = $this->should_initiate_demo_content();

?>

<div class="wrap">
	<div id="root">
		<div class="eso-header eso-grid-2">
			<h1><?php esc_html_e( 'Getting started with your eCommerce Store', 'ecommerce-store-optimizer' ); ?></h1>
			<div class="eso-header-right">
				<a id="eso-view-website-button" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener noreferrer" style="<?php echo esc_attr( $initiate_demo_content ? 'display:none;' : 'display:block;' ); ?>"><img src="<?php echo esc_url( $this->context->url . 'lib/Modules/GettingStartedPage/assets/images/home.svg' ); ?>" alt="<?php esc_html_e( 'View Your Store', 'ecommerce-store-optimizer' ); ?>" /> <?php esc_html_e( 'View Your Store', 'ecommerce-store-optimizer' ); ?></a>
			</div>
		</div>

		<div class="eso-body eso-grid-2">
			<div class="eso-left">
				<div class="eso-left-box">
					<h2><span><?php esc_html_e( 'Store Setup', 'ecommerce-store-optimizer' ); ?></span></h2>
					<div class="eso-left-checklist">
						<ul>
							<li>
								<p><a href="<?php echo esc_url( $enable_payments ); ?>" target="_blank"><?php esc_html_e( 'Enable Payments', 'ecommerce-store-optimizer' ); ?> &rarr;</a><span class="eso-prod-notice"><?php esc_html_e( 'Use Stripe Connect to accept payments (optional)', 'ecommerce-store-optimizer' ); ?></span></p>
							</li>
							<li>
								<p><a href="<?php echo esc_url( $activate_performance_features ); ?>" target="_blank"><?php esc_html_e( 'Activate Performance Features', 'ecommerce-store-optimizer' ); ?> &rarr;</a><span class="eso-prod-notice"><?php esc_html_e( 'Unlock enhanced store performance and speed', 'ecommerce-store-optimizer' ); ?></span></p>
							</li>
							<li>
								<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-admin' ) ); ?>"><?php esc_html_e( 'Set up WooCommerce', 'ecommerce-store-optimizer' ); ?> &rarr;</a><span class="eso-prod-notice"><?php esc_html_e( 'Update your store settings to prepare for sales', 'ecommerce-store-optimizer' ); ?></span></p>
							</li>
							<li>
								<p><a href="<?php echo esc_url( $golive_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Complete the Go Live Checklist', 'ecommerce-store-optimizer' ); ?> &rarr;</a><span class="eso-prod-notice"><?php esc_html_e( 'Not available for staging or development sites', 'ecommerce-store-optimizer' ); ?></span></p>
							</li>
							<li>
								<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=site-visibility' ) ); ?>"><?php esc_html_e( 'Make your Site Live', 'ecommerce-store-optimizer' ); ?> &rarr;</a><span class="eso-prod-notice"><?php esc_html_e( 'When you\'re ready, turn off the coming soon page', 'ecommerce-store-optimizer' ); ?></span></p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="eso-right">
				<div class="eso-right-box">
					<h2><?php esc_html_e( 'Welcome to the WP Engine eCommerce Suite', 'ecommerce-store-optimizer' ); ?></h2>
					<?php demo_content_importer( $initiate_demo_content, $this->get_force_regenerate_demo_content_endpoint_url() ); ?>
					<p>
						You made the right choice trusting WP Engine with your store - we're here to help you.
					</p>
					<p>
						Ensure your site loads at lightning speed throughout the shopper journey by activating all of the performance enhancing and site management features available to you (Step 2).
					</p>

					<div class="eso-help">
						<h3><?php esc_html_e( 'Need Help?', 'ecommerce-store-optimizer' ); ?></h3>
						<p><strong><?php esc_html_e( "Don't stay stuck.", 'ecommerce-store-optimizer' ); ?></strong> <?php esc_html_e( 'WP Engine Support is available 24/7.', 'ecommerce-store-optimizer' ); ?></p>
						<a class="eso-support-button" href="https://my.wpengine.com/support/" target="_blank" rel="noopener noreferrer">
							<?php esc_html_e( 'Support Center', 'ecommerce-store-optimizer' ); ?>
						</a>
					</div>

					<div class="eso-docs" style="margin-top: 30px;">
						<h4><?php esc_html_e( 'Technical Documentation', 'ecommerce-store-optimizer' ); ?></h4>
						<ul>
							<li><a href="https://wpengine.com/support/ecommerce-solution/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'eCommerce Docs', 'ecommerce-store-optimizer' ); ?></a></li>
							<li><a href="https://woocommerce.com/documentation/woocommerce/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WooCommerce Docs', 'ecommerce-store-optimizer' ); ?></a></li>
							<li><a href="https://woocommerce.com/documentation/products/themes/storefront/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Storefront Docs', 'ecommerce-store-optimizer' ); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
