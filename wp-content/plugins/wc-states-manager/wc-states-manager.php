<?php
/**
 * Plugin Name: States Manager for WooCommerce
 * Description: A plugin to manage states/regions for multiple countries in WooCommerce checkout and shipping options.
 * Version: 1.0.1
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Muhammad Usman Ramzan
 * Author URI: https://gravatar.com/usmanramzanpk
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-states-manager
 * Domain Path: /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 9.4.1
 *
 * @package StatesManagerForWooCommerce
 *
 * States Manager For WooCommerce is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WCSTATES_VERSION', '1.0.1');
define('WCSTATES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WCSTATES_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WCSTATES_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Check if WooCommerce is active
 *
 * @return boolean
 */
function wcstates_check_woocommerce_active()
{
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        add_action('admin_notices', 'wcstates_woocommerce_missing_notice');
        return false;
    }
    return true;
}

// Declare HPOS compatibility
add_action('before_woocommerce_init', function() {
    if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, true);
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('remote_logging', __FILE__, true);
    }
});

/**
 * Display admin notice if WooCommerce is not active
 */
function wcstates_woocommerce_missing_notice()
{
    ?>
    <div class="error">
        <p><?php esc_html_e('WooCommerce States Manager requires WooCommerce to be installed and active.', 'wc-states-manager'); ?>
        </p>
    </div>
    <?php
}

/**
 * Initialize the plugin
 */
function wcstates_init()
{
    // Load text domain for translations
    load_plugin_textdomain('wc-states-manager', false, dirname(WCSTATES_PLUGIN_BASENAME) . '/languages');

    if (!wcstates_check_woocommerce_active()) {
        return;
    }

    // Initialize logger
    $logger = wc_get_logger();

    if (is_admin()) {
        add_action('admin_menu', 'wcstates_settings_admin_submenu');
        add_action('admin_enqueue_scripts', 'wcstates_admin_scripts');
        add_filter('plugin_action_links_' . WCSTATES_PLUGIN_BASENAME, 'wcstates_add_settings_link');
    }

    // Register frontend filters
     add_action('init', function() use ($logger) {
        if (!is_admin()) {
            add_filter('woocommerce_states', function($states) use ($logger) {
                try {
                    return wcstates_filter_states($states);
                } catch (Exception $e) {
                    $logger->error(
                        'States filtering error: ' . $e->getMessage(),
                        array('source' => 'wc-states-manager')
                    );
                    return $states;
                }
            });
        }
    });
}
add_action('plugins_loaded', 'wcstates_init');

/**
 * Add settings link on plugin page
 *
 * @param array $links Array of plugin action links
 * @return array Modified array of plugin action links
 */
function wcstates_add_settings_link($links) {
    $settings_link = sprintf(
        '<a href="%s">%s</a>',
        admin_url('admin.php?page=wcstates-settings'),
        __('Settings', 'wc-states-manager')
    );
    
    // Add settings link to beginning of the array
    array_unshift($links, $settings_link);
    
    return $links;
}
add_filter('plugin_action_links_' . WCSTATES_PLUGIN_BASENAME, 'wcstates_add_settings_link');

/**
 * Add submenu page to WooCommerce settings
 */
function wcstates_settings_admin_submenu()
{
    $menu_title = __('Edit States/Regions', 'wc-states-manager');
    add_submenu_page(
        'woocommerce',
        $menu_title,
        $menu_title,
        'manage_woocommerce',
        'wcstates-settings',
        'wcstates_setting_page'
    );
}

/**
 * Enqueue admin scripts and styles
 *
 * @param string $hook Current admin page hook
 */
function wcstates_admin_scripts($hook)
{
    if ('woocommerce_page_wcstates-settings' !== $hook) {
        return;
    }

    // Enqueue admin JavaScript
    wp_enqueue_script(
        'wcstates-admin',
        WCSTATES_PLUGIN_URL . 'assets/js/admin.js',
        array(),
        WCSTATES_VERSION,
        true
    );

    // Enqueue admin CSS
    wp_enqueue_style(
        'wcstates-admin-styles',
        WCSTATES_PLUGIN_URL . 'assets/css/admin.css',
        array(),
        WCSTATES_VERSION
    );

    wp_localize_script('wcstates-admin', 'wcstatesAdmin', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wcstates-admin-nonce'),
        'i18n' => array(
            'searchPlaceholder' => __('Search country and states...', 'wc-states-manager'),
            'selectedStates' => __('Selected states:', 'wc-states-manager'),
            'confirmEmpty' => __('You haven\'t selected any states. Are you sure you want to continue?', 'wc-states-manager')
        )
    ));
}

