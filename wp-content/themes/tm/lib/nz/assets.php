<?php

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
