<?php
/**
 * Genesis Blocks Customer Testimonial section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_customer_testimonial',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#eeeeee\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-customer-testimonial\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-customer-testimonial gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#eeeeee\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"textAlign\":\"center\",\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:center\"><!-- wp:image {\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/person-w-1.jpg\" alt=\"\"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"textAlign\":\"left\",\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:left\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":20}}} -->
<h2 style=\"font-size:20px\">Customer Testimonial </h2>
<!-- /wp:heading -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":28}}} -->
<p style=\"font-size:28px\">This is always my first stop when looking for quality shirts that don’t break the bank. The fit and finish on these shirts is truly incredible. Try them for yourself!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":20}}} -->
<p style=\"font-size:20px\">- Anne Alpine / Nature First</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Customer Testimonial', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'Ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'Testimonial', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'Ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'testimonial', 'ecommerce-store-optimizer' ),
		esc_html__( 'customer', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend customer testimonial', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_customer_testimonial.jpg',
];
