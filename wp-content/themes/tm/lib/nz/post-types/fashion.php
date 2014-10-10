<?php

/**
 *      fashion post type
 */
// Register Custom Post Type
function register_fashion_post_type() {

      $labels = array(
            'name' => _x( 'Fashion items', 'Post Type General Name', 'text_domain' ),
            'singular_name' => _x( 'Fashion item', 'Post Type Singular Name', 'text_domain' ),
            'menu_name' => __( 'Fashion', 'text_domain' ),
            /* 'parent_item_colon' => __('Parent Item:', 'text_domain'), */
            'all_items' => __( 'All Fashion Items', 'text_domain' ),
            'view_item' => __( 'View Fashion Item', 'text_domain' ),
            'add_new_item' => __( 'Add New Fashion Item', 'text_domain' ),
            'add_new' => __( 'Add New Fashion Item', 'text_domain' ),
            'edit_item' => __( 'Edit Fashion Item', 'text_domain' ),
            'update_item' => __( 'Update Fashion Item', 'text_domain' ),
            'search_items' => __( 'Search Fashion Items', 'text_domain' ),
            'not_found' => __( 'Not found', 'text_domain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
      );
      $args = array(
            'label' => __( 'fashion', 'text_domain' ),
            'description' => __( 'Fashion post type', 'text_domain' ),
            'labels' => $labels,
            'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats' ),
            'taxonomies' => array( 'category', 'post_tag' ),
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
            'rewrite' => true
                /* 'capability_type' => 'page', */
      );
      register_post_type( 'fashion', $args );
}

// Hook into the 'init' action
add_action( 'init', 'register_fashion_post_type', 0 );

/**
 *      filter for pre get archive fashion
 */
function nz_pre_get_archive_fashion( $query ) {

      if (
                !$query->is_main_query() ||
                !$query->is_post_type_archive( 'fashion' ) ||
                is_admin()
      )
            return;
      
      d();

      $query->set( 'lang', array( 'en', 'es' ) );
}

/*add_action( 'pre_get_posts', 'nz_pre_get_archive_fashion' );*/
