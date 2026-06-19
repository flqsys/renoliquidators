<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.welaunch.io
 * @since      1.0.0
 *
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/admin
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class WooCommerce_Ultimate_Tabs_Admin extends WooCommerce_Ultimate_Tabs {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Load redux Framework Options
	 *
	 * @since    1.0.0
	 */
	public function load_redux()
	{
	    // Load the theme/plugin options
	    if ( file_exists( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php' ) ) {
	        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php';
	    }
	}

	/**
	 * Inits the Ultimate Tabs
	 *
	 * @since    1.0.0
	 */
    public function init()
    {
		global $woocommerce_ultimate_tabs_options, $woocommerce;

		$this->options = $woocommerce_ultimate_tabs_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		add_action( 'woocommerce_product_write_panel_tabs', array( $this, 'product_write_panel_tab' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'product_write_panel' ) );
		add_action( 'woocommerce_process_product_meta',     array( $this, 'product_save_data' ), 10, 2 );

		if($this->get_option('variationSupport')) {
			add_action('woocommerce_product_after_variable_attributes',array($this, 'custom_variation_fields'), 10, 3 ); 
			add_filter('woocommerce_save_product_variation', array($this,'save_product_variation'), 10, 2 );
		}

    }

    public function enqueue_scripts()
    {
	    wp_enqueue_editor();

	    wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__).'js/woocommerce-ultimate-tabs-admin.js', array('jquery'), $this->version, true);
	    // wp_enqueue_script($this->plugin_name . '-tinymce', plugin_dir_url(__FILE__).'js/woocommerce-gallery-images-admin.js', array('jquery'), $this->version, true);

	    /**
	     * Example of adding a plugin to the WP JS editor
	     */
	    // wp_register_script(
	    //     'tinymce_table_plugin',
	    //     get_bloginfo('stylesheet_directory') . '/assets/js/tinymce/plugins/table/plugin.min.js',
	    //     array('wp-tinymce-root'),
	    //     $theme_version,
	    //     true
	    // );

	    // wp_enqueue_script('tinymce_table_plugin');
    }

	/**
	 * Add Input Field Tab
	 * @author DB-Dzine
	 * @version 1.0.3
	 * @since   1.0.3
	 * @link    http://www.welaunch.io
	 */
	public function product_write_panel_tab() {
		echo '<li class="woocommerce_ultimate_tabs"><a href="#woocommerce_ultimate_tabs"><span>' . __( 'Custom Tabs', 'woocommerce-ultimate-tabs' ) . '</span></a></li>';
	}


	/**
	 * Panel Input Tab Fields
	 * @author DB-Dzine
	 * @version 1.0.3
	 * @since   1.0.3
	 * @link    http://www.welaunch.io
	 */
	public function product_write_panel() {

		global $post;

		$product = wc_get_product($post->ID);

		$tabCustomCount = $this->get_option('tabCustomCount') ? $this->get_option('tabCustomCount') : 8;

		// pull the custom tab data out of the database
		$tab_data = maybe_unserialize( $product->get_meta( 'woocommerce_ultimate_tabs_custom' ) );

		if(isset($tab_data[0])) {
			$tmp = array();
			$ii = 1;
			foreach ($tab_data as $value) {
				$tmp[$ii] = $value;
				$ii++;
			}
			$tab_data = $tmp;
		}

		if(!is_array($tab_data)) {
			$tab_data = array();
		}

		echo '<div id="woocommerce_ultimate_tabs" class="panel wc-metaboxes-wrapper woocommerce_options_panel">';
		for ($i=1; $i <= $tabCustomCount; $i++) { 
			
			if(!isset($tab_data[$i]) || empty($tab_data[$i])) {
				$priority = 20 + ($i * 5);
				$tab_data[$i] = array( 'title' => '', 'content' => '', 'priority' => $priority );
			}
			
			$tab = $tab_data[$i];

			// display the custom tab panel
			echo '<h3 style="padding: 5px 15px;">Tab ' . $i . '</h3>';
			
			woocommerce_wp_text_input( array( 'id' => '_woocommerce_ultimate_tabs_title' . $i . '[' . $post->ID . ']', 'label' => __( 'Tab Title', 'woocommerce-ultimate-tabs' ), 'description' => __( 'Required for tab to be visible', 'woocommerce-ultimate-tabs' ), 'value' => $tab['title'] ) );

			woocommerce_wp_text_input( array( 'id' => '_woocommerce_ultimate_tabs_priority' . $i . '[' . $post->ID . ']', 'label' => __( 'Priority', 'woocommerce-ultimate-tabs' ), 'description' => __( 'Priority of the Tab', 'woocommerce-ultimate-tabs' ), 'value' => $tab['priority'] ) );

			echo '<div class="form-field" style="padding: 10px 20px 20px;">';
				echo '<label for="_woocommerce_ultimate_tabs_content' . $i . '">' . $i . '. '.  __('Tab Content', 'woocommerce-ultimate-tabs') . '</label>';
			   	wp_editor( $tab['content'], '_woocommerce_ultimate_tabs_content' . $i . '_' . $post->ID, array(
			        'wpautop'       => true,
			        'media_buttons' => true,
			        'textarea_name' => '_woocommerce_ultimate_tabs_content' . $i . '[' . $post->ID . ']',
			        'textarea_rows' => 10,
			        'teeny'         => false
			    ) );
		    echo '</div>';
		    echo '<hr>';
		}
		echo '</div>';
	}


	/**
	 * Save Input Fields
	 * @author DB-Dzine
	 * @version 1.0.3
	 * @since   1.0.3
	 * @link    http://www.welaunch.io
	 */
	public function product_save_data( $post_id, $post )
	{
		$tabCustomCount = $this->get_option('tabCustomCount') ? $this->get_option('tabCustomCount') : 8;

		$product = wc_get_product($post_id);

		$tab_data = array();
		for ($i=1; $i <= $tabCustomCount; $i++) { 

			$tab_title = stripslashes( $_POST['_woocommerce_ultimate_tabs_title' . $i ][$post_id] );
			$tab_priority = stripslashes( $_POST['_woocommerce_ultimate_tabs_priority' . $i ][$post_id] );
			$tab_content = stripslashes( $_POST['_woocommerce_ultimate_tabs_content' . $i ][$post_id] );

			if ( empty( $tab_title ) && empty( $tab_content ) && get_post_meta( $post_id, 'woocommerce_ultimate_tabs_custom', true ) ) {
				continue;
			} elseif ( ! empty( $tab_title ) || ! empty( $tab_content ) ) {
				$tab_data[$i] = array( 'title' => $tab_title, 'priority' => $tab_priority, 'id' => 'custom-tab-' . $i, 'content' => $tab_content );
			}
		}

		if(empty($tab_data)) {
			$product->delete_meta_data( 'woocommerce_ultimate_tabs_custom' );
		} else {
			$product->update_meta_data( 'woocommerce_ultimate_tabs_custom', $tab_data );
		}

		$product->save();
	}

	/**
	 * Add variation title backend field
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https:/welaunch.io
	 * @param   [type]             $loop           [description]
	 * @param   [type]             $variation_data [description]
	 * @param   [type]             $variation      [description]
	 */
	public function custom_variation_fields($loop, $variation_data, $variation)
	{
		// pull the custom tab data out of the database
		$tab_data = maybe_unserialize( get_post_meta( $variation->ID, 'woocommerce_ultimate_tabs_custom', true ) );
		$tabCustomCount = $this->get_option('tabCustomCount') ? $this->get_option('tabCustomCount') : 8;

		if(isset($tab_data[0])) {
			$tmp = array();
			$ii = 1;
			foreach ($tab_data as $value) {
				$tmp[$ii] = $value;
				$ii++;
			}
			$tab_data = $tmp;
		}

		if(!is_array($tab_data)) {
			$tab_data = array();
		}

		?>
		<p class="form-field">

		<?php
		for ($i=1; $i <= $tabCustomCount; $i++) { 
			
			if(!isset($tab_data[$i])) {
				
				$priority = 20 + ($i * 5);
				$tab_data[$i] = array( 'title' => '', 'content' => '', 'priority' => $priority );
			}
			
			$tab = $tab_data[$i];

			echo '<label for="_woocommerce_ultimate_tabs_custom_content' . $i . '_' . $variation->ID . '">' . $i . '. '.  __('Tab Content', 'woocommerce-ultimate-tabs') . '</label>';
			echo '<textarea name="_woocommerce_ultimate_tabs_custom_content' . $i . '[' . $variation->ID . ']" id="_woocommerce_ultimate_tabs_custom_content' . $i . '_' . $variation->ID . '" cols="30" rows="10">' . $tab['content'] . '</textarea>';
		   	// wp_editor( $tab['content'], '_woocommerce_ultimate_tabs_custom_content' . $i . '_' . $variation->ID, array(
		    //     'wpautop'       => true,
		    //     'media_buttons' => true,
		    //     'textarea_name' => '_woocommerce_ultimate_tabs_custom_content' . $i . '[' . $variation->ID . ']',
		    //     'textarea_rows' => 10,
		    //     'teeny'         => true
		    // ) );

	    }		
	    ?>

		</p>
		<?php
	}

	/**
	 * Save Variation Data (title)
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https:/welaunch.io
	 * @param   [type]             $variation_id [description]
	 * @param   [type]             $i            [description]
	 * @return  [type]                           [description]
	 */
	public function save_product_variation($variation_id, $i)
	{
		if(empty($variation_id)) {
			return;
		}

		$tabCustomCount = $this->get_option('tabCustomCount') ? $this->get_option('tabCustomCount') : 8;

		$product = wc_get_product($variation_id);
		$tab_data = array();
		for ($i=1; $i <= $tabCustomCount; $i++) { 

			$tab_content = stripslashes( $_POST['_woocommerce_ultimate_tabs_custom_content' . $i ][$variation_id] );
			if(empty($tab_content)) {
				continue;
			}

			$tab_data[$i] = array( 'content' => $tab_content );

		}

		if(empty($tab_data)) {
			$product->delete_meta_data( 'woocommerce_ultimate_tabs_custom' );
		} else {
			$product->update_meta_data( 'woocommerce_ultimate_tabs_custom', $tab_data );
		}

		$product->save();
	}
	
}
