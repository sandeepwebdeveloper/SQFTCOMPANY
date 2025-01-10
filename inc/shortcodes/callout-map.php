<?php
/**
 * Map Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class MapCallout
 */
class MapCallout {
    /**
     * MapCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_map_callout_mapping' ), 99 );
        add_shortcode( 'kc_map_callout', array( $this, 'kc_map_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_map_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_map_callout' => array(
                        'name'        => __( 'Map Call Out', 'msteele' ),
                        'description' => __( 'Display a google map', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
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
    function kc_map_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
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
        // prepare the link
        $link_arr = explode( "|", $atts['link'] );

        // get animation details
        $aos                  = 'data-aos="' . $atts['data-aos'] . '"';
        $aos_offset           = 'data-aos-offset="' . $atts['data-aos-offset'] . '"';
        $aos_duration         = 'data-aos-duration="' . $atts['data-aos-duration'] . '"';
        $aos_easing           = 'data-aos-easing="' . $atts['data-aos-easing'] . '"';
        $aos_delay            = 'data-aos-delay="' . $atts['data-aos-delay'] . '"';
        $aos_anchor           = 'data-aos-anchor="' . $atts['data-aos-anchor'] . '"';
        $aos_anchor_placement = 'data-aos-anchor-placement="' . $atts['data-aos-anchor-placement'] . '"';

        // prepare the animation
        if ( ! empty ( $atts['data-aos'] ) ):
            $animation = $aos . $aos_offset . $aos_duration . $aos_easing . $aos_delay . $aos_anchor . $aos_anchor_placement;
        else:
            $animation = '';
        endif;

        // start the output
        ob_start(); ?>
        <div class="map-callout <?php echo $atts['class']; ?>">

            <div class="map-content" <?php echo $animation; ?>>

              <?php do_action('add_google_map'); ?>

            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}


new MapCallout();
