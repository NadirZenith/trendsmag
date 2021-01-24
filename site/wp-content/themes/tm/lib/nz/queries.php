<?php


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
