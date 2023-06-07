<?php

/**
 * Register the content type
 */
add_action( 'init', 'bh_register_promotions_content_type' );
function bh_register_promotions_content_type() {

	//* NAME
	$name_plural = 'Promotions';
	$name_singular = 'Promotion';
	$post_type = 'promotions';
	$slug = 'promotions';
	$icon = 'lightbulb'; //* https://developer.wordpress.org/resource/dashicons/
	$supports = array( 'title', 'editor' );

	$labels = array(
		'name' => $name_plural,
		'singular_name' => $name_singular,
		'add_new' => 'Add new',
		'add_new_item' => 'Add new ' . $name_singular,
		'edit_item' => 'Edit ' . $name_singular,
		'new_item' => 'New ' . $name_singular,
		'view_item' => 'View ' . $name_singular,
		'search_items' => 'Search ' . $name_plural,
		'not_found' =>  'No ' . $name_plural . ' found',
		'not_found_in_trash' => 'No ' . $name_plural . ' found in trash',
		'parent_item_colon' => '',
		'menu_name' => $name_plural,
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => $slug ),
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-' . $icon,
		'show_in_rest' => true, // enable gutenberg
		'supports' => $supports,
	);

	register_post_type( $post_type, $args );

}

//* Redirect the single posts to the custom archive page
add_action( 'template_redirect', 'bh_redirect_single_promotions' );
function bh_redirect_single_promotions() {
	
    if ( !is_singular( 'promotions' ) )
        return;

    wp_redirect( home_url(), 301 );

    exit;
}