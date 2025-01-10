<?php
/*
 * Store Multiple Passwords for Password protected posts and pages.
 * Version: 1.1.0
 * Author: Brian DiChiara
 * Project Profile: https://github.com/solepixel/wp-multiple-passwords
 *
 * Modified by Sohrab on Sept 14,2017
 */

add_action( 'template_redirect', 'wpmp_override_password' );
add_filter( 'acf/location/rule_types', 'wpmp_location_rules_types' );
add_filter( 'acf/location/rule_values/post_visibility', 'wpmp_location_rules_values_visibility' );
add_filter( 'acf/location/rule_values/page_visibility', 'wpmp_location_rules_values_visibility' );
add_filter( 'acf/location/rule_match/post_visibility', 'wpmp_location_rules_match_visibility', 10, 3 );
add_filter( 'acf/location/rule_match/page_visibility', 'wpmp_location_rules_match_visibility', 10, 3 );


/**
 * Modify the post's post_password value to match an accurate additional password at run time
 * @return void
 */
function wpmp_override_password() {
	global $post;
	$global = false;

	if ( empty( $post ) && isset( $GLOBALS['post'] ) ) {
		$post   = $GLOBALS['post'];
		$global = true;
	}

	if ( ! $post ) {
		return;
	}

	// store the original password.
	$correct_password = is_array( $post ) ? $post['post_password'] : $post->post_password;

	// bail if there is no password set for the post
	if ( ! $correct_password ) {
		return;
	}

	// this part needs ACF
	$extra_passwords = function_exists( 'get_field' ) ? get_field( '_extra_passwords' ) : array();

	// this will add non-pro ACF support
	if ( $extra_passwords && ! function_exists( 'acf_add_local_field_group' ) && function_exists( 'register_field_group' ) ) {
		$extra_passwords = array_filter( preg_split( '/\r\n|[\r\n]/', $extra_passwords ) );
	}

	// You can set your own passwords here: (see below)
	$extra_passwords = apply_filters( 'wpmp_extra_passwords', $extra_passwords, $post );


	if ( ! $extra_passwords || ! is_array( $extra_passwords ) ) {
		return;
	}

	if ( ! isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ) {
		return;
	}

	# the next few lines come from /wp-includes/post-template function post_password_required()
	if ( ! class_exists( 'PasswordHash' ) ) {
		require_once ABSPATH . WPINC . '/class-phpass.php';
	}

	$hasher = new PasswordHash( 8, true );
	$hash   = wp_unslash( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] );
	if ( 0 !== strpos( $hash, '$P$B' ) ) {
		return;
	}

	$passed = false;

	// Check the extra passwords to see if the submitted password matches
	foreach ( $extra_passwords as $password ) {
		if ( ! $password ) {
			continue;
		}

		$check_password = $password;

		if ( is_array( $check_password ) && isset( $check_password['password'] ) ) // ACF Support
		{
			$check_password = $check_password['password'];
		}

		if ( is_string( $check_password ) || is_numeric( $check_password ) ) {
			$check_password = trim( $check_password );
		} else {
			continue;
		} // must be an object or something not supported.

		if ( $hasher->CheckPassword( $check_password, $hash ) ) {
			$passed = $check_password;
			break;
		}
	}

	// don't do anything if none of the passwords matched
	if ( ! $passed ) {
		return;
	}

	// temporarily changed the post_password so everything else works as normal
	if ( is_array( $post ) ) {
		$post['post_password'] = $passed;
	} else {
		$post->post_password = $passed;
	}

	if ( $global ) {
		$GLOBALS['post'] = $post;
	}
}


/**
 * Create custom ACF Rules for Visibility
 *
 * @param  array $choices ACF array of choices
 *
 * @return array $choices
 */
function wpmp_location_rules_types( $choices ) {

	$choices['Post']['post_visibility'] = __( 'Post Visibility', 'wpmp' );
	$choices['Page']['page_visibility'] = __( 'Page Visibility', 'wpmp' );

	return $choices;

}


