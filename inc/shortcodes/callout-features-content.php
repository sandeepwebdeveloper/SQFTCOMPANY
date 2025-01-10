<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class FeaturesContentCallout
 */
class FeaturesContentCallout {
    /**
     * FeaturesContentCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_Featurescontent_callout_mapping' ), 99 );
        add_shortcode( 'kc_Featurescontent_callout', array( $this, 'kc_Featurescontent_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_Featurescontent_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_Featurescontent_callout' => array(
                        'name'        => __( 'Features Content Callout', 'msteele' ),
                        'description' => __( 'Display Features content', 'msteele' ),
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
    function kc_Featurescontent_callout_html( $atts ) {
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
            <div class="features-inner valet-connected" <?php echo $animation; ?>>
                <div class="d-none d-xl-block">
                    <ul>
                        <li>
                            <span><img src="/wp-content/uploads/2024/05/connectted-icon.svg" alt="connected living redefined"></span>
                            <h3>connected living redefined
                                <span>GRANT EASY AND SECURE COURIER ACCESS FOR CONVENIENT PACKAGE DELIVERY</span>
                            </h3>
                        </li>

                        <li>
                            <span><img src="/wp-content/uploads/2024/05/virtual-keys.svg" alt="FACIAL & DIGITAL ENTRY"></span>
                            <h3>FACIAL & DIGITAL ENTRY
                                <span>NO KEYS? NO PROBLEM. ENTER THE BUILDING USING FACE ID OR THE DIGITAL KEYS ON YOUR MOBILE DEVICE</span>
                            </h3>
                        </li>

                        <li>
                            <span><img src="/wp-content/uploads/2024/05/virtual-keys.svg" alt="virtual keys"></span>
                            <h3>virtual keys
                                <span>ALLOW QUICK, SECURE GUEST ACCESS WITH VIRTUAL TEXT KEYS</span>
                            </h3>
                        </li>

                        <li>
                            <span><img src="/wp-content/uploads/2024/05/video-calling.svg" alt="VIDEO CALLING"></span>
                            <h3>VIDEO CALLING
                                <span>SEE WHO’S AT THE DOOR BEFORE LETTING THEM IN</span>
                            </h3>
                        </li>

                        <li>
                            <span><img src="/wp-content/uploads/2024/05/keyless-suites.svg" alt="KEYLESS SUITE ENTRY"></span>
                            <h3>KEYLESS SUITE ENTRY
                                <span>ENJOY EASY ACCESS TO YOUR SUITE USING ONLY YOUR MOBILE PHONE</span>
                            </h3>
                        </li>

                        <li>
                            <span><img src="/wp-content/uploads/2024/05/fast-internet.svg" alt="LIGHTNING-FAST INTERNET"></span>
                            <h3>LIGHTNING-FAST INTERNET
                                <span>WIRED FOR SPEED, ROGERS INTERNET PROVIDES SEAMLESS SERVICE</span>
                            </h3>
                        </li>
                        
                    </ul>
                </div>
                <div class="d-xl-none px-35 py-5">
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span><img src="/wp-content/uploads/2024/05/connectted-icon.svg" alt="connected living redefined"></span>
                                    <h3>connected living redefined</h3>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    GRANT EASY AND SECURE COURIER ACCESS FOR CONVENIENT PACKAGE DELIVERY                            
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span><img src="/wp-content/uploads/2024/05/virtual-keys.svg" alt="FACIAL & DIGITAL ENTRY"></span>
                                    <h3>FACIAL & DIGITAL ENTRY</h3>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    NO KEYS? NO PROBLEM. ENTER THE BUILDING USING FACE ID OR THE DIGITAL KEYS ON YOUR MOBILE DEVICE
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span><img src="/wp-content/uploads/2024/05/virtual-keys.svg" alt="virtual keys"></span>
                                    <h3>virtual keys</h3>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    ALLOW QUICK, SECURE GUEST ACCESS WITH VIRTUAL TEXT KEYS
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    <span><img src="/wp-content/uploads/2024/05/video-calling.svg" alt="VIDEO CALLING"></span>
                                    <h3>VIDEO CALLING</h3>
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    SEE WHO’S AT THE DOOR BEFORE LETTING THEM IN
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    <span><img src="/wp-content/uploads/2024/05/keyless-suites.svg" alt="KEYLESS SUITE ENTRY"></span>
                                    <h3>KEYLESS SUITE ENTRY</h3>
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    ENJOY EASY ACCESS TO YOUR SUITE USING ONLY YOUR MOBILE PHONE
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    <span><img src="/wp-content/uploads/2024/05/fast-internet.svg" alt="LIGHTNING-FAST INTERNET"></span>
                                    <h3>LIGHTNING-FAST INTERNET</h3>
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    WIRED FOR SPEED, ROGERS INTERNET PROVIDES SEAMLESS SERVICE
                                </div>
                            </div>
                        </div>                        
                    </div>

                </div>

            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}

new FeaturesContentCallout();