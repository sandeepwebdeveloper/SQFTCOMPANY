<?php
/*
Element Description: Slider callout
@author: Sohrab
*/

// Element Class
class SliderFullCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_Slider_Full_callout_mapping' ), 99 );
		add_shortcode( 'kc_Slider_Full_callout', array( $this, 'kc_Slider_Full_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_Slider_Full_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_Slider_Full_callout' => array(
						'name'        => __( 'Slider Full Callout', 'msteele' ),
						'description' => __( 'Display a Multiple slider With Custom Class', 'msteele' ),
						'icon'        => '',
						'category'    => 'Post Types',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'gallery',
									'label'       => 'Gallery Title',
									'type'        => 'text',
									'description' => 'Gallery',
								),
								array(
									'name'        => 'sliderclassname',
									'label'       => 'Slider Class Name',
									'type'        => 'text',
									'description' => 'Slider Class name',
								),

							),
							'Customization' => array(
								array(
									'name'        => 'animation',
									'label'       => 'Animation',
									'type'        => 'text',
									'description' => 'Enter AOS animation type, leave empty for no animation',
								),
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
	 */
	function kc_Slider_Full_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'gallery'                   => '',
					'sliderclassname'           => '',
					'animation'                 => '',
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
		ob_start();

		$name = $atts['gallery'];

		$gallery_post_id = get_page_by_title( $name, OBJECT, 'gallery' );
		$images          = get_field( 'ms_toolkit_gallery', $gallery_post_id );
		if ( $images ): ?>
		<div class="position-relative <?php echo $atts['class']; ?>">
            <div class="slider-callout swiper swiper-container full-slider <?php echo $atts['sliderclassname']; ?>">
                <div class="swiper-wrapper" <?php echo $animation; ?>>
					<?php foreach ( $images as $image ): ?>
                        <div class="swiper-slide">
							<div class="slider-img">
								<?php if(is_page('overview')){ ?>
									<img src="<?php echo $image['sizes']['slider-thumb-size']; ?>" alt="<?php echo $image['title']; ?>">
								<?php } else { ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
								<?php } ?>
								<?php if( $image['title']) { ?>
									<div class="slider-text">
										<h3><?php echo $image['title']; ?></h3>
									</div>
								<?php } ?>
								<?php if ( $image['caption'] ) : ?>
								<div class="video-icons">
									<img src="/wp-content/uploads/2023/11/play-icon.svg" alt="Video Play Here">
								</div>
								<?php endif; ?> 
							</div>
						</div>
					<?php endforeach; ?>
                </div>
				<div class="swiper-pagination"></div>
				
			</div>
			<div class="navigation-slider">
					<div class="slider-button-prev">
						<img src="/wp-content/uploads/2023/10/left-arrow.svg" alt="Left Arrow">
					</div>
					<div class="slider-button-next">
						<img src="/wp-content/uploads/2023/10/right-arrow.svg" alt="Right Arrow">
					</div>
				</div>
		</div>
		<?php endif;

		return ob_get_clean();
	}
} // end Element Class


// element Class Init
new SliderFullCallout();
