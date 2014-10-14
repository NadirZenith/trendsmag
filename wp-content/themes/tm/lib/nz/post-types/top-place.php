<?php

/**
 *      top place post type
 */
// Register Custom Post Type
function register_top_place_post_type() {

      $labels = array(
            'name' => _x( 'Top Places items', 'Post Type General Name', 'text_domain' ),
            'singular_name' => _x( 'Top Place item', 'Post Type Singular Name', 'text_domain' ),
            'menu_name' => __( 'Top Places', 'text_domain' ),
            /* 'parent_item_colon' => __('Parent Item:', 'text_domain'), */
            'all_items' => __( 'All Top Places Items', 'text_domain' ),
            'view_item' => __( 'View Top Place Item', 'text_domain' ),
            'add_new_item' => __( 'Add Top Place Item', 'text_domain' ),
            'add_new' => __( 'Add Top Place Item', 'text_domain' ),
            'edit_item' => __( 'Edit Top Place Item', 'text_domain' ),
            'update_item' => __( 'Update Top Place Item', 'text_domain' ),
            'search_items' => __( 'Search Top Places Items', 'text_domain' ),
            'not_found' => __( 'Not found', 'text_domain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
      );

      $args = array(
            'label' => __( 'Top Places', 'text_domain' ),
            'description' => __( 'Top Places post type', 'text_domain' ),
            'labels' => $labels,
            'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats' ),
            'taxonomies' => array('place-type'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => true,
                /* 'capability_type' => 'page', */
      );
      register_post_type( 'top-place', $args );
}

// Hook into the 'init' action
add_action( 'init', 'register_top_place_post_type', 0 );


// Register Custom Taxonomy
function place_type_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tipos de lugares', 'Taxonomy General Name', 'nz' ),
		'singular_name'              => _x( 'Tipo de Lugar', 'Taxonomy Singular Name', 'nz' ),
		'menu_name'                  => __( 'Place type', 'nz' ),
		'all_items'                  => __( 'All Items', 'nz' ),
		'parent_item'                => __( 'Parent Item', 'nz' ),
		'parent_item_colon'          => __( 'Parent Item:', 'nz' ),
		'new_item_name'              => __( 'New Item Name', 'nz' ),
		'add_new_item'               => __( 'Add New Item', 'nz' ),
		'edit_item'                  => __( 'Edit Item', 'nz' ),
		'update_item'                => __( 'Update Item', 'nz' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'nz' ),
		'search_items'               => __( 'Search Items', 'nz' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'nz' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'nz' ),
		'not_found'                  => __( 'Not Found', 'nz' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
        
	register_taxonomy( 'place-type', array( 'top-place' ), $args );
}


// Hook into the 'init' action
add_action( 'init', 'place_type_taxonomy', 0 );