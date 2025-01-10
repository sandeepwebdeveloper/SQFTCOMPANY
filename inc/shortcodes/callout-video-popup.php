<?php
/**
 * Video Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class VideoPopupCallout
 */
class VideoPopupCallout {
    /**
     * VideoPopupCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_video_popup_callout_mapping' ), 99 );
        add_shortcode( 'kc_video_popup_callout', array( $this, 'kc_video_popup_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_video_popup_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_video_popup_callout' => array(
                        'name'        => __( 'Video Popup Callout', 'msteele' ),
                        'description' => __( 'Display video with FitVid', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Content',
                        'params'      => array(
                            'Video'        => array(
                                array(
                                    'name'        => 'videoimg',
                                    'label'       => 'Video Image',
                                    'type'        => 'attach_image',
                                    'description' => '',
                                ),
                                array(
                                    'name'        => 'video',
                                    'label'       => 'Video Code',
                                    'type'        => 'text',
                                    'description' => '',
                                ),
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
    function kc_video_popup_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'video'              		=> '',
                    'videoimg'                  => '',
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
        <div class="video-callout <?php echo $atts['class']; ?>">
            <div class="video-inner" <?php echo $animation; ?>>
	            <?php 
                    $video = $atts['video'];
                    $ImageID = $atts['videoimg']; 
                    $img_src    = wp_get_attachment_image_url( $ImageID, 'full' );
                    $img_srcset = wp_get_attachment_image_srcset( $ImageID, 'full' );
                    $sizes      = wp_get_attachment_image_sizes( $ImageID, 'full' );
                    $alt        = get_post_meta( $ImageID, '_wp_attachment_image_alt', true ); 
                ?>
                <div class="video-section">
		            <?php if( $video ) : ?>
			        	<div id="intro-video">
    						<div class="fluid-width-video-wrapper">
                                <?php //echo "<pre>"; print_r($img_src); echo "</pre>"; ?>
    			                <img src="<?php echo $img_src; ?>" alt="<?php echo $alt; ?>">
                                <div class="video-icon">
                                    <a href="<?php echo $video; ?>" data-lity>
                                        <img src="<?php bloginfo('template_url'); ?>/images/play-icon.svg" alt="<?php echo $alt; ?>">
                                    </a>
                                </div>
    				 		</div>
			        	</div>
		            <?php endif; ?>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}

new VideoPopupCallout();
