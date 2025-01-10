<?php
/*
Element Description: Broker Portal Call Out
@author: Johnson
@Modified by Sohrab on Aug 13 to fix some stuff
*/

// Element Class
class BrokerPortalSimpleCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_brokerportal_Simple_callout_mapping' ), 99 );
		add_shortcode( 'kc_brokerportal_Simple_callout', array( $this, 'kc_brokerportal_Simple_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_brokerportal_Simple_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_brokerportal_Simple_callout' => array(
						'name'        => __( 'Broker Portal List', 'msteele' ),
						'description' => __( 'Display broker portal resources', 'msteele' ),
						'icon'        => '',
						'category'    => 'Post Types',
						'params'      => array(
							'General'       => array(
								array(
									'name'        => 'posts',
									'label'       => 'Number of posts to show',
									'type'        => 'text',
									'description' => 'Set number of posts, default is set to show all',
								),
							),
							'Customization' => array(
								array(
									'name'        => 'class',
									'label'       => 'Extra Class Name',
									'type'        => 'text',
									'description' => 'Enter extra class name for the element',
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
	function kc_brokerportal_Simple_callout_html( $atts ) {
		// params extraction
		extract(
			shortcode_atts(
				array(
					'posts'     => '',
					'animation' => '',
					'class'     => '',
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
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		// start the output
		ob_start();
		$query_args = ( array(
			'post_type'      => 'floor-plan',
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => $post_number,
			'paged'          => $paged
		) );
		$the_query  = new WP_Query( $query_args );

		$custom_terms = get_terms( 'vip-category' ); ?>
        <div class="broker-portal-callout <?php echo $atts['class']; ?>">
            <div class="container">
                <div class="row my-5">
                    <div class="col-md-12">
						<?php if(isset( $_COOKIE['UserBroker'] ) ) : ?>
							<?php if ( isset( $_GET['logout'] ) ) :
								unset( $_COOKIE['UserLoggedIn'] );
								unset( $_COOKIE['UserBroker'] );
								setcookie('UserLoggedIn', null, -1, '/');
								setcookie('UserBroker', null, -1, '/');
								header( 'Location: /broker-portal/' );
								exit;
							endif; ?>
                            <div class="user-logged-in-message m-t-20 m-b-20">
                                <div class="row">
                                    <div class="col-md-9 my-auto">
                                        <p class="mb-0">
                                            Hello <?php echo $_COOKIE['UserBroker']; ?>! you are currently logged in,
                                            make sure you logout once
                                            you
                                            are done.</p>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="?logout" class="global-btn  float-md-right" id="logout-broker">Logout</a>
                                    </div>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">

				<?php
				foreach ( $custom_terms as $custom_term ) {
					wp_reset_query();
					$args = array(
						'post_type'      => 'vip',
						'order'          => 'DESC',
						'posts_per_page' => $post_number,
						'paged'          => $paged,
						'tax_query'      => array(
							array(
								'taxonomy' => 'vip-category',
								'field'    => 'slug',
								'terms'    => $custom_term->slug,
							),
						),
					);

					$loop = new WP_Query( $args ); ?>

                    <div class="col-sm-12 col-md-6 col-lg-6 card-vip">
                        <div class="bp-vip-wrapper container">
							<?php if ( $loop->have_posts() ) { ?>
                                <div class="card">
                                    <div id="card-<?php echo $custom_term->term_id; ?>" class="card_<?php echo $custom_term->slug; ?>">
										<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
										<?php
										$file        = get_field( 'field_ms_toolkit_vip_file' );
										//echo "<pre>"; print_r($file); echo "</pre>";
										//$preview     = get_field( 'field_ms_toolkit_vip_thumbnail' );
										$vip_link    = get_field( 'field_ms_toolkit_vip_link' );
										//$image       = get_field( 'field_ms_toolkit_vip_thumbnail' );
										//$vip_desc_br = get_field( 'field_ms_toolkit_vip_description' );
										//$vip_desc    = trim( strip_tags( $vip_desc_br ) );
										//$slug        = get_post_field( 'post_name', get_post() );
										?>
										<?php if($file['url']) { ?>
											<a href="<?php echo $file['url']; ?>" target="_blank">
												<div class="cat-header_<?php echo $custom_term->slug; ?>">

													<div class="font-weight-bold font-playfair headline">
														<h2><?php echo $custom_term->name; ?></h2>
													</div>
													<?php /* if($custom_term->description){ ?>
														<p><?php echo $custom_term->description; ?></p>
													<?php } */?>
												</div>
											</a>
										<?php } else { ?>
											<a href="<?php echo $vip_link['url']; ?>" target="_blank">
												<div class="cat-header_<?php echo $custom_term->slug; ?>">

													<div class="font-weight-bold font-playfair headline">
														<h2><?php echo $custom_term->name; ?></h2>
													</div>
													<?php /* if($custom_term->description){ ?>
														<p><?php echo $custom_term->description; ?></p>
													<?php } */?>
												</div>
											</a>
										<?php } ?>
										<?php endwhile; ?>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                    </div>
				<?php } ?>

            </div>
        </div>

		<?php
		return ob_get_clean();
	}
} // end Element Class


// element Class Init
new BrokerPortalSimpleCallout();