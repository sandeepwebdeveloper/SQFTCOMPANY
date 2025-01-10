<?php
/*
Element Description: List of blog posts with page navigation
@author: Sohrab
*/

// Element Class
class FeaturesFinishesCallout {

	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'Features_Finishes_callout_mapping' ), 99 );
		add_shortcode( 'Features_Finishes_callout', array( $this, 'Features_Finishes_callout_html' ) );
	}

	/**
	 * Map element
	 */
	function Features_Finishes_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'Features_Finishes_callout' => array(
						'name'        => __( 'Features & Finishes Callout', 'msteele' ),
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
	function Features_Finishes_callout_html( $atts ) {
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
				<div class="row py-5">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();  ?>
					<div class="col-md-6 pb-5">
					<h3 class="pb-4"><?php the_title(); ?></h3>
					<ul>
						<?php if( have_rows('field_ms_toolkit_feature') ): ?>
						<?php  while( have_rows('field_ms_toolkit_feature') ) : the_row(); ?>
								<li><?php echo $sub_value = get_sub_field('field_ms_toolkit_feature_list'); ?></li>
						<?php   
							endwhile;
							endif; 
						?>
					</ul>
					</div>
				<?php endwhile;  ?>
				<?php /*
						<div class="col-md-3 pr-md-0">
							<ul class="nav nav-tabs tabs-left">
								<?php 
									$features = 0;
									while ( $the_query->have_posts() ) : $the_query->the_post(); 
									$features++;
									{
									if($features == 1) {
										$active_class = 'active';
									}else {
										$active_class = ' ';
									}
								?>
								<li>
									<a class="<?php echo $active_class; ?>" href="#tab-<?php echo $features; ?>" data-toggle="tab"><?php the_title(); ?></a>
								</li>
								<?php } 
								endwhile; 
								wp_reset_postdata(); ?>
							</ul>
						</div>
						*/?>
						<?php /*
						<div class="col-md-9 pl-md-0">
							<!-- Tab panes -->
							<div class="tab-content">
							<?php 
									$features_1 = 0;
									while ( $the_query->have_posts() ) : $the_query->the_post(); 
									$features_1++;
									{
									if($features_1 == 1) {
										$active_class = 'active';
									}else {
										$active_class = 'NoActive';
									}
								?>
								<div class="tab-pane <?php echo $active_class; ?>" id="tab-<?php echo $features_1; ?>">
									<ul>
										<?php if( have_rows('field_ms_toolkit_feature') ): ?>
											<?php  while( have_rows('field_ms_toolkit_feature') ) : the_row(); ?>
											<li><?php echo $sub_value = get_sub_field('field_ms_toolkit_feature_list'); ?></li>
										<?php   endwhile;
										endif; ?>
									</ul>
								</div>
								<?php } 
								endwhile; 
								wp_reset_postdata(); ?>
							</div>
						</div> */?>

					</div>
					<?php /*

						<div class="panel-group d-block d-xl-none" id="accordion">
							<?php 
								$features_M = 0;
								while ( $the_query->have_posts() ) : $the_query->the_post(); 
								$features_M++;
								{
								if($features_M == 1) {
									$show_class = 'in show';
								}else {
									$show_class = ' ';
								}
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $features_M; ?>">
											<?php the_title(); ?>
										</a>
									</h4>
								</div>
								<div id="collapse-<?php echo $features_M; ?>" class="panel-collapse collapse <?php echo $show_class; ?>">
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
					</div> */?>
			<?php endif; ?>
		</div>

		<?php
		return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FeaturesFinishesCallout();
