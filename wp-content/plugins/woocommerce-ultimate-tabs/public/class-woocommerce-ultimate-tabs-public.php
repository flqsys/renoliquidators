<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.welaunch.io
 * @since      1.0.0
 *
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooCommerce_Ultimate_Tabs
 * @subpackage WooCommerce_Ultimate_Tabs/public
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class WooCommerce_Ultimate_Tabs_Public extends WooCommerce_Ultimate_Tabs {

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
	 * options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options
	 */
	protected $options;

	/**
	 * Current tab
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string
	 */
	protected $current_tab;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Sets the current tab
	 *
	 * @param    string    $tab      Name Of the tab
	 * @since    1.0.0
	 */
    private function set_current_tab($tab)
    {
    	$this->current_tab = $tab;
    }

	/**
	 * Gets the current tab
	 *
	 * @param    string    $tab      Name Of the tab
	 * @since    1.0.0
	 */
    private function get_current_tab()
    {
    	return $this->current_tab;
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() 
	{
		global $woocommerce_ultimate_tabs_options;
		$this->options = $woocommerce_ultimate_tabs_options;

		if(!$this->get_option('variationSupport')) {
			return false;
		}

		wp_enqueue_script( $this->plugin_name.'-public', plugin_dir_url( __FILE__ ) . 'js/woocommerce-ultimate-tabs-public.js', array( 'jquery' ), $this->version, false );

		$forJS = array(
			'ajax_url' => admin_url('admin-ajax.php'),
		);
        wp_localize_script($this->plugin_name . '-public', 'woocommerce_ultimate_tabs_options', $forJS);

	}

	/**
	 * Inits the Ultimate Tabs
	 *
	 * @since    1.0.0
	 */
    public function init()
    {
		global $woocommerce_ultimate_tabs_options;

		$this->options = $woocommerce_ultimate_tabs_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		add_filter( 'woocommerce_product_tabs', array($this, 'woocommerce_ultimate_tabs' ));
		
		add_action( 'wp_ajax_nopriv_woocommerce_ultimate_tabs_get_variation_tabs', array($this, 'get_variation_tab') );
        add_action( 'wp_ajax_woocommerce_ultimate_tabs_get_variation_tabs', array($this, 'get_variation_tab') );
		
    }

    public function get_variation_tab()
    {
		$response = array(
			'status' => false,
			'tabs' => array()
		);

		if(!isset($_POST['variation_id']) || empty($_POST['variation_id'])) {
			echo json_encode($response);
			die();
		}

		$product = wc_get_product($_POST['variation_id']);
		if(!$product) {
			echo json_encode($response);
			die();
		}

		$tabs = $product->get_meta( 'woocommerce_ultimate_tabs_custom' );

		if(!empty($tabs)) {
			$response['status'] = true;
			$response['tabs'] = $tabs; 
		}

		echo json_encode($response);
		die();
    }

	/**
	 * Filter function for woocommerce_product_tabs 
	 *
	 * @param    array    $tabs      All Tabs
	 * @since    1.0.0
	 */
    public function woocommerce_ultimate_tabs($tabs)
    {
    	global $product;

    	// Reorder / Disable general WooCommerce Tabs
		if($this->get_option('modifyGeneralTabs'))
		{
			$disabledTabs = $this->get_option('modifyGeneralTabs');
			$disabledTabs = $disabledTabs['disabled'];
			foreach ($disabledTabs as $key => $value) {
				unset( $tabs[$key] );
			}

			$reorderTabs = $this->get_option('modifyGeneralTabs');
			$reorderTabs = $reorderTabs['enabled'];

			$descriptionTabPosition = array_search("description", array_keys($reorderTabs))*10;
			$reviewsTabPosition = array_search("reviews", array_keys($reorderTabs))*10;
			$additionalInformationTabposition = array_search("additional_information", array_keys($reorderTabs))*10;

			if(isset($tabs['description']))
			{
				$tabs['description']['priority'] = $descriptionTabPosition;
			}
			if(isset($tabs['reviews']))
			{
				$tabs['reviews']['priority'] = $reviewsTabPosition;
			}
			if(isset($tabs['additional_information']) && is_object( $product ) )
			{
				if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
					$tabs['additional_information']['priority'] = $additionalInformationTabposition;
				}
			}
		}

		// Rename Tabs
		if($this->get_option('renameTabs'))
		{
			if($this->get_option('renameDescriptionTab') && isset($tabs['description']))
			{
				$tabs['description']['title'] = $this->get_option('renameDescriptionTab');
			}
			if($this->get_option('renameReviewsTab') && isset($tabs['reviews']))
			{
				$tabs['reviews']['title'] = $this->get_option('renameReviewsTab');
			}
			if($this->get_option('renameAdditionalInformationTab') && isset($tabs['additional_information']) && is_object( $product ))
			{
				if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
					$tabs['additional_information']['title'] = $this->get_option('renameAdditionalInformationTab');
				}
			}
		}

		$globalIcon = $this->get_option('globalTabIcon');
		if(!empty($globalIcon['url'])){
			$img = '<img src="'.$globalIcon['url'].'" class="ultimate-tab-icon">';

			if(!empty($tabs['description']['title'])) {
				$tabs['description']['title'] = $img.$tabs['description']['title'] ;
			}

			if(!empty($tabs['reviews']['title'])) {
				$tabs['reviews']['title'] = $img.$tabs['reviews']['title'] ;
			}

			if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
				$tabs['additional_information']['title'] = $img.$tabs['additional_information']['title'] ;
			}
		}

		$css = "";
		// Global Styling
		if($this->get_option('globalTabStyling')) {
			$backgroundImage = $this->get_option('globalTabBackgroundImage');
			$backgroundSize = $this->get_option('globalTabBackgroundSize');
			$backgroundRepeat = $this->get_option('globalTabBackgroundRepeat');
			$textColor = $this->get_option('globalTabTextColor');
			$backgroundColor = $this->get_option('globalTabBackgroundColor');

			$css .= "
			.woocommerce-tabs ul.tabs > li {
				color: ".$textColor." !important;
				background-color: ".$backgroundColor." !important;
				background-image: url('".$backgroundImage['url']."');
				background-size: ".$backgroundSize.";
				background-repeat: ".$backgroundRepeat.";
			}
			.woocommerce-tabs ul.tabs li.active a,
			.woocommerce-tabs ul.tabs li a {
				color: ".$textColor." !important;
			}
			
			.woocommerce-product-gallery {
				opacity: 1 !important;
			}
			";

			if($this->get_option('globalTabStylingStyle') == "vertical") {

				$css .= '
				.woocommerce-tabs ul.tabs {
					width: 20%;
					float: left;
					height: 100% !important;
				}

				.woocommerce-tabs ul.tabs > li {
					width: 100%;
					display: block;
				}

				.woocommerce-tabs .wc-tab {
					width: 80%;
					padding: 0 20px;
					float: left;
				}
				.woocommerce-tabs:after {
				    content: "";
				    display: table;
				    clear: both;
				}

				@media(max-width:768px) {
					.woocommerce-tabs ul.tabs, .woocommerce-tabs .wc-tab {
						width: 100%;
						float: none;
					}
				}
				';
			}
		}

		// Loop through custom Tabs
		$customTabs = array(
            'first', 
            'second', 
            'third', 
            'fourth', 
            'fifth', 
            'sixth', 
            'seventh', 
            'eight', 
            'ninth', 
            
            'tenth', 
            'eleventh', 
            'twelfth', 
            'thirteenth', 
            'fourteenth', 
            'fifteenth', 
            'sixteen',
            'seventeen',
            'eighteen',
            'nineteen',

            'twenty',
            'twentyone',
            'twentytwo',
            'twentythree',
            'twentyfour',
            'twentyfive',
            'twentysix',
            'twentyseven',
            'twentyeight',
            'twentynine',

            'thirty',
            'thirtyone',
            'thirtytwo',
            'thirtythree',
            'thirtyfour',
            'thirtyfive',
            'thirtysix',
            'thirtyseven',
            'thirtyeight',
            'thirtynine',
            'forty',
		);

	    foreach($customTabs as $key => $tab)
	    {
			if($this->get_option($tab.'TabEnabled'))
			{
				global $currentTab;
				$currentTab = $tab.'Tab';
				$this->set_current_tab($tab.'Tab');

				$tabData = $this->create_new_tab($tab.'Tab');
				if(!$tabData) {
					continue;
				}

				$tabs[$tab.'_tab'] = $tabData;

				if($this->get_option($tab.'TabStyling'))
				{
					$icon = $this->get_option($tab.'TabIcon');
					$backgroundImage = $this->get_option($tab.'TabBackgroundImage');
					$backgroundSize = $this->get_option($tab.'TabBackgroundSize');
					$backgroundRepeat = $this->get_option($tab.'TabBackgroundRepeat');
					$textColor = $this->get_option($tab.'TabTextColor');
					$backgroundColor = $this->get_option($tab.'TabBackgroundColor');



					$css .= "
					.woocommerce-tabs ul.tabs > li.".$tab."_tab_tab {
						color: ".$textColor." !important;
						background-color: ".$backgroundColor." !important;";

					if(!empty($backgroundImage['url'])){
						$css .= "background-image: url('".$backgroundImage['url']."');";
					} else {
						$css .= "background-image: none;";
					}

					$css .= "	
						background-size: ".$backgroundSize.";
						background-repeat: ".$backgroundRepeat.";
					}
					.woocommerce-tabs ul.tabs li.".$tab."_tab_tab.active a,
					.woocommerce-tabs ul.tabs li.".$tab."_tab_tab a {
						color: ".$textColor." !important;
					}
					";
				}

				if($this->get_option($tab.'TabCategories'))
				{
					$categories = $this->get_option($tab.'TabCategories');
					$terms = get_the_terms( $product->get_id(), 'product_cat' );
					
					$inProductCategory = false;
					if($terms)
					{
						foreach ($terms as $term)
						{
							if(in_array($term->term_id, $categories))
							{
								$inProductCategory = true;
							}
						}
					}

					if(!$inProductCategory)
					{
						unset($tabs[$tab.'_tab']);
					}
				}

				if($this->get_option($tab.'TabProducts'))
				{		
					$products = $this->get_option($tab.'TabProducts');

					$inProducts = false;
					if(in_array($product->get_id(), $products))
					{
						$inProducts = true;
					}

					
					if(!$inProducts)
					{
						unset($tabs[$tab.'_tab']);
					}
				}
			}
		}

		if($this->get_option('disableTabs'))
		{
			wp_dequeue_script( 'wc-single-product' );
			$css .= "
			.woocommerce-tabs ul.tabs {
				display: none !important;
			}
			.tab-panels .panel:not(.active), .tab-panels .panel,
			.woocommerce-tabs .wc-tab, .woocommerce-Tabs-panel {
				display: block !important;
				visibility: visible !important;
				height: auto !important;
				opacity: 1 !important;
			}";
		}

		// Write CSS
		echo '<style>' . $css . '</style>';


		if ( $this->product_has_custom_tab( $product ) ) {
			$custom_tabs = $product->custom_tabs;

			foreach ($custom_tabs as $custom_tab) {

				if(empty($custom_tab) || !isset($custom_tab['title']) || empty($custom_tab['title'])) {
					continue;
				}

				$tab_title = $custom_tab['title'];
				$tab_priority = intval($custom_tab['priority']);
				$tab_content = $custom_tab['content'];

				$tabs[ $custom_tab['id'] ] = array(
					'title'    => $tab_title,
					'priority' => $tab_priority,
					'callback' => array( $this, 'custom_tab_callback' ),
					'content'  => $tab_content,  // custom field
				);
			}
		}
		return $tabs;
    }

    /**
     * Check if custom Tab exists
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://www.welaunch.io
     * @param   [type]                         $product [description]
     * @return  [type]                                  [description]
     */
	private function product_has_custom_tab( $product ) {
		if ( empty($product->custom_tabs) ) {
			$product->custom_tabs = maybe_unserialize( get_post_meta( $product->get_id(), 'woocommerce_ultimate_tabs_custom', true ) );
		}
		// tab must at least have a title to exist
		return ! empty( $product->custom_tabs );
	}

	/**
	 * Create a new tab and return it
	 *
	 * @return $tab
	 * @since    1.0.0
	 */
	public function create_new_tab()
	{
		$currentTab = $this->get_current_tab();

		$tabName = $this->get_option($currentTab.'Name'); 
		if(empty($tabName)) {
			$tabName = $this->get_option($currentTab.'Title'); 
		}

		if(empty($tabName)) {
			return false;
		}

		$priority = $this->get_option($currentTab.'Priority');
		$callback = $this->get_option($currentTab.'Callback');

		$globalIcon = $this->get_option('globalTabIcon');
		$icon = $this->get_option($currentTab.'Icon');
		if(!empty($icon['url'])){
			$img = '<img src="'.$icon['url'].'" class="ultimate-tab-icon">';
			$tabName = $img . $tabName;
		} elseif(!empty($globalIcon['url'])){
			$img = '<img src="'.$globalIcon['url'].'" class="ultimate-tab-icon">';
			$tabName = $img . $tabName;
		}

		$tab = array(
			'title' 	=> $tabName,
			'priority' 	=> $priority,
			'callback' 	=> array($this, 'custom_tab_callback_'.$currentTab)
		);

		return $tab;
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_firstTab() {
		$callBackType = $this->get_option('firstTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('firstTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'firstTab');	
		}

		
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_secondTab() {
		$callBackType = $this->get_option('secondTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('secondTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'secondTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirdTab() {
		$callBackType = $this->get_option('thirdTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirdTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirdTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_fourthTab() {
		$callBackType = $this->get_option('fourthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('fourthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'fourthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_fifthTab() {
		$callBackType = $this->get_option('fifthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('fifthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'fifthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_sixthTab() {
		$callBackType = $this->get_option('sixthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('sixthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'sixthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_seventhTab() {
		$callBackType = $this->get_option('seventhTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('seventhTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'seventhTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_eightTab() {
		$callBackType = $this->get_option('eightTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('eightTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'eightTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_ninthTab() {
		$callBackType = $this->get_option('ninthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('ninthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'ninthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_tenthTab() {
		$callBackType = $this->get_option('tenthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('tenthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'tenthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_eleventhTab() {
		$callBackType = $this->get_option('eleventhTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('eleventhTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'eleventhTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twelfthTab() {
		$callBackType = $this->get_option('twelfthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twelfthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twelfthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirteenthTab() {
		$callBackType = $this->get_option('thirteenthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirteenthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirteenthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_fourteenthTab() {
		$callBackType = $this->get_option('fourteenthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('fourteenthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'fourteenthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_fifteenthTab() {
		$callBackType = $this->get_option('fifteenthTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('fifteenthTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'fifteenthTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_sixteenTab() {
		$callBackType = $this->get_option('sixteenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('sixteenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'sixteenTab');
		}
	}

	/**
	 * Callback-Function for first Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_seventeenTab() {
		$callBackType = $this->get_option('seventeenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('seventeenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'seventeenTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_eighteenTab() {
		$callBackType = $this->get_option('eighteenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('eighteenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'eighteenTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_nineteenTab() {
		$callBackType = $this->get_option('nineteenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('nineteenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'nineteenTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentyTab() {
		$callBackType = $this->get_option('twentyTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentyTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentyTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentyoneTab() {
		$callBackType = $this->get_option('twentyoneTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentyoneTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentyoneTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentytwoTab() {
		$callBackType = $this->get_option('twentytwoTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentytwoTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentytwoTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentythreeTab() {
		$callBackType = $this->get_option('twentythreeTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentythreeTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentythreeTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentyfourTab() {
		$callBackType = $this->get_option('twentyfourTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentyfourTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentyfourTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentyfiveTab() {
		$callBackType = $this->get_option('twentyfiveTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentyfiveTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentyfiveTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentysixTab() {
		$callBackType = $this->get_option('twentysixTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentysixTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentysixTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentysevenTab() {
		$callBackType = $this->get_option('twentysevenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentysevenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentysevenTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentyeightTab() {
		$callBackType = $this->get_option('twentyeightTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentyeightTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentyeightTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_twentynineTab() {
		$callBackType = $this->get_option('twentynineTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('twentynineTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'twentynineTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtyTab() {
		$callBackType = $this->get_option('thirtyTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtyTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtyTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtyoneTab() {
		$callBackType = $this->get_option('thirtyoneTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtyoneTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtyoneTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtytwoTab() {
		$callBackType = $this->get_option('thirtytwoTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtytwoTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtytwoTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtythreeTab() {
		$callBackType = $this->get_option('thirtythreeTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtythreeTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtythreeTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtyfourTab() {
		$callBackType = $this->get_option('thirtyfourTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtyfourTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtyfourTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtyfiveTab() {
		$callBackType = $this->get_option('thirtyfiveTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtyfiveTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtyfiveTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtysixTab() {
		$callBackType = $this->get_option('thirtysixTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtysixTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtysixTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtysevenTab() {
		$callBackType = $this->get_option('thirtysevenTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtysevenTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtysevenTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtyeightTab() {
		$callBackType = $this->get_option('thirtyeightTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtyeightTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtyeightTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_thirtynineTab() {
		$callBackType = $this->get_option('thirtynineTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('thirtynineTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'thirtynineTab');
		}
	}

	/**
	 * Callback-Function for X Tab
	 *
	 * @since    1.0.0
	 */
	public function custom_tab_callback_fortyTab() {
		$callBackType = $this->get_option('fortyTabCallback');
		if($callBackType == "function") {
			$function = $this->get_option('fortyTabFunctionName');
			if(function_exists($function)) {
				$function();
			}
		} else {
			$this->do_callback($callBackType, 'fortyTab');
		}
	}


	/**
	 * Function that fires for each callback of the tab
	 *
	 * @param      string    $callBackType       	The Callback Type
	 * @param      string    $tab       			The name of the Tab.
	 * @since    1.0.0
	 */
	public function do_callback($callBackType, $tab)
	{
		$perPage = $this->get_option($tab.'PerPage');
		$columns = $this->get_option($tab.'Columns');

		if(!$this->get_option($tab.'HideTitle')) {
			echo '<h2>' . $this->get_option($tab.'Title') . '</h2>';
		}

		// Contact Form 7
		if($callBackType == "contactForm7") {
			$contactFormId = $this->get_option($tab.'ContactForm7');
			echo do_shortcode('[contact-form-7 id="'.$contactFormId.'" ]');

		// Products
		}  elseif($callBackType == "products") {
			$products = implode(',', $this->get_option($tab.'ShowProducts'));
			echo do_shortcode('[products ids="'.$products.'" columns="'.$columns.'"]');

		// productsByCategory
		} elseif($callBackType == "productsByCategory") {
			$category = $this->get_option($tab.'ProductsByCategory');
			$term = get_term_by( 'id', $category, 'product_cat', 'ARRAY_A' );
			echo do_shortcode('[product_category category="'.$term['slug'].'" columns="'.$columns.'"]');

		// productCategories
		} elseif($callBackType == "productCategories") {
			$categories = implode(',', $this->get_option($tab.'ShowCategories'));
			echo do_shortcode('[product_categories ids="'.$categories.'" number="'.$perPage.'" columns="'.$columns.'"]');

		// cart
		} elseif($callBackType == "cart") {
			echo do_shortcode('[woocommerce_cart]');

		// checkout
		} elseif($callBackType == "checkout") {
			echo do_shortcode('[woocommerce_checkout]');

		// orderTracking
		} elseif($callBackType == "orderTracking") {
			echo do_shortcode('[woocommerce_order_tracking]');

		// myaccount
		} elseif($callBackType == "myaccount") {
			echo do_shortcode('[woocommerce_my_account]');

		// recentProducts
		} elseif($callBackType == "recentProducts") {
			echo do_shortcode('[recent_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// featuredProducts
		} elseif($callBackType == "featuredProducts") {
			echo do_shortcode('[featured_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// sales
		} elseif($callBackType == "sales") {
			echo do_shortcode('[sale_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// bestSelling
		} elseif($callBackType == "bestSelling") {
			echo do_shortcode('[best_selling_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// topRated
		} elseif($callBackType == "topRated") {
			echo do_shortcode('[top_rated_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// relatedProducts
		} elseif($callBackType == "relatedProducts") {
			echo do_shortcode('[related_products per_page="'.$perPage.'" columns="'.$columns.'"]');

		// editor
		} elseif($callBackType == "editor") {
			$currentTabEditor = $this->get_option($tab.'Editor');
			echo do_shortcode( wpautop( $currentTabEditor) );
		}

		return TRUE;
	}

	public function custom_tab_callback( $key, $tab ) {

		// allow shortcodes to function
		$content = $tab['content'];
		$content = str_replace( ']]>', ']]&gt;', $content );

		echo '<h2>' . $tab['title'] . '</h2>';
		echo do_shortcode( wpautop($content) );
	}

}