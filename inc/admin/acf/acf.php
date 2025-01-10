<?php
/**
 * Include acf plugin
 */
add_action( 'current_screen', 'load_acf_admin_style', 1 );
add_action( 'admin_enqueue_scripts', 'load_options_style' );


/**
 * Load a custom style before acf core style to hide the option model
 * @since 1.3.0
 */
function load_acf_admin_style() {

    $screen         = get_current_screen();
    $theme_settings = 'toplevel_page_theme-general-settings';

    if ( $screen->id != $theme_settings ) {
        return;
    }
    wp_enqueue_style( 'acf_custom_options_css', get_stylesheet_directory_uri() . '/inc/admin/assets/css/acf-admin.css' );
}

/**
 * Load custom style for the option page
 *
 * @param $hook
 */
function load_options_style( $hook ) {
    $screen = get_current_screen();

    if ( $hook !== 'toplevel_page_theme-general-settings' && $screen->id != 'page' && $screen->id != 'post' ) {
        return;
    }
    if ( $hook == 'toplevel_page_theme-general-settings' ) {
        wp_enqueue_script( 'custom_options_js', get_stylesheet_directory_uri() . '/inc/admin/assets/js/admin.js', array( 'jquery' ) );
    }
    wp_enqueue_style( 'custom_options_css', get_stylesheet_directory_uri() . '/inc/admin/assets/css/admin.css' );
}
