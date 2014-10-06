<?php 
/*
Plugin Name: Admin Panel Customization
Description: Alters the admin panel and login/register screens
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */

/**
 * Attach Stylesheet for Login and register Screen
 * @since  0.1
 */
add_action( 'login_enqueue_scripts', 'rad_login_style' );
function rad_login_style(){
	//get the path to the css file
	$login_css = plugins_url( 'css/login-style.css', __FILE__ );
	//put it on the page
	wp_enqueue_style( 'login-stylesheet', $login_css );
}

/**
 * Change login title and href from Wordpress to our home page
 */
add_filter('login_headerurl', 'rad_login_title_url');
function rad_login_title_url(){
	return home_url(); //get the path for the front page of the site
}

add_filter( 'login_headertitle', 'rad_login_tooltip' );
function rad_login_tooltip(){
	return 'Return to '. get_bloginfo( 'name' );
}

/**
 * Dashboard Widgets - Hide the ones you don't need!
 */
add_action( 'wp_dashboard_setup', 'rad_remove_dash_widgets' );
function rad_remove_dash_widgets(){
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	//remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    // remove_meta_box('dashboard_activity', 'dashboard', 'normal');   // Activity
}
/**
 * Custom dashboard Meta Box - Help!
 */
add_action('wp_dashboard_setup', 'rad_custom_dash_widget');
function rad_custom_dash_widget(){
	wp_add_dashboard_widget( 'dashboard_rad_widget', 'Melissa\'s Blog Feed', 
		'rad_dash_widget_content' );
}
//callback for the content
function rad_dash_widget_content(){
	wp_widget_rss_output( array(
		'url' 			=> 'http://wordpress.melissacabral.com/feed/',
		'items' 		=> 5,
		'show_date' 	=> true,
		'show_summary'	=> true,
		'show_author' 	=> false,
	) );
}

/**
 * Remove Wordpress menu from admin bar
 */
add_action( 'admin_bar_menu', 'rad_remove_wp_menu', 999 );

function rad_remove_wp_menu( $wp_admin_bar ){	
	$wp_admin_bar->remove_node('wp-logo');
}

/**
 * Admin and login favicons
 */
add_action( 'admin_head', 'rad_admin_favi' );
add_action( 'login_head', 'rad_admin_favi' );

function rad_admin_favi(){
	$favicon_path = plugins_url( 'images/admin-favicon.ico', __FILE__ );
	?>
	<link rel="icon" type="image/x-icon" href="<?php echo $favicon_path ?>">
	<?php
}


