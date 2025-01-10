<?php
/**
 * Actions
 *
 * Contains all actions used in the theme
 *
 * @author  Sohrab
 * @package msteele
 */

if ( ! class_exists( 'msteele_actions' ) ):

	class msteele_actions {

		/**
		 * Constructor
		 */ 

		public function __construct() {
			add_action( 'add_fav_icons', array( $this, 'add_fav_icons' ) );
			add_action( 'add_header', array( $this, 'add_header' ) );
			add_action( 'add_default_header', array( $this, 'add_default_header' ) );
			add_action( 'add_footer', array( $this, 'add_footer' ) );
			add_action( 'add_default_footer', array( $this, 'add_default_footer' ) );
			add_action( 'add_header_scripts', array( $this, 'add_header_scripts' ) );
			add_action( 'add_header_page_custom', array( $this, 'add_header_page_custom' ) );
			add_action( 'add_footer_scripts', array( $this, 'add_footer_scripts' ) );
			add_action( 'add_footer_page_custom', array( $this, 'add_footer_page_custom' ) );
			add_action( 'add_social_media', array( $this, 'add_social_media' ) );
			add_action( 'add_social_sharing', array( $this, 'add_social_sharing' ), 10, 2 );
			add_action( 'add_google_map', array( $this, 'add_google_map' ) );
			add_action( 'add_leaflet_map', array( $this, 'add_leaflet_map' ) );
			add_action( 'add_register_form', array( $this, 'add_register_form' ) );
		}

		/**
		 * Add fav icons
		 * Use this online tool to generate icons: https://realfavicongenerator.net/
		 * Copy and paste the generated icons in the assets/images/icons/ folder
		 * Make sure to change the theme color based on the design
		 */
		function add_fav_icons() {
			// get the path
			$path = get_template_directory_uri();
			// @formatter:off
            ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $path; ?>/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $path; ?>/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $path; ?>/images/favicon-16x16.png">
<link rel="manifest" href="<?php echo $path; ?>/images/site.webmanifest">
<link rel="mask-icon" href="<?php echo $path; ?>/images/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<link rel="stylesheet" href="https://use.typekit.net/rgh2kfp.css">

<?php
            // @formatter:on
		}

		/**
		 * Add header
		 * Displays the header if it is not set as hidden in the page option
		 */
		function add_header() {
			$queried_object = get_queried_object();
			if ( ! empty( $queried_object->ID ) ) {
				// make sure to display the header where it is not hidden
				if ( ! get_field( 'page_hide_header', $queried_object->ID ) ) {
					do_action( 'add_default_header' );
				}
			}
			// also show the header on 404, archive and search pages
			if ( ( is_404() || is_archive() || is_search() ) && ! is_author() ) {
				do_action( 'add_default_header' );
			}
		}

		/**
		 * Default header
		 * Does not check for page option condition
		 */
		function add_default_header() {
			?>

<header id="fixed-header" class="site-header">
    <div class="container-fluid px-120">
        <div class="menu-wrapper">
            <div class="site-header__logo">
                <a href="/">
                    <img src="/wp-content/uploads/2024/09/logo-1.svg" alt="SQFT Company Website Logo">
                </a>
            </div>
            <div class="site-header__menu">
                <button class="menu-btn-wrap">
                    <span class="menu-btn-bar"></span>
                    <span class="menu-btn-bar"></span>
                    <span class="menu-btn-bar"></span>
                </button>
            </div>
        </div>
        <div class="open-menu-block">
            <div class="menu-block-wrap">
                <?php
								// Display the menu in your WordPress theme
								wp_nav_menu(array(
									'theme_location' => 'header', 
									'menu' => 'Main Menu',
									'fallback_cb' => false              // Fallback function if menu is not found (can be set to false to disable)
								));
							?>
            </div>
        </div>
    </div>
</header>


<?php
		}


		/**
		 * Add footer
		 * Show the footer if it is not set as hidden in page option
		 */
		function add_footer() {
			$queried_object = get_queried_object();
			if ( ! empty( $queried_object->ID ) ) {
				// make sure to display the footer where it is not hidden
				if ( ! get_field( 'page_hide_footer', $queried_object->ID ) ) {
					do_action( 'add_default_footer' );
				}
			}
			// also show the footer on 404, archive and search pages
			if ( ( is_404() || is_archive() || is_search() ) && ! is_author() ) {
				do_action( 'add_default_footer' );
			}
		}

		/**
		 * Default footer
		 * Does not check for any condition
		 */
		function add_default_footer() { ?>

<footer id="footer-block" class="site-footer">
    <div class="container px-m-35">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-logo">
                    <img src="/wp-content/uploads/2024/09/logo-1.svg" alt="Logo in Footer">
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-heading">
                    <h3>Contact Us</h3>
                </div>
                <div class="footer-contact">
                    <h3>Tarun Jaiswal</h3>
                    <span>Real Estate Agent</span>
                    <div class="contact-info">
                        <span class="text-email">
                            <a href="mailto:tarun@sqftcompany.com">tarun@sqftcompany.com</a>
                        </span>
                        <span class="text-phone">
                            <a href="mailto:4374539555">437-453-9555</a>
                        </span>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-heading follow-us">
                    <h3>Follow Us</h3>
                </div>
                <div class="social-media">
                    <?php do_action( 'add_social_media' ); ?>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="copyrights">
                            <p>© 2024 sqftcompany.com. All Rights Reserved. Unauthorized reproduction, distribution, or
                                use of any material on this website without prior written permission is strictly
                                prohibited. </p>
                        </div>
                    </div>
                </div>
            </div>

</footer><!-- #colophon -->
<?php
		}

		/**
		 * Add header scripts
		 * Insert the codes set by the user in the theme option page
		 */
		function add_header_scripts() {
			echo get_field( 'additional_header_codes', 'option' ); // additional codes
			echo get_field( 'head_tracking_codes', 'option' ); // header tracking codes
		}

		/**
		 * Add the custom header codes inserted by the user in page option settings
		 */
		function add_header_page_custom() {
			$queried_object = get_queried_object();
			// make sure we are in a page
			if ( ! empty( $queried_object->ID ) ) {
				echo get_field( 'page_header_custom_code' );
			}

		}

		/**
		 * Add footer scripts
		 * These scripts are loaded in the footer based on theme settings
		 * When loading additional scripts, make sure you load them via scripts.php
		 */
		function add_footer_scripts() {

			echo get_field( 'additional_footer_codes', 'option' ); // insert additional codes from theme settings
			echo get_field( 'body_tracking_codes', 'option' ); // insert before body tracking codes

			// Google Analytics tracking code
			// @formatter:off
            if ( ! empty ( get_field( 'google_analytics_track_id', 'option' ) ) ) : ?>
<script async
    src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_field('google_analytics_track_id', 'option');?>">
</script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', "<?php echo get_field('google_analytics_track_id', 'option');?>");
</script>
<?php endif;
            // @formatter:on

			// Check to see if user input utm tracking url
			// @formatter:off
            if ( ! empty ( get_field( 'utm_tracking_domain', 'option' ) ) ) : ?>
<script type="text/javascript">
var _uf = _uf || {};
_uf.domain = ".<?php echo get_field( 'utm_tracking_domain', 'option' ); ?>";
</script>
<script src="<?php echo get_template_directory_uri() . '/library/utm/utm_form-1.0.4.min.js'; ?>" async></script>
<?php endif;
            // @formatter:on

		}

		/**
		 * Add the custom footer codes inserted by the user in page option settings
		 */
		function add_footer_page_custom() {
			$queried_object = get_queried_object();
			// make sure we are in a page
			if ( ! empty( $queried_object->ID ) ) {
				echo get_field( 'page_footer_custom_code' );
			}
		}

		/**
		 * Add social media icons
		 * Get social media urls from the theme option page
		 */
		function add_social_media() {
			if ( have_rows( 'field_social_networks', 'option' ) ): ?>
<ul class="social-media">
    <?php while ( have_rows( 'field_social_networks', 'option' ) ): the_row();
						$image = get_sub_field( 'social_media_icon', 'option' );
						$link  = get_sub_field( 'social_media_url', 'option' );
						?>
    <li class="social-media-item">
        <?php if ( $link ): ?>
        <a href="<?php echo $link; ?>" target="_blank" aria-hidden="true">
            <?php endif; ?>
            <i class="fab <?php echo $image; ?> fa-lg" aria-hidden="true"></i>
            <?php if ( $link ): ?>
        </a>
        <?php endif; ?>
    </li>
    <?php endwhile; ?>
</ul>

<?php endif;
		}

		/**
		 * Add social sharing to posts
		 *
		 * @param $link
		 * @param $content
		 */
		function add_social_sharing( $link, $content ) {

			// check to see if user enabled social sharing on posts
			if ( get_field( 'enable_social_sharing', 'option' ) ) :?>
<div class="share-social-media">
    <span class="">Share this:</span>
    <div class="social-media-lists">
        <ul class="social-media">
            <li class="social-media-item">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" target="_blank">
                    <i class="fab fa-facebook" aria-hidden="true"></i>
                </a>
            </li>
            <li class="social-media-item">
                <a href="https://twitter.com/home?status=<?php echo $link; ?>" target="_blank">
                    <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
            </li>
            <li class="social-media-item">
                <a href="mailto:?&subject=Check this article&body=<?php echo $link; ?>%0A<?php echo $content; ?>"
                    target="_blank">
                    <i class="fab fa-envelope-o" aria-hidden="true"></i>
                </a>
            </li>
            <li class="social-media-item">
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link; ?>&title=&summary=<?php echo $content; ?>&source="
                    target="_blank">
                    <i class="fab fa-linkedin" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php endif;
		}

		/**
		 * Add Google map
		 */
		function add_google_map() {
			?>
<!-- Google map location -->
<div id="map-canvas" class="google-map" data-map-type="ROADMAP" data-zoom="15"
    data-pin-icon="<?php echo get_field( 'map_marker', 'option' ); ?>"
    data-latitude="<?php echo get_field( 'map_latitude', 'option' ); ?>"
    data-longitude="<?php echo get_field( 'map_longitude', 'option' ); ?>"
    <?php if ( get_field( 'map_description', 'option' ) ) : ?>
    data-address="<?php echo get_field( 'map_description', 'option' ); ?>" <?php endif; ?> data-pan-control="true"
    data-zoom-control="true" data-map-type-control="true" data-scale-control="true" data-draggable="true"
    data-modify-coloring="true" data-saturation="-100" data-lightness="-40" data-hue="#373737">
</div>

<?php
		}

		/**
		 * Add Leaflet Map
		 */
		function add_leaflet_map() {
			?>
<!-- Map location -->
<div id="map-canvas" class="leaf-map" data-map-key="<?php echo get_field( 'map_api_key', 'option' ); ?>" data-zoom="15"
    data-pin-icon="<?php echo get_field( 'map_marker', 'option' ); ?>"
    data-latitude="<?php echo get_field( 'map_latitude', 'option' ); ?>"
    data-longitude="<?php echo get_field( 'map_longitude', 'option' ); ?>"
    <?php if ( get_field( 'map_description', 'option' ) ) : ?>
    data-address="<?php echo get_field( 'map_description', 'option' ); ?>" <?php endif; ?>>
</div>

<?php
		}

	}

	$msteele_actions = new msteele_actions();

endif;