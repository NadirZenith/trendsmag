<?php

/* include_once 'hide-default.php'; */

/* include_once 'news.php'; */
/* include_once 'fashion.php'; */
/* include_once 'art.php'; */
/* include_once 'music.php'; */
/* include_once 'street-trend.php'; */
include_once 'event.php';
include_once 'top-place.php';
/*
 */

/*
  'title'
  'editor' (content)
  'author'
  'thumbnail' (featured image, current theme must also support post-thumbnails)
  'excerpt'
  'trackbacks'
  'custom-fields'
  'comments' (also will see comment count balloon on edit screen)
  'revisions' (will store revisions)
  'page-attributes' (menu order, hierarchical must be true to show Parent option)
  'post-formats' add post formats, see Post Formats
 *  */

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
      $query->set( 'posts_per_page', 12 );
}

add_action( 'pre_get_posts', 'nz_front_page_query' );
?>