<?php
/*
Element Description: List of blog posts with page navigation
@author: Sohrab
*/

// Element Class
class FloorplansListingCallout {

	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'Floorplans_listing_callout_mapping' ), 99 );
		add_shortcode( 'Floorplans_listing_callout', array( $this, 'Floorplans_listing_callout_html' ) );
	}

	/**
	 * Map element
	 */
	function Floorplans_listing_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'Floorplans_listing_callout' => array(
						'name'        => __( 'Floorplans Listing Callout', 'msteele' ),
						'description' => __( 'List of Floorplans with PDFs download links', 'msteele' ),
						'icon'        => '',
						'category'    => 'Content',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'post_number',
									'label'       => 'Number of Posts to Show',
									'type'        => 'text',
									'description' => 'Enter number of initial floorplans to show',
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
	function Floorplans_listing_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'post_number' => '',
					'class'       => '',
				),
				$atts
			)
		);

		// check to see if user set number of posts to show
		if ( ! empty ( $atts['post_number'] ) ) {
			$post_number = $atts['post_number'];
		} else {
			$post_number = 6; // default to 6 posts
		}


		// start the output
		ob_start();
		?>
		<div class="blog-archive-callout <?php echo $atts['class']; ?>">
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args  = array(
				'suppress_filters' => true,
				'post_type'        => 'floor-plan',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="row">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post() ?>
						<div class="col-md-12">
							<div class="blog-item h-100">
								<a href="<?php the_permalink(); ?>">
									<?php
									//$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
									if (get_the_title() ): ?>
									<div class="post-thumbnail" style="background-image:url(<?php echo $featured_image[0]; ?>);">
									</div>
									<div class="post-details-inner d-flex align-items-center">
										<a target="_blank" href="<?php echo get_field('field_ms_toolkit_floor_plan_file'); ?>">
											<h3 class="title"> <?php the_title(); ?> </h3>
										</a>
										<a class="ml-auto text-white download-btn" download href="<?php echo get_field('field_ms_toolkit_floor_plan_file'); ?>">Download</a>
									</div>
									<?php else : ?>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FloorplansListingCallout();
