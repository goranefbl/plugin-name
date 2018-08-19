<?php
/**
 * Plugin Name: Your Plugin Name
 * Plugin URI: https://pluginlink.com
 * Description: Your Plugin Description
 * Version: 1.0.0
 * Author: Your Plugin Author
 * Author URI: https://authorurl.com
 * Text Domain: plugin-name
 * Domain Path: /languages
 */

namespace Plugin_Name;

use Plugin_Name\Includes\Admin\Plugin_Name_Activator;
use Plugin_Name\Includes\Plugin_Name_Shortcodes;

if ( !class_exists( 'Plugin_Name' ) ) :

	final class Plugin_Name {
		
		/**
		 * Plugin version.
		 *
		 * @var string
		 * @since 1.0
		 */
		private $version = '1.0.0';

		/**
		 * The single instance of the class.
		 *
		 * @var Plugin_Name
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * Main WooCommerce Instance.
		 *
		 * Ensures only one instance of WooCommerce is loaded or can be loaded.
		 *
		 * @since 1.0
		 * @static
		 * @return Plugin Name - Main instance.
		 */
		public static function instance()
		{
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Plugin Constructor.
		 * @since 1.0
		 */
		public function __construct()
		{
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

		/**
		 * Define RAF Constants.
		 * @since 1.0
		 */
		private function define_constants()
		{
			$this->define( 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'PLUGIN_NAME_ABSPATH', dirname( __FILE__ ) . '/' );
            $this->define( 'PLUGIN_NAME_VERSION', $this->get_version() );
            $this->define( 'PLUGIN_NAME_BASE', plugin_basename(__FILE__) );
		}

		/**
		 * What type of request is this?
		 *
		 * @param  string $type admin, ajax, cron or frontend.
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' :
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		/**
		 * Define constant if not already set.
		 *
		 * @since  1.0
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value )
		{
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Returns Plugin version for global
		 * @since  1.0
		 */
		private function get_version()
		{
			return $this->version;
		}

		/**
		 * Include required core files used in admin and on the frontend. 
		 * @since  1.0
		 */
		public function includes()
		{
            require_once( PLUGIN_NAME_ABSPATH . 'autoload.php' );
			include_once( PLUGIN_NAME_ABSPATH . 'includes/class-plugin-name-post-type.php' );

			// Admin Classes that are no
			if ( $this->is_request( 'admin' ) ) {
				include_once( PLUGIN_NAME_ABSPATH . 'includes/admin/class-plugin-name-admin-assets.php' );
				include_once( PLUGIN_NAME_ABSPATH . 'includes/admin/class-plugin-name-settings.php' );
				include_once( PLUGIN_NAME_ABSPATH . 'includes/admin/class-plugin-name-menu.php' );
			}

			// Front Classes
			if ( $this->is_request( 'frontend' ) ) {
				include_once( PLUGIN_NAME_ABSPATH . 'includes/class-plugin-name-assets.php' );
			}
		}
		
		/**
		 * Hook into Actions & Filters.
		 * @since  1.0
		 */
		private function init_hooks()
		{
			register_activation_hook( __FILE__, array( 'Plugin_Name\Includes\Admin\Plugin_Name_Activator', 'activate' ) );
			add_action( 'init', array( $this, 'init' ), 0 );
            add_action( 'init', array( 'Plugin_Name\Includes\Plugin_Name_Shortcodes', 'init' ) ); // shortcodes and template path example
		}

		/**
		 * Init Plugin when WordPress Initialises.
		 * @since  1.0
		 */
		public function init()
		{
			// Before init action.
			do_action( 'before_plugin_name_init' );
			
			// Set up localisation.
			$this->load_plugin_textdomain();

			// After init action.
			do_action( 'after_plugin_name_init' );
		}

		/**
		 * Load Localisation files.
		 * @since  1.0
		 */
		public function load_plugin_textdomain()
		{
			load_plugin_textdomain( 'plugin-name', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}


	    /**
	     * Get the path of PHP template
	     *
	     * @since  1.0
	     * @return string
	     */
	    public static function get_template_path($template_name, $template_path = '') 
	    {
	    	// Default Template Path
	    	$default_path = PLUGIN_NAME_ABSPATH. 'templates' .trailingslashit($template_path);

			// Look within passed path within the theme - this is priority.
			$template = locate_template(
				array(
					'plugin-name'. trailingslashit( $template_path ) . $template_name,
					$template_name,
				)
			);

			// Get default template/
			if ( ! $template ) {
				$template = $default_path . $template_name;
			}

			// Return what we found.
			return apply_filters( 'plugin_name_locate_template', $template, $template_path );
	    }
	    
	}

endif;


/**
 * Main instance of Plugin.
 *
 * Returns the main instance of plugin to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Plugin_Name
 */
function Plugin_Name() {
	return Plugin_Name::instance();
}

Plugin_Name();
