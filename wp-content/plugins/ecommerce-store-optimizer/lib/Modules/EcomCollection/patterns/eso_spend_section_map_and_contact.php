<?php
/**
 * Genesis Blocks Map and Contact section for Spend Collection.
 *
 * @package ecommerce-store-optimizer
 */

return [
	'type'       => 'section',
	'key'        => 'eso_spend_section_map_and_contact',
	'collection' => [
		'slug'                   => 'spend',
		'label'                  => esc_html__( 'Spend', 'ecommerce-store-optimizer' ),
		'allowThemeColorPalette' => true,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":20,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":8,\"paddingRight\":3,\"paddingBottom\":8,\"paddingLeft\":3,\"paddingUnit\":\"%\",\"backgroundColor\":\"eso-secondary\",\"columnMaxWidth\":1200,\"className\":\"eso-spend-section-map-and-contact \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns eso-spend-section-map-and-contact gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-20 has-eso-secondary-background-color gb-columns-center alignfull\" style=\"padding-top:8%;padding-right:3%;padding-bottom:8%;padding-left:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":50}},\"className\":\"has-text-align-center\"} -->
<h2 class=\"has-text-align-center\" style=\"font-size:50px\">Shop Information</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Learn about our shop details and policies.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:html -->
<iframe title=\"Our Location\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3470.5670865756474!2d-95.09152774886842!3d29.558099181973784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86409da671292593%3A0xf684f098a7237a30!2sNASA+Mission+Control+Center!5e0!3m2!1sen!2sus!4v1560875318343!5m2!1sen!2sus\" width=\"100%\" height=\"560\" frameborder=\"0\" style=\"border:0\" allowfullscreen=\"\"></iframe>
<!-- /wp:html --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":4,\"layout\":\"gb-4-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-4 gb-4-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22}}} -->
<h3 style=\"font-size:22px\">Address</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Startup Square<br>123 Block Ave<br>Austin, Texas 36521</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22}}} -->
<h3 style=\"font-size:22px\">Store Hours</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Mon-Fri: 8am - 5pm<br>Sat: 8am 9pm<br>Sun: 8am - 2pm</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22}}} -->
<h3 style=\"font-size:22px\">Email</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">hello@example.com sales@example.com support@example.com</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22}}} -->
<h3 style=\"font-size:22px\">Telephone</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Tel: 514-281-3821<br>Fax: 514-281-5210</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Spend Map and Contact', 'ecommerce-store-optimizer' ),
	'category'   => [
		esc_html__( 'contact', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'ecommerce', 'ecommerce-store-optimizer' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'ecommerce-store-optimizer' ),
		esc_html__( 'business', 'ecommerce-store-optimizer' ),
		esc_html__( 'landing', 'ecommerce-store-optimizer' ),
		esc_html__( 'map', 'ecommerce-store-optimizer' ),
		esc_html__( 'directions', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend', 'ecommerce-store-optimizer' ),
		esc_html__( 'spend map and contact', 'ecommerce-store-optimizer' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/spend/eso_spend_section_map_and_contact.jpg',
];
