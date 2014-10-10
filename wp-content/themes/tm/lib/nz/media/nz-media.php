<?php

/**
 *  add theme suport post thumbnails
 */
add_theme_support( 'post-thumbnails' );


/**
 * remove default sizes
 */
add_filter( 'intermediate_image_sizes', '__return_empty_array' );

/**
 *      get thumbnail crop default
 *      uses WP-THUMB
 * 
 *    @return array/false returns image thumb array
 *          array(
 *                0 => url,
 *                1 => w,
 *                2 => h,
 *                3 => crop
 *          )
 */
function nz_get_thumb( $id, $width, $height, $crop = true ) {

      $args = array(
            'width' => $width,
            'height' => $height,
            'crop' => $crop
      );

      $thumb_array = wpthumb_post_image( null, $id, $args );

      $thumb_array[ 0 ] = apply_filters( 'nz_get_thumb', $thumb_array[ 0 ] );

      return $thumb_array;
}

/**
 *    same as above but returns full image tag
 * 
 *    @return string Image tag
 */
function nz_get_thumb_tag( $w, $h, $class = '', $title = null ) {

      $id = get_post_thumbnail_id();

      $alt = get_the_title();
      /* $title = $title ? 'title="' . esc_attr( $title ) . '" ' : ''; */

      $thumb = nz_get_thumb( $id, $w, $h );

      if ( $thumb ) {
            return nz_get_img_tag( $thumb[ 0 ], $alt, $thumb[ 1 ], $thumb[ 2 ], $class, $title );
      }

      return FALSE;
}

/**
 *    get image by id
 *    only widht -> no crop
 * 
 *    @return array 
 *    @see nz_get_thumb
 */
function nz_get_image( $id, $width ) {

      $image_array = nz_get_thumb( $id, $width, $height, FALSE );

      return $image_array;
}

function nz_get_image_tag( $width, $class = '', $title = NULL ) {

      $img_tag = nz_get_thumb_tag( $width, null, $class, $title );

      return $img_tag;
}

/**
 * returns <img tag>
 */
function nz_get_img_tag( $src, $alt, $width = null, $height = null, $class = "", $title = NULL ) {
      $title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';

      $hwstring = image_hwstring( $width, $height );

      $html = '<img src="' . esc_attr( $src ) . '" alt="' . esc_attr( $alt ) . '" ' . $title . $hwstring . 'class="' . $class . '" >';

      return $html;
}

function nz_send_image_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt ) {

      $img_array = nz_get_image( $id, 1000 );

      $class = 'align' . $align . ' nz-image-' . $id;

      $html = nz_get_img_tag( $img_array[ 0 ], $alt, $img_array[ 1 ], $img_array[ 2 ], $class, $caption );

      if ( $url )
            $html = '<a href="' . esc_attr( $img_array[ 0 ] ) . '" class="thumbnail">' . $html . '</a>';

      return $html;
}

add_filter( 'image_send_to_editor', 'nz_send_image_to_editor', 10, 9 );

add_filter( 'disable_captions', '__return_true' );
