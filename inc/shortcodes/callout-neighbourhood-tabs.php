<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class NeighbourhoodTabsCallout
 */
class NeighbourhoodTabsCallout {
    /**
     * NeighbourhoodTabsCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_NeighbourhoodTabs_callout_mapping' ), 99 );
        add_shortcode( 'kc_NeighbourhoodTabs_callout', array( $this, 'kc_NeighbourhoodTabs_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_NeighbourhoodTabs_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_NeighbourhoodTabs_callout' => array(
                        'name'        => __( 'Neighbourhood Tabs Callout', 'msteele' ),
                        'description' => __( 'Display Neighbourhood Tabs content', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
                            'General'       => array(
                                array(
                                    'name'        => 'main_content',
                                    'label'       => 'Content',
                                    'type'        => 'editor',
                                    'description' => 'Content',
                                )
                            ),
                            'Customization' => array(
                                array(
                                    'name'        => 'class',
                                    'label'       => 'Extra Class Name',
                                    'type'        => 'text',
                                    'description' => 'Enter extra class name for the element',
                                )
                            ),
                            'Animation'     => array(
                                array(
                                    'name'        => 'data-aos',
                                    'label'       => 'AOS Type',
                                    'type'        => 'text',
                                    'description' => 'Enter AOS animation type, leave empty for no animation',
                                ),
                                array(
                                    'name'        => 'data-aos-offset',
                                    'label'       => 'AOS Offset',
                                    'type'        => 'text',
                                    'description' => 'Change offset to trigger animations sooner or later',
                                    'value'       => '120',
                                ),
                                array(
                                    'name'        => 'data-aos-duration',
                                    'label'       => 'AOS Duration',
                                    'type'        => 'text',
                                    'description' => 'Duration of animation (default 400)',
                                    'value'       => '400',
                                ),
                                array(
                                    'name'        => 'data-aos-easing',
                                    'label'       => 'AOS Easing',
                                    'type'        => 'text',
                                    'description' => 'Choose timing function to ease elements in different ways',
                                    'value'       => 'ease',
                                ),
                                array(
                                    'name'        => 'data-aos-delay',
                                    'label'       => 'AOS Delay',
                                    'type'        => 'text',
                                    'description' => 'Delay animation in ms',
                                    'value'       => '0',
                                ),
                                array(
                                    'name'        => 'data-aos-anchor',
                                    'label'       => 'AOS Anchor',
                                    'type'        => 'text',
                                    'description' => 'Anchor element, whose offset will be counted to trigger animation',
                                    'value'       => '',
                                ),
                                array(
                                    'name'        => 'data-aos-anchor-placement',
                                    'label'       => 'AOS Anchor Placement',
                                    'type'        => 'text',
                                    'description' => 'Which one position of element on the screen should trigger animation',
                                    'value'       => 'top-bottom',
                                ),
                            ),
                        ),
                    ),  // End of element
                )
            ); // End add map
        } // End if
    }

    /**
     * Output element
     *
     * @param $atts
     *
     * @return string
     * @since 1.0.0
     */
    function kc_NeighbourhoodTabs_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'main_content'              => '',
                    'class'                     => '',
                    'data-aos'                  => '',
                    'data-aos-offset'           => '',
                    'data-aos-duration'         => '',
                    'data-aos-easing'           => '',
                    'data-aos-delay'            => '',
                    'data-aos-anchor'           => '',
                    'data-aos-anchor-placement' => '',
                ),
                $atts
            )
        );

        // get animation details
        $aos                  = 'data-aos="' . $atts['data-aos'] . '" ';
        $aos_offset           = 'data-aos-offset="' . $atts['data-aos-offset'] . '" ';
        $aos_duration         = 'data-aos-duration="' . $atts['data-aos-duration'] . '" ';
        $aos_easing           = 'data-aos-easing="' . $atts['data-aos-easing'] . '" ';
        $aos_delay            = 'data-aos-delay="' . $atts['data-aos-delay'] . '" ';
        $aos_anchor           = 'data-aos-anchor="' . $atts['data-aos-anchor'] . '" ';
        $aos_anchor_placement = 'data-aos-anchor-placement="' . $atts['data-aos-anchor-placement'] . '" ';

        // prepare the animation
        if ( ! empty ( $atts['data-aos'] ) ):
            $animation = $aos . $aos_offset . $aos_duration . $aos_easing . $aos_delay . $aos_anchor . $aos_anchor_placement;
        else:
            $animation = '';
        endif;

        // start the output
        ob_start(); ?>
        <div class="content-callout <?php echo $atts['class']; ?>">
            <div class="content-inner" <?php echo $animation; ?>>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="make-the-connection-1" data-toggle="tab" href="#make-the-connection" role="tab" aria-controls="make-the-connection" aria-selected="true">Make the connection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="live-the-local-1" data-toggle="tab" href="#live-the-local" role="tab" aria-controls="live-the-local" aria-selected="false">Live the local</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="take-a-walk-1" data-toggle="tab" href="#take-a-walk" role="tab" aria-controls="take-a-walk" aria-selected="false">Take a walk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="must-have-it-1" data-toggle="tab" href="#must-have-it" role="tab" aria-controls="must-have-it" aria-selected="false">Must-have it</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="calling-all-foodies-1" data-toggle="tab" href="#calling-all-foodies" role="tab" aria-controls="contact" aria-selected="false">Calling all foodies</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="make-the-connection" role="tabpanel" aria-labelledby="make-the-connection">
                        <?php
                            $my_id = 275;
                            $post_id_5369 = get_post($my_id);
                            $content = $post_id_5369->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        ?>
                    </div>
                    <div class="tab-pane fade" id="live-the-local" role="tabpanel" aria-labelledby="profile-tab">
                    <?php
                            $my_id = 315;
                            $post_id_5369 = get_post($my_id);
                            $content = $post_id_5369->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        ?>
                    </div>
                    <div class="tab-pane fade" id="take-a-walk" role="tabpanel" aria-labelledby="take-a-walk-tab">
                        <?php
                            $my_id = 332;
                            $post_id_5369 = get_post($my_id);
                            $content = $post_id_5369->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        ?>
                    </div>
                    <div class="tab-pane fade" id="must-have-it" role="tabpanel" aria-labelledby="must-have-it-tab">
                        <?php
                            $my_id = 340;
                            $post_id_5369 = get_post($my_id);
                            $content = $post_id_5369->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        ?>
                    </div>
                    <div class="tab-pane fade" id="calling-all-foodies" role="tabpanel" aria-labelledby="calling-all-foodies-tab">
                        <?php
                            $my_id = 349;
                            $post_id_5369 = get_post($my_id);
                            $content = $post_id_5369->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    
        <?php

        return ob_get_clean();

    }
}

new NeighbourhoodTabsCallout();