<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class RegisterFormCallout
 */
class RegisterFormCallout {
    /**
     * RegisterFormCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_registerform_callout_mapping' ), 99 );
        add_shortcode( 'kc_registerform_callout', array( $this, 'kc_registerform_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_registerform_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_registerform_callout' => array(
                        'name'        => __( 'Register Form Callout', 'msteele' ),
                        'description' => __( 'Display content', 'msteele' ),
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
    function kc_registerform_callout_html( $atts ) {
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
        <div class="formcode">
        <form action="https://e.lifetimedevelopments.com/l/1027973/2023-05-02/9f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="text" name="first_name" id="firstname" placeholder="First Name">
                        <label for="firstname">First Name<span>*</span></label>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="text" name="last_name" id="LastName" placeholder="Last Name">
                        <label for="LastName">Last Name<span>*</span></label>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="email" name="email_address" id="email" placeholder="Email">
                        <label for="email">Email<span>*</span></label>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="text" name="phone" id="phone" placeholder="Phone">
                        <label for="phone">Phone<span>*</span></label>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="text" name="city" id="city" placeholder="City">
                        <label for="city">City<span>*</span></label>
                    </div>
                </div> 
                <div class="col-6 col-md-4">
                    <div class="field">
                        <input required type="text" name="postal_code" id="postalcode" placeholder="Postal Code">
                        <label for="postalcode">Postal Code<span>*</span></label>
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="field">
                        <input type="text" name="what_amenities_are_you_interested_in" id="amenityintrested" placeholder="What amenities are you interested in?">
                        <label for="amenityintrested">What amenities are you interested in? </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field select-field mt-md-0">
                        <label for="hear">Where did you hear about us?</label>
                        <select name="where_did_you_hear_about_us" class="required mt-0" id="mce-HDYH">
                            <option value="">Select...</option>
                            <option value="Eblast">Eblast</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Google">Google</option>
                            <option value="Instagram">Instagram</option>
                            <option value="A-Frames">A-Frames</option>
                            <option value="UrbanToronto">UrbanToronto</option>
                            <option value="Buzz Buzz Homes">Buzz Buzz Homes</option>
                            <option value="Word of Mouth">Word of Mouth</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field select-field">
                        <label for="desiresuits">What type of suite are you interested in?</label>
                        <select  name="what_type_of_suite_are_you_interested_in" class="required mt-0" id="mce-HDYH">
                            <option value="">Select...</option>
                            <option value="Studio">Studio</option>
                            <option value="One bedroom">One bedroom</option>
                            <option value="One bedroom+">One bedroom+</option>
                            <option value="Two bedroom">Two bedroom</option>
                            <option value="Two bedroom+">Two bedroom+</option>
                            <option value="Three bedroom+">Three bedroom+</option>
                            <option value="Penthouse Units">Penthouse Units</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field select-field">
                        <label for="suitesize">What size of suite are you interested in?</label>
                        <select  name="what_size_of_suite_are_you_interested_in" class="required mt-0" id="mce-HDYH">
                            <option value="">Select...</option>
                            <option value="&lt;500 sq. ft">&lt;500 sq. ft</option>
                            <option value="501 - 600 sq. ft">501 - 600 sq. ft</option>
                            <option value="601 - 700 sq. ft">601 - 700 sq. ft</option>
                            <option value="701 - 800 sq. ft">701 - 800 sq. ft</option>
                            <option value="801 - 900 sq. ft">801 - 900 sq. ft</option>
                            <option value="901 - 1000 sq. ft">901 - 1000 sq. ft</option>
                            <option value="1000 sq. ft +">1000 sq. ft +</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="field select-field">
                        <label for="reasonbuy">What is the reason for buying? </label>
                        <select  name="what_is_the_reason_for_buying" class="required mt-0" id="mce-HDYH">
                            <option value="">Select...</option>
                            <option value="First-time buyer">First-time buyer</option>
                            <option value="Investor">Investor</option>
                            <option value="Down-sizing">Down-sizing</option>
                            <option value="Up-sizing">Up-sizing</option>
                            <option value="End user">End user</option>
                            <option value="International Buyer">International Buyer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field select-field">
                        <label for="suitesize">How old are you?</label>
                        <select name="how_old_are_you" class="required mt-0" id="mce-HDYH">
                            <option value="">Select...</option>
                            <option value="21-25">21-25</option>
                            <option value="26-30">26-30</option>
                            <option value="31-35">31-35</option>
                            <option value="36-40">36-40</option>
                            <option value="41-45">41-45</option>
                            <option value="46-50">46-50</option>
                            <option value="51-55">51-55</option>
                            <option value="56-60">56-60</option>
                            <option value="60+">60+</option>
                        </select>
                    </div>
                </div>   
            </div>

            <div class="row text-left">

                <div class="col-md-4">
                    <div class="field radio-field">
                        <label for="reasonbuy">Are you a realtor?</label>
                        <ul>
                            <li>
                                <input type="radio" value="Yes" name="are_you_realtor" id="mce-MMERGE7-0">
                                <label for="mce-MMERGE7-0">Yes</label>
                            </li>
                            <li>
                                <input type="radio" value="No" name="are_you_realtor" id="mce-MMERGE7-1">
                                <label for="mce-MMERGE7-1">No</label>
                            </li>
                        </ul>
                            <div class="field mt-4" style="display:none" id="brokeragefield">
                        <input type="text" name="brokeragename" id="brokeragename" placeholder="Brokerage Name">
                        <label for="brokeragename">Brokerage Name</label>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field radio-field">
                        <label for="reasonbuy">Are you working with a realtor? </label>
                        <ul>
                            <li>
                                <input type="radio" value="Yes" name="are_you_working_with_realtor" id="mce-MMERGE10-0">
                                <label for="mce-MMERGE10-0">Yes</label>
                            </li>
                            <li>
                                <input type="radio" value="No" name="are_you_working_with_realtor" id="mce-MMERGE10-1">
                                <label for="mce-MMERGE10-1">No</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="field radio-field checkbox-style">
                            <ul class="for-disclaimer">
                                <li>
                                    <input required="required" type="checkbox" value="true" name="email_opt_in" id="disclaimer">
                                        <label for="disclaimer" class="form-disclaimer">
                <span>By clicking this box or by completing this Registration Form for Q Tower, I expressly provide my consent to receive electronic messages from Lifetime Developments, DiamondCorp, Q Tower and its affiliated companies retroactively, today and in the future for Q Tower and any projects by Lifetime Developments or DiamondCorp. I understand that I may withdraw my consent by unsubscribing anytime.</span>
                                        </label>
                                </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="submitt-button">
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit Now">
                    </div>
                </div>
            </div>
            </div>
        </form>
        </div>
        <?php

        return ob_get_clean();

    }
}

new RegisterFormCallout();