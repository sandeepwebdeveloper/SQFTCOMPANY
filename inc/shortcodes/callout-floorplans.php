<?php
/*
Element Description: Floorplan Call Out
@author: Johnson
*/

// Element Class
class FloorplanCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_floorplan_callout_mapping' ), 99 );
		add_shortcode( 'kc_floorplan_callout', array( $this, 'kc_floorplan_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_floorplan_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_floorplan_callout' => array(
						'name'        => __( 'Floorplan Call Out', 'msteele' ),
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
	function kc_floorplan_callout_html( $atts ) {
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

		<script type='text/javascript' src='/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
		<script>
            jQuery(document).ready(function ($) {
                var filter_button = ".filter-button";
				var filter_button_mobile = ".filter_button_mobile";
                var filter_link = ".filter";
				jQuery("#town").css("display","none");
				jQuery(".town").css("display","none");
				// alert($(window).width());
				if($(window).width() > 1200){
					$(filter_button).click(function () {
                    var value = $(this).attr('data-filter');
					console.log(value);
                    if (value === "suites") {
                        $(".suites-all").show('1000');

                    }
                    else {
                        $(filter_link).not('.' + value).hide('3000');
                        $(filter_link).filter('.' + value).show('3000');

                    }
                    if ($(filter_button).removeClass("active")) {
                        $(this).removeClass("active");
                    }
                    $(this).addClass("active");
                });
				} else {
				// alert($(window).width());
				$(filter_button_mobile).change(function () {
					// alert($(window).width());

                    var value = $(this).val();
					// alert(value);
                    if (value === "all") {
                        $(".suites-all").show('1000');

                    }
                    else {
                        $(filter_link).not('.' + value).hide('3000');
                        $(filter_link).filter('.' + value).show('3000');

                    }
                    if ($(filter_button_mobile).removeClass("active")) {
                        $(this).removeClass("active");
                    }
                    $(this).addClass("active");
                });
				}
                

                // in here we fake it to make it
                $(".tabset .town").change(function () {
                    if (this.checked) {
                        $("div.floor-plans-nav button:first-child").addClass("active");
                        $('#town .active').trigger('click');
                        $('.tabset .tab-panel').hide();
                        $('#town').show();

                    }
                });
                $(".tabset .condo").change(function () {
                    if (this.checked) {
                        $("div.floor-plans-nav button:first-child").addClass("active");
                        $('#condo .active').trigger('click');
                        $('.tabset .tab-panel').hide();
                        $('#condo').show();
                    }
                });


            });
        </script>

        <?php
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query_args = ( array(
			'public'         => true,
			'post_type'      => 'floor-plan',
			'order'          => 'DESC',
			'orderby'        => 'term_order',
			'posts_per_page' => 6,
			'paged'          => $paged
		) );
		$the_query  = new WP_Query( $query_args );
		?>

  


        <div class="floor-plans-callout">
            <div class="tabset">
				<div class="tabset-nav-wrap">
			<?php
				$term_counter = 0;
				foreach ( $all_unit_terms as $all_unit_term ) :
					$term_slug = $all_unit_term->slug; ?>

                    <input type="radio" name="tabset" class="<?php echo $term_slug; ?>"
                           id="tab-<?php echo $term_slug; ?>"
                           aria-controls="<?php echo $term_slug; ?>" <?php echo( $term_counter == 0 ? "checked" : "" ); ?>>
                    <label for="tab-<?php echo $term_slug; ?>"><?php echo $all_unit_term->name; ?></label>

					<?php $term_counter ++; ?>
				<?php endforeach; ?>
				</div>
                <div class="tab-panels">
					<?php foreach ( $all_unit_terms as $all_unit_term ) : $slug_new = $all_unit_term->slug; 
					// echo "<pre>"; print_r($all_unit_term); echo "</pre>";
					?>

						<?php
						foreach ( $terms as $term ) :$slug = $term->slug;
						
							$posts_ids                     = get_posts( array(
								'public'         => true,
								'post_type'      => 'floor-plan',
								//'order'          => 'ASC',
								//'orderby'        => 'term_order',
								'posts_per_page' => -1,
								"fields"         => "ids",
								"tax_query"      => array(
									array(
										'taxonomy' => 'floor-plan-category',
										'field'    => 'slug',
										'terms'    => $slug_new,
									),

								)
							) );
						endforeach;

						$terms_final_filter = wp_get_object_terms( $posts_ids, "floor_plan_bedroom" );
						//echo "<pre>"; print_r($terms_final_filter); echo "</pre>";

						?>
                        <section id="<?php echo $slug_new; ?>" class="tab-panel">
                            <div class="floor-plans-nav text-center d-none d-xl-block">
                                <button class="btn-default filter-button active" id="defaultBtn" data-filter="<?php echo "suites-all"; ?>" checked>All</button>
								<?php
								foreach ( $terms_final_filter as $filter_terms ) {
									$slug = $filter_terms->slug;
									echo '<button class="btn-default filter-button" data-filter="' . $slug . '-' . $slug_new . '" value="' . $slug . '-' . $slug_new . '">' . $filter_terms->name . '</button>';
								}
								?>
                            </div>

							<div class="floor-plans-nav text-center d-xl-none">
							<div class="row">
								<div class="col-md-12 dropdown">
								<select name="" class="filter_button_mobile">
									<option value="all">All</option>							
								<?php
								foreach ( $terms_final_filter as $filter_terms ) {
									$slug = $filter_terms->slug;
									echo '<option class="btn-default " data-filter="' . $slug . '-' . $slug_new . '" value="' . $slug . '-' . $slug_new . '">' . $filter_terms->name . '</option>';
								}
								?>
								</select>
								</div>
                            </div>
							</div>
                            <div class="floorplans_grid">
								<div class="row">
									<div class="filter suites-all suites">
										<div class="row">
											<?php  if ( $the_query->have_posts() ) : ?>
											<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
											<?php global $post; $totalpost=$the_query->post_count;?>
											<div class="col-12 col-sm-6 col-md-4 floor-plan-single mb-5">
												<div class="floorplan-box hvr-box">
													<div class="floor-plan-image">
														<div class="floor-plan-description">
															<h2 class="floor-title"><?php the_title(); ?></h2>
																<?php $fp_description = get_field( 'field_ms_toolkit_floor_plan_description' );
																$description = str_replace("n", '<br />', $fp_description); ?>
																<p><?php echo $description; ?></p>
															<!-- <a class="btn btn-primary" href="<?php the_permalink(); ?>">View</a> -->
															</div>
															<div class="hover-floorplan">
																<?php
																$floorplan_image = get_field('field_ms_toolkit_floor_plan_preview');

																if( !empty($floorplan_image) ):

																// vars
																$url = $floorplan_image['url'];
																$title = $floorplan_image['title'];
																$alt = $floorplan_image['alt'];
																$caption = $floorplan_image['caption'];
																?>
																	<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
																<?php endif; ?>
															</div>
															<div class="download-btn">
																<a target="_blank" href="<?php  echo $floorplans_pdf = get_field( 'field_ms_toolkit_floor_plan_file' ); ?>">
																	Quick View
																</a>
															</div>
														</div>
													</div>
												</div>
											<?php endwhile; ?>
											<?php endif; ?>
										</div>
										<?php //echo "New Loop here"; ?>
				                    	<?php  echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" pause="true" post_type="floor-plan" posts_per_page="6" offset="6"]'); ?>		

									</div>
									<div class="filter studio-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="studio" taxonomy_operator="IN"]'); ?>		

									</div>
									<div class="filter suites-1bed-suites 1bed-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="1bed" taxonomy_operator="IN"]'); ?>		

									</div>
									<div class="filter suites-1bed-den-suites 1bed-den-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="1bed-den" taxonomy_operator="IN"]'); ?>		

									</div>
									<div class="filter suites-2bed-suites 2-beds-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="2-beds" taxonomy_operator="IN"]'); ?>		

									</div>
									<div class="filter suites-2bed-den-suites 2-beds-den-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="2-beds-den" taxonomy_operator="IN"]'); ?>		

									</div>
									<div class="filter suites-3bed-suites 3-bed-suites suites">
				                    	<?php 
										echo do_shortcode('[ajax_load_more transition_container="false" id="4070463849" post_type="floor-plan" posts_per_page="6" taxonomy="floor_plan_bedroom" taxonomy_terms="3-bed" taxonomy_operator="IN"]'); ?>		

									</div>
									</div>
							</div> <!-- /floorplans_grid -->

                        </section>
					<?php endforeach; ?>
                </div>
            </div>
        </div>

		<?php
		return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FloorplanCallout();
