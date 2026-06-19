<?php
/**
 * EcommerceStoreOptimizer PageTemplate module.
 *
 * This module adds a page template which can be used to show block patterns at their optimal.
 *
 * @since 0.3.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);
namespace Genesis\EcommerceStoreOptimizer\Modules\PageTemplate;

/**
 * Register this module.
 *
 * @since 0.3.0
 * @uses \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface
 */
final class Module implements \Genesis\EcommerceStoreOptimizer\Core\ModuleInterface {

	/**
	 * A Unique Identifier
	 *
	 * @var string $plugin_slug Plugin slug.
	 */
	protected $plugin_slug;

	/**
	 * A reference to an instance of this class.
	 *
	 * @var Module $instance Instance reference.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 *
	 * @var array $templates Template array.
	 */
	protected $templates;

	/**
	 * A reference to context object.
	 *
	 * @var object $context Context object.
	 */
	protected object $context;
	/**
	 * Initialize frontend and admin.
	 *
	 * This is a workaround for the activate method, as ModuleInterface does not allow a return,
	 * but we need one for unit testing this setup.
	 *
	 * @since 0.3.0
	 * @param object $context Current environment information.
	 */
	public function activate( $context ): void {
		$this->context = $context;
		$theme_name    = get_template();
		if ( $theme_name === 'storefront' ) {
			// Add your templates to this array.
			$this->templates = array( 'blocks.php' => __( 'Blocks', 'ecommerce-store-optimizer' ) );

			// Filter the page templates shown in the dropdown.
			add_filter( 'theme_page_templates', array( $this, 'dropdown_pages' ), 10, 4 );

			// Add a filter to the attributes metabox to inject template into the cache.
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );

			// Add a filter to the save post to inject out template into the page cache.
			add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );

			// Add a filter to the template include to determine if the page has our
			// Template assigned and return it's path.
			add_filter( 'template_include', array( $this, 'view_project_template' ) );
		}
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doesn't really exist.
	 *
	 * @since 0.3.0
	 * @param mixed $atts Attributes.
	 */
	public function register_project_templates( $atts ) {

		// Get theme object.
		$theme = wp_get_theme();

		// Create the key used for the themes cache.
		$cache_key = 'page_templates-' . md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );

		// Retrieve existing page templates.
		$templates = $theme->get_page_templates();

		// Check the title of the default page template as well - This filter: https://core.trac.wordpress.org/ticket/27178.
		$default_page_template_title = apply_filters( 'default_page_template_title', __( 'Default Template', 'ecommerce-store-optimizer' ) );

		// Add our template(s) to the list of existing templates by merging the arrays.
		$templates = array_merge( $templates, $this->templates );

		// Replace existing value in cache.
		wp_cache_set( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Adds our template to the page template dropdown
	 *
	 * @param array  $templates Template array.
	 * @param object $theme Theme object.
	 * @param object $post Post object.
	 * @param string $post_type Post Type.
	 */
	public function dropdown_pages( $templates, $theme, $post, $post_type ) {

		// Create the key used for the themes cache.
		$cache_key = 'page_templates-' . md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );

		// Check the title of the default page template as well - This filter: https://core.trac.wordpress.org/ticket/27178.
		$default_page_template_title = apply_filters( 'default_page_template_title', __( 'Default Template', 'ecommerce-store-optimizer' ) );

		// Add our template(s) to the list of existing templates by merging the arrays.
		$templates = array_merge( $templates, $this->templates );

		// Replace existing value in cache.
		wp_cache_set( $cache_key, $templates, 'themes', 1800 );

		return $templates;

	}

	/**
	 * Checks if the template is assigned to the page
	 *
	 * @param string $template Template name.
	 */
	public function view_project_template( $template ) {

		global $post;

		if ( ! isset( $post->ID ) ) {
			return $template;
		}

		if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {

			return $template;

		}

		$file = plugin_dir_path( __FILE__ ) . get_post_meta( $post->ID, '_wp_page_template', true );

		// Just to be safe, we check if the file exist first.
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo esc_html( $file );
		}

		return $template;

	}

}
