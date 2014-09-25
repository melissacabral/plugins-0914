<?php 
/*
Plugin Name: Corner Ribbon
Description: A basic plugin that puts a promo-ribbon on the corner of the screen
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */

/**
 * HTML output
 * @since 0.1
 */
add_action( 'wp_footer', 'rad_ribbon_output' );
function rad_ribbon_output(){
	//only show on the front page or the blog page
	if( is_front_page() OR is_home() ):
	?>
	<!-- Rad Corner Ribbon by Melissa C. -->
	<a href="#" id="rad-corner-ribbon">
		<img src="<?php echo plugins_url( 'images/corner-ribbon.png', __FILE__ ); ?>" alt="View the Shop">
	</a>
	<!-- End Rad Corner Ribbon -->
	<?php
	endif;
}

/**
 * Attach stylesheet
 * @since 0.1
 */
add_action( 'wp_enqueue_scripts', 'rad_ribbon_style' );
function rad_ribbon_style(){
	//only load on home page or front page
	if( is_front_page() OR is_home() ):
		//filepath for the CSS document
		$css_file = plugins_url( 'css/style.css', __FILE__ );
		//tell WP this file exists
		wp_register_style( 'rad-ribbon-css', $css_file );
		//put the file on the page
		wp_enqueue_style( 'rad-ribbon-css' );
	endif;
}