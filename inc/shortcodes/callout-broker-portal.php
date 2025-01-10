<?php
/*
Element Description: Broker Portal Call Out
@author: Johnson
@Modified by Sohrab on Aug 13 to fix some stuff
*/

// Element Class
class BrokerPortalCallout {
	// element Init
	function __construct() {
		add_action( 'init', array( $this, 'kc_brokerportal_callout_mapping' ), 99 );
		add_shortcode( 'kc_brokerportal_callout', array( $this, 'kc_brokerportal_callout_html' ) );

	}

	/**
	 * Map element
	 */
	function kc_brokerportal_callout_mapping() {

		if ( function_exists( 'kc_add_map' ) ) {
			kc_add_map(
				array(

					'kc_brokerportal_callout' => array(
						'name'        => __( 'Broker Portal Call Out', 'msteele' ),
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
	function kc_brokerportal_callout_html( $atts ) {
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
                <div class="row">
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

                    <div class="col-sm-12 col-md-6 col-lg-4 card-vip">
                        <div class="bp-vip-wrapper container">
							<?php if ( $loop->have_posts() ) { ?>
                                <div class="card">
                                    <div id="card-<?php echo $custom_term->term_id; ?>"
                                         class="card-header card_<?php echo $custom_term->slug; ?>">
                                        <div class="btn btn-info modal-btn" data-toggle="modal"
                                             data-target="#modal-<?php echo $custom_term->slug; ?>">
                                            <div class="category-header cat-header_<?php echo $custom_term->slug; ?>">

												<?php
												$cat_image = get_field( 'vip_cat_icon', $custom_term );
												$vip_files = get_field( 'all_files', $custom_term );

												if ( ! empty( $cat_image ) ): ?>
                                                    <img class="vip-cat-image" src="<?php echo $cat_image['url']; ?>"
                                                         alt="<?php echo $cat_image['alt']; ?>"/>
												<?php endif; ?>

                                                <div class="font-weight-bold font-playfair headline">
                                                    <h2><?php echo $custom_term->name; ?></h2>
                                                </div>
                                                <p><?php echo $custom_term->description; ?></p>
                                            </div>

                                            <div class="category-details">
                                            <span class="post-count"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/count-file.png"
                                                        alt="Total Count"/><?php echo $loop->found_posts; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-modal">

                                        <div id="modal-<?php echo $custom_term->slug; ?>" class="modal fade"
                                             role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-sidebar">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                        </div>
                                                        <div class="modal-details">
                                                            <div class="font-weight-bold font-playfair headline">
                                                                <h2><?php echo $custom_term->name; ?></h2>
                                                            </div>

                                                            <p><?php echo $custom_term->description; ?></p>

                                                            <div class="modal-btns">
                                                                <a href="<?php echo $vip_files; ?>"
                                                                   target="_blank" class="global-btn" download="">Download
                                                                    All</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="document-details">

														<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
															<?php
															$file        = get_field( 'field_ms_toolkit_vip_file' );
															$preview     = get_field( 'field_ms_toolkit_vip_thumbnail' );
															$vip_link    = get_field( 'field_ms_toolkit_vip_link' );
															$image       = get_field( 'field_ms_toolkit_vip_thumbnail' );
															$vip_desc_br = get_field( 'field_ms_toolkit_vip_description' );
															$vip_desc    = trim( strip_tags( $vip_desc_br ) );
															$slug        = get_post_field( 'post_name', get_post() );
															?>
															<?php if ( get_the_ID() === 117 ) : ?>
                                                                <div class="worksheet-item">
                                                                    <div class="vip-item">
                                                                        <div class="modal-documents">
                                                                            <div class="font-weight-bold font-playfair headline">
                                                                                <h2 class="modal-title title-<?php echo $slug; ?>"><?php the_title(); ?></h2>
                                                                            </div>
																			<?php echo FrmFormsController::get_form_shortcode( array(
																				'id'          => 3,
																				'title'       => false,
																				'description' => false
																			) ); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
															<?php endif; ?>
															<?php if ( get_the_ID() !== 117 ) : ?>
                                                                <div class="vip-item">
                                                                    <div class="modal-documents">

                                                                        <div class="font-weight-bold font-playfair headline">
                                                                            <h2 class="modal-title title-<?php echo $slug; ?>"><?php the_title(); ?></h2>
                                                                        </div>


																		<?php echo $vip_desc; ?>

																		<?php if ( ! empty( $image ) ): ?>
                                                                            <div class="vip-thumbnail">
                                                                                <img src="<?php echo $image['url']; ?>"
                                                                                     alt="<?php echo $image['alt']; ?>"/>
                                                                            </div>
																		<?php endif; ?>


                                                                        <div class="media-options">
                                                                            <ul>
																				<?php if ( $preview ): ?>
                                                                                    <li>
                                                                                        <a class="preview"
                                                                                           href="<?php echo $preview['url']; ?>"
                                                                                           data-lity>
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </a>
                                                                                    </li>
																				<?php endif; ?>
																				<?php if ( $file ): ?>
                                                                                    <li>
                                                                                        <a href="mailto:?subject=File&body=Download the file: %0D%0A<?php echo $file['url']; ?>"
                                                                                           class="sendEmail">
                                                                                            <i class="fas fa-envelope"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a class="download"
                                                                                           href="<?php echo $file['url']; ?>"
                                                                                           target="_blank"
                                                                                           download>
                                                                                            <i class="fas fa-download"></i>
                                                                                        </a>
                                                                                    </li>
																				<?php endif; ?>
																				<?php if ( $vip_link ): ?>
                                                                                    <li><a class="download"
                                                                                           href="<?php echo $vip_link['url']; ?>"
                                                                                           target="<?php echo $vip_link['target']; ?>">
                                                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dl-resource-icon.svg"
                                                                                                 alt="Download <?php echo $vip_link['title']; ?>"
                                                                                                 title="Download <?php echo $vip_link['title']; ?>"/></a>
                                                                                    </li>
																				<?php endif; ?>
                                                                            </ul>
                                                                        </div>

                                                                    </div>
                                                                </div>
															<?php endif; ?>
														<?php endwhile; ?>
                                                    </div>


                                                </div> <!-- /modal-content -->

                                            </div>
                                        </div>
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
new BrokerPortalCallout();