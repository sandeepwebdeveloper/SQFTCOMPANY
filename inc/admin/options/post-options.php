<?php
/**
 * Post Options
 * @author   Sohrab
 * @since    1.0.0
 * @package  msteele
 */
if ( function_exists( 'acf_add_local_field_group' ) ):

    acf_add_local_field_group( array(
        'key'                   => 'group_post_options',
        'title'                 => 'Post Options',
        'fields'                => array(
            array(
                'key'               => 'field_hide_sidebar',
                'label'             => 'Hide Sidebar',
                'name'              => 'post_hide_sidebar',
                'type'              => 'true_false',
                'instructions'      => 'Disable sidebar on this post',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => 0,
                'ui'                => 1,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
            array(
                'key'               => 'field_hide_social',
                'label'             => 'Hide Social Sharing',
                'name'              => 'post_hide_social',
                'type'              => 'true_false',
                'instructions'      => 'Disable social sharing icons on this particular post',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => 0,
                'ui'                => 1,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
            array(
                'key'               => 'field_post_source_name',
                'label'             => 'Post Source',
                'name'              => 'post_source_name',
                'type'              => 'text',
                'instructions'      => 'Enter the post Source Name',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => 0,
                'ui'                => 1,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
            array(
                'key'               => 'field_post_source_link',
                'label'             => 'Post Source Link',
                'name'              => 'post_source_link',
                'type'              => 'text',
                'instructions'      => 'Enter the post Source Link',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => 0,
                'ui'                => 1,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
            array(
                'key'               => 'field_post_video_link',
                'label'             => 'Post Video Link',
                'name'              => 'post_video_link',
                'type'              => 'text',
                'instructions'      => 'Enter the post Source Link',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => '',
                'ui'                => 1,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => 1,
        'description'           => '',
    ) );

endif;