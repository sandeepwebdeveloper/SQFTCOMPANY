<?php


/**
 * Broker Portal Users Post Type
 * @author Sohrab
 */
class Broker_Portal_Users {

	/**
	 * Initialize & hook into WP
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'broker_portal_register_user' ) );
		add_action( 'init', array( $this, 'broker_portal_register_fields' ) );
	}

	/**
	 * Team Post Type
	 * @since 1.0.0
	 */
	function broker_portal_register_user() {

		$labels = array(
			"name"          => __( "Brokers", "msteele" ),
			"singular_name" => __( "Broker", "msteele" ),
		);

		$args = array(
			"label"               => __( "Borker", "msteele" ),
			"labels"              => $labels,
			"description"         => "",
			"public"              => false,
			"publicly_queryable"  => false,
			"show_ui"             => true,
			"show_in_rest"        => false,
			"rest_base"           => "",
			"has_archive"         => false,
			"show_in_menu"        => true,
			"exclude_from_search" => false,
			"capability_type"     => "post",
			"map_meta_cap"        => true,
			"hierarchical"        => false,
			"rewrite"             => false,
			"query_var"           => true,
			"menu_icon"           => "dashicons-groups",
			"supports"            => array( "title" ),
		);

		register_post_type( "broker", $args );
	}

	/**
	 * Team Fields
	 * @since 1.0.0
	 */
	function broker_portal_register_fields() {
		if ( function_exists( 'acf_add_local_field_group' ) ):


		endif;
	}

}

$Broker_Portal_Users = new Broker_Portal_Users();