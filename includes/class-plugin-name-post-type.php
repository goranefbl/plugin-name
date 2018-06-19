<?php
/**
 * Registers post types and taxonomies.
 *
 * @since       1.0.0
 */

namespace Plugin_Name\Includes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plugin_Name_Post_Type {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ), 10 );
        // add_action( 'init', array( $this, 'register_post_type_taxonomies' ), 10 );
    }

    /**
     * Setup the post type for CPTS.
     *
     * @since   1.0
     * @access  public 
     */
    public function register_post_type() {

        $cpt_labels = apply_filters( 'plugin_name_post_type_labels', 
            array(
                'name'                  => __( 'Example CPTs', 'plugin-name' ),
                'singular_name'         => _x( 'Example CPT', 'Singular Name', 'plugin-name' ),
                'menu_name'             => _x( 'Example CPT', 'Menu Name', 'plugin-name' ),
                'all_items'             => __( 'All CPT Items', 'plugin-name' ),
                'name_admin_bar'        => _x( 'Example CPT', 'Admin bar add new', 'plugin-name'),
                'add_new'               => __( 'Add New CPT', 'plugin-name' ),
                'add_new_item'          => __( 'Add New CPT', 'plugin-name' ),
                'edit'                  => __( 'Edit', 'plugin-name' ),
                'edit_item'             => __( 'Edit CPT', 'plugin-name' ),
                'new_item'              => __( 'New CPT', 'plugin-name' ),
                'view'                  => __( 'View CPT', 'plugin-name' ),
                'view_item'             => __( 'View CPT', 'plugin-name' ),
                'search_items'          => __( 'Search CPTS', 'plugin-name' ),
                'not_found'             => __( 'No CPTS found', 'plugin-name' ),
                'not_found_in_trash'    => __( 'No CPTS found in trash', 'plugin-name' )
            )
        );

        $cpt_args = apply_filters( 'plugin_name_post_type_args',
            array(
                'labels'                => $cpt_labels,
                'public'                => true,
                'show_ui'               => true,
                'capability_type'       => 'post',
                'map_meta_cap'          => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'hierarchical'          => false,   
                'query_var'             => true,
                'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats', 'page-attributes' ),
                'has_archive'           => false,
                'show_in_nav_menus'     => true,
                'menu_position'         => 20,
                'menu_icon'             => 'dashicons-portfolio'
            ), 
            $cpt_labels
        );

        register_post_type( 'plugin_name_cpt', $cpt_args );
    }

}

new Plugin_Name_Post_Type();