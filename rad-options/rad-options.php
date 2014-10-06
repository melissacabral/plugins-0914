<?php 
/*
Plugin Name: Company Info Options
Description: Adds a page under "settings" for company information
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */

/**
 * Add section to the Admin panel
 */
add_action('admin_menu', 'rad_options_admin_page');
function rad_options_admin_page(){
	//title, menu label, capability, slug, callback for content
	add_options_page( 'Company Information Settings', 'Company Info', 'manage_options', 
		'company-info', 'rad_options_form' );
}

//callback for content
function rad_options_form(){
	//double-check capability for security
	if( current_user_can( 'manage_options' ) ){
		//load the form
		require( plugin_dir_path( __FILE__ ) . 'rad-form.php'  );
	}else{
		wp_die('You do not have permission to view this page.');
	}
}

/**
 * Whitelist the option group so it is allowed in the DB
 */
add_action( 'admin_init', 'rad_options_create_settings' );
function rad_options_create_settings(){
	//group name, db row name, sanitizing Callback
	register_setting('rad_options_group', 'rad_options', 'rad_options_sanitize');
}

/**
 * Sanitizing callback
 * @param  array $input  list of dirty data fields
 */
function rad_options_sanitize($input){
	//clean each key in the array 
	$input['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );

	//allow <p> and <br> in address
	$allowed = array( 
			'p' => array(),
			'br' => array(),
	 );
	$input['address'] = wp_kses( $input['address'], $allowed );

	//all clean! return the data to WP for DB storage
	return $input;
}

/**
 * Bonus round! Shortcodes
 * allows you to show options in the post content areas
 */

//shortcode for [phone]
add_shortcode( 'phone', 'rad_shortcode_phone' );
function rad_shortcode_phone(){
	$values = get_option('rad_options');
	return $values['phone'];
}

//shortcode for [email]
add_shortcode( 'email', 'rad_shortcode_email' );
function rad_shortcode_email(){
	$values = get_option('rad_options');
	return '<a href="mailto:' . $values['email'] . '">Email Us at ' . $values['email']  . '</a>';
}

/**
 * Make widgets do shortcodes too
 */
add_filter( 'widget_text', 'do_shortcode' );