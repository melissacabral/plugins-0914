<?php
/*
Plugin Name: Custom Post Types - Products
Description: Adds Products to the site
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */

/**
 * Create "Products" post type
 * @since  0.1
 */
add_action( 'init', 'rad_setup_products' );
function rad_setup_products(){
	register_post_type( 'product', array(
			'public' 		=> true,
			'has_archive' 	=> true,
			'menu_position' => 5,
			'menu_icon'		=> 'dashicons-cart',
			'supports' 		=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'labels' 		=> array(
				'name' => 'Products',
				'singular_name' => 'Product',
				'add_new_item' 	=> 'Add New Product',
				'not_found'		=> 'No products found',
				),
		) );
}