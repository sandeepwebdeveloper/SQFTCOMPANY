<?php
/**
 * Image Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class ImageCallout
 */
class ImageContentCallout {
    /**
     * ImageCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_image_content_callout_mapping' ), 99 );
        add_shortcode( 'kc_image_content_callout', array( $this, 'kc_image_content_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_image_content_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_image_content_callout' => array(
                        'name'        => __( 'Image with content Call Out', 'msteele' ),
                        'description' => __( 'Display an image', 'msteele' ),
                        'icon'        => '',
                        'category'    => 'Media',
                        'params'      => array(
                            'Images'        => array(
                                array(
                                    'name'        => 'image',
                                    'label'       => 'image',
                                    'type'        => 'attach_image',
                                    'description' => 'image',
                                ),
                                array(
                                    'name'        => 'imagetitle',
                                    'label'       => 'Image Title',
                                    'type'        => 'text',
                                    'description' => 'Image Title',
                                ),
                                array(
                                    'name'        => 'imagesubtitle',
                                    'label'       => 'Image Sub Title',
                                    'type'        => 'text',
                                    'description' => 'Image Sub Title',
                                ),
                                array(
                                    'name'        => 'imagecontent',
                                    'label'       => 'Image Title',
                                    'type'        => 'textarea',
                                    'description' => 'Image Title',
                                ),
                                array(
                                    'name'        => 'imagelink',
                                    'label'       => 'Image link',
                                    'type'        => 'link',
                                    'description' => 'Image link',
                                ),

                            ),
                            'Link'          => array(
                                array(
                                    'name'        => 'link',
                                    'label'       => 'link',
                                    'type'        => 'link',
                                    'value'       => '',
                                    'description' => 'Link for the image',
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
    function kc_image_content_callout_html( $atts ) {
        // params extraction
        extract(
            shortcode_atts(
                array(
                    'image'                     => '',
                    'link'                      => '',
                    'imagetitle'                => '',
                    'imagesubtitle'             => '',
                    'imagecontent'              => '',
                    'imagelink'                 => '',
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
        <div class="image-callout <?php echo $atts['class']; ?>">

            <?php $id   = $atts['image'];
            $img_src    = wp_get_attachment_image_url( $id, 'full' );
            $img_srcset = wp_get_attachment_image_srcset( $id, 'full' );
            $sizes      = wp_get_attachment_image_sizes( $id, 'full' );
            $alt        = get_post_meta( $id, '_wp_attachment_image_alt', true ); 
            $imagetitle = $atts['imagetitle']; 
            $imagesubtitle = $atts['imagesubtitle'];
            $imagecontent = $atts['imagecontent']; 
            $imagelink = $atts['imagesubtitle']; 
            ?>

            <div class="image-content position-relative overlay-img" <?php echo $animation; ?>>

                <?php if ( ! empty( $link_arr[0] ) ) : ?>
                <a href="<?php echo $link_arr[0]; ?>" target="<?php echo $link_arr[2]; ?>">
                    <?php endif; ?>
                    <img src="<?php echo $img_src; ?>"
                         srcset="<?php echo esc_attr( $img_srcset ); ?>"
                         sizes="<?php echo esc_attr( $sizes ); ?>"
                         alt="<?php echo esc_attr( $alt ); ?>" class="img-fluid" />
                         <?php if($imagetitle) { ?>
                            <div class="img-content">
                                <div class="img-content__title">
                                    <h3><?php echo esc_html_e($imagetitle); 
                                       // echo "Yes: ". $var = str_replace(array("\r\n","\n"),'<br>', $imagetitle);
                                    ?></h3>
                                </div>
                                <div class="img-content__bg">
                                    <div class="img-content__bg">
                                        <h3><?php echo $imagesubtitle; ?></h3>
                                        <p><?php echo $imagecontent; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php if ( ! empty( $link_arr[0] ) ) : ?>
                </a>
            <?php endif; ?>

            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}


new ImageContentCallout();