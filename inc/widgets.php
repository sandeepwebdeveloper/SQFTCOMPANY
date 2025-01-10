<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function msteele_widgets_init() {

    // posts widget
    register_sidebar( array(
        'name'          => esc_html__( 'Posts Sidebar', 'msteele' ),
        'id'            => 'posts-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'msteele' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    // archive widget
    register_sidebar( array(
        'name'          => esc_html__( 'Archive Sidebar', 'msteele' ),
        'id'            => 'archive-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'msteele' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'msteele_widgets_init' );