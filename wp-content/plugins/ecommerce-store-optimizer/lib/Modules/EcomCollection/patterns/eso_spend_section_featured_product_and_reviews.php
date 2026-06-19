<?php
/**
 * Genesis Blocks Featured Product and  Reviews section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_featured_product_and_reviews',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"customBackgroundColor\":\"#eeeeee\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-featured-product-and-reviews\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-featured-product-and-reviews gb-layout-columns-1 one-column gb-has-custom-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%;background-color:#eeeeee\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"columnMaxWidth\":840} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:840px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":50}}} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Our Top Rated Product</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">This awesome product has become our top rated product of the year. Find out why!</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/featured-product /--></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:woocommerce/reviews-by-product -->
<div class=\"wp-block-woocommerce-reviews-by-product wc-block-all-reviews has-image has-name has-date has-rating has-content\" data-image-type=\"reviewer\" data-orderby=\"most-recent\" data-reviews-on-page-load=\"10\" data-reviews-on-load-more=\"10\" data-show-load-more=\"true\" data-show-orderby=\"true\"></div>
<!-- /wp:woocommerce/reviews-by-product --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Featured Product and  Reviews', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
		esc_html__( 'testimonial', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'reviews', 'ecommerce-store-optimizer' ),
		esc_html__( 'product', 'ecommerce-store-optimizer' ),
		esc_html__( 'featured', 'ecommerce-store-optimizer' ),
		esc_html__( 'shop', 'ecommerce-store-optimizer' ),
		esc_html__( 'testimonial', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend featured product and reviews', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_featured_product_and_reviews.jpg',
];
