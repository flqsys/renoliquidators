<?php
/**
 * The template for displaying full width pages without breadcrumbs or title.
 *
 * Template Name: Blocks
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

// Removes the page title.
remove_action( 'storefront_page', 'storefront_page_header', 10 );

// Removes the breadcrumbs.
remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );

add_filter( 'body_class', 'eso_template_body_class' );

/**
 * Adds the storefront-full-width-content body class to add full width styles.
 *
 * Storefront uses this class to change the layout when no widgets are present in the sidebar.
 *
 * @since 0.3.0
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function eso_template_body_class( $classes ) {

	$classes[] = 'storefront-full-width-content';
	return $classes;

}

wp_enqueue_style( 'eso-blocks-template', ECOMMERCE_STORE_OPTIMIZER_PLUGIN_URL . 'lib/Modules/PageTemplate/styles.css', array(), ECOMMERCE_STORE_OPTIMIZER_VERSION );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
