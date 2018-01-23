<?php

/**
 * Example Class for using Shortodes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin_Name_Shortcodes
{

    /**
     * Init shortcodes.
     * @since 1.0.0
     */
    public static function init() 
    {   
        // Init Main Shortcodes
        $shortcodes = array(
            'PLUGIN_NAME_EXAMPLE_SHORTCODE' => __CLASS__.'::plugin_name_shortcode_example'
        );

        foreach ($shortcodes as $shortcode => $function) {
            add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
        }
    }


    public static function plugin_name_shortcode_example($atts)
    {
        $atts = shortcode_atts( array(
            'guest_text' => 'Please register to get your referral link.',
            'url'        => get_home_url(),
            'id'         => get_current_user_id()
        ), $atts, 'PLUGIN_NAME_EXAMPLE_SHORTCODE' );

        $guest_text  = $atts['guest_text'];

        $template_path  = Plugin_Name::get_template_path('advance-shortcode.php','');

        if (!is_readable($template_path)) {
            return sprintf('<!-- Could not read "%s" file -->', $template_path);
        }

        ob_start();

        include $template_path;

        return ob_get_clean();
    }

}