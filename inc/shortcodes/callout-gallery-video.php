<?php
/*
Element Description: Gallery Video Call Out
@author: Lucas Daniel
*/

// Element Class
class GalleryVideoCallout
{
	// element Init
	function __construct()
	{
		add_action('init', array($this, 'kc_gallery_video_callout_mapping'), 99);
		add_shortcode('kc_gallery_video_callout', array($this, 'kc_gallery_video_callout_html'));
	}

	/**
	 * Map element
	 */
	function kc_gallery_video_callout_mapping()
	{

		if (function_exists('kc_add_map')) {
			kc_add_map(
				array(

					'kc_gallery_video_callout' => array(
						'name'        => __('Gallery Video Callout', 'msteele'),
						'description' => __('Gallery video callout', 'msteele'),
						'icon'        => '',
						'category'    => 'Content',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'gallery',
									'label'       => 'Gallery Category',
									'type'        => 'text',
									'description' => 'Enter the gallery post title',
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
	function kc_gallery_video_callout_html($atts)
	{
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
		?>

		<?php
				global $post;
				// set the post arguments for the first set of posts
				$args = array(
					'post_type'      => 'gallery',
					'posts_per_page' => -1,
					'tax_query'      => array(
						array(
							'taxonomy' => 'gallery-category',
							'field'    => 'slug',
							'terms'    => $atts['gallery'],
						),
					),
				);
				?>
		<div class="gallery-video-callout gallery-group-callout">
			<div class="container">
				<?php $featured_posts = get_posts($args);
						foreach ($featured_posts as $post) : setup_postdata($post); ?>
					<?php $images = get_field('ms_toolkit_gallery', $post->ID); ?>
					<div class="gallery-items row align-items-start gallery-video">
						<h3><?php //the_title(); 
										?></h3>
						<?php foreach ($images as $image) : //print_r($image);exit();
										?>
							<div class="col-md-4">
								<div class="single-item">
									<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
									<div class="view-button">
										<a href="<?php echo $image['caption']; ?>" class="mfp-iframe" title="<?php echo $image['title']; ?>">
											<div class="text">
												<i class="fa fa-plus-circle fa-3x" aria-hidden="true"></i>
											</div>
										</a>
									</div>
								</div>
								<h4><a href="<?php echo $image['caption']; ?>" class="mfp-iframe" title="<?php echo $image['title']; ?>"><?php echo $image['title']; ?></a></h4>
							</div>
						<?php endforeach; ?>
					</div>

				<?php endforeach;
						wp_reset_postdata(); ?>

			</div>
		</div>
<?php

		return ob_get_clean();
	}
} // end Element Class


// element Class Init
new GalleryVideoCallout();
