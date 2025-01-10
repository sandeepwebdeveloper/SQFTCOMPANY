<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class FeaturesTabsCallout
 */
class FeaturesTabsCallout {
    /**
     * FeaturesTabsCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_tabs_ff_callout_mapping' ), 99 );
        add_shortcode( 'kc_tabs_ff_callout', array( $this, 'kc_tabs_ff_callout_html' ) );

    }

    /**
     * Map element
     * @since 1.0.0
     */
    function kc_tabs_ff_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_tabs_ff_callout' => array(
                        'name'        => __( 'Features and Finishes Callout', 'msteele' ),
                        'description' => __( 'Display Tabs', 'msteele' ),
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
    function kc_tabs_ff_callout_html( $atts ) {
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
        <div class="tabs-callout <?php echo $atts['class']; ?>">
            <div class="tabs-inner" <?php echo $animation; ?>>
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args  = array(
				'suppress_filters' => true,
				'post_type'        => 'feature',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
                <div class="align-items-start d-none d-xl-flex">
                    <div class="col-xl-5">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php if ( $the_query->have_posts() ) : ?>
                                <?php $teamcount = 0; while ( $the_query->have_posts() ) : $the_query->the_post();  
                                    $teamcount++;
                                    if($teamcount == 1) {
                                        $classActive = 'active';
                                    }
                                    else {
                                        $classActive = 'not-active';
                                    }
                                ?>
                                <button class="nav-link <?php echo $classActive; ?>" id="v-pills-tab-<?php echo $teamcount; ?>" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $teamcount; ?>" type="button" role="tab" aria-controls="v-pills-<?php echo $teamcount; ?>" aria-selected="true">
                                    <span><img src="/wp-content/uploads/2024/05/tab-icon.svg" alt=""></span> <?php the_title(); ?>
                                </button>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                    <div class="offset-xl-1 col-xl-6">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php if ( $the_query->have_posts() ) : ?>
                            <?php $teamcount_1 = 0; while ( $the_query->have_posts() ) : $the_query->the_post();  
                                $teamcount_1++;
                                if($teamcount_1 == 1) {
                                    $activeShow = 'show active';
                                }
                                else {
                                    $activeShow = 'not-active';
                                }
                            ?>
                            <div class="tab-pane fade <?php echo $activeShow; ?>" id="v-pills-<?php echo $teamcount_1 ; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $teamcount_1 ; ?>">
                                <div class="tab-content">
                                        <?php //echo wpautop( get_the_content()); 
                                            
                                            $feature_list = get_field('ms_toolkit_feature');
                                        ?>
                                        <ul>
                                            <?php  foreach($feature_list as $feature_list_data) { ?>
                                            <?php //print_r($feature_list_data); ?>
                                                <li><?php echo $feature_list_data['ms_toolkit_feature_list']; ?></li>
                                            <?php } ?>
                                        </ul>
                                        
                                </div>
                            </div>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
                <div class="d-xl-none">
                <div class="accordion" id="accordionExample">
                    <?php if ( $the_query->have_posts() ) : ?>
                        <?php $teamcount_1 = 0; while ( $the_query->have_posts() ) : $the_query->the_post();  
                            $teamcount_1++;
                            if($teamcount_1 == 1) {
                                $activeShowM = 'collapse show';
                                $collapsed = 'collapse-no';
                            }
                            else {
                                $activeShowM = 'collapsed';
                                $collapsed = 'collapsed';

                            }
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $teamcount_1; ?>">
                                <button class="accordion-button <?php echo $collapsed; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $teamcount_1; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $teamcount_1; ?>">
                                    <?php the_title(); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?php echo $teamcount_1; ?>" class="accordion-collapse collapse <?php echo $activeShowM; ?> " aria-labelledby="heading-<?php echo $teamcount_1; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="">
                                    <?php //echo wpautop( get_the_content()); 
                                            
                                            $feature_list = get_field('ms_toolkit_feature');
                                        ?>
                                        <ul>
                                            <?php  foreach($feature_list as $feature_list_data) { ?>
                                            <?php //print_r($feature_list_data); ?>
                                                <li><?php echo $feature_list_data['ms_toolkit_feature_list']; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                
                                    <?php  if(get_field('ms_toolkit_teambuilder_innertag')) { ?>
                                        <a href="<?php echo get_field('ms_toolkit_teambuilder_link'); ?>" target="_blank" class="btn btn-primary "><?php echo get_field('ms_toolkit_teambuilder_linkTitle'); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }
}

new FeaturesTabsCallout();