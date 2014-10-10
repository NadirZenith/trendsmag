<?php

/**
 *      Home Page Query
 */
function nz_front_page_query( $query ) {

      if ( !$query->is_main_query() || is_admin() )
            return;

      /* $query->set( 'lang', array('en', 'es')); */

      if ( !$query->is_front_page() || !$query->is_home )
            return;

      /* $query->set( 'post_type', array( 'fashion', 'news', 'event', 'art', 'street-trend', 'music' ) ); */
      $query->set( 'posts_per_page', 6 );
}

add_action( 'pre_get_posts', 'nz_front_page_query' );


/**
 *      Add query vars
 */
add_filter( 'query_vars', 'add_used_vars' );

//to use get_query_var( 'action' ) && TYPE;
function add_used_vars( $vars ) {
      $vars[] = "type"; //
      $vars[] = "action"; //
      $vars[] = "date"; //
      /* $vars[] = "child"; // */
      return $vars;
}

add_action( 'pre_get_posts', 'nz_pre_get_archive' );

/**
 *      filter for pre get archive
 */
function nz_pre_get_archive( $query ) {

      if (
                !$query->is_main_query() ||
                !$query->is_archive()
      )
            return;

      if ( $query->is_paged() ) {
            $query->set( 'posts_per_page', 10 );
      } else {
            $query->set( 'posts_per_page', 10 );
      }
}