/**
 * Values for Visibility Rules
 *
 * @param  array $choices ACF array of choices
 *
 * @return array $choices
 */
function wpmp_location_rules_values_visibility( $choices ) {

	$choices['password']    = __( 'Has Password', 'wpmp' );
	$choices['no-password'] = __( 'Does Not Have Password', 'wpmp' );

	return $choices;
}


/**
 * Rules to match visibility
 *
 * @param  bool $match Return value
 * @param  array $rule ACF Rule Array
 * @param  array $options Rule Options
 *
 * @return bool  $match
 */
function wpmp_location_rules_match_visibility( $match, $rule, $options ) {
	global $post;
	// make sure access the property if it is not empty
	if ( ! empty( $post->post_password ) ) {


		if ( $rule['value'] == 'password' && $post->post_password ) {
			if ( $rule['operator'] == "==" ) {
				$match = true;
			} elseif ( $rule['operator'] == "!=" ) {
				$match = false;
			}
		} else if ( $rule['value'] == 'no-password' && ! $post->post_password ) {
			if ( $rule['operator'] == "==" ) {
				$match = true;
			} elseif ( $rule['operator'] == "!=" ) {
				$match = false;
			}
		}
	}

	return $match;
}

$wpmp_repeater_field = array(
	'key'               => 'field_579786e0d0eea',
	'label'             => __( 'Extra Passwords', 'wpmp' ),
	'name'              => '_extra_passwords',
	'type'              => 'repeater',
	'instructions'      => 'Insert additional passwords to view the password protected content',
	'required'          => 0,
	'conditional_logic' => 0,
	'wrapper'           => array(
		'width' => '',
		'class' => '',
		'id'    => '',
	),
	'collapsed'         => '',
	'min'               => '',
	'max'               => '',
	'layout'            => 'table',
	'button_label'      => __( 'Add Password', 'wpmp' ),
	'sub_fields'        => array(
		array(
			'key'               => 'field_579786fcd0eeb',
			'label'             => __( 'Password', 'wpmp' ),
			'name'              => 'password',
			'type'              => 'text',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'default_value'     => '',
			'placeholder'       => '',
			'prepend'           => '',
			'append'            => '',
			'maxlength'         => '',
			'readonly'          => 0,
			'disabled'          => 0,
		),
	),
);

$wpmp_textarea_field = array(
	'key'           => 'field_582771dd32cb8',
	'label'         => __( 'Extra Passwords', 'wpmp' ),
	'name'          => '_extra_passwords',
	'type'          => 'textarea',
	'instructions'  => __( 'Place passwords on individual lines.', 'wpmp' ),
	'default_value' => '',
	'placeholder'   => '',
	'maxlength'     => '',
	'rows'          => 6,
	'formatting'    => 'none',
);

$addl_passwords_field = array(
	'key'                   => 'group_579786b845c7f',
	'title'                 => __( 'Additional Passwords', 'wpmp' ),
	'options'               => array(
		'position'       => 'normal',
		'layout'         => 'default',
		'hide_on_screen' => array(),
	),
	'fields'                => array(),
	'location'              => array(
		array(
			array(
				'param'    => 'page_visibility',
				'operator' => '==',
				'value'    => 'password',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
		array(
			array(
				'param'    => 'post_visibility',
				'operator' => '==',
				'value'    => 'password',
				'order_no' => 0,
				'group_no' => 1,
			),
		),
	),
	'menu_order'            => 5,
	'position'              => 'normal',
	'style'                 => 'default',
	'label_placement'       => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen'        => '',
	'active'                => 1,
	'description'           => '',
);

if ( function_exists( 'acf_add_local_field_group' ) ):

	$addl_passwords_field['fields'] = array( $wpmp_repeater_field );

	acf_add_local_field_group( $addl_passwords_field );

elseif ( function_exists( 'register_field_group' ) ):

	$addl_passwords_field['fields'] = array( $wpmp_textarea_field );

	register_field_group( $addl_passwords_field );

endif;