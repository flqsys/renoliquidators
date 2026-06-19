<?php
add_shortcode( 'select_shop_active', 'rs_select_shop_active' );
function rs_select_shop_active($atts){

    $store_locator = get_posts( array(
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post_type'      => 'wpsl_stores',
        'fields'         => 'ids'
    ) );

    $a = shortcode_atts( array(
        'position' => 'center',
    ), $atts );


    $html_select_out = '';
    if(!empty($store_locator)){
        $html_select_out .= '<div class="select_store_locator '.$a['position'].'">
            <select>
                <option disabled selected>Select your Store</option>';
                foreach ($store_locator as $key => $store_id) {
                    $store_meta = get_post_meta($store_id);
                    
                    if(!empty($_COOKIE['location-cookie']) && $_COOKIE['location-cookie'] == $store_id){
                        $html_select_out .= '<option selected data-store-id="'.$store_id.'" data-lng="'.$store_meta['wpsl_lng'][0].'" data-lat="'.$store_meta['wpsl_lat'][0].'">'.get_the_title($store_id).'</option>';
                    } else{
                        $html_select_out .= '<option data-store-id="'.$store_id.'" data-lng="'.$store_meta['wpsl_lng'][0].'" data-lat="'.$store_meta['wpsl_lat'][0].'">'.get_the_title($store_id).'</option>';
                    }
                }
            $html_select_out .= '</select>
        </div>';
    } 

    return $html_select_out;
}

//to remove the additional information tab
add_filter( 'woocommerce_product_tabs', 'my_remove_product_tabs', 98 );
function my_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] );
  return $tabs;
}

add_action( 'wp_footer', 'cf7_redirect_wp_footer' );
function cf7_redirect_wp_footer() {
?>
    <script>
         document.addEventListener( 'wpcf7mailsent', function( event ) {
                 location = 'http://localhost/renoliquidators/thank-you/';
         }, false );
    </script>
<?php
}

// Remove SKU
add_filter( 'wc_product_sku_enabled', '__return_false' );


/*------- Shortcode to display product name [post_title] To be used with Global Scheama -----------------------------------------------------------*/
function post_title_shortcode(){
     if( is_tax() ) {
    	$term = get_queried_object();
    	return $term->name;
	} else{
   	 return get_the_title();
	}
}
add_shortcode('post_title','post_title_shortcode');

/*------- Shortcode to display page title without space [post_title_url]-----------------------------------------------------------*/
function post_title_like_url(){
   	 return str_replace(" ", "-", get_the_title());
}
add_shortcode('post_title_url','post_title_like_url');

/*------- Shortcode to display product name [url_post_title] with lowercase ----------------------------*/
function url_post_title_shortcode(){   
         return str_replace(' ', '-', strtolower(get_the_title()) );
}
add_shortcode('url_post_title','url_post_title_shortcode');

/*------- Disable Backorders Globally -----------------------------------------------------------*/
add_filter( 'woocommerce_product_backorders_allowed', '__return_false', 1000 );



/*----------------ACF - add WC Product Attribute  -------*/
// Adds a custom rule type.
add_filter( 'acf/location/rule_types', function( $choices ){
    $choices[ __("Other",'acf') ]['wc_prod_attr'] = 'WC Product Attribute';
    return $choices;
} );

// Adds custom rule values.
add_filter( 'acf/location/rule_values/wc_prod_attr', function( $choices ){
    foreach ( wc_get_attribute_taxonomies() as $attr ) {
        $pa_name = wc_attribute_taxonomy_name( $attr->attribute_name );
        $choices[ $pa_name ] = $attr->attribute_label;
    }
    return $choices;
} );

// Matching the custom rule.
add_filter( 'acf/location/rule_match/wc_prod_attr', function( $match, $rule, $options ){
    if ( isset( $options['taxonomy'] ) ) {
        if ( '==' === $rule['operator'] ) {
            $match = $rule['value'] === $options['taxonomy'];
        } elseif ( '!=' === $rule['operator'] ) {
            $match = $rule['value'] !== $options['taxonomy'];
        }
    }
    return $match;
}, 10, 3 );
/*----------------END ACF - add WC Product Attribute  -------*/

