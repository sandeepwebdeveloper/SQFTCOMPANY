<?php
/*
Element Description: Floorplan Call Out
@author: Johnson
*/

// Element Class
class FloorplanPOPUPCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_floorplan__popup_callout_mapping' ), 99 );
		add_shortcode( 'kc_floorplan__popup_callout', array( $this, 'kc_floorplan__popup_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_floorplan__popup_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_floorplan__popup_callout' => array(
						'name'        => __( 'Floorplan With Popup Call Out', 'msteele' ),
						'description' => __( 'Display Floorplans', 'msteele' ),
						'icon'        => '',
						'category'    => 'Post Types',
						'params'      => array(
							'General' => array(
								array(
									'name'        => 'posts',
									'label'       => 'Number of posts to show',
									'type'        => 'text',
									'description' => 'Set number of posts, default is set to show all',
								),
								array(
									'name'        => 'loadmore_text',
									'label'       => 'Text for Load More button',
									'type'        => 'text',
									'description' => 'Set the text for Load More button',
								),
								array(
									'name'        => 'loadingmore_text',
									'label'       => 'Text for button while it is loading',
									'type'        => 'text',
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
	function kc_floorplan__popup_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'posts' => '',
					'loadmore_text' => '',
					'loadingmore_text' => '',
				),
				$atts
			)
		);

		// just for the sake of getting errors
		if ( ! empty( $atts['posts'] ) ) {
			$post_number = $atts['posts'];
		} else {
			$post_number = '-1'; // set the default post number to unlimited
		}
		// start the output
		ob_start();
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$query_args_terms = ( array(
			'public'         => true,
			'post_type'      => 'floor-plan',
			//'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'posts_per_page' => $post_number,
			'paged'          => $paged
		) );
		$all_unit_terms   = get_terms( 'floor-plan-category', $query_args_terms );

		$query_args = ( array(
			'public'         => true,
			'post_type'      => 'floor-plan',
			'orderby'        => 'menu_order',
			'hide_empty'     => true,
			'posts_per_page' => $post_number,
			'paged'          => $paged
		) );
		$terms      = get_terms( 'floor_plan_bedroom', $query_args );
		?>

        <?php
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query_args = ( array(
			'public'         => true,
			'post_type'      => 'floor-plan',
			'order'          => 'DESC',
			//'orderby'        => 'term_order',
			'posts_per_page' => -1,
			'paged'          => $paged
		) );
		$the_query  = new WP_Query( $query_args );
		?>

  


        <div class="floor-plans-callout">
			<div class="row">
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-6">
							<div class="floorplans__wrap">
								<div class="floorplans__image">
									<?php $floorplan_image = get_field('field_ms_toolkit_floor_plan_preview'); 
										$Imgurl = $floorplan_image['url'];
										$alt = $floorplan_image['alt'];
									?>
									<img src="<?php echo $Imgurl; ?>" alt="<?php echo $alt; ?>">
								</div>
								<div class="floorplans__title">
									<h3><?php the_title(); ?></h3>
								</div>
								<div class="floorplans__down pt-4 pb-2">
									<?php $field_floor_plan_file = get_field('field_ms_toolkit_floor_plan_file'); 
									
									?>
									<a target="_blank" class="btn btn-primary" href="<?php echo $field_floor_plan_file; ?>">
										ENLARGE
									</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>	
			</div>
		</div>
                        <?php /*
						<section id="<?php echo $slug_new; ?>" class="tab-panel">
                          
								
                            <div class="floorplans_grid">
								<div class="row">
									<?php if ( $the_query->have_posts() ) : ?>
											<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
												<?php global $post; ?>
				                                <div class="col-12 col-sm-6 col-md-4 floor-plan-single filter <?php $terms_cpt = get_the_terms( $post->ID, 'floor_plan_bedroom' );
													foreach ( $terms_cpt as $term2 ) {
													echo $term2->slug . '-';
													} ?><?php $terms_cpt_cat = get_the_terms( $post->ID, 'floor-plan-category' );
													foreach ( $terms_cpt_cat as $term3 ) {
													echo $term3->slug . ' '.$term3->slug;
													} ?>">

													<a href="<?php echo the_permalink(); ?>" class="floorplans-btn">
														<div class="floorplan-box hvr-box">
									                        <div class="floor-plan-image">
																<div class="hover-floorplan">

																	<?php
																	$floorplan_image = get_field('field_ms_toolkit_floor_plan_preview');

																	if( !empty($floorplan_image) ):

																	// vars
																	$url = $floorplan_image['url'];
																	$title = $floorplan_image['title'];
																	$alt = $floorplan_image['alt'];
																	$caption = $floorplan_image['caption'];

																	// thumbnail
																	$size = 'floorplan-500x879';
																	$thumb = $floorplan_image['sizes'][ $size ];
																	$width = $floorplan_image['sizes'][ $size . '-width' ];
																	$height = $floorplan_image['sizes'][ $size . '-height' ];
																	?>

																		<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

																	<?php endif; ?>
																</div>
									                        </div>

									                        <div class="floor-plan-description">
									                        	<h2 class="floor-title py-4"><?php the_title(); ?></h2>
										                        <?php
											                        $fp_description = get_field( 'field_ms_toolkit_floor_plan_description' );
											                        $description = str_replace("\n", '<br />', $fp_description); ?>
										                        <p><?php echo $description; ?></p>
																<a class="btn btn-primary" href="<?php the_permalink(); ?>">View</a>
									                        </div>
														</div>
													</a>

				                                </div>
											<?php endwhile; ?>
										<?php endif; ?>
									</div>
							</div> <!-- /floorplans_grid -->

                        </section>
						
						*/?>


		<?php
		return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FloorplanPOPUPCallout();
