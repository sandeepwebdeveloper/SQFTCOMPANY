<?php
/**
 * Content Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class neighbourMapCallout
 */
class neighbourMapCallout {
    /**
     * neighbourMapCallout constructor.
     */
    function __construct() {
        add_action( 'init', array( $this, 'kc_neighbourmaps_callout_mapping' ), 99 );
        add_shortcode( 'kc_neighbourmaps_callout', array( $this, 'kc_neighbourmaps_callout_html' ) );

    }
    /**
     * Map element
     * @since 1.0.0
     */
    function kc_neighbourmaps_callout_mapping() {

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map(
                array(

                    'kc_neighbourmaps_callout' => array(
                        'name'        => __( 'Neighbour Map Callout', 'msteele' ),
                        'description' => __( 'Display Neighbour Map', 'msteele' ),
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
    function kc_neighbourmaps_callout_html( $atts ) {
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
        <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args  = array(
				'suppress_filters' => true,
				'post_type'        => 'neighbour-map',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
                <div class="floorviews-callout <?php echo $atts['class']; ?>">
                    <div class="floorviews-inner" <?php echo $animation; ?>>
                        <div class="row">
                            <div class="col-xl-3 order-2 order-xl-1">
                               <div class="accordion" id="accordionExample">
                                    <?php 
                                        $features_M = 0;
                                        while ( $the_query->have_posts() ) : $the_query->the_post(); 
                                        $features_M++;
                                        if($features_M == 1) {
                                            $show_class = 'collapse show';
                                            $collasped = 'collapse-in';
                                        }else {
                                            $show_class = 'collapse';
                                            $collasped = 'collapsed';
                                        }
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-<?php echo $features_M; ?>">
                                        <?php 
                                            $text = get_the_title();
                                            $stripped_text = wp_strip_all_tags($text);
                                            $stripped_text;
                                        ?>
                                            <button id="#img<?php echo $stripped_text; ?>" class="accordion-button cards__title <?php echo $collasped;  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $features_M; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $features_M; ?>">
                                                <div class="floor-title">
                                                    <?php the_title(); ?>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse-<?php echo $features_M; ?>" class="accordion-collapse <?php echo $show_class;  ?>" aria-labelledby="heading-<?php echo $features_M; ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php  echo $floorListing = get_field('ms_toolkit_neighbour_map_description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="col-xl-9 order-1 order-xl-2">
                                <div class="floors-image-block">
                                    <?php 
                                        $features_M = 0;
                                        while ( $the_query->have_posts() ) : $the_query->the_post(); 
                                        $features_M++;
                                        if($features_M == 1) {
                                            $show_class = 'in show';
                                            $collasped = 'collapse-in';
                                        }else {
                                            $show_class = ' ';
                                            $collasped = 'collapsed';
                                        }
                                            $text = get_the_title();
                                            $stripped_text = wp_strip_all_tags($text);
                                             $stripped_text;
                                    ?>
                                    <div id="img<?php echo $stripped_text; ?>" class="floor-image pageAttr">
                                        <?php  $floorImg = get_field('ms_toolkit_neighbour_map_preview'); ?>
                                        <img src="<?php echo $floorImg['url']; ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        <?php endif; ?>
        <?php

        return ob_get_clean();

    }
}

new neighbourMapCallout();