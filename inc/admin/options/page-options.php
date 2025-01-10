<?php
/**
 * Page options
 * @author   Sohrab
 * @since    1.0.0
 * @package  msteele
 */
if ( function_exists( 'acf_add_local_field_group' ) ):

    acf_add_local_field_group( array(
        'key'                   => 'group_page_options',
        'title'                 => 'Page Options',
        'fields'                => array(
            /**
             * Header Tab
             */
            array(
                'key'               => 'field_header_tab',
                'label'             => '<div class="settings-icon icon-header"></div> Header',
                'name'              => '',
                'type'              => 'tab',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'placement'         => 'left',
                'endpoint'          => 0,
            ),
            array(
                'key'               => 'field_page_hide_header',
                'label'             => 'Hide Header',
                'name'              => 'page_hide_header',
                'type'              => 'true_false',
                'instructions'      => 'Check this option if you want to hide the header',
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
                'key'               => 'field_page_hide_title',
                'label'             => 'Hide Title',
                'name'              => 'page_hide_title',
                'type'              => 'true_false',
                'instructions'      => 'Check this option if you want to hide the title',
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
                'key'               => 'field_page_header_custom_code',
                'label'             => 'Custom Header Codes',
                'name'              => 'page_header_custom_code',
                'type'              => 'textarea',
                'instructions'      => 'Add custom codes to the header for this particular page',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'placeholder'       => '',
                'maxlength'         => '',
                'rows'              => '8',
                'new_lines'         => '',
            ),
            /**
             * Footer Tab
             */
            array(
                'key'               => 'field_footer_tab',
                'label'             => '<div class="settings-icon icon-footer"></div> Footer',
                'name'              => '',
                'type'              => 'tab',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'placement'         => 'left',
                'endpoint'          => 0,
            ),
            array(
                'key'               => 'field_page_hide_footer',
                'label'             => 'Hide Footer',
                'name'              => 'page_hide_footer',
                'type'              => 'true_false',
                'instructions'      => 'Check this option if you want to hide the footer in this page',
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
                'key'               => 'field_page_footer_custom_code',
                'label'             => 'Custom Footer Codes',
                'name'              => 'page_footer_custom_code',
                'type'              => 'textarea',
                'instructions'      => 'Add custom codes to the footer for this particular page',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'placeholder'       => '',
                'maxlength'         => '',
                'rows'              => '8',
                'new_lines'         => '',
            ),
            /**
             * Container Tab
             */
            array(
                'key'               => 'field_container_page_tab',
                'label'             => '<div class="settings-icon icon-container"></div> Container',
                'name'              => '',
                'type'              => 'tab',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'placement'         => 'left',
                'endpoint'          => 0,
            ),
            array(
                'key'               => 'field_page_hide_container',
                'label'             => 'Disable Container',
                'name'              => 'page_hide_container',
                'type'              => 'true_false',
                'instructions'      => 'Check this option if you want to disable the default container set for pages',
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
                'key'               => 'field_page_body_class',
                'label'             => 'Custom Body Class Name',
                'name'              => 'page_custom_body_class',
                'type'              => 'text',
                'instructions'      => 'Enter a custom body class',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
                'maxlength'         => '',
            ),

        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
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