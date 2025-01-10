<?php
/**
 * Enqueue scripts and styles.
 *
 * @author  Sohrab
 * @package msteele
 */

add_action( 'wp_enqueue_scripts', 'msteele_primary_scripts', 999 );
add_action( 'wp_enqueue_scripts', 'msteele_libraries' );
add_action( 'wp_enqueue_scripts', 'msteele_inline_scripts' );

/**
 * Load primary styles and scripts
 * These are loaded after all other styles and scripts are loaded
 * @since 1.0.0
 */
function msteele_primary_scripts() {

    // enqueue bootstrap and popper
    // wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/library/bootstrap/js/bootstrap.min.js', array(
    //     'jquery',
    //     'popper-js'
    // ), true );
    // wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/library/popper/popper.min.js', array( 'jquery' ), true );

    // load main styles
    // wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/style.min.css' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );

}

/**
 * Load library styles and scripts
 * @since 1.0.0
 */
function msteele_libraries() {

    // if you need to enqueue other scripts, load them here
    // make sure to check for dependency and add dependency handle as required
    wp_enqueue_style( 'hamburgers', get_template_directory_uri() . '/library/hamburgers/dist/hamburgers.min.css' );
    // wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), true );

    // get list of enabled libraries
    $get_libraries = get_field( 'ms_theme_libraries', 'option' );

    // get the Google API key
    $api_key = get_field( 'map_api_key', 'option' );

    // setup scripts handle and path
    $scripts = [
        'aos'                 => get_template_directory_uri() . '/library/aos/aos.min.js',
        'barba'               => get_template_directory_uri() . '/library/barba/barba.min.js',
        'lity'                => get_template_directory_uri() . '/library/lity/lity.min.js',
        'leaflet'             => get_template_directory_uri() . '/library/leaflet/leaflet.js',
        'plyr'                => get_template_directory_uri() . '/library/plyr/plyr.min.js',
        'smooth-scroll'       => get_template_directory_uri() . '/library/smooth-scroll/smooth-scroll.min.js',
        'google-map'          => get_template_directory_uri() . '/library/google-map/google-map.js',
        'map-api'             => 'https://maps.googleapis.com/maps/api/js?key=' . $api_key,
        'headroom'            => get_template_directory_uri() . '/library/headroom/headroom.min.js',
        'jquery-lazy'         => get_template_directory_uri() . '/library/jquery-lazy/jquery.lazy.min.js',
        'jquery-lazy-plugins' => get_template_directory_uri() . '/library/jquery-lazy/jquery.lazy.plugins.min.js',
        'fitvids'             => get_template_directory_uri() . '/library/fitvids/jquery.fitvids.min.js',
        'slick'               => get_template_directory_uri() . '/library/slick/slick.min.js',
    ];

    // setup the styles handle and path
    $styles = [
        'animate'      => get_template_directory_uri() . '/library/animate/animate.min.css',
        'aos'          => get_template_directory_uri() . '/library/aos/aos.min.css',
        'lity'         => get_template_directory_uri() . '/library/lity/lity.min.css',
        'plyr'         => get_template_directory_uri() . '/library/plyr/plyr.css',
        'font-awesome' => get_template_directory_uri() . '/library/font-awesome/css/all.min.css',
    ];

    // check to see which libraries are enabled
    if ( $get_libraries ):
        foreach ( $get_libraries as $library ):
            // loop through all scripts
            foreach ( $scripts as $script => $path ):
                // if script matches the library user enabled
                if ( $script === $library ):
                    wp_enqueue_script( $script, $path, array( 'jquery' ), true );
                endif;
            endforeach;
            // loop through all styles
            foreach ( $styles as $style => $path ):
                // if style matches the library user enabled
                if ( $style === $library ):
                    wp_enqueue_style( $style, $path );
                endif;
            endforeach;
        endforeach;
    endif;
}

/**
 * Add inline scripts
 * @since 1.0.0
 */
function msteele_inline_scripts() {
    // make sure you use the same handle as the one used to setup the scripts
    wp_add_inline_script( 'aos', 'AOS.init({easing: \'ease-out-back\', duration: 1000, disable: \'mobile\',once: \'true\'});' );
    wp_add_inline_script( 'smooth-scroll', 'var scroll = new SmoothScroll(\'.link-scroll\', {speed: 1500});' );
    wp_add_inline_script( 'fitvids', 'jQuery(document).ready(function($) {$("#video-container").fitVids()});' );
    wp_add_inline_script( 'jquery-lazy', 'jQuery(document).ready(function($) {$(\'.lazy\').Lazy({effect: "fadeIn",effectTime: 2000,threshold: 0});});' );
    wp_add_inline_script( 'plyr', 'const players = Array.from(document.querySelectorAll(\'.js-player\')).map(player => new Plyr(player));' );

    // other js which requires the libraries
    wp_enqueue_script( 'leaflet-map', get_template_directory_uri() . '/library/leaflet/leaflet-map.js', array( 'leaflet' ), true );
    wp_enqueue_script( 'headroom-jq', get_template_directory_uri() . '/library/headroom/jQuery.headroom.js', array( 'headroom' ), true );

    wp_enqueue_script( 'barba-start', get_template_directory_uri() . '/library/barba/barba.js', array( 'barba' ), true );
}
