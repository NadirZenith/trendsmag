<?php

/**
 *      NZ DEBUG FUNCTIONS
 */

/**
 *      Dump headers
 */
/* add_filter('wp_headers', 'nz_debug_headers'); */

function nz_debug_headers( $headers ) {
      d( $headers );
}

/* add_filter('wp_head', 'nz_debug_head'); */

function nz_debug_head( $head ) {
      d( $head );
}

function nz_get_image_sizes() {

      global $_wp_additional_image_sizes;
      $sizes = array();
      $intermediate_image_sizes = get_intermediate_image_sizes();
      // Create the full array with sizes and crop info
      foreach ( $intermediate_image_sizes as $_size ) {

            if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                  $sizes[ $_size ][ 'width' ] = get_option( $_size . '_size_w' );
                  $sizes[ $_size ][ 'height' ] = get_option( $_size . '_size_h' );
                  $sizes[ $_size ][ 'crop' ] = ( bool ) get_option( $_size . '_crop' );
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                  $sizes[ $_size ] = array(
                        'width' => $_wp_additional_image_sizes[ $_size ][ 'width' ],
                        'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
                        'crop' => $_wp_additional_image_sizes[ $_size ][ 'crop' ]
                  );
            }
      }


      return $sizes;
}

/**
 *      FLUSH REWRITE RULES
 */
/* add_filter('init', 'nz_flush_rewrite_rules'); */

/*
  function nz_flush_rewrite_rules2() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
  }
 */

function nz_dump_print() {
      global $nz_dump_more;
      foreach ( $nz_dump_more as $key => $value ) {
            d( $value );
      }
      global $wp_query;
      echo '<p>';
      d($wp_query);
      echo '</p>';
}

function nz_dump( $var ) {
      global $nz_dump_more;
      $nz_dump_more[] = $var;
}
