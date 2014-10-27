<?php

if ( !function_exists( 'is_localhost' ) ) {

      function is_localhost() {
            $whitelist = array( '127.0.0.1', '::1' );
            if ( in_array( $_SERVER[ 'REMOTE_ADDR' ], $whitelist ) )
                  return true;
      }

}

function nz_get_asset( $type, $asset = null ) {
      if ( $asset ) {
            if ( is_localhost() ) {

                  return trailingslashit( get_site_url() ) . 'assets/' . trailingslashit( $type ) . $asset;
            } else {
                  return trailingslashit( get_home_url() ) . 'assets/' . trailingslashit( $type ) . $asset;
            }
      }
      return FALSE;
}

function nz_get_image_asset( $asset = null ) {
      if ( $asset ) {
            return nz_get_asset( 'img', $asset );
      }
      return FALSE;
}
