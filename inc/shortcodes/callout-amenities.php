<?php
/*
Element Description: List of blog posts with page navigation
@author: Sohrab
*/

// Element Class
class Amenitiesblock {

	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_Amenities_Block__callout_mapping' ), 99 );
		add_shortcode( 'kc_Amenities_Block__callout', array( $this, 'kc_Amenities_Block__callout_html' ) );
	}

	/**
	 * Map element
	 */
	function kc_Amenities_Block__callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_Amenities_Block__callout' => array(
						'name'        => __( 'Amenities Callout', 'msteele' ),
						'description' => __( 'List of blog posts with page navigation', 'msteele' ),
						'icon'        => '',
						'category'    => 'Content',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'post_number',
									'label'       => 'Number of Posts to Show',
									'type'        => 'text',
									'description' => 'Enter number of initial posts to show',
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
	function kc_Amenities_Block__callout_html( $atts ) {
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
				'post_type'        => 'amenity',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="row">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post() ?>
						<div class="blog-item-column col-md-4">
							<div class="blog-item h-100">
									<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
										<div class="blog-items__image position-relative">
											<img src="<?php echo $featured_image[0] ; ?>" alt="">
											<span class="hover-popup gallery-group-callout">
												<a href="<?php echo $featured_image[0] ; ?>">
													<i class="fas fa-plus"></i>
												</a>
											</span>
										</div>
									<?php
									$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
									if (has_post_thumbnail( $post->ID ) ): ?>
									
									<div class="post-details-inner">
										<h2 class="title">
												<?php echo substr( get_the_title(), 0, 50 ); ?>
												<?php if ( strlen( get_the_title() ) > 50 ) {
													echo "...";
												} ?> // <span class="subtitle">
													<?php echo get_field('field_sud_title'); ?>
												</span>
										</h2>
										<div class="post-text">
											<?php the_content(); ?>
										</div>
									</div>
									<?php else : ?>
									<?php endif; ?>
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
new Amenitiesblock();
