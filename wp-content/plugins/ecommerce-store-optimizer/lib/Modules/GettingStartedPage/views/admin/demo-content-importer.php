<?php
/**
 * Demo Content Importer.
 *
 * Outputs markup to help with importing demo content.
 *
 * @package Ecommerce_Store_Optimizer
 */

/**
 * Demo Content Importer
 *
 * Outputs markup to help with importing demo content.
 *
 * @param bool   $initiate_demo_content                Should we display the demo content importing notifier.
 * @param string $demo_content_regenerate_endpoint     The endpoint to force regeneration of demo content.
 * @param bool   $show_regenerate_demo_content_button  Whether to show the force-regenerate demo content button.
 * @return void
 */
function demo_content_importer(
	bool $initiate_demo_content,
	string $demo_content_regenerate_endpoint,
	bool $show_regenerate_demo_content_button = false,
) { ?>
	<div id="eso-importing-notifier" class="eso-importing" style="<?php echo esc_attr( $initiate_demo_content ? 'display:block;' : 'display:none;' ); ?>">
		<div id="eso-importing">
			<span class="spinner is-active"></span>
			<p><?php esc_html_e( 'Your site demo content is being added.', 'ecommerce-store-optimizer' ); ?></p>
		</div>
		<div id="eso-import-success" style="display:none;">
			<p><?php esc_html_e( 'Your site demo content was successfully added.', 'ecommerce-store-optimizer' ); ?></p>
		</div>
	</div>
	<?php
	// If we should show a "Regenerate Demo Content" button.
	if ( $show_regenerate_demo_content_button ) {
		?>
		<div id="eso-import-demo-content-option" class="eso-import-demo-content-option">
			<script type="text/javascript">
				function eso_initiate_demo_content_regeneration() {
					// Hide the content regeneration button.
					document.getElementById("eso-import-demo-content-option").style.display = "none";
					// Show the importing notifier.
					document.getElementById("eso-importing-notifier").style.display = "block";

					// Send the fetch call to the server to regenerate the demo content.
					fetch( "<?php echo esc_url_raw( $demo_content_regenerate_endpoint ); ?>", {
						method: "POST",
						mode: "same-origin",
						credentials: "same-origin",
					} ).then(function() {
						// When fetch is complete, hide the importing notifier.
						document.getElementById("eso-importing").style.display = "none";
						// Show the success message.
						document.getElementById("eso-import-success").style.display = "block";
						// Show the View site button.
						document.getElementById("eso-view-website-button").style.display = "block";
					} );
				}
			</script>
			<button class="eso-regenerate" onclick="eso_initiate_demo_content_regeneration()"><?php esc_html_e( 'Regenerate Demo Content', 'ecommerce-store-optimizer' ); ?></button>
		</div>
		<?php
	}
}
