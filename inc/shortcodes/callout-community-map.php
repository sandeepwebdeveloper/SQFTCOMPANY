<?php
/**
 * Map Call Out
 *
 * @author  Sohrab
 * @package msteele
 */

/**
 * Class CommunityMapCallout
 */
class CommunityMapCallout {
	/**
	 * CommunityMapCallout constructor.
	 */
	function __construct() {
		add_action( 'init', array( $this, 'kc_community_map_callout_mapping' ), 99 );
		add_shortcode( 'kc_community_map_callout', array( $this, 'kc_community_map_callout_html' ) );

	}

	/**
	 * Map element
	 * @since 1.0.0
	 */
	function kc_community_map_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_community_map_callout' => array(
						'name'        => __( 'Community Map Call Out', 'msteele' ),
						'description' => __( 'Display a Google map', 'msteele' ),
						'icon'        => '',
						'category'    => 'Content',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'latitude',
									'label'       => 'Latitude',
									'type'        => 'text',
									'description' => 'Enter location latitude',
								),
								array(
									'name'        => 'longitude',
									'label'       => 'Longitude',
									'type'        => 'text',
									'description' => 'Enter location longitude',
								),
								array(
									'name'        => 'map_pin',
									'label'       => 'Map Pin',
									'type'        => 'attach_image',
									'description' => 'Map Pin',
								),
								array(
									'name'        => 'map_content',
									'label'       => 'Content',
									'type'        => 'textarea',
									'description' => 'Content',
								),
								array(
									'name'    => 'show_waze',
									'label'   => 'Enable Waze Map',
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
	function kc_community_map_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'class'                     => '',
					'latitude'                  => '',
					'longitude'                 => '',
					'map_pin'                   => '',
					'map_content'               => '',
					'show_waze'                 => '',
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

		$id         = $atts['map_pin'];
		$img_src    = wp_get_attachment_image_url( $id, 'full' );


		// start the output
		ob_start(); ?>
        <div class="community-map-callout <?php echo $atts['class']; ?>">

            <div class="map-content" <?php echo $animation; ?>>
		<?php
		// check to see if user enabled smooth scroll
				if ( $atts['show_waze'] == 'option_yes' ):	
		?>
				<div class="wrapper-waze-map">
					<iframe id="map-waze" src="https://embed.waze.com/iframe?zoom=16&lat=<?php echo $atts['latitude']; ?>&lon=<?php echo $atts['longitude']; ?>&ct=livemap&pin=1" width="600" height="450" allowfullscreen></iframe>
				</div>
				<?php else: ?>
					<!-- Google map location -->
					<div id="map-canvas" class="google-map"
						data-map-type="ROADMAP"
						data-zoom="15"
						data-pin-icon="<?php echo $img_src; ?>"
						data-latitude="<?php echo $atts['latitude']; ?>"
						data-longitude="<?php echo $atts['longitude']; ?>"
						<?php if ( $atts['map_content'] ) : ?> data-address="<?php echo $atts['map_content']; ?>"<?php endif; ?>
						data-pan-control="true" data-zoom-control="true" data-map-type-control="true"
						data-scale-control="true"
						data-draggable="true"
						data-modify-coloring="true" data-saturation="-100" data-lightness="-40" data-hue="#373737">
					</div>
				<?php endif; ?>
			</div>
        </div>
		<?php

		return ob_get_clean();

	}
}


new CommunityMapCallout();
