<?php

/**
 *      fashion post type
 */
// Register Custom Post Type
function register_news_post_type() {

      $labels = array(
            'name' => _x( 'News items', 'Post Type General Name', 'text_domain' ),
            'singular_name' => _x( 'News item', 'Post Type Singular Name', 'text_domain' ),
            'menu_name' => __( 'News', 'text_domain' ),
            /* 'parent_item_colon' => __('Parent Item:', 'text_domain'), */
            'all_items' => __( 'All News Items', 'text_domain' ),
            'view_item' => __( 'View News Item', 'text_domain' ),
            'add_new_item' => __( 'Add News Item', 'text_domain' ),
            'add_new' => __( 'Add News Item', 'text_domain' ),
            'edit_item' => __( 'Edit News Item', 'text_domain' ),
            'update_item' => __( 'Update News Item', 'text_domain' ),
            'search_items' => __( 'Search News Items', 'text_domain' ),
            'not_found' => __( 'Not found', 'text_domain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
      );

      $args = array(
            'label' => __( 'news', 'text_domain' ),
            'description' => __( 'News post type', 'text_domain' ),
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
            /*'rewrite' => true*/
                /* 'capability_type' => 'post', */
      );
      register_post_type( 'news', $args );
}

// Hook into the 'init' action
add_action( 'init', 'register_news_post_type', 0 );
