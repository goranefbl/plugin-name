<?php
/**
 * Handle frontend scripts
 *
 * @since     2.0.0
 */

namespace Plugin_Name\Includes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plugin_Name_Assets {

    /**
     * Hook in methods.
     */
    public static function init() {
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
    //    add_action( 'wp_print_scripts', array( __CLASS__, 'localize_printed_scripts' ), 5 );
    }

    /**
     * Register/queue frontend scripts.
     */
    public static function load_scripts() {
        wp_enqueue_script( 'plugin-name-js', PLUGIN_NAME_URL. 'assets/js/plugin-name-public.js', array( 'jquery' ), PLUGIN_NAME_VERSION, false );
        wp_enqueue_style(  'plugin-name',  PLUGIN_NAME_URL. 'assets/css/plugin-name-public.css', array(), PLUGIN_NAME_VERSION, 'all' );
    }

    /**
     * Localise frontend scripts.
     */
    public static function localize_printed_scripts() {
        $var = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
        wp_localize_script('plugin-name-js', 'plugin_name', $var );
    }
}

Plugin_Name_Assets::init();