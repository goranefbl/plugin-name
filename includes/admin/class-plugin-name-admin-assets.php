<?php

namespace Plugin_Name\Includes\Admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Handle frontend scripts
 *
 * @since     2.0.0
 */
class Plugin_Name_Admin_Assets {

    /**
     * Hook in methods.
     */
    public static function init() {
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
    //    add_action( 'wp_print_scripts', array( __CLASS__, 'localize_printed_scripts' ), 5 );
    }

    /**
     * Register/queue frontend scripts.
     */
    public static function load_scripts($hook) {
    	// Load only on ?page=mypluginname
        if($hook != 'toplevel_page_plugin_name_settings') {
                return;
        }

         // We're including the farbtastic script & styles here because they're needed for the colour picker
        // If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_script( 'farbtastic' );

        // We're including the WP media scripts here because they're needed for the image upload field
        // If you're not including an image upload then you can leave this function call out
        wp_enqueue_media();

        wp_enqueue_script( 'plugin-name-admin-js', PLUGIN_NAME_URL. 'includes/admin/assets/js/plugin-name-admin.js', array( 'farbtastic', 'jquery' ), PLUGIN_NAME_VERSION, false );
        wp_enqueue_style(  'plugin-name-admin-css',  PLUGIN_NAME_URL. 'includes/admin/assets/css/plugin-name-admin.css', array(), PLUGIN_NAME_VERSION, 'all' );
    }

    /**
     * Localise frontend scripts.
     */
    public static function localize_printed_scripts() {
        $var = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
        wp_localize_script('plugin-name-js', 'plugin_name', $var );
    }
}

Plugin_Name_Admin_Assets::init();