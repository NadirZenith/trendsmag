<?php

add_action( 'admin_bar_menu', 'nz_toolbar_todo', 1050 );

function nz_toolbar_todo( $wp_admin_bar ) {

      $todo_total = 0;
      $post_types = array( 'event' );
      $info_string = '<span style="color:red;"> ( %d ) </span>';

      foreach ( $post_types as $post_type ) {
            $posts = get_posts(
                      array(
                            'posts_per_page' => -1,
                            'post_type' => $post_type,
                            'post_status' => 'pending',
                            'suppress_filters' => true
                      )
            );
            $total_posts = count( $posts );
            if ( $total_posts > 0 ) {

                  $url = ($total_posts == 1) ?
                            get_edit_post_link( $posts[ 0 ]->ID ) :
                            admin_url( 'edit.php?post_status=pending&post_type=' . $post_type );

                  $args = array(
                        'id' => 'pending-' . $post_type,
                        'title' => $post_type . sprintf( $info_string, $total_posts ), // alter the title of existing node
                        'href' => $url,
                        'parent' => 'nz-todo', // set parent to false to make it a top level (parent) node
                  );
                  $todo_total += $total_posts;

                  $wp_admin_bar->add_node( $args );
            }
      }
      $args = array(
            'id' => 'nz-todo',
            'title' => '@Todo ' . sprintf( $info_string, $todo_total ),
            'meta' => array( 'class' => 'nz-toolbar-todo' )
      );

      $wp_admin_bar->add_node( $args );
}
