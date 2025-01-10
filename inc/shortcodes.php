<?php
/**
 * Shortcodes
 *
 * King Composer Shortcodes
 *
 * @author: Sohrab
 * @package msteele
 */

add_action('init', 'load_theme_actions');

/**
 * Initialize King Composer actions
 */
function load_theme_actions() {

        // require_once( get_template_directory() . '/inc/shortcodes/callout-Content-Slider.php' );
        // require_once( get_template_directory() . '/inc/shortcodes/callout-Left-Content-slider.php' );
        // require_once( get_template_directory() . '/inc/shortcodes/callout-Right-Content-slider.php' );

    require_once( get_template_directory() . '/inc/shortcodes/callout-blog-archive.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-image.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-image-with-content.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-headline.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-content.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-text.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-button.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-shortcode.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-video.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-video-popup.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-map.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-broker-portal.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-floorplans.php' );
    require_once( get_template_directory() . '/inc/shortcodes/Callout-Floorplan-Listing.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-amenities-block.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-menu.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-banner.php' );
    require_once( get_template_directory() . '/inc/shortcodes/Callout-Features-and-finished.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-floorplans-popup.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-broker-portal-simple.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-amenities.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-neighbourhood-slider.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-gallery-group.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-Crousel-Slider.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-Slider-Creative-Heading.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-full-Slider.php' );
    require_once( get_template_directory() . '/inc/shortcodes/Callout-Features-and-finished-accordian.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-community-map.php' ); 
    require_once( get_template_directory() . '/inc/shortcodes/callout-neighbourhood-maps.php' ); 
    require_once( get_template_directory() . '/inc/shortcodes/callout-neighbourhood-tabs.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-features-tabs.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-news-media.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-tabs.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-register-form.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-features-content.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-suites-view.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-building-floors-view.php' );
    require_once( get_template_directory() . '/inc/shortcodes/callout-neighbour-maps.php' );

    
    
}
