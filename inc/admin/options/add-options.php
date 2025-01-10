<?php
/**
 * Add options page capability
 * @author   Sohrab
 * @since    1.0.0
 * @package  msteele
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme Settings <span class="title-count">' . MSTEELE_THEME_VERSION . '</span>',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}