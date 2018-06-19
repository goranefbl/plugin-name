<?php
namespace Plugin_Name\Includes\Admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plugin_Name_Settings {

    /**
     * The single instance of WordPress_Plugin_Template_Settings.
     * @var     object
     * @access  private
     * @since   1.0.0
     */
    private static $_instance = null;

    /**
     * Prefix for plugin settings.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $base = '';

    /**
     * Available settings for plugin.
     * @var     array
     * @access  public
     * @since   1.0.0
     */
    public $settings = array();

    public function __construct () {

        $this->base = 'plugin_name_';

        // Initialise settings
        add_action( 'init', array( $this, 'init_settings' ), 1 );

        // Register plugin settings
        add_action( 'admin_init' , array( $this, 'register_settings' ) );

    }

    /**
     * Initialise settings
     * @return void
     */
    public function init_settings () {
        $this->settings = $this->settings_fields();
    }

    public function get_settings_fields (){
        return $this->settings;
    }


    /**
     * Build settings fields
     * @return array Fields to be displayed on settings page
     */
    private function settings_fields() {

        $settings['standard'] = array(
            'title'                 => __( 'Standard', 'wordpress-plugin-template' ),
            'description'           => __( 'These are fairly standard form input fields.', 'wordpress-plugin-template' ),
            'fields'                => array(
                array(
                    'id'            => 'text_field',
                    'label'         => __( 'Some Text' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This is a standard text field.', 'wordpress-plugin-template' ),
                    'type'          => 'text',
                    'default'       => '',
                    'placeholder'   => __( 'Placeholder text', 'wordpress-plugin-template' )
                ),
                array(
                    'id'            => 'password_field',
                    'label'         => __( 'A Password' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This is a standard password field.', 'wordpress-plugin-template' ),
                    'type'          => 'password',
                    'default'       => '',
                    'placeholder'   => __( 'Placeholder text', 'wordpress-plugin-template' )
                ),
                array(
                    'id'            => 'secret_text_field',
                    'label'         => __( 'Some Secret Text' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This is a secret text field - any data saved here will not be displayed after the page has reloaded, but it will be saved.', 'wordpress-plugin-template' ),
                    'type'          => 'text_secret',
                    'default'       => '',
                    'placeholder'   => __( 'Placeholder text', 'wordpress-plugin-template' )
                ),
                array(
                    'id'            => 'text_block',
                    'label'         => __( 'A Text Block' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This is a standard text area.', 'wordpress-plugin-template' ),
                    'type'          => 'textarea',
                    'default'       => '',
                    'placeholder'   => __( 'Placeholder text for this textarea', 'wordpress-plugin-template' )
                ),
                array(
                    'id'            => 'single_checkbox',
                    'label'         => __( 'An Option', 'wordpress-plugin-template' ),
                    'description'   => __( 'A standard checkbox - if you save this option as checked then it will store the option as \'on\', otherwise it will be an empty string.', 'wordpress-plugin-template' ),
                    'type'          => 'checkbox',
                    'default'       => ''
                ),
                array(
                    'id'            => 'select_box',
                    'label'         => __( 'A Select Box', 'wordpress-plugin-template' ),
                    'description'   => __( 'A standard select box.', 'wordpress-plugin-template' ),
                    'type'          => 'select',
                    'options'       => array( 'drupal' => 'Drupal', 'joomla' => 'Joomla', 'wordpress' => 'WordPress' ),
                    'default'       => 'wordpress'
                ),
                array(
                    'id'            => 'radio_buttons',
                    'label'         => __( 'Some Options', 'wordpress-plugin-template' ),
                    'description'   => __( 'A standard set of radio buttons.', 'wordpress-plugin-template' ),
                    'type'          => 'radio',
                    'options'       => array( 'superman' => 'Superman', 'batman' => 'Batman', 'ironman' => 'Iron Man' ),
                    'default'       => 'batman'
                ),
                array(
                    'id'            => 'multiple_checkboxes',
                    'label'         => __( 'Some Items', 'wordpress-plugin-template' ),
                    'description'   => __( 'You can select multiple items and they will be stored as an array.', 'wordpress-plugin-template' ),
                    'type'          => 'checkbox_multi',
                    'options'       => array( 'square' => 'Square', 'circle' => 'Circle', 'rectangle' => 'Rectangle', 'triangle' => 'Triangle' ),
                    'default'       => array( 'circle', 'triangle' )
                )
            )
        );

        $settings['extra'] = array(
            'title'                 => __( 'Extra', 'wordpress-plugin-template' ),
            'description'           => __( 'These are some extra input fields that maybe aren\'t as common as the others.', 'wordpress-plugin-template' ),
            'fields'                => array(
                array(
                    'id'            => 'number_field',
                    'label'         => __( 'A Number' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This is a standard number field - if this field contains anything other than numbers then the form will not be submitted.', 'wordpress-plugin-template' ),
                    'type'          => 'number',
                    'default'       => '',
                    'placeholder'   => __( '42', 'wordpress-plugin-template' )
                ),
                array(
                    'id'            => 'colour_picker',
                    'label'         => __( 'Pick a colour', 'wordpress-plugin-template' ),
                    'description'   => __( 'This uses WordPress\' built-in colour picker - the option is stored as the colour\'s hex code.', 'wordpress-plugin-template' ),
                    'type'          => 'color',
                    'default'       => '#21759B'
                ),
                array(
                    'id'            => 'an_image',
                    'label'         => __( 'An Image' , 'wordpress-plugin-template' ),
                    'description'   => __( 'This will upload an image to your media library and store the attachment ID in the option field. Once you have uploaded an imge the thumbnail will display above these buttons.', 'wordpress-plugin-template' ),
                    'type'          => 'image',
                    'default'       => '',
                    'placeholder'   => ''
                ),
                array(
                    'id'            => 'multi_select_box',
                    'label'         => __( 'A Multi-Select Box', 'wordpress-plugin-template' ),
                    'description'   => __( 'A standard multi-select box - the saved data is stored as an array.', 'wordpress-plugin-template' ),
                    'type'          => 'select_multi',
                    'options'       => array( 'linux' => 'Linux', 'mac' => 'Mac', 'windows' => 'Windows' ),
                    'default'       => array( 'linux' )
                )
            )
        );

        $settings = apply_filters( 'plugin_name_settings_fields', $settings );

        return $settings;
    }

    /**
     * Register plugin settings
     * @return void
     */
    public function register_settings () {
        if ( is_array( $this->settings ) ) {

            // Check posted/selected tab
            $current_section = '';
            if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
                $current_section = $_POST['tab'];
            } else {
                if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                    $current_section = $_GET['tab'];
                }
            }

            foreach ( $this->settings as $section => $data ) {

                if ( $current_section && $current_section != $section ) continue;

                // Add section to page
                add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), 'plugin_name_settings' );

                foreach ( $data['fields'] as $field ) {

                    // Validation callback for field
                    $validation = '';
                    if ( isset( $field['callback'] ) ) {
                        $validation = $field['callback'];
                    }

                    // Register field
                    $option_name = $this->base . $field['id'];
                    register_setting( 'plugin_name_settings', $option_name, $validation );

                    // Add field to page
                    add_settings_field( $field['id'], $field['label'], array( $this, 'display_field' ), 'plugin_name_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
                }

                if ( ! $current_section ) break;
            }
        }
    }

    public function settings_section( $section ) {
        $html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
        echo $html;
    }


    /**
     * Generate HTML for displaying fields
     * @param  array   $field Field data
     * @param  boolean $echo  Whether to echo the field HTML or return it
     * @return void
     */
    public function display_field ( $data = array(), $post = false, $echo = true ) {
        // Get field info
        if ( isset( $data['field'] ) ) {
            $field = $data['field'];
        } else {
            $field = $data;
        }
        // Check for prefix on option name
        $option_name = '';
        if ( isset( $data['prefix'] ) ) {
            $option_name = $data['prefix'];
        }
        // Get saved data
        $data = '';
        if ( $post ) {
            // Get saved field data
            $option_name .= $field['id'];
            $option = get_post_meta( $post->ID, $field['id'], true );
            // Get data to display in field
            if ( isset( $option ) ) {
                $data = $option;
            }
        } else {
            // Get saved option
            $option_name .= $field['id'];
            $option = get_option( $option_name );
            // Get data to display in field
            if ( isset( $option ) ) {
                $data = $option;
            }
        }
        // Show default data if no option saved and default is supplied
        if ( $data === false && isset( $field['default'] ) ) {
            $data = $field['default'];
        } elseif ( $data === false ) {
            $data = '';
        }
        $html = '';
        switch( $field['type'] ) {
            case 'text':
            case 'url':
            case 'email':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . esc_attr( $data ) . '" />' . "\n";
            break;
            case 'password':
            case 'number':
            case 'hidden':
                $min = '';
                if ( isset( $field['min'] ) ) {
                    $min = ' min="' . esc_attr( $field['min'] ) . '"';
                }
                $max = '';
                if ( isset( $field['max'] ) ) {
                    $max = ' max="' . esc_attr( $field['max'] ) . '"';
                }
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . esc_attr( $data ) . '"' . $min . '' . $max . '/>' . "\n";
            break;
            case 'text_secret':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="" />' . "\n";
            break;
            case 'textarea':
                $html .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="5" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>'. "\n";
            break;
            case 'checkbox':
                $checked = '';
                if ( $data && 'on' == $data ) {
                    $checked = 'checked="checked"';
                }
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
            break;
            case 'checkbox_multi':
                foreach ( $field['options'] as $k => $v ) {
                    $checked = false;
                    if ( in_array( $k, (array) $data ) ) {
                        $checked = true;
                    }
                    $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '" class="checkbox_multi"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
                }
            break;
            case 'radio':
                foreach ( $field['options'] as $k => $v ) {
                    $checked = false;
                    if ( $k == $data ) {
                        $checked = true;
                    }
                    $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
                }
            break;
            case 'select':
                $html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
                foreach ( $field['options'] as $k => $v ) {
                    $selected = false;
                    if ( $k == $data ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
                }
                $html .= '</select> ';
            break;
            case 'select_multi':
                $html .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
                foreach ( $field['options'] as $k => $v ) {
                    $selected = false;
                    if ( in_array( $k, (array) $data ) ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
                }
                $html .= '</select> ';
            break;
            case 'image':
                $image_thumb = '';
                if ( $data ) {
                    $image_thumb = wp_get_attachment_thumb_url( $data );
                }
                $html .= '<img id="' . $option_name . '_preview" class="image_preview" src="' . $image_thumb . '" /><br/>' . "\n";
                $html .= '<input id="' . $option_name . '_button" type="button" data-uploader_title="' . __( 'Upload an image' , 'wordpress-plugin-template' ) . '" data-uploader_button_text="' . __( 'Use image' , 'wordpress-plugin-template' ) . '" class="image_upload_button button" value="'. __( 'Upload new image' , 'wordpress-plugin-template' ) . '" />' . "\n";
                $html .= '<input id="' . $option_name . '_delete" type="button" class="image_delete_button button" value="'. __( 'Remove image' , 'wordpress-plugin-template' ) . '" />' . "\n";
                $html .= '<input id="' . $option_name . '" class="image_data_field" type="hidden" name="' . $option_name . '" value="' . $data . '"/><br/>' . "\n";
            break;
            case 'color':
                ?><div class="color-picker" style="position:relative;">
                    <input type="text" name="<?php esc_attr_e( $option_name ); ?>" class="color" value="<?php esc_attr_e( $data ); ?>" />
                    <div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>
                </div>
                <?php
            break;
            case 'repeater':
                if($data) {
                    foreach ($data as $key => $value) {
                        $html .= '<div class="am2_repeating_section">';
                        $html .= '<input type="text" style="width:100%" name="' . esc_attr( $option_name ) . '['.$key.'][name]" placeholder="Name" value="'.$value['name'].'" />';
                        $html .= '<input type="text" style="width:100%" name="' . esc_attr( $option_name ) . '['.$key.'][url]" placeholder="URL" value="'.$value['url'].'" />';
                        $html .= '<a href="#" class="delete">Remove</a>';
                        $html .= '</div>';
                    }
                } else {
                    $html .= '<div class="am2_repeating_section">';
                    $html .= '<input type="text" style="width:100%" name="' . esc_attr( $option_name ) . '[0][name]" placeholder="Name" value="" />';
                    $html .= '<input type="text" style="width:100%" name="' . esc_attr( $option_name ) . '[0][url]" placeholder="URL" value="" />';
                    $html .= '<a href="#" class="delete">Remove</a>';
                    $html .= '</div>';
                }
                $html .= '<a href="#" class="am2_add_getter button button-small">Add new Cookie</a>';
            break;
            case 'editor':
                wp_editor($data, $option_name, array(
                    'textarea_name' => $option_name
                ) );
            break;
        }
        switch( $field['type'] ) {
            case 'checkbox_multi':
            case 'radio':
            case 'select_multi':
                $html .= '<br/><span class="description">' . $field['description'] . '</span>';
            break;
            default:
                if ( ! $post ) {
                    $html .= '<label for="' . esc_attr( $field['id'] ) . '">' . "\n";
                }
                $html .= '<span class="description">' . $field['description'] . '</span>' . "\n";
                if ( ! $post ) {
                    $html .= '</label>' . "\n";
                }
            break;
        }
        if ( ! $echo ) {
            return $html;
        }
        echo $html;
    }

    /**
     * Main WordPress_Plugin_Template_Settings Instance
     *
     * Ensures only one instance of WordPress_Plugin_Template_Settings is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main WordPress_Plugin_Template_Settings instance
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}

Plugin_Name_Settings::instance();