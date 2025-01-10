<?php
/**
 * Utilities
 *
 * Contains some modifications to make this theme better
 *
 * @author: Sohrab
 * @package msteele
 */
add_action( 'nf_display_enqueue_scripts', 'remove_ninja_forms_scripts' );
//add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 3 );
//add_filter( 'nav_menu_css_class', 'special_nav_class_footer', 10, 3 );
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
add_filter( 'excerpt_more', 'custom_excerpt_more' );
add_filter( 'wp_get_attachment_link', 'add_lity_images' );
add_filter( 'body_class', 'add_custom_body_class' );
add_filter( 'site_transient_update_plugins', 'remove_update_notification_acf' );
add_filter( 'xmlrpc_enabled', '__return_false' ); // disable xml rpc
add_filter( 'script_loader_tag', 'async_scripts', 10, 3 );
add_filter( 'wpcf7_form_elements', 'remove_contact_form_7_style' );
add_filter( 'wpcf7_form_action_url', 'remove_contact_form_7_unit_tag' );
add_action( 'wp_enqueue_scripts', 'remove_contact_form_7_scripts' );
add_filter( 'flamingo_map_meta_cap', 'add_flamingo_map_meta_cap' );
add_filter( 'script_loader_tag', 'remove_type_attr', 11, 2 );

// Form filers and actions
add_filter( 'frm_create_cookies', '__return_false' );
add_action( 'frm_after_create_entry', 'add_form_cookie', 30, 2 );
add_action( 'frm_after_create_entry', 'check_brokers', 30, 2 );
add_filter( 'frm_new_post', 'frm_save_entry_id_to_custom_field', 10, 2 );
add_filter( 'frm_upload_folder', 'frm_custom_upload', 10, 2 );
add_action( 'wp_head', 'javascript_variables2' );
add_action('wp_ajax_send_form', 'send_form'); // This is for authenticated users
add_action('wp_ajax_nopriv_send_form', 'send_form'); // This is for unauthenticated users.
function javascript_variables2(){ ?>
    <script type="text/javascript">
        var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
        var ajax_nonce = '<?php echo wp_create_nonce( "secure_nonce_name" ); ?>';
    </script><?php
}

