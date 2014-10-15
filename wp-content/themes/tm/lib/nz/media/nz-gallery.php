<?php

if ( current_theme_supports( 'nz-bootstrap-gallery' ) ) {
      remove_shortcode( 'gallery' );
      add_shortcode( 'gallery', 'nz_gallery_shortcode' );
      /* add_filter( 'use_default_gallery_style', '__return_null' ); */
}

/**
  @param array $attr {
 *     Attributes of the gallery shortcode.
 *
 *     @type string $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 *     @type string $orderby    The field to use when ordering the images. Default 'menu_order ID'.
 *                              Accepts any valid SQL ORDERBY statement.
 *     @type int    $id         Post ID.
 *     @type string $itemtag    HTML tag to use for each image in the gallery.
 *                              Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
 *     @type string $icontag    HTML tag to use for each image's icon.
 *                              Default 'dt', or 'div' when the theme registers HTML5 gallery support.
 *     @type string $captiontag HTML tag to use for each image's caption.
 *                              Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
 *     @type int    $columns    Number of columns of images to display. Default 3.
 *     @type string $size       Size of the images to display. Default 'thumbnail'.
 *     @type string $ids        A comma-separated list of IDs of attachments to display. Default empty.
 *     @type string $include    A comma-separated list of IDs of attachments to include. Default empty.
 *     @type string $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
 *     @type string $link       What to link each image to. Default empty (links to the attachment page).
 *                              Accepts 'file', 'none'.
 * }
 *    @return string HTML content to display gallery.
 */
function nz_gallery_shortcode( $attr ) {

      $post = get_post();

      static $instance = 0;
      $instance++;

      if ( !empty( $attr[ 'ids' ] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr[ 'orderby' ] ) ) {
                  $attr[ 'orderby' ] = 'post__in';
            }
            $attr[ 'include' ] = $attr[ 'ids' ];
      }


      $nz_bootstrap_gallery = apply_filters( 'nz_bootstrap_gallery', '', $attr );
      if ( $nz_bootstrap_gallery != '' ) {
            return $nz_bootstrap_gallery;
      }

      // We're trusting author input, so let's at least make sure it looks like a valid orderby statement

      if ( isset( $attr[ 'orderby' ] ) ) {
            $attr[ 'orderby' ] = sanitize_sql_orderby( $attr[ 'orderby' ] );
            if ( !$attr[ 'orderby' ] ) {
                  unset( $attr[ 'orderby' ] );
            }
      }



      $atts = shortcode_atts( array(
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => $post ? $post->ID : 0,
            /* 'itemtag' => 'figure', */
            /* 'icontag' => 'div', */
            /* 'captiontag' => 'figcaption', */
            'columns' => 3,
            'size' => 'thumbnail',
            'include' => '',
            'exclude' => '',
            'link' => ''
                ), $attr, 'gallery' );

      $id = intval( $atts[ 'id' ] );
      if ( 'RAND' == $atts[ 'order' ] ) {
            $atts[ 'orderby' ] = 'none';
      }

      if ( !empty( $atts[ 'include' ] ) ) {
            $_attachments = get_posts( array( 'include' => $atts[ 'include' ], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts[ 'order' ], 'orderby' => $atts[ 'orderby' ] ) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                  $attachments[ $val->ID ] = $_attachments[ $key ];
            }
      } elseif ( !empty( $atts[ 'exclude' ] ) ) {
            $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts[ 'exclude' ], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts[ 'order' ], 'orderby' => $atts[ 'orderby' ] ) );
      } else {
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts[ 'order' ], 'orderby' => $atts[ 'orderby' ] ) );
      }

      if ( empty( $attachments ) ) {
            return '';
      }
      /**
       * @todo nz test feed for gallery
       *     if ( is_feed() ) {
       *           $feed_output = "\n";
       *           foreach ( $attachments as $att_id => $attachment ) {
       *                 $feed_output .= wp_get_attachment_link( $att_id, $atts[ 'size' ], true ) . "\n";
       *           }
       *           return $feed_output;
       *     }
       */
      $columns = (12 % intval( $atts[ 'columns' ] ) == 0) ? intval( $atts[ 'columns' ] ) : 4;
      $grid = sprintf( 'col-sm-%1$s col-lg-%1$s', 12 / $columns );

      $selector = "gallery-{$instance}";

      $size_class = sanitize_html_class( $atts[ 'size' ] );
      $output = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

      foreach ( $attachments as $id => $attachment ) {
            $image_output = apply_filters( 'nz_bootstrap_gallery_attachment_link', $id, $atts );
            if ( !isset( $image_output ) ) {
                  if ( !empty( $atts[ 'link' ] ) && 'file' === $atts[ 'link' ] ) {
                        $image_output = wp_get_attachment_link( $id, $atts[ 'size' ], false, false );
                  } elseif ( !empty( $atts[ 'link' ] ) && 'none' === $atts[ 'link' ] ) {
                        $image_output = wp_get_attachment_image( $id, $atts[ 'size' ], false );
                  } else {
                        $image_output = wp_get_attachment_link( $id, $atts[ 'size' ], true, false );
                  }
            }

            $output .= "<figure class='gallery-item {$grid}'>";
            $output .= "
			<div class='gallery-icon thumbnail'>
				$image_output
			</div>";
            if ( trim( $attachment->post_excerpt ) ) {
                  $output .= "
				<figcaption class='wp-caption-text gallery-caption'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</figcaption>";
            }
            $output .= "</figure>";
      }


      $output .= "</div>\n";

      return $output;
}

add_filter( 'nz_bootstrap_gallery_attachment_link', 'nz_gallery_attach_img_tag' );

function nz_gallery_attach_img_tag( $id ) {
      $thumb_info = nz_get_thumb( $id, 500, 250 );
      $thumb_tag = nz_get_img_tag( $thumb_info[ '0' ], 'gallery-item', $thumb_info[ 1 ], $thumb_info[ 2 ] );

      $image_info = nz_get_image( $id, 1000 );

      return '<a rel="nz_gallery" href="' . $image_info[ 0 ] . '">' . $thumb_tag . '</a>';
}
