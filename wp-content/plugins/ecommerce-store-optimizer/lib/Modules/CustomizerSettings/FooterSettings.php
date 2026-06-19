<?php
/**
 * Footer Customizer settings.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Modules\CustomizerSettings;

use \Genesis\EcommerceStoreOptimizer\Core\StaticVars;

/**
 * Footer settings.
 *
 * @since 0.4.0
 */
final class FooterSettings {

	/**
	 * Register the customizer settings.
	 *
	 * @param \WP_Customize_Manager $wp_customize WP Customizer object.
	 */
	public function register_settings( $wp_customize ): void {
		$wp_customize->add_setting(
			StaticVars::$footer_copyright_text,
			[
				'default'           => get_bloginfo(),
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => function( string $x ): string {
					return esc_html( $x );
				},
			]
		);
		$wp_customize->add_setting(
			StaticVars::$footer_credit_text,
			[
				'default'           => get_home_url(),
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => function( string $x ): string {
					return esc_html( $x );
				},
			]
		);
		$wp_customize->add_setting(
			StaticVars::$footer_credit_link,
			[
				'default'           => get_home_url(),
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => function( string $x ): string {
					return esc_url( $x );
				},
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				StaticVars::$footer_copyright_text,
				[
					'label'       => __( 'Footer Copyright Text', 'ecommerce-store-optimizer' ),
					'section'     => 'storefront_footer',
					'settings'    => StaticVars::$footer_copyright_text,
					'type'        => 'text',
					'description' => 'Customize the text that displays after the &copy symbol. Defaults to the Site Title',
				]
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				StaticVars::$footer_credit_text,
				[
					'label'       => __( 'Footer Credits Text', 'ecommerce-store-optimizer' ),
					'section'     => 'storefront_footer',
					'settings'    => StaticVars::$footer_credit_text,
					'type'        => 'text',
					'description' => 'Customize the linked text that will display below the footer copyright. Defaults to the Site URL',
				]
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				StaticVars::$footer_credit_link,
				[
					'label'       => __( 'Footer Credit Link', 'ecommerce-store-optimizer' ),
					'section'     => 'storefront_footer',
					'settings'    => StaticVars::$footer_credit_link,
					'type'        => 'text',
					'description' => 'Customize the link used for the Footer Credits Text. Defaults to the Site URL',
				]
			)
		);
	}

	/**
	 * Filter Footer Credit Text.
	 *
	 * @since 0.4.0
	 *
	 * @uses get_the_privacy_policy_link
	 * @doc https://developer.wordpress.org/reference/functions/get_the_privacy_policy_link/
	 *
	 * @param string $text Incoming credit text.
	 *
	 * @return string
	 */
	public function filter_credit_text( string $text ): string {
		$credit_text = get_option( StaticVars::$footer_credit_text, get_site_url() );
		$credit_link = get_option( StaticVars::$footer_credit_link, get_site_url() );

		if ( empty( $credit_link ) ) {
			// If credit link is empty, output a span or empty string
			$output = ( empty( $credit_text ) ) ? '' : sprintf( '<span>%s</span>', $credit_text );
		} elseif ( ! empty( $credit_link ) ) {
			// If credit_link is not empty output a link
			$credit_text = ( empty( $credit_text ) ) ? $credit_link : $credit_text;
			$output      = sprintf( '<a href="%s">%s</a>', $credit_link, $credit_text );
		} else {
			$output = '';
		}

		if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
			$separator = ( empty( $output ) ) ? '' : '<span role="separator" aria-hidden="true"></span>';
			$output    = get_the_privacy_policy_link( '', $separator ) . $output;
		}

		return $output;
	}

	/**
	 * Filter Footer Copyright Text.
	 *
	 * @since 0.4.0
	 *
	 * @param string $text Incoming copyright text.
	 *
	 * @return string
	 */
	public function filter_copyright_text( string $text ): string {
		$copyright_text = get_option( StaticVars::$footer_copyright_text, get_bloginfo() );

		if ( empty( $copyright_text ) ) {
			return '';
		}

		return '&copy; ' . esc_html( $copyright_text ) . ' ' . gmdate( 'Y' );
	}

}
