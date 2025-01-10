<?php
/*
Element Description: List of blog posts with page navigation
@author: Sohrab
*/

// Element Class
class BlogArchiveCallout {

	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_blog_archive_callout_mapping' ), 99 );
		add_shortcode( 'kc_blog_archive_callout', array( $this, 'kc_blog_archive_callout_html' ) );
	}

	/**
	 * Map element
	 */
	function kc_blog_archive_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_blog_archive_callout' => array(
						'name'        => __( 'Blog Archive Callout', 'msteele' ),
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
	function kc_blog_archive_callout_html( $atts ) {
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
				'post_type'        => 'post',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="row">
					<?php $Hover_el = 0; while ( $the_query->have_posts() ) : $the_query->the_post();
						$Hover_el++;
						if($Hover_el % 2 == 0) {
							$Hover_Class = 'hover-x';
						} else {
							$Hover_Class = 'hover-o';
						}
					?>
						<div class="col-md-6 col-lg-4 col-xl-3 pb-5">
							<div class="blog-item h-100 ">
								
									<?php
									$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb-size' );
									if (has_post_thumbnail( $post->ID ) ): ?>
									<div class="post-thumbnail">
										<a target="_blank" href="<?php echo get_field('field_post_source_link'); ?>">
											<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>">
											<span class="<?php echo $Hover_Class; ?>"></span>
										</a>
										
									</div>
									
									<div class="post-details-inner">
										<h2 class="title">
											<?php the_title();  ?>
											<?php /*  echo substr( get_the_title(), 0, 50 ); ?>
											<?php if ( strlen( get_the_title() ) > 50 ) {
												echo "...";
											} */ ?>
										</h2>
										<div class="meta-data">
											<span class="time"><?php echo get_the_date( 'F j, Y' ); ?></span>
										</div>
										<div class="post-source">
											<span>
												<?php echo get_field('field_post_source_name'); ?>
											</span>
										</div>
										<div class="read-more">
											<?php if(get_field('field_post_source_link')) { ?>
												<a target="_blank" class="blog-btn" href="<?php echo get_field('field_post_source_link'); ?>">READ MORE</a>
											<?php } else { ?>
												<a class="blog-btn" href="<?php the_permalink(); ?>">READ MORE</a>
											<?php } ?>
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
new BlogArchiveCallout();
