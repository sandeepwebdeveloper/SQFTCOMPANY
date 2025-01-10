<?php
/*
Element Description: Gallery Callout
@author: Sohrab
*/

// Element Class
class GalleryCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_gallery_callout_mapping' ), 99 );
		add_shortcode( 'kc_gallery_callout', array( $this, 'kc_gallery_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_gallery_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_gallery_callout' => array(
						'name'        => __( 'Gallery Callout', 'msteele' ),
						'description' => __( 'Display gallery images', 'msteele' ),
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
	function kc_gallery_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'gallery'   => '',
					'animation' => '',
					'class'     => '',
				),
				$atts
			)
		);

		// start the output
		ob_start();

		$name = $atts['gallery'];

		$gallery_post_id = get_page_by_title( $name, OBJECT, 'gallery' );
		$images          = get_field( 'ms_toolkit_gallery', $gallery_post_id );
	
		if ( $images ): ?>
			<?php 	$inc = 0;$inc++; ?>
			    <div class="slider-wrapper">
					<div class="swiper-container swiper-gallery">
						<div class="swiper-wrapper lightboxGallery">
							<?php foreach ( $images as $image ): ?>
								<div class="swiper-slide" role="group">
									<a rel="rel<?php echo $inc; ?>" href="<?php echo $image['url']; ?>">
										<img class="gallery-image-src" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
		<?php endif;

		return ob_get_clean();


	}
} // end Element Class


// element Class Init
new GalleryCallout();