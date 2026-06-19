<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'weLaunch' ) && ! class_exists( 'Redux' ) ) {
        return;
    }

    if( class_exists( 'weLaunch' ) ) {
        $framework = new weLaunch();
    } else {
        $framework = new Redux();
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "woocommerce_ultimate_tabs_options";

    $args = array(
        'opt_name' => 'woocommerce_ultimate_tabs_options',
        'use_cdn' => TRUE,
        'dev_mode' => FALSE,
        'display_name' => __('WooCommerce Ultimate Tabs', 'woocommerce-ultimate-tabs'),
        'display_version' => '1.3.9',
        'page_title' => __('WooCommerce Ultimate Tabs', 'woocommerce-ultimate-tabs'),
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => '&copy; '.date('Y').' weLaunch',
        'admin_bar' => false,
        'menu_type' => 'submenu',
        'menu_title' => 'Ultimate Tabs',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'woocommerce',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => FALSE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    global $weLaunchLicenses;
    if( (isset($weLaunchLicenses['woocommerce-ultimate-tabs']) && !empty($weLaunchLicenses['woocommerce-ultimate-tabs'])) || (isset($weLaunchLicenses['woocommerce-plugin-bundle']) && !empty($weLaunchLicenses['woocommerce-plugin-bundle'])) ) {
        $args['display_name'] = '<span class="dashicons dashicons-yes-alt" style="color: #9CCC65 !important;"></span> ' . $args['display_name'];
    } else {
        $args['display_name'] = '<span class="dashicons dashicons-dismiss" style="color: #EF5350 !important;"></span> ' . $args['display_name'];
    }

    
    $framework::setArgs( $opt_name, $args );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    $framework::setSection( $opt_name, array(
        'title'  => __( 'Ultimate Tabs', 'woocommerce-ultimate-tabs' ),
        'id'     => 'general',
        'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'woocommerce-ultimate-tabs' ),
        'icon'   => 'el el-home',
    ) );

    $globalTabs = array(
        'enabled'  => array(
            'description' => __('Description', 'woocommerce-ultimate-tabs'),
            'additional_information' => __('Additional Information', 'woocommerce-ultimate-tabs'),
            'reviews'     => __('Reviews', 'woocommerce-ultimate-tabs'),
        ),
        'disabled' => array(
        )
    );

    if(class_exists('WordPress_Helpdesk')) {
        $globalTabs['enabled']['wordpress-helpdesk-faq'] = __('TotalDesk FAQs', 'woocommerce-ultimate-tabs');
    }
    

    $framework::setSection( $opt_name, array(
        'title'      => __( 'General', 'woocommerce-ultimate-tabs' ),
        'desc'       => __( 'To get auto updates please <a href="' . admin_url('tools.php?page=welaunch-framework') . '">register your License here</a>.', 'woocommerce-ultimate-tabs' ),
        'id'         => 'general-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable',
                'type'     => 'switch',
                'title'    => __( 'Enable', 'woocommerce-ultimate-tabs' ),
                'subtitle' => __( 'Enable ultimate tabs to use the options below', 'woocommerce-ultimate-tabs' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'tabCount',
                'type' => 'spinner',
                'title' => __('Amount of Global Tabs', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Limit the number of tabs to decrease admin panel load time.', 'woocommerce-ultimate-tabs'), 
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'       => 'tabCustomCount',
                'type' => 'spinner',
                'title' => __('Amount of Custom Tabs', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Limit the number of tabs to decrease admin panel load time.', 'woocommerce-ultimate-tabs'), 
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'      => 'modifyGeneralTabs',
                'type'    => 'sorter',
                'title'   => 'Reorder / Disable the general Tabs',
                'subtitle'    => __('Reorder or even disable the general WooCommerce Tabs', 'woocommerce-ultimate-tabs'),
                'options' => $globalTabs,
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'       => 'variationSupport',
                'type'     => 'switch',
                'title'    => __( 'Enable Variation Support', 'woocommerce-ultimate-tabs' ),
                'subtitle'    => __('This allows you to override custom (not global) tabs on each variation level. Edit a variation product to see tab textarea fields.', 'woocommerce-ultimate-tabs'),
                'default'  => 0,
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'       => 'renameTabs',
                'type'     => 'switch',
                'title'    => __( 'Enable Tab Rename', 'woocommerce-ultimate-tabs' ),
                'default'  => 0,
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'       => 'renameDescriptionTab',
                'type'     => 'text',
                'title'    => __( 'Rename Description Tab', 'woocommerce-ultimate-tabs' ),
                'default'  => 'Description',
                'required' => array('renameTabs','equals','1'),
            ),
            array(
                'id'       => 'renameReviewsTab',
                'type'     => 'text',
                'title'    => __( 'Rename Reviews Tab', 'woocommerce-ultimate-tabs' ),
                'default'  => 'Reviews',
                'required' => array('renameTabs','equals','1'),
            ),
            array(
                'id'       => 'renameAdditionalInformationTab',
                'type'     => 'text',
                'title'    => __( 'Rename Additional Information Tab', 'woocommerce-ultimate-tabs' ),
                'default'  => 'Additional Information',
                'required' => array('renameTabs','equals','1'),
            ),
            array(
                'id'       => 'disableTabs',
                'type'     => 'checkbox',
                'title'    => __( 'Remove Tab-Functionality', 'woocommerce-ultimate-tabs' ),
                'subtitle' => __( 'This only removes the tab fields where you can click. You will see the tabs displayed below each other.', 'woocommerce-ultimate-tabs'),
                'required' => array('enable','equals','1'),
            ),
       )
    ) );

    // Global Tab Styling
    $framework::setSection( $opt_name, array(
        'title'      => __( 'Global Styles', 'woocommerce-ultimate-tabs' ),
        'id'         => 'global-styling',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'globalTabStyling',
                'type'     => 'switch',
                'title'    => __( 'Enable Global Styles', 'woocommerce-ultimate-tabs' ),
            ),
            array(
                'id'     =>'globalTabStylingStyle',
                'type'     => 'select',
                'options'  => array(
                    'horizontal' => __('Horizontal', 'woocommerce-ultimate-tabs' ),
                    'vertical' => __('Vertical', 'woocommerce-ultimate-tabs' ),
                ),
                'title' => __('Tab Style', 'woocommerce-ultimate-tabs'), 
                'required' => array('globalTabStyling','equals','1'),
                'default'   => 'horizontal',
            ),
            
            array(
                'id'   => 'info_normal',
                'type' => 'info',
                'title' => 'Tab Icon Important',
                'style' => 'warning',
                'desc' => __('In order to add an icon to your tabs you have to adjust your theme / woocommerce template. Please go to your-theme/woocommerce/single-product/tabs/tabs.php and change <b>esc_html( $tab[\'title\'] )</b> to <b>$tab[\'title\']</b>!', 'redux-framework-demo'),
                'required' => array('globalTabStyling','equals','1'),
            ),
            array(
                'id'     =>'globalTabIcon',
                'type' => 'media',
                'url'      => true,
                'title' => __('Tab Icon', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Add an Icon to the tabs.', 'woocommerce-ultimate-tabs'),
                'required' => array('globalTabStyling','equals','1'),
            ),
            array(
                'id'     =>'globalTabBackgroundImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Tab Background Image', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Add an Background Image to the tabs.', 'woocommerce-ultimate-tabs'),
                'required' => array('globalTabStyling','equals','1'),
            ),
            array(
                'id'     =>'globalTabBackgroundSize',
                'type'     => 'select',
                'options'  => array(
                    'contain' => __('Contain', 'woocommerce-ultimate-tabs' ),
                    'cover' => __('Cover', 'woocommerce-ultimate-tabs' ),
                ),
                'title' => __('Tab Background Size', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Set the Size for the Background Image.', 'woocommerce-ultimate-tabs'),
                'required' => array('globalTabBackgroundImage','not_empty_and','1'),
                'default'   => 'contain',
            ),
            array(
                'id'     =>'globalTabBackgroundRepeat',
                'type'     => 'select',
                'options'  => array(
                    'repeat' => __('Repeat', 'woocommerce-ultimate-tabs' ),
                    'no-repeat' => __('No Repeat', 'woocommerce-ultimate-tabs' ),
                    'repeat-y' => __('Repeat-Y', 'woocommerce-ultimate-tabs' ),
                    'repeat-x' => __('Repeat-X', 'woocommerce-ultimate-tabs' ),
                ),
                'title' => __('Tab Background Repeat', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Set the Repeat for the Background Image.', 'woocommerce-ultimate-tabs'),
                'required' => array('globalTabBackgroundImage','not_empty_and','1'),
                'default'   => 'repeat',
            ),
            array(
                'id'     =>'globalTabTextColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Tab Text Color', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Add a text color to the tabs.', 'woocommerce-ultimate-tabs'),
                'validate' => 'color',
                'required' => array('globalTabStyling','equals','1'),
            ),
            array(
                'id'     =>'globalTabBackgroundColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Tab Background Color', 'woocommerce-ultimate-tabs'), 
                'subtitle' => __('Add a background color to the tabs.', 'woocommerce-ultimate-tabs'),
                'validate' => 'color',
                'required' => array('globalTabStyling','equals','1'),
            ), 
        )
    ) );

    $options = get_option('woocommerce_ultimate_tabs_options');
    $tabOut = 16;
    if(isset($options['tabCount']) && !empty($options['tabCount'])) {
        $tabOut = $options['tabCount'];
    }
    $tabs = 
    array(
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

    $tabs = array_slice($tabs, 0, $tabOut);
    $defaultPriority = 50;
    foreach($tabs as $key => $tab)
    { 

        $title = __( 1+$key.'. Tab', 'woocommerce-ultimate-tabs' );
        if(!empty($options[$tab . 'TabTitle'])) {
            $title = $options[$tab . 'TabTitle'];
        }

        if(!empty($options[$tab . 'TabInternalName'])) {
            $title = $options[$tab . 'TabInternalName'];
        }

        $defaultPriority = $defaultPriority+10;
        $framework::setSection( $opt_name, array(
            'title'      => $title,
            'id'         => $tab . '-tab',
            'subsection' => true,
            'fields'     => array(
                array(
                    'id'       => $tab . 'TabEnabled',
                    'type'     => 'switch',
                    'title'    => __( 'Enable', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __( 'Enable this tab.', 'woocommerce-ultimate-tabs' ),
                ),
                array(
                    'id'       => $tab . 'TabTitle',
                    'type'     => 'text',
                    'title'    => __( 'Title', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __('Title of the Tab (H2 inside the tab).', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'       => $tab . 'TabHideTitle',
                    'type'     => 'checkbox',
                    'title'    => __( 'Hide title', 'woocommerce-ultimate-tabs' ),
                    'default'  => 0,
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'       => $tab . 'TabName',
                    'type'     => 'text',
                    'title'    => __( 'Tab Name', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __('Name of the Tab itself.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'       => $tab . 'TabInternalName',
                    'type'     => 'text',
                    'title'    => __( 'Internal Name', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __('Name inside plugin setting here.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'       => $tab . 'TabPriority',
                    'type'     => 'text',
                    'title'    => __( 'Priority', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __('Priority of the Tab. General Tabs have the priority as followed:<br/>TAB Position * 10 (e.g. Product Description is on 1, then you have the priority of 10).', 'woocommerce-ultimate-tabs'), 
                    'default'  => $defaultPriority,
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'       => $tab . 'TabCallback',
                    'type'     => 'select',
                    'options'  => array(
                        'editor' => __('Editor', 'woocommerce-ultimate-tabs' ),
                        'contactForm7' => __('Contact 7 Form', 'woocommerce-ultimate-tabs' ),
                        'function' => __('Custom Function', 'woocommerce-ultimate-tabs' ),
                        'products' => __('Show single Products', 'woocommerce-ultimate-tabs' ),
                        'productsByCategory' => __('Show Products by category', 'woocommerce-ultimate-tabs' ),
                        'productCategories' => __('Show Product Categories', 'woocommerce-ultimate-tabs' ),
                        'cart' => __('Show Cart', 'woocommerce-ultimate-tabs' ),
                        // 'checkout' => __('Show Checkout', 'woocommerce-ultimate-tabs' ),
                        'orderTracking' => __('Show Order Tracking', 'woocommerce-ultimate-tabs' ),
                        'myaccount' => __('Show My Account', 'woocommerce-ultimate-tabs' ),
                        'recentProducts' => __('Show Recent Products', 'woocommerce-ultimate-tabs' ),
                        'featuredProducts' => __('Show Featured Products', 'woocommerce-ultimate-tabs' ),
                        'sales' => __('Show Sale Products', 'woocommerce-ultimate-tabs' ),
                        'bestSelling' => __('Show Best Selling Products', 'woocommerce-ultimate-tabs' ),
                        'topRated' => __('Show Top Rated Products', 'woocommerce-ultimate-tabs' ),
                        'relatedProducts' => __('Show Related Products', 'woocommerce-ultimate-tabs' ),
                        //'productAttribute' => __('Show best Selling Products', 'woocommerce-ultimate-tabs' ),
                    ),
                    'title'    => __( 'Callback', 'woocommerce-ultimate-tabs' ),
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                // Callback types
                array(
                    'id'       => $tab . 'TabEditor',
                    'type'     => 'editor',
                    'title'    => __( 'Content Editor', 'woocommerce-ultimate-tabs' ),
                    'required' => array($tab . 'TabCallback','equals','editor'),
                    'args'   => array(
                        'teeny'            => false,
                    )
                ),
                array(
                    'id'     =>$tab . 'TabContactForm7',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array(
                        'post_type' => array('wpcf7_contact_form'), 
                        'posts_per_page' => -1
                    ),
                    'ajax' => true,
                    'title' => __('Contact 7 Forms', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Select the form you want to show.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabCallback','equals','contactForm7'),
                ),
                // Callback types
                array(
                    'id'       => $tab . 'TabFunctionName',
                    'type'     => 'text',
                    'title'    => __( 'Function Name', 'woocommerce-ultimate-tabs' ),
                    'subtitle' => __( 'Best is to create the function in your child theme.', 'woocommerce-ultimate-tabs' ),
                    'required' => array($tab . 'TabCallback','equals','function'),

                ),
                array(
                    'id'     =>$tab . 'TabShowProducts',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array(
                        'post_type' => array('product'), 
                        'posts_per_page' => -1
                    ),
                    'multi' => true,
                    'ajax' => true,
                    'title' => __('Show Products', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Select the products you want to show.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabCallback','equals','products'),
                ),
                array(
                    'id'     =>$tab . 'TabProductsByCategory',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('product_cat')),
                    'ajax' => true,
                    'title' => __('Show Products by category', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Select the category from where the products should be shown.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabCallback','equals','productsByCategory'),
                ),
                array(
                    'id'     =>$tab . 'TabShowCategories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('product_cat')),
                    'multi' => true,
                    'ajax' => true,
                    'title' => __('Show Categories', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Select the products you want to show.', 'woocommerce-ultimate-tabs'), 
                    'required' => array($tab . 'TabCallback','equals','productCategories'),
                ),
                array(
                    'id'     =>$tab . 'TabPerPage',
                    'type' => 'spinner',
                    'title' => __('Amount of products', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Limit the number of products to be shown on e.g. related products callback.', 'woocommerce-ultimate-tabs'), 
                    'default'  => '12',
                    'min'      => '1',
                    'step'     => '1',
                    'max'      => '99',
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'     =>$tab . 'TabColumns',
                    'type' => 'spinner',
                    'title' => __('Columns', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Configure how many columns will be shown on e.g. related products callback.', 'woocommerce-ultimate-tabs'), 
                    'default'  => '3',
                    'min'      => '1',
                    'step'     => '1',
                    'max'      => '99',
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                // END Callback Types
                // Apply For
                array(
                       'id' => $tab . 'applyForSection',
                       'type' => 'section',
                       'title' => __('Apply Tab only for', 'woocommerce-ultimate-tabs'),
                       'subtitle' => __('Only add this tab to specific product categories.', 'woocommerce-ultimate-tabs'),
                       'indent' => true 
                ),
                array(
                    'id'    => $tab . 'TabCategories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('product_cat')),
                    'ajax' => true,
                    'multi' => true,
                    'title' => __('Apply for Product Categories', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Only add this tab to specific product categories.', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'     =>$tab . 'TabProducts',
                    'type' => 'select',
                    // 'options' => $woocommerce_ultimate_tabs_options_products,
                    'data' => 'posts',
                    'args' => array('post_type' => array('product'), 'posts_per_page' => -1),
                    'ajax' => true,

                    'multi' => true,
                    'title' => __('Apply for Products ', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Only add this tab to specific products.', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'     => $tab . 'applyForSectionEnd',
                    'type'   => 'section',
                    'indent' => false,
                ),
                // END APPLY FOR
                // STYLING
                array(
                       'id' => $tab . 'stylingSection',
                       'type' => 'section',
                       'title' => __('Styling', 'woocommerce-ultimate-tabs'),
                       'subtitle' => __('Style this Tab.', 'woocommerce-ultimate-tabs'),
                       'indent' => false,
                ),
                array(
                    'id'       => $tab . 'TabStyling',
                    'type'     => 'switch',
                    'title'    => __( 'Enable Styling', 'woocommerce-ultimate-tabs' ),
                    'required' => array($tab . 'TabEnabled', 'equals', '1'),
                ),
                array(
                    'id'   => $tab . 'info_normal',
                    'type' => 'info',
                    'title' => 'Tab Icon Important',
                    'style' => 'warning',
                    'desc' => __('In order to add an icon to your tabs you have to adjust your theme / woocommerce template. Please go to your-theme/woocommerce/single-product/tabs/tabs.php and change <b>esc_html( $tab[\'title\'] )</b> to <b>$tab[\'title\']</b>!', 'redux-framework-demo'),
                    'required' => array($tab . 'TabStyling','equals','1'),
                ),
                array(
                    'id'     =>$tab . 'TabIcon',
                    'type' => 'media',
                    'url'      => true,
                    'title' => __('Tab Icon', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Add an Icon to this tab. <b>Important', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabStyling','equals','1'),
                ),
                array(
                    'id'     =>$tab . 'TabBackgroundImage',
                    'type' => 'media',
                    'url'      => true,
                    'title' => __('Tab Background', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Add an Background to this tab.', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabStyling','equals','1'),
                ),
                array(
                    'id'     =>$tab . 'TabBackgroundSize',
                    'type'     => 'select',
                    'options'  => array(
                        'contain' => __('Contain', 'woocommerce-ultimate-tabs' ),
                        'cover' => __('Cover', 'woocommerce-ultimate-tabs' ),
                    ),
                    'title' => __('Tab Background Size', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Set the Size for the Background Image.', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabBackgroundImage','not_empty_and','1'),
                    'default'   => 'contain',
                ),
                array(
                    'id'     =>$tab . 'TabBackgroundRepeat',
                    'type'     => 'select',
                    'options'  => array(
                        'repeat' => __('Repeat', 'woocommerce-ultimate-tabs' ),
                        'no-repeat' => __('No Repeat', 'woocommerce-ultimate-tabs' ),
                        'repeat-y' => __('Repeat-Y', 'woocommerce-ultimate-tabs' ),
                        'repeat-x' => __('Repeat-X', 'woocommerce-ultimate-tabs' ),
                    ),
                    'title' => __('Tab Background Repeat', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Set the Repeat for the Background Image.', 'woocommerce-ultimate-tabs'),
                    'required' => array($tab . 'TabBackgroundImage','not_empty_and','1'),
                    'default'   => 'repeat',
                ),
                array(
                    'id'     =>$tab . 'TabTextColor',
                    'type' => 'color',
                    'url'      => true,
                    'title' => __('Tab Text Color', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Add a text color to this tab.', 'woocommerce-ultimate-tabs'),
                    'validate' => 'color',
                    'required' => array($tab . 'TabStyling','equals','1'),
                ),
                array(
                    'id'     =>$tab . 'TabBackgroundColor',
                    'type' => 'color',
                    'url'      => true,
                    'title' => __('Tab Background Color', 'woocommerce-ultimate-tabs'), 
                    'subtitle' => __('Add a background color to this tab.', 'woocommerce-ultimate-tabs'),
                    'validate' => 'color',
                    'required' => array($tab . 'TabStyling','equals','1'),
                ), 
                array(
                    'id'     => $tab . 'stylingSectionEnd',
                    'type'   => 'section',
                    'indent' => false,
                ),
           )
        ) );
    }

    /*
     * <--- END SECTIONS
     */
