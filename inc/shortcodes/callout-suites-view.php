<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class SuitesViewCallout
 */
class SuitesViewCallout {
    /**
     * SuitesViewCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_suites_view_callout_mapping' ), 99 );
        add_shortcode( 'kc_suites_view_callout', array( $this, 'kc_suites_view_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_suites_view_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_suites_view_callout' => array(
                        'name'        => __( 'Suites View Callout', 'msteele' ),
                        'description' => __( 'Display View Panel', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
                            'General'       => array(
                                array(
                                    'name'        => 'main_image',
                                    'label'       => 'View Image',
                                    'type'        => 'attach_image',
                                    'description' => 'Upload Image for View',
                                ),
                                array(
                                    'name'        => 'main_content',
                                    'label'       => 'Content',
                                    'type'        => 'editor',
                                    'description' => 'Upload Content for View',
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
    function kc_suites_view_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'main_image'                => '',
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
         <?php $id   = $atts['main_image'];
            $img_src    = wp_get_attachment_image_url( $id, 'false' );
            $img_srcset = wp_get_attachment_image_srcset( $id, 'full' );
            $sizes      = wp_get_attachment_image_sizes( $id, 'full' );
            $alt        = get_post_meta( $id, '_wp_attachment_image_alt', true ); 
        ?>
        <div class="suites-view-callout <?php echo $atts['class']; ?>">
            <div class="suites-view-inner" <?php echo $animation; ?>>
                <div class="pan-wrapper pan-wrapper-1 position-relative">
                    <?php if($atts['main_image']) { ?>
                        <img src="<?php echo $img_src; ?>" alt="">
                    <?php } else { ?>
                        <img src="/wp-content/uploads/2024/05/view-point.jpg" alt="">
                    <?php } ?>
                    <div class="pan-arrows">
                        <div class="pan-arrows-left-1">
                            <img src="/wp-content/uploads/2024/05/view-left-icon.svg" alt="Pan Arrow Left">
                        </div>
                        <div class="pan-arrows-right-1">
                            <img src="/wp-content/uploads/2024/05/view-right-icon.svg" alt="Pan Arrow Right">
                        </div>
                    </div>
                </div>
                <?php if($atts['main_content']){ ?>
                        <div class="views-content">
                            <p><?php echo $atts['main_content']; ?></p>
                        </div>
                    <?php } ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

new SuitesViewCallout();