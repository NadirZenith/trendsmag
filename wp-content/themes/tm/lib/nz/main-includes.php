<?php

/**
 *      NZ DEBUG FILES
 */
if ( WP_ENV === 'development' ) {
      include_once 'debug/functions.php';
      include_once 'debug/css-media-queries.php'; //output BAR on wp_footer hook
      include_once 'debug/queries.php';
}

/**
 *   -------   NZ INCLUDE FILES  ------------
 */
/**
 *      VENDORS
 */
//autoload
include_once 'vendor/autoload.php';
include_once 'nz-container.php';
//wp
include_once 'vendor/roots-rewrites/roots-rewrites.php'; //rewrite for assets
include_once 'vendor/soil/soil.php'; //cleanup wordpress headers
include_once 'vendor/wp-thumb/wpthumb.php'; //dynamic image resize
include_once 'vendor/advanced-custom-fields/acf.php';
include_once 'custom-fields/acf-config.php';
include_once 'todo-pending-posts.php';


/**
 *      NZ MAIN FILES
 */
include_once 'rewrites.php';
include_once 'i18n.php';
include_once 'nz-bs-carousel/nz-bs-carousel.php';
include_once 'assets.php';
include_once 'queries.php';
include_once 'media/nz-media.php';
include_once 'media/nz-gallery.php';
include_once 'post-types/post-types.php';
include_once 'template.php';
include_once 'nz-widgets.php';
include_once 'search-menu-item.php';
include_once 'home-menu-item.php';
include_once 'social/facebook-config.php';
include_once 'social/twitter-config.php';
include_once 'maintenance.php';
/* include_once 'sidebar.php'; */



/**
 *      NZ TEST / DEV
 */
/* include_once 'meta/head.php'; //using roots soil */
/* include_once 'meta/headers.php'; */

/**
 *      Excerpt size
 */
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_length( $length ) {
      return 20;
}

/**
 *      remove plugin from list
 */
function nz_hide_plugin() {
      global $wp_list_table;
      d( $wp_list_table );
      return;
      $hidearr = array( 'plugin-directory/plugin-file.php' );
      $myplugins = $wp_list_table->items;
      foreach ( $myplugins as $key => $val ) {
            if ( in_array( $key, $hidearr ) ) {
                  unset( $wp_list_table->items[ $key ] );
            }
      }
}

/* add_action('pre_current_active_plugins', 'nz_hide_plugin'); */

function add_admin_scripts( $hook ) {

      global $post;

      if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            if ( 'event' === $post->post_type ) {
                  wp_enqueue_script( 'nz_maps_script', get_stylesheet_directory_uri() . '/assets/js/admin/nz_maps_admin_script.js' );
            }
      }
}

/*add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );*/


