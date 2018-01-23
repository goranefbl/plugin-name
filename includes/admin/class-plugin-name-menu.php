<?php
/**
 * Setup Menu Pages
 * @author    WPGens
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin_Name_Menu {

	private $settings;

	public function __construct() {
		// Add submenu items
		add_action( 'admin_menu', array( $this, 'add_menu_item') );
		// TODO: Temporary settings screen
		add_filter( 'woocommerce_get_settings_pages', array( $this, 'settings_page') );
		// Add links under plugin page.
		add_filter( 'plugin_action_links_' . PLUGIN_BASENAME , array( $this, 'add_settings_link' ) );
		add_filter( 'plugin_action_links_' . PLUGIN_BASENAME , array( $this, 'docs_link') );
		
	}


	/**
	 * Define submenu page under Woocommerce Page
	 *
	 * @since 2.0.0
	 */
	public function add_menu_item() {
		// change to add_options_page to add it under general options.
		add_menu_page( __( 'Plugin Settings', 'wordpress-plugin-template' ) , __( 'Plugin Settings', 'wordpress-plugin-template' ) , 'manage_options' , 'plugin_name_settings' ,  array( $this, 'settings_page' ) );
	}


	/**
	 * Init the view part.
	 *
	 * @since 2.0.0
	 */
	public function display_plugin_admin_page() {

		include( PLUGIN_NAME_ABSPATH . 'includes/admin/views/html-some-admin-page.php' );
	}


	/**
	 * Temporary Settings page untill we finish separate page.
	 *
	 * @since 2.0.0
	 */
//	public function settings_page( $settings ) {
//		$settings[] = require_once( PLUGIN_NAME_ABSPATH . 'includes/admin/class-wpgens-raf-settings.php' );
//		return $settings;
//	}



    /**
     * Load settings page content
     * @return void
     */
    public function settings_page() {

    	$settings_api = Plugin_Name_Settings::instance();
    	$this->settings = $settings_api->get_settings_fields();

        // Build page HTML
        $html = '<div class="wrap" id="' . 'plugin_name_settings">' . "\n";
            $html .= '<h2>' . __( 'Plugin Settings' , 'wordpress-plugin-template' ) . '</h2>' . "\n";

            $tab = '';
            if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                $tab .= $_GET['tab'];
            }

            // Show page tabs
            if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

                $html .= '<h2 class="nav-tab-wrapper" style="padding:0;">' . "\n";

                $c = 0;
                foreach ( $this->settings as $section => $data ) {

                    // Set tab class
                    $class = 'nav-tab';
                    if ( ! isset( $_GET['tab'] ) ) {
                        if ( 0 == $c ) {
                            $class .= ' nav-tab-active';
                        }
                    } else {
                        if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
                            $class .= ' nav-tab-active';
                        }
                    }

                    // Set tab link
                    $tab_link = add_query_arg( array( 'tab' => $section ) );
                    if ( isset( $_GET['settings-updated'] ) ) {
                        $tab_link = remove_query_arg( 'settings-updated', $tab_link );
                    }

                    // Output tab
                    $html .= '<a href="' . $tab_link . '" class="' . esc_attr( $class ) . '">' . esc_html( $data['title'] ) . '</a>' . "\n";

                    ++$c;
                }

                $html .= '</h2>' . "\n";
            }

            $html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";

                // Get settings fields
                ob_start();
                settings_fields( 'plugin_name_settings' );
                do_settings_sections( 'plugin_name_settings' );
                $html .= ob_get_clean();

                $html .= '<p class="submit">' . "\n";
                    $html .= '<input type="hidden" name="tab" value="' . esc_attr( $tab ) . '" />' . "\n";
                    $html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'wordpress-plugin-template' ) ) . '" />' . "\n";
                $html .= '</p>' . "\n";
            $html .= '</form>' . "\n";
        $html .= '</div>' . "\n";

        include( PLUGIN_NAME_ABSPATH . 'includes/admin/views/html-settings-page.php' );
    }





	/**
	 * Plugin Settings Link on plugin page
	 *
	 * @since 		2.0.0
	 */
	function add_settings_link( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=gens_raf' ) . '">Settings</a>',
		);
		return array_merge( $links, $mylinks );
	}


	/**
	 * Plugin Documentation Link on plugin page
	 *
	 * @since 		2.0.0
	 */
	function docs_link( $links ) {
		$mylinks = array(
			'<a target="_blank" href="http://wpgens.helpscoutdocs.com">Docs</a>',
		);
		return array_merge( $links, $mylinks );
	}

}

new Plugin_Name_Menu();