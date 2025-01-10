<?php
/*
Element Description: List of blog posts with page navigation
@author: Sohrab
*/

// Element Class
class FeaturesFinishesAccCallout {

	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'Features_Finishes__Acc_callout_mapping' ), 99 );
		add_shortcode( 'Features_Finishes__Acc_callout', array( $this, 'Features_Finishes__Acc_callout_html' ) );
	}

	/**
	 * Map element
	 */
	function Features_Finishes__Acc_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'Features_Finishes__Acc_callout' => array(
						'name'        => __( 'Features Accordion Callout', 'msteele' ),
						'description' => __( 'Feature Finishes Accordion', 'msteele' ),
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
	function Features_Finishes__Acc_callout_html( $atts ) {
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
				'post_type'        => 'feature',
				'posts_per_page'   => $post_number,
				'paged'            => $paged,
			);

			$the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="row" style="min-height:300px;">
					<div class="panel-group" id="accordion">
						<?php 
							$features_M = 0;
							while ( $the_query->have_posts() ) : $the_query->the_post(); 
							$features_M++;
							{
							if($features_M == 1) {
								$show_class = 'in show';
								$collasped = 'collapse-in';
							}else {
								$show_class = ' ';
								$collasped = 'collapsed';
							}
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" class="<?php echo $collasped; ?>" data-parent="#accordion" href="#collapse-<?php echo $features_M; ?>">
										<div class="d-flex justify-content-between">
											<span><?php the_title(); ?></span>
											<span>
												<i class="fa-solid fa-plus"></i>
												<i class="fas fa-minus"></i>
											</span>
											
										</div>
									</a>
								</h4>
							</div>
							<div id="collapse-<?php echo $features_M; ?>" class="panel-collapse collapse <?php //echo $show_class; ?>">
								<div class="panel-body">
									<ul>
									<?php if( have_rows('field_ms_toolkit_feature') ): ?>
										<?php  while( have_rows('field_ms_toolkit_feature') ) : the_row(); ?>
											<li><?php echo $sub_value = get_sub_field('field_ms_toolkit_feature_list'); ?></li>
										<?php   endwhile;
										endif; ?>
									</ul>
								</div>
							</div>
						</div>
					<?php } 
						endwhile; 
						wp_reset_postdata(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php
		return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FeaturesFinishesAccCallout();