/**
 * Creates an admin notice HTML
 *
 * @param string $message The message to display
 * @param string $type The notice type (success, error, warning, info)
 * @param bool $dismissible Whether the notice should be dismissible
 * @return string The formatted admin notice HTML
 */
function wcstates_admin_notice($message, $type = 'success', $dismissible = true) {
    $allowed_types = array(
        'success' => 'updated',
        'error' => 'error',
        'warning' => 'update-nag',
        'info' => 'notice notice-info'
    );
    
    // Ensure valid notice type or fallback to success
    $notice_type = isset($allowed_types[$type]) ? $allowed_types[$type] : $allowed_types['success'];
    
    // Add dismissible class if needed
    $classes = array($notice_type);
    if ($dismissible) {
        $classes[] = 'is-dismissible';
    }
    
    return sprintf(
        '<div class="%1$s"><p>%2$s</p></div>',
        esc_attr(implode(' ', $classes)),
        esc_html($message)
    );
}

/**
 * Get all countries that have states
 *
 * @return array
 */
function wcstates_get_countries_with_states()
{
    $wc_countries = new WC_Countries();
    $all_states = $wc_countries->get_states();

    foreach ($all_states as $country_code => $states) {
        if (!empty($states)) {
            $countries[$country_code] = $wc_countries->get_countries()[$country_code];
        }
    }

    return $countries;
}

/**
 * Handle form submission and sanitize input data
 *
 * @param array $post_data Raw POST data
 * @return array Sanitized states data
 */
function wcstates_sanitize_states_input($post_data) {
    $sanitized_states = array();

    if (!empty($post_data['enabled_states']) && is_array($post_data['enabled_states'])) {
        foreach ($post_data['enabled_states'] as $state_key) {
            
            // Unslash and sanitize each state key
            $state_key = sanitize_text_field(wp_unslash($state_key));
            
            // Validate state key format (country_code_state_code)
            if (preg_match('/^[A-Z]{2}_[A-Z0-9-]{1,}$/i', $state_key)) {
                $sanitized_states[] = $state_key;
            }
        }
    }
    
    return $sanitized_states;
}

/**
 * Process states data into storage format
 *
 * @param array $sanitized_states Array of sanitized state keys
 * @return array Processed states data for storage
 */
function wcstates_process_states_data($sanitized_states) {
    $new_states = array();
    $new_update_states = array();
    
    // Get WC_Countries instance
    $wc_countries = new WC_Countries();
    $countries = wcstates_get_countries_with_states();
    
    // First, set all states as disabled by default
    foreach ($countries as $country_code => $country_name) {
        $country_states = $wc_countries->get_states($country_code);
        if (!empty($country_states)) {
            foreach ($country_states as $state_code => $state_name) {
                $new_states[$country_code][$state_code] = '0';
            }
        }
    }
    
    // Then enable only the valid checked states
    foreach ($sanitized_states as $state_key) {
        list($country_code, $state_code) = explode('_', $state_key, 2);
        if (isset($new_states[$country_code][$state_code])) {
            $new_update_states[$country_code][$state_code] = '1';
        }
    }
    
    return $new_update_states;
}

/**
 * Render the settings page
 */
