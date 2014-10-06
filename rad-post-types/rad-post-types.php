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
	//add the Brand taxonomy to products
	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 	=> true,  //checklist interface, can have parent/child terms
		'labels' 		=> array(
				'name' 			=> 'Brands',
				'singular_name' => 'Brand',
				'search_items'	=> 'Search Brands',
				'add_new_item' 	=> 'Add New Brand',
			),
	) );
	//add the Feature taxonomy to products
	register_taxonomy( 'feature', 'product', array(
		'hierarchical' 	=> false,  //comma-separated interface, flat list
		'labels' 		=> array(
				'name' 			=> 'Features',
				'singular_name' => 'Feature',
				'search_items'	=> 'Search Features',
				'add_new_item' 	=> 'Add New Feature',
			),
	) );
}

/**
 * Fix permalink 404 errors when the plugin activates
 * @since  0.1
 */
function rad_rewrite_flush(){
	rad_setup_products(); //call the func that registers CPT/Taxos
	flush_rewrite_rules(); //re-create the .htaccess rules
}
register_activation_hook( __FILE__, 'rad_rewrite_flush' );
