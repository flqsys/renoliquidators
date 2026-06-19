<?php
/**
 * Color Customizer settings.
 *
 * @since 0.4.1
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerSettings;

/**
 * Returns true for light colors and false for dark colors.
 *
 * @param  strong $color Hex color e.g. #111111.
 * @return bool          True if the average lightness of the three components of the color is higher or equal than 127.5.
 * @since  0.4.1
 */
function eso_is_color_light( $color ) {
	$rgb_values        = eso_get_rgb_values_from_hex( $color );
	$average_lightness = ( $rgb_values['r'] + $rgb_values['g'] + $rgb_values['b'] ) / 3;
	return $average_lightness >= 127.5;
}

/**
 * Given a hex color, returns an array with the color components.
 *
 * @param  strong $color Hex color e.g. #111111.
 * @return bool          Array with color components (r, g, b).
 * @since  0.4.1
 */
function eso_get_rgb_values_from_hex( $color ) {
	// Format the hex color string.
	$color = str_replace( '#', '', $color );

	if ( 3 === strlen( $color ) ) {
		$color = str_repeat( substr( $color, 0, 1 ), 2 ) . str_repeat( substr( $color, 1, 1 ), 2 ) . str_repeat( substr( $color, 2, 1 ), 2 );
	}

	// Get decimal values.
	$r = hexdec( substr( $color, 0, 2 ) );
	$g = hexdec( substr( $color, 2, 2 ) );
	$b = hexdec( substr( $color, 4, 2 ) );

	return array(
		'r' => $r,
		'g' => $g,
		'b' => $b,
	);
}

/**
 * Color settings.
 *
 * @since 0.4.1
 */
final class ColorSettings {

	use \Genesis\EcommerceStoreOptimizer\Core\DefaultColorsTrait;

	/**
	 * Register the customizer settings.
	 *
	 * @param \WP_Customize_Manager $wp_customize WP Customizer object.
	 */
	public function register_settings( $wp_customize ): void {
		// Get theme name.
		$theme_name = get_template();

		// Default color palette.
		$eso_default_colors = $this->get_default_colors();

		if ( $theme_name !== 'storefront' ) {
			$panel_name                = esc_html__( 'Collection Color Settings', 'ecommerce-store-optimizer' );
			$primary_color_description = esc_html__( 'Customize the color of dark background sections such as Testimonials.', 'ecommerce-store-optimizer' );
			$primary_color_label       = esc_html__( 'Dark Section Background Color', 'ecommerce-store-optimizer' );
			$primary_text_description  = esc_html__( 'Customize the text color of dark background sections such Testimonials.', 'ecommerce-store-optimizer' );
			$primary_text_label        = esc_html__( 'Dark Section Text Color', 'ecommerce-store-optimizer' );
		} else {
			$panel_name                = esc_html__( 'Color Settings', 'ecommerce-store-optimizer' );
			$primary_color_description = esc_html__( 'Customize the color of dark background sections such as the Header, Footer, and Testimonials.', 'ecommerce-store-optimizer' );
			$primary_color_label       = esc_html__( 'Header & Footer Background Color', 'ecommerce-store-optimizer' );
			$primary_text_description  = esc_html__( 'Customize the text color of dark background sections such as Header, Footer, and Testimonials.', 'ecommerce-store-optimizer' );
			$primary_text_label        = esc_html__( 'Header & Footer Text Color', 'ecommerce-store-optimizer' );
		}

		// Adds color settings panel.
		$wp_customize->add_panel(
			'eso_color_settings_panel',
			[
				'description' => sprintf( '<p><strong>%1$s</strong></p><p>%2$s</p>', esc_html__( 'Bring your site to life and showcase your brand colors with these settings!', 'ecommerce-store-optimizer' ), esc_html__( 'The Main Color Options allow you to customize the overall look and feel of your site. The Typography Color Options allow you to customize the default color of headings and content text as well as the content link color.', 'ecommerce-store-optimizer' ) ),
				'title'       => $panel_name,
				'priority'    => 20,
			]
		);

		// Adds the settings sections within the color settings panel.
		$wp_customize->add_section(
			'eso_color_settings',
			[
				'description' => sprintf( '<strong>%s</strong>', esc_html__( 'Customize the main colors used throughout your site.', 'ecommerce-store-optimizer' ) ),
				'title'       => esc_html__( 'Main Color Options', 'ecommerce-store-optimizer' ),
				'panel'       => 'eso_color_settings_panel',
			]
		);

		$wp_customize->add_section(
			'eso_typography_settings',
			[
				'description' => sprintf( '<strong>%s</strong>', esc_html__( 'Customize the text colors used throughout your site.', 'ecommerce-store-optimizer' ) ),
				'title'       => esc_html__( 'Typography Color Options', 'ecommerce-store-optimizer' ),
				'panel'       => 'eso_color_settings_panel',
			]
		);

		$wp_customize->add_setting(
			'eso_primary_color',
			[
				'default'           => $eso_default_colors['primary'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'eso_primary_color',
				[
					'description' => $primary_color_description,
					'label'       => $primary_color_label,
					'section'     => 'eso_color_settings',
					'settings'    => 'eso_primary_color',
				]
			)
		);

		$wp_customize->add_setting(
			'eso_primary_color_contrast',
			[
				'default'           => $eso_default_colors['primary_contrast'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'eso_primary_color_contrast',
				[
					'description' => $primary_text_description,
					'label'       => $primary_text_label,
					'section'     => 'eso_color_settings',
					'settings'    => 'eso_primary_color_contrast',
				]
			)
		);

		$wp_customize->add_setting(
			'eso_secondary_color',
			[
				'default'           => $eso_default_colors['secondary'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'eso_secondary_color',
				[
					'description' => esc_html__( 'Customize the accent color used in page content sections, buttons, and banners.', 'ecommerce-store-optimizer' ),
					'label'       => esc_html__( 'Accent Color', 'ecommerce-store-optimizer' ),
					'section'     => 'eso_color_settings',
					'settings'    => 'eso_secondary_color',
				]
			)
		);

		if ( $theme_name === 'storefront' ) {
			// Move storefront color controls to color panel.
			$wp_customize->get_control( 'storefront_text_color' )->section    = 'eso_typography_settings';
			$wp_customize->get_control( 'storefront_accent_color' )->section  = 'eso_color_settings';
			$wp_customize->get_control( 'storefront_heading_color' )->section = 'eso_typography_settings';

			// Rename setting.
			$wp_customize->get_control( 'storefront_accent_color' )->label = esc_html__( 'Link color', 'ecommerce-store-optimizer' );

			// Add descriptions.
			$wp_customize->get_control( 'storefront_text_color' )->description    = esc_html__( 'Customize the default color of the text found within site content.', 'ecommerce-store-optimizer' );
			$wp_customize->get_control( 'storefront_accent_color' )->description  = esc_html__( 'Customize the color of links found within your site content and focus outlines.', 'ecommerce-store-optimizer' );
			$wp_customize->get_control( 'storefront_heading_color' )->description = esc_html__( 'Customize the default color of headings found within site content.', 'ecommerce-store-optimizer' );

			// Remove unused Hero heading color controls. These are not used since the default Storefront Homepage template is removed.
			$wp_customize->remove_control( 'storefront_hero_heading_color' );
			$wp_customize->remove_control( 'storefront_hero_text_color' );
			$wp_customize->remove_control( 'storefront_header_background_color' );
			$wp_customize->remove_control( 'storefront_header_text_color' );
			$wp_customize->remove_control( 'storefront_header_link_color' );
			$wp_customize->remove_control( 'storefront_footer_background_color' );
			$wp_customize->remove_control( 'storefront_footer_heading_color' );
			$wp_customize->remove_control( 'storefront_footer_text_color' );
			$wp_customize->remove_control( 'storefront_footer_link_color' );
			$wp_customize->remove_section( 'storefront_buttons' );
			$wp_customize->remove_section( 'storefront_typography' );
		}
	}

	/**
	 * Generate CSS for editor colors based on theme color palette support.
	 *
	 * @since 0.4.1
	 */
	public function inline_color_palette() {

		// Default color palette.
		$eso_default_colors = $this->get_default_colors();

		$eso_primary_color = get_option(
			'eso_primary_color',
			$eso_default_colors['primary']
		);

		$eso_secondary_color = get_option(
			'eso_secondary_color',
			$eso_default_colors['secondary']
		);

		$primary_contrast = get_option(
			'eso_primary_color_contrast',
			$eso_default_colors['primary_contrast']
		);

		// Check if the color is light or dark using Storefront theme function.
		$secondary_contrast = eso_is_color_light( $eso_secondary_color ) ? '#000000' : '#ffffff';

		$css = '';

		// Customizer color palette.
		$css .= <<<CSS
		.has-background-color.has-eso-primary-background-color p,
		.has-background-color.has-eso-secondary-background-color p {
			color: inherit;
		}
		.has-eso-white-color,
		.has-inline-color.has-eso-white-color {
			color: #fff;
		}
		.has-eso-white-background-color {
			background-color: #fff;
		}
		.has-eso-gray-color,
		.has-inline-color.has-eso-gray-color {
			color: #c6c6c6;
		}
		.has-eso-gray-background-color {
			background-color: #c6c6c6;
		}
		.has-eso-black-color,
		.has-inline-color.has-eso-black-color {
			color: #000;
		}
		.has-eso-black-background-color {
			background-color: #000;
		}
		.has-eso-primary-color,
		.has-eso-primary-color.has-text-color,
		.has-inline-color.has-eso-primary-color {
			color: $eso_primary_color;
		}
		.has-eso-primary-background-color,
		.has-eso-primary-background-color h1,
		.has-eso-primary-background-color h2,
		.has-eso-primary-background-color h3,
		.has-eso-primary-background-color h4,
		.has-eso-primary-background-color h5,
		.has-eso-primary-background-color h6,
		.has-eso-primary-background-color.has-background,
		.has-eso-primary-background-color.has-background a,
		.has-eso-primary-background-color.has-background.wp-block-button__link,
		.has-eso-primary-background-color.has-background.wp-block-button__link:not(.has-text-color),
		.has-eso-primary-background-color.has-background.wp-block-button__link:active,
		.has-eso-primary-background-color.has-background.wp-block-button__link:hover,
		.has-eso-primary-background-color.has-background.wp-block-button__link:focus,
		.editor-styles-wrapper .has-eso-primary-background-color .block-editor-block-list__block,
		.editor-styles-wrapper .has-eso-primary-background-color.block-editor-block-list__block {
			background-color: $eso_primary_color;
			color: $primary_contrast;
		}
		.has-eso-secondary-color,
		.has-eso-secondary-color.has-text-color,
		.has-inline-color.has-eso-secondary-color {
			color: $eso_secondary_color;
		}
		.has-eso-secondary-background-color,
		.has-eso-secondary-background-color h1,
		.has-eso-secondary-background-color h2,
		.has-eso-secondary-background-color h3,
		.has-eso-secondary-background-color h4,
		.has-eso-secondary-background-color h5,
		.has-eso-secondary-background-color h6,
		.has-eso-secondary-background-color.has-background,
		.has-eso-secondary-background-color.has-background a,
		.has-eso-secondary-background-color.has-background.wp-block-button__link,
		.has-eso-secondary-background-color.has-background.wp-block-button__link:not(.has-text-color),
		.has-eso-secondary-background-color.has-background.wp-block-button__link:active,
		.has-eso-secondary-background-color.has-background.wp-block-button__link:hover,
		.has-eso-secondary-background-color.has-background.wp-block-button__link:focus,
		.editor-styles-wrapper .has-eso-secondary-background-color .block-editor-block-list__block,
		.editor-styles-wrapper .has-eso-secondary-background-color.block-editor-block-list__block {
			background-color: $eso_secondary_color;
			color: $secondary_contrast;
		}
CSS;

		if ( wp_style_is( 'genesis-page-builder-frontend-styles', $list = 'enqueued' ) ) { /* phpcs:ignore */
			wp_add_inline_style( 'genesis-page-builder-frontend-styles', $css );
		}
	}

}
