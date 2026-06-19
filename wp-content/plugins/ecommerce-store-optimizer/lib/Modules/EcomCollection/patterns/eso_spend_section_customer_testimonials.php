<?php
/**
 * Genesis Blocks Customer Testimonials section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_customer_testimonials',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-primary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-customer-testimonials\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-customer-testimonials gb-layout-columns-1 one-column has-eso-primary-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Customer Testimonials</h2>
<!-- /wp:heading -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingUnit\":\"em\",\"columnMaxWidth\":1200,\"className\":\"gpb-spend-section-customer-testimonials\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-spend-section-customer-testimonials gb-layout-columns-2 gb-2-col-equal gb-columns-center alignfull\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingSync\":true,\"paddingUnit\":\"em\",\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/spend/eso_spend_customer_testimonial_1.jpg\" alt=\"\"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>This team took my product from an idea to a reality in record time. Not only were they easy to work with, but the design they came up with was better than I could have even asked for.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Anne Alpine / Nature First</strong></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/spend/eso_spend_customer_testimonial_2.jpg\" alt=\"\"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>This team took my product from an idea to a reality in record time. Not only were they easy to work with, but the design they came up with was better than I could have even asked for.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Riley Glacier / Snap Crackle</strong></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Customer Testimonials', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'header', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend customer testimonials', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_customer_testimonials.jpg',
];
