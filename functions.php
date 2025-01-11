<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
define( 'MSTEELE_THEME_VERSION', '1.4.3' ); // set theme version
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
register_nav_menus(
	array(
		'LeftMenu' => __( 'Left Menu', 'Celeste' ),
		'RightMenu' => __( 'Right Menu', 'Celeste' ),
		'MobileMenu' => __( 'Mobile Menu', 'Celeste' ),
	)
);
function twentynineteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'twentynineteen_widgets_init' );
remove_filter( 'the_content', 'wpautop' );

function twentynineteen_scripts() {
	if(strstr($_SERVER['SERVER_NAME'], 'sqft-company.local')) {
		wp_enqueue_script('uce-Scripts', 'http://localhost:3736/bundled-scripts.js', NULL , '1.0', true);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css');
        
		
	} else {

		wp_enqueue_script('Theme-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.2c8522e6431965e923b8.js') , NULL , '1.0', true);
		wp_enqueue_script('uce-Scripts', get_theme_file_uri('/bundled-assets/scripts.bc0daa4c6660d0e1f03a.js') , NULL , '1.0', true);
		wp_enqueue_style('uce-Styles', get_theme_file_uri('/bundled-assets/styles.bc0daa4c6660d0e1f03a.css'));
		
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );
/**
 * Include Admin Stuff
 */
if ( class_exists( 'acf' ) ):
	require get_template_directory() . '/inc/admin/acf/acf.php';                // include acf pro
	require get_template_directory() . '/inc/admin/options/add-options.php';    // register option page
	require get_template_directory() . '/inc/admin/options/theme-options.php';  // theme option
	require get_template_directory() . '/inc/admin/options/theme-tracking.php'; // theme track
	require get_template_directory() . '/inc/admin/options/page-options.php';   // page options
	require get_template_directory() . '/inc/admin/options/post-options.php';   // post options
	require get_template_directory() . '/inc/admin/acf/custom-fields.php';      // additional custom fields
	require get_template_directory() . '/inc/admin/acf/post-type-broker.php';   // post type borker
endif;

/**
 * Include Main Functions
 */
require get_template_directory() . '/inc/setup.php';          // contains the theme setup
require get_template_directory() . '/inc/scripts.php';        // enqueue scripts and styles
require get_template_directory() . '/inc/widgets.php';        // widgets
require get_template_directory() . '/inc/template-tags.php';  // additional tags in posts and pages
require get_template_directory() . '/inc/cleanup.php';        // general cleanup
require get_template_directory() . '/inc/actions.php';        // all necessary actions
require get_template_directory() . '/inc/shortcodes.php';     // custom king composer shortcodes
require get_template_directory() . '/inc/utilities.php';      // utilities to make this theme better
/**
 * Include Libraries Loaded in Admin area
 */
//require get_template_directory() . '/library/navwalker/class-wp-bootstrap-navwalker.php';   // nav walker library
require get_template_directory() . '/library/cleanup/soil.php';                             // cleanup WordPress
require get_template_directory() . '/library/multi-pass/multi-pass.php';                    // multi pass

	
add_image_size( 'blog-thumb-size', 350, 250, true ); 
add_image_size( 'gallery-thumb-size', 350, 250, true ); 

add_image_size( 'slider-thumb-size', 995, 788, true ); 
		// add_action( 'init',  'toolkit_register_post_category' );


  
  

