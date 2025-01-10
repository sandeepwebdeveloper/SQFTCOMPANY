<?php
/**
 * Headline Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class AmenitiesCallout
 */
class AmenitiesCallout {
    /**
     * AmenitiesCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_Amenities_callout_mapping' ), 99 );
        add_shortcode( 'kc_Amenities_callout', array( $this, 'kc_Amenities_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_Amenities_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_Amenities_callout' => array(
                        'name'        => __( 'Amenity Block Call Out', 'msteele' ),
                        'description' => __( 'Display a Amenity', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
                            'General'       => array(
                                array(
                                    'name'        => 'amenitiynumber',
                                    'label'       => 'Number',
                                    'type'        => 'text',
                                    'description' => 'Area Score Number',
                                ),
                                array(
                                    'name'        => 'amenitiytitle',
                                    'label'       => 'Title',
                                    'type'        => 'text',
                                    'description' => 'Title of the headline',
                                ),
                                array(
                                    'name'        => 'amenitiyimage',
                                    'label'       => 'Image',
                                    'type'        => 'attach_image',
                                    'description' => 'Image of the headline',
                                ),
                                array(
                                    'name'        => 'heading',
                                    'label'       => 'Heading Tag ',
                                    'type'        => 'select',
                                    'options'     => array(
                                        'h1' => 'H1',
                                        'h2' => 'H2',
                                        'h3' => 'H3',
                                        'h4' => 'H4',
                                        'h5' => 'H5',
                                    ),
                                    'value'       => 'h2',
                                    'description' => 'Select a heading tag'
                                ),
                								array(
                									'name'    => 'enable_typing',
                									'label'   => 'Enable Self Typing',
                									'type'    => 'checkbox',
                									'options' => array(
                										'option_yes' => 'Yes',
                									)
                								),

                            ),
                            'Customization' => array(
                                array(
                                    'name'        => 'class',
                                    'label'       => 'Extra Class Name',
                                    'type'        => 'text',
                                    'description' => 'Enter extra class name for the element',
                                ),
                                array(
                                    'name'        => 'headline_text_class',
                                    'label'       => 'Headline Text Class',
                                    'type'        => 'text',
                                    'description' => 'Enter Headline text class name for the element',
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
    function kc_Amenities_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'title'                     => '',
                    'heading'                   => '',
                    'enable_typing'             => '',
                    'class'                     => '',
                    'headline_text_class'       => '',
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
        $aos                  = 'data-aos="'.$atts['data-aos'].'" ';
        $aos_offset           = 'data-aos-offset="'.$atts['data-aos-offset'] . '" ';
        $aos_duration         = 'data-aos-duration="'.$atts['data-aos-duration'] . '" ';
        $aos_easing           = 'data-aos-easing="'.$atts['data-aos-easing'] . '" ';
        $aos_delay            = 'data-aos-delay="'.$atts['data-aos-delay'] . '" ';
        $aos_anchor           = 'data-aos-anchor="'.$atts['data-aos-anchor'] . '" ';
        $aos_anchor_placement = 'data-aos-anchor-placement="'.$atts['data-aos-anchor-placement'] . '" ';

        // prepare the animation
        if ( ! empty ( $atts['data-aos'] ) ):
            $animation = $aos . $aos_offset . $aos_duration . $aos_easing . $aos_delay . $aos_anchor . $aos_anchor_placement;
        else:
            $animation = '';
        endif;

    		// check to see if user enabled smooth scroll
    		if ( ! empty ( $atts['enable_typing'] ) ) {
    			if ( $atts['enable_typing'] == 'option_yes' ) {
    				$typing = 'typing';
    			}
    		}

        // start the output
        ob_start(); ?>
        <div class="headline-callout <?php echo $atts['class']; ?>">
            <div class="headline-content" >
                <div class="headline-title <?php echo $typing; ?> auto-margin-off">
                    <<?php echo $atts['heading']; ?> class="<?php echo $atts['headline_text_class']; ?>" <?php echo $animation; ?>>
                    <?php echo html_entity_decode( $atts['title'] ); ?>
                    </<?php echo $atts['heading']; ?>>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}

new AmenitiesCallout();
