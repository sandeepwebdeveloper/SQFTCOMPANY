<?php
/*
Element Description: Floorplan Call Out - theme file
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

		


        <?php
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query_args = ( array(
			'public'         => true,
			'post_type'      => 'floor-plan',
			'order'          => 'ASC',
			'meta_key' => 'ms_toolkit_floor_plan_area',
    		'orderby' => 'meta_value_num',
			//'orderby'        => 'term_order',
			'posts_per_page' => -1,
			'paged'          => $paged
		) );
		$the_query  = new WP_Query( $query_args );
		?>

  


        <div class="floor-plans-callout">
            <div class="tabset">
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
                <div class="tab-panels">
					<?php foreach ( $all_unit_terms as $all_unit_term ) : $slug_new = $all_unit_term->slug; ?>

						<?php
						foreach ( $terms as $term ) :$slug = $term->slug;
							$posts_ids                     = get_posts( array(
								'public'         => true,
								'post_type'      => 'floor-plan',
								//'order'          => 'ASC',
								//'orderby'        => 'term_order',
								'posts_per_page' => - 1,
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
						?>
                        <section id="<?php echo $slug_new; ?>" class="tab-panel">
                            <div class="floor-plans-nav text-center">
                            	<?php //if($slug_new=="all-plans") { ?>
                                	<button class="btn-default filter-button active" id="defaultBtn" data-filter="<?php echo $slug_new; ?>">All</button>
                            	<?php //} ?>
								<?php
								foreach ( $terms_final_filter as $filter_terms ) {
									$slug = $filter_terms->slug;
									$hometype=$filter_terms->name;
									echo '<button class="btn-default filter-button" data-filter="' . $slug . '-' . $slug_new . '" value="' . $slug . '-' . $slug_new . '">' . $filter_terms->name . '</button>';
								}
								?>
                            </div>

<div class="floorplans_grid">
<div class="row">



<?php  if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php global $post; $totalpost=$the_query->post_count;?>

<div class="col-12 col-sm-6 col-md-3 floor-plan-single filter <?php $terms_cpt = get_the_terms( $post->ID, 'floor_plan_bedroom' );
foreach ( $terms_cpt as $term2 ) {
echo $term2->slug . '-';
} ?><?php $terms_cpt_cat = get_the_terms( $post->ID, 'floor-plan-category' );
foreach ( $terms_cpt_cat as $term3 ) {
echo $term3->slug . ' '.$term3->slug;
} ?>">
<div class="col-md-12 floor-plan-single-item"> 
<a href="<?php echo the_permalink(); ?>" class="floorplans-btn">
<div class="floorplan-box hvr-box">
<div class="floor-plan-image">
<div class="hover-floorplan">

<?php
$floorplan_image = get_field('field_ms_toolkit_floor_plan_preview');
$suite_area = get_field('ms_toolkit_floor_plan_area');
//print_r($floorplan_image);

if( !empty($floorplan_image) ):

// vars
$url = $floorplan_image['url'];
$fimage = $floorplan_image['url'];
$title = $floorplan_image['title'];
$alt = $floorplan_image['alt'];
$caption = $floorplan_image['caption'];

// thumbnail
$size = 'floorplan-500x879';
$thumb = $floorplan_image['sizes'];
$width = $floorplan_image['sizes'][ $size . '-width' ];
$height = $floorplan_image['sizes'][ $size . '-height' ];
?>

<img src="<?php echo $fimage; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

<?php endif; ?>
</div>
</div>

<div class="floor-plan-description">
<h2 class="floor-title"><?php the_title(); ?></h2>
<?php
$fp_description = get_field( 'field_ms_toolkit_floor_plan_description' );
$description = str_replace("\n", '<br />', $fp_description); ?>
<h3><?php echo $term2->name; ?></h3>
<h4><?php echo $suite_area; ?></h4>

</div>
</div>
</a>
</div>
</div> <!--.col-12 col-sm-6-->
<?php endwhile; ?>
 
<?php endif; ?>
</div>
</div> <!-- /floorplans_grid -->

</section>
<?php endforeach; ?>

</div>
</div>
<div id="pageNav"></div>
</div>

<?php
return ob_get_clean();

	}
} // end Element Class


// element Class Init
new FloorplanCallout();