function create_property_post_type() {
    $labels = array(
        'name'                  => _x( 'Properties', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Property', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Properties', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Property', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'property', 'textdomain' ),
        'add_new_item'          => __( 'Add New Property', 'textdomain' ),
        'new_item'              => __( 'New Property', 'textdomain' ),
        'edit_item'             => __( 'Edit Property', 'textdomain' ),
        'view_item'             => __( 'View Property', 'textdomain' ),
        'all_items'             => __( 'All Properties', 'textdomain' ),
        'search_items'          => __( 'Search Properties', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Properties:', 'textdomain' ),
        'not_found'             => __( 'No properties found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No properties found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Property Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Property archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into property', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this property', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter properties list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Properties list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Properties list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'property' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'property', $args );
}
add_action( 'init', 'create_property_post_type' );
function create_property_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Cities', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'City', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Cities', 'textdomain' ),
        'all_items'         => __( 'All Cities', 'textdomain' ),
        'parent_item'       => __( 'Parent City', 'textdomain' ),
        'parent_item_colon' => __( 'Parent City:', 'textdomain' ),
        'edit_item'         => __( 'Edit City', 'textdomain' ),
        'update_item'       => __( 'Update City', 'textdomain' ),
        'add_new_item'      => __( 'Add New City', 'textdomain' ),
        'new_item_name'     => __( 'New City Name', 'textdomain' ),
        'menu_name'         => __( 'Cities', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'city' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'cities', array( 'property' ), $args );

    // Property Type taxonomy
    $labels = array(
        'name'              => _x( 'Property Types', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Property Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Property Types', 'textdomain' ),
        'all_items'         => __( 'All Property Types', 'textdomain' ),
        'parent_item'       => __( 'Parent Property Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Property Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Property Type', 'textdomain' ),
        'update_item'       => __( 'Update Property Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Property Type', 'textdomain' ),
        'new_item_name'     => __( 'New Property Type Name', 'textdomain' ),
        'menu_name'         => __( 'Property Type', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'property-type' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'property-type', array( 'property' ), $args );

    // Property Status taxonomy
    $labels = array(
        'name'              => _x( 'Property Statuses', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Property Status', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Property Statuses', 'textdomain' ),
        'all_items'         => __( 'All Property Statuses', 'textdomain' ),
        'parent_item'       => __( 'Parent Property Status', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Property Status:', 'textdomain' ),
        'edit_item'         => __( 'Edit Property Status', 'textdomain' ),
        'update_item'       => __( 'Update Property Status', 'textdomain' ),
        'add_new_item'      => __( 'Add New Property Status', 'textdomain' ),
        'new_item_name'     => __( 'New Property Status Name', 'textdomain' ),
        'menu_name'         => __( 'Property Status', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'property-status' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'property-status', array( 'property' ), $args );
}
add_action( 'init', 'create_property_taxonomies', 0 );

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_1',
        'title' => 'Property Gallery',
        'fields' => array(
            array(
                'key' => 'field_1',
                'label' => 'Project Gallery',
                'name' => 'property_gallery',
                'type' => 'gallery',
                'instructions' => 'Add images to the property gallery',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'insert' => 'append',
                'library' => 'all',
                'min' => '',
                'max' => '',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'property',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
endif;

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'property_meta',
        'title' => 'Property Meta',
        'fields' => array(
            array(
                'key' => 'project_price',
                'label' => 'Project Price',
                'name' => 'project_price',
                'type' => 'text',
                'instructions' => 'Add Project Price',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'project_location',
                'label' => 'Project Location',
                'name' => 'project_location',
                'type' => 'text',
                'instructions' => 'Add Project Location',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'property',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
endif;

// Services

// Register Custom Post Type: Services
function create_services_post_type() {
    $labels = array(
        'name'                  => _x( 'Services', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Services', 'textdomain' ),
        'name_admin_bar'        => __( 'Service', 'textdomain' ),
        'add_new_item'          => __( 'Add New Service', 'textdomain' ),
        'edit_item'             => __( 'Edit Service', 'textdomain' ),
        'new_item'              => __( 'New Service', 'textdomain' ),
        'view_item'             => __( 'View Service', 'textdomain' ),
        'all_items'             => __( 'All Services', 'textdomain' ),
    );

    $args = array(
        'label'                 => __( 'Service', 'textdomain' ),
        'description'           => __( 'Custom post type for services', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type( 'services', $args );
}

// Hook to register the post type
add_action( 'init', 'create_services_post_type', 0 );

// Flush rewrite rules to register the new custom post type properly
function flush_services_rewrite_rules() {
    create_services_post_type();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'flush_services_rewrite_rules' );