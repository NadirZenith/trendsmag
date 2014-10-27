<?php

/**
 *      event post type
 */
// Register Custom Post Type
function register_event_post_type() {

      $labels = array(
            'name' => _x( 'Event items', 'Post Type General Name', 'text_domain' ),
            'singular_name' => _x( 'Event item', 'Post Type Singular Name', 'text_domain' ),
            'menu_name' => __( 'Events', 'text_domain' ),
            /* 'parent_item_colon' => __('Parent Item:', 'text_domain'), */
            'all_items' => __( 'All Event Items', 'text_domain' ),
            'view_item' => __( 'View Event Item', 'text_domain' ),
            'add_new_item' => __( 'Add Event Item', 'text_domain' ),
            'add_new' => __( 'Add Event Item', 'text_domain' ),
            'edit_item' => __( 'Edit Event Item', 'text_domain' ),
            'update_item' => __( 'Update Event Item', 'text_domain' ),
            'search_items' => __( 'Search Event Items', 'text_domain' ),
            'not_found' => __( 'Not found', 'text_domain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
      );

      $args = array(
            'label' => __( 'Event', 'text_domain' ),
            'description' => __( 'Event post type', 'text_domain' ),
            'labels' => $labels,
            'supports' => array( 'title', 'editor', 'thumbnail', 'post-formats', 'custom-fields' ),
            'taxonomies' => array('post_tag' ),
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
            'rewrite' => array(
                  'slug' => 'events'
            ),
            'rewrite' => true,
                /* 'capability_type' => 'page', */
      );
      register_post_type( 'event', $args );
}

// Hook into the 'init' action
add_action( 'init', 'register_event_post_type', 0 );

/**
 *      filter for pre get archive event
 */
function nz_pre_get_archive_event( $query ) {

      if (
                !$query->is_main_query() ||
                !$query->is_post_type_archive( 'event' ) ||
                is_admin()
      )
            return;

      /*return;*/
      $date = get_query_var( 'date' );

      $DateTime = DateTime::createFromFormat( 'd-m-Y', $date );
      if ( $DateTime ) {
            $DateTime->setTime( 0, 0, 0 ); //to avoid date problems
            $start_date = $DateTime->getTimestamp();
      } else {
            $start_date = strtotime( "now" );
      }

      $end_date = strtotime( '+ 1 month', $start_date );
      /*
        d( $start_date );
        d( $end_date );
       */

      /*
       */
      $query->set( 'posts_per_page', -1 );
      $query->set( 'order', 'ASC' );
      $query->set( 'orderby', 'meta_value_num' );
      $query->set( 'meta_key', 'event_begin_date' );
      $query->set( 'meta_query', array(
            array(
                  'key' => 'event_begin_date',
                  'value' => array( $start_date, $end_date ),
                  'type' => 'NUMERIC',
                  'compare' => 'BETWEEN'
            )
      ) );

      //load scripts
      //load styles
}

add_action( 'pre_get_posts', 'nz_pre_get_archive_event' );


/**
 *    Gravity forms
 */
global $nz;

$nz[ 'form.event' ] = array(
      'id' => 1,
      'ajax' => 'false'
);

$nz[ 'event_form' ] = function($nz) {
      $form = $nz[ 'form.event' ];

      $shortcode = sprintf( $nz[ 'shortcode.gform' ], $form[ 'id' ], $form[ 'ajax' ] );
      return do_shortcode( $shortcode );
};

add_filter( "gform_pre_render_" . $nz[ 'form.event' ][ 'id' ], "nz_pre_render_form_event" );

function nz_pre_render_form_event( $form ) {

      foreach ( $form[ 'fields' ] as &$value ) {
            if ( $value[ 'id' ] == 3 ) {
                  $date = new DateTime();
                  $date->setTime( 23, 59, 00 );
                  $value[ 'defaultValue' ] = $date->format( 'd/m/Y H:i' );
            }
      }

      return $form;
}

/** change gform event date to unix timestamp */
add_filter( "gform_post_data", "event_change_date_format", 10, 3 );

function event_change_date_format( $post_data, $form, $entry ) {
      global $nz;

      if ( $form[ "id" ] != $nz[ 'form.event' ][ 'id' ] ) {
            return $post_data;
      }

      $user_input_date = $post_data[ 'post_custom_fields' ][ 'event_begin_date' ];
      $user_input_DATETIME = date_create_from_format( 'd/m/Y H:i', $user_input_date );
      if ( $user_input_DATETIME ) {
            $post_data[ 'post_custom_fields' ][ 'event_begin_date' ] = $user_input_DATETIME->getTimestamp();
      }

      $user_input_date = $post_data[ 'post_custom_fields' ][ 'event_end_date' ];
      $user_input_DATETIME = date_create_from_format( 'd/m/Y H:i', $user_input_date );
      if ( $user_input_DATETIME ) {
            $post_data[ 'post_custom_fields' ][ 'event_end_date' ] = $user_input_DATETIME->getTimestamp();
      }

      return $post_data;
}

add_filter( "nz_gform_google_maps_after_submission_" . $nz[ 'form.event' ][ 'id' ] . '_11', "process_event_map", 10, 5 );

function process_event_map( $arg ) {
      $post_id = $arg[ 'entry' ][ 'post_id' ];
      $Map = json_decode( $arg[ 'entry' ][ '11' ] );
      $array_map = array(
            'address' => $Map->address,
            'lat' => $Map->lat,
            'lng' => $Map->lng
      );
      update_post_meta( $post_id, 'event_place_direction', $array_map );
}