function send_form(){
 
    // This is a secure process to validate if this request comes from a valid source.
    check_ajax_referer( 'secure_nonce_name', 'security' );
 
    /**
     * First we make some validations, 
     * I think you are able to put better validations and sanitizations. =)
     */
     
    if ( empty( $_POST["FirstName"] ) ) {
        echo "Insert your First Name please";
        wp_die();
    }
	if ( empty( $_POST["LastName"] ) ) {
        echo "Insert your Last Name please";
        wp_die();
    }
 
    if ( ! filter_var( $_POST["Email"], FILTER_VALIDATE_EMAIL ) ) {
        echo 'Insert your email please';
        wp_die();
    }
 
    if ( empty( $_POST["Phone"] ) ) {
        echo "Insert your Phone please";
        wp_die();
    }
	if ( empty( $_POST["PostalCode"] ) ) {
        echo "Insert your Postal Code please";
        wp_die();
    }
	if ( empty( $_POST["Unit_Type"] ) ) {
        echo "Insert your Unit Type please";
        wp_die();
    }
	if ( empty( $_POST["hearaboutus"] ) ) {
        echo "Insert your hearaboutus please";
        wp_die();
    }
	if ( empty( $_POST["Price_Range"] ) ) {
        echo "Insert your Price Range please";
        wp_die();
    }
	if ( empty( $_POST["Size_of_Home"] ) ) {
        echo "Insert your Size of Home please";
        wp_die();
    }
	if ( empty( $_POST["Current_Home_Status"] ) ) {
        echo "Insert your Current Home Status please";
        wp_die();
    }
	if ( empty( $_POST["Buyer_s_Profile"] ) ) {
        echo "Insert your Buyer s Profile please";
        wp_die();
    }
	if ( empty( $_POST["Interested_in_Commercial_or_Retail_Space"] ) ) {
        echo "Insert your Interested in Commercial or Retail Space please";
        wp_die();
    }
	if ($_POST["Are_You_Working_With_a_Realtor"] == 1) {
		$Are_You_Working_With_a_Realtor = true;
		if ( empty( $_POST["Realtor_Name"] ) ) {
			echo "Insert your Realtor_Name please";
			wp_die();
		}
		if ( empty( $_POST["Realtor_Brokerage_Name"] ) ) {
			echo "Insert your Realtor_Brokerage_Name please";
			wp_die();
		}
	} else {
		$Are_You_Working_With_a_Realtor = false;
	}
	if ($_POST["Are_You_a_Realtor"] == 1) {
		$Are_You_a_Realtor = true;
		if ( empty( $_POST["Realtor_Agency"] ) ) {
			echo "Insert your Realtor_Brokerage_Name please";
			wp_die();
		}
	} else {
		$Are_You_a_Realtor = false;
	}

	// if ( empty( $_POST["Are_You_Working_With_a_Realtor"] ) ) {
    //     echo "Select Are You Working With a Realtor";
    //     wp_die();
    // } else {
	// 	if ($_POST["Are_You_Working_With_a_Realtor"] == "Yes") {
	// 		$Are_You_Working_With_a_Realtor = true;
	// 	} else {
	// 		$Are_You_Working_With_a_Realtor = false;
	// 	}
	// }
	// if ( empty( $_POST["Are_You_a_Realtor"] ) ) {
    //     echo "Pick Realtor please";
    //     wp_die();
    // } else {
	// 	if ($_POST["Are_You_a_Realtor"] == "Yes") {
	// 		$Are_You_a_Realtor = true;
	// 	} else {
	// 		$Are_You_a_Realtor = false;
	// 	}
	// }
	//echo "<pre>"; print_r($data); echo "</pre>"; die;
				$data = array(  
					"key" => "SfKMZ7PBvXfYHrnP8ybP",
					"secret" => "35cf6856-4dc9-4eed-8837-c2ee68e4c908",
					"projectIds" => ["a093t00000M4RwDAAV"],
					'FirstName' => $_POST["FirstName"], 
					'LastName' => $_POST["LastName"], 
					'Email' => $_POST["Email"], 
					'Phone' => $_POST["Phone"], 
					'PostalCode' => $_POST["PostalCode"], 
					'Unit_Type__c' => $_POST["Unit_Type"], 
					'How_Did_You_Hear_About_Us__c' => $_POST["hearaboutus"], 
					'Price_Range__c' => $_POST["Price_Range"], 
					'Size_of_Home__c' => $_POST["Size_of_Home"], 
					'Current_Home_Status__c' => $_POST["Current_Home_Status"], 
					'Buyer_s_Profile__c' => $_POST["Buyer_s_Profile"], 
					'Interested_in_Commercial_or_Retail_Space__c' => $_POST["Interested_in_Commercial_or_Retail_Space"], 
					'Are_You_Working_With_a_Realtor__c' => $Are_You_Working_With_a_Realtor,
					'Realtor_Name__c' => $_POST["Realtor_Name"], 
					'Realtor_Brokerage_Name__c' => $_POST["Realtor_Brokerage_Name"], 
					'Are_You_a_Realtor__c' => $Are_You_a_Realtor,
					'Realtor_Agency__c' => $_POST["Realtor_Agency"], 
					// 'Buyer_s_Profile__c' => $_POST["Buyer_s_Profile"], 
					
					"Language__c" => "English",
					"LeadSource" => "www.xo2condos.com",
					'ads__referral_url__c' => "",
					'ads__landing_url__c' => ""
					
				);
				$response = wp_remote_post('https://api.baker-re.com/lead',array(
					'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
					'body'        => json_encode($data),
					'method'      => 'POST',
					'data_format' => 'body',
				) ); 
    print_r ($response);
    wp_die();
}
/**
 * Add a class to the header menu
 */
function special_nav_class( $classes, $item, $args ) {
	// make sure we only modify the header menu
	if ( 'header' === $args->theme_location ) {
		// add classes
		$classes[] = '';
		// add a class if it is selected item
		if ( in_array( 'current-menu-item', $classes ) ) {
			$classes[] = 'header-current ';
		}
	}

	// return all classes
	return $classes;
}

/**
 * Add a class to the footer menu
 */
function special_nav_class_footer( $classes, $item, $args ) {
	// make sure we only modify the header menu
	if ( 'footer' === $args->theme_location ) {
		// add classes
		$classes[] = '';
		// add a class if it is selected item
		if ( in_array( 'current-menu-item', $classes ) ) {
			$classes[] = 'footer-current ';
		}
	}

	// return all classes
	return $classes;
}

/**
 * Remove ninja form stylesheets
 */
function remove_ninja_forms_scripts() {
	wp_dequeue_style( 'nf-display' );
}

/**
 * Remove contact form 7 styles from the fields
 *
 * @param $content
 *
 * @return mixed
 */