function wcstates_setting_page()
{
    // Security check
    if (!current_user_can('manage_woocommerce')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'wc-states-manager'));
    }

    $wc_countries = new WC_Countries();
    $countries = wcstates_get_countries_with_states();
    $message = '';

    // Handle form submission
    if (isset($_POST['submit_states']) && check_admin_referer('wcstates_update_settings')) {
        // Sanitize and validate the input data
        $sanitized_states = wcstates_sanitize_states_input($_POST);
        
        // Process the sanitized data
        $new_update_states = wcstates_process_states_data($sanitized_states);
                
        // Update the option in database
        update_option('wcstates_allowed_states', $new_update_states);
        
        // Show success message
        $message = wcstates_admin_notice(
            __('Settings saved successfully!', 'wc-states-manager'),
            'success',
            true
        );
    }

    // Get current settings
    $allowed_states = get_option('wcstates_allowed_states', array());

    // Output settings page HTML
    ?>
    <div class="wrap">
        <?php echo wp_kses_post($message); ?>

        <form method="post" class="states-manager" id="statesManagerForm">
            <?php wp_nonce_field('wcstates_update_settings'); ?>
            <h1><?php esc_html_e('States/Regions Manager Settings', 'wc-states-manager'); ?></h1>
            <p><?php esc_html_e('Select the states/regions you want to allow for shipping and billing in WooCommerce.', 'wc-states-manager'); ?></p>

            <?php 
            foreach ($countries as $country_code => $country_name):
                $states = $wc_countries->get_states($country_code);
                if (empty($states)) continue;
            ?>
                <div class="country-section" id="country-<?php echo esc_attr($country_code); ?>">
                    <h2><?php echo esc_html($country_name); ?></h2>
                    <div class="country-controls">
                        <button type="button" class="button toggle-country" data-select="all" 
                                data-country="<?php echo esc_attr($country_code); ?>">
                            <?php esc_html_e('Select All', 'wc-states-manager'); ?>
                        </button>
                        <button type="button" class="button toggle-country" data-select="none" 
                                data-country="<?php echo esc_attr($country_code); ?>">
                            <?php esc_html_e('Deselect All', 'wc-states-manager'); ?>
                        </button>
                    </div>
                    <ul class="states-list">
                        <?php 
                        foreach ($states as $state_code => $state_name):
                            $state_key = $country_code . '_' . $state_code;
                            $checked = isset($allowed_states[$country_code][$state_code]) && 
                                     $allowed_states[$country_code][$state_code] === '1' ? 
                                     ' checked="checked"' : '';
                        ?>
                            <li>
                                <label>
                                    <input type="checkbox" 
                                           name="enabled_states[]" 
                                           value="<?php echo esc_attr($state_key); ?>"
                                           <?php echo wp_kses_post($checked); ?>
                                           class="state-checkbox" 
                                           data-country="<?php echo esc_attr($country_code); ?>">
                                    <?php echo esc_html($state_name); ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="<?php esc_html_e('Save Changes', 'wc-states-manager'); ?>" 
                   name="submit_states" class="button button-primary">
        </form>
    </div>
    <?php
}

/**
 * Filter WooCommerce states based on settings
 *
 * @param array $states Array of states
 * @return array Modified array of states
 */
function wcstates_filter_states($states)
{
    try {
        $allowed_states = get_option('wcstates_allowed_states', array());
        
        if (!empty($allowed_states) && is_array($allowed_states)) {
            
            foreach ($allowed_states as $country_code => $country_states) {
                if (isset($states[$country_code]) && is_array($states[$country_code])) {
                    foreach ($states[$country_code] as $state_code => $state_name) {
                        // Remove state if it's explicitly disabled or not set
                        if (!isset($country_states[$state_code]) || $country_states[$state_code] !== '1') {
                            unset($states[$country_code][$state_code]);
                        }
                    }
                }
            }
        }
    
        return $states;
    } catch (Exception $e) {
        if (function_exists('wc_get_logger')) {
            wc_get_logger()->error(
                'Error filtering states: ' . $e->getMessage(),
                array('source' => 'wc-states-manager')
            );
        }
        return $states;
    }
}

function wcstates_register_filters() {
    if (!is_admin()) {
        add_filter('woocommerce_states', 'wcstates_filter_states');
    }
}
add_action('init', 'wcstates_register_filters');

/**
 * Plugin activation hook
 */
function wcstates_activate() {
    if (!get_option('wcstates_allowed_states')) {
        add_option('wcstates_allowed_states', array());
    }

    // Clear WooCommerce cache
    if (class_exists('WC_Cache_Helper')) {
        WC_Cache_Helper::get_transient_version('shipping', true);
    }

    // Log activation
    if (function_exists('wc_get_logger')) {
        wc_get_logger()->info(
            'States Manager plugin activated',
            array('source' => 'wc-states-manager')
        );
    }
}
register_activation_hook(__FILE__, 'wcstates_activate');

/**
 * Plugin deactivation hook
 */
function wcstates_deactivate() {
    if (function_exists('wc_get_logger')) {
        wc_get_logger()->info(
            'States Manager plugin deactivated',
            array('source' => 'wc-states-manager')
        );
    }
}
register_deactivation_hook(__FILE__, 'wcstates_deactivate');

/**
 * Plugin uninstall hook
 */
function wcstates_uninstall()
{
    // Remove plugin options
    delete_option('wcstates_allowed_states');
    
    if (function_exists('wc_get_logger')) {
        wc_get_logger()->info(
            'States Manager plugin uninstalled',
            array('source' => 'wc-states-manager')
        );
    }
}
register_uninstall_hook(__FILE__, 'wcstates_uninstall');