function remove_contact_form_7_style( $content ) {
	$content = preg_replace( '/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content );

	return $content;
}

/**
 * Remove contact form 7 tag in the url
 *
 * @param $url
 *
 * @return mixed
 */
function remove_contact_form_7_unit_tag( $url ) {
	$remove_unit_tag = explode( '#', $url );
	$new_url         = $remove_unit_tag[0];

	return $new_url;
}

/**
 * Remove contact form default 7 styles and scripts
 */
function remove_contact_form_7_scripts() {
	wp_dequeue_script( 'contact-form-7' );
	wp_dequeue_style( 'contact-form-7' );
}

/**
 * Allow editors to see the flamingo tab
 *
 * @param $meta_caps
 *
 * @return array
 */
function add_flamingo_map_meta_cap( $meta_caps ) {
	$meta_caps = array_merge( $meta_caps, array(
		'flamingo_edit_contacts'         => 'edit_pages',
		'flamingo_edit_inbound_messages' => 'edit_pages',
	) );

	return $meta_caps;
}


/**
 * Custom excerpt length
 *
 * @param $length
 *
 * @return int
 */
function custom_excerpt_length( $length ) {
	// change 30 to your desired output length
	return 30;
}

/**
 * Custom content length
 *
 * @param $more
 *
 * @return string
 */
function custom_excerpt_more( $more ) {
	return '...';
}

/**
 *
 * Attach the lity to links
 *
 * @param $link
 *
 * @return mixed
 */
function add_lity_images( $link ) {

	// check to see if user enabled lity
	if ( get_field( 'enable_options_lity', 'option' ) ) {
		return str_replace( '<a href', '<a data-lity href', $link );
	}

	return $link;
}

/**
 * Add a custom class to the body
 *
 * @param $classes
 *
 * @return array
 */
function add_custom_body_class( $classes ) {
	$queried_object = get_queried_object();
	if ( ! empty( $queried_object->ID ) ) {
		// add the class
		$classes[] = get_field( 'page_custom_body_class', $queried_object->ID );

	}

	return $classes;

}

/**
 * Remove ACF update notification
 *
 * @param $value
 *
 * @return mixed
 */
function remove_update_notification_acf( $value ) {
	if ( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {
		unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	}

	return $value;
}

/**
 * Add async and defer to scripts
 *
 * @param $tag
 * @param $handle
 * @param $src
 *
 * @return string
 */
function async_scripts( $tag, $handle, $src ) {
	// the handles of the enqueued scripts
	$async_scripts = array( 'google-map', 'leaflet' );

	if ( in_array( $handle, $async_scripts ) ) {
		return '<script src="' . $src . '" defer async></script>' . "\n";
	}

	return $tag;
}

/**
 * Remove the type attribute
 *
 * @param $tag
 * @param $handle
 *
 * @return string|string[]|null
 */
function remove_type_attr( $tag, $handle ) {
	return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}


/**
 * When broker registration form is submitted
 *
 * @param $entry_id
 * @param $form_id
 */
function add_form_cookie( $entry_id, $form_id ) {
	if ( $form_id == 2) {
		set_url_cookie( $_POST['item_meta'][6] );
	}
}

/**
 * Set a cookie when the user logged in
 */
function set_url_cookie( $user ) {
	$cookie_name_login = 'UserLoggedIn';
	$cookie_name_user  = 'UserBroker';
	$value_login       = 'Yes';
	$value_name        = $user;
	$expiration        = 86400; // one day
	setcookie( $cookie_name_login, $value_login, time() + $expiration, COOKIEPATH, COOKIE_DOMAIN );
	setcookie( $cookie_name_user, $value_name, time() + $expiration, COOKIEPATH, COOKIE_DOMAIN );
}

/**
 * @param $entry_id
 * @param $form_id
 */
function check_brokers( $entry_id, $form_id ) {
	if ( $form_id == 5 ) {
		global $wpdb;
		if ( isset( $_POST['item_meta'][43] ) ) {
			check_duplicate_posts( $_POST['item_meta'][43], $entry_id );
		}
	}
}

/**
 * Check for duplicate posts
 *
 * @param $email
 * @param $entry_id
 */
function check_duplicate_posts( $email, $entry_id ) {
	// args
	$args  = array(
		'numberposts' => - 1,
		'post_type'   => 'broker',
		'meta_key'    => 'broker_email',
		'meta_value'  => $email
	);
	$query = new WP_Query( $args );

	// args
	$new_args  = array(
		'numberposts' => - 1,
		'post_type'   => 'broker',
		'meta_query'  => array(
			'relation' => 'AND',
			array(
				'key'     => 'broker_email',
				'value'   => $email,
				'compare' => '='
			),
			array(
				'key'     => 'broker_entry_id',
				'value'   => $entry_id,
				'type'    => 'NUMERIC',
				'compare' => '!='
			)
		)
	);
	$new_query = new WP_Query( $new_args );
	if ( $query->found_posts > 1 ):
		if ( $new_query->have_posts() ):
			while ( $new_query->have_posts() ): $new_query->the_post();
				if ( get_field( 'broker_entry_id' ) !== $entry_id ):
					wp_delete_post( get_the_ID(), true );
				endif;
			endwhile;
		endif;
		wp_reset_postdata();
	endif;
}

/**
 * Save id as custom field
 *
 * @param $post
 * @param $args
 *
 * @return mixed
 */
function frm_save_entry_id_to_custom_field( $post, $args ) {
	if ( $args['form']->id == 5 ) {
		$post['post_custom']['broker_entry_id'] = $args['entry']->id;
	}

	return $post;
}

/**
 * Change upload path
 *
 * @param $folder
 *
 * @return string
 */
function frm_custom_upload( $folder, $atts ) {
	$folder = '../../wp-content/uploads/worksheets/';
	if ( $atts['form_id'] == 3 ) {
		global $current_user;
		$folder = $folder . '/' . $current_user->user_login;
	}

	return $folder;
}