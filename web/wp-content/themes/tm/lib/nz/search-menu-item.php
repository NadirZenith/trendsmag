<?php

/*add_filter( 'wp_nav_menu_items', 'nz_add_menu_search_item', 10, 2 );*/

function nz_add_menu_search_item( $items, $args ) {
      if ( $args->theme_location == "primary_navigation" ) {

            $search_menu_content = '<a class="search fa fa-search" href="#" ></a>';
            $search_form = '
                  <div class="menu-search-form-wrapper">
                        <form role="search" method="get" class="" action="' . esc_url( home_url( '/' ) ) . '">
                              <input class="search-field form-control" type="search" value="' . get_search_query() . '" name="s" placeholder="' . __( 'Search', 'roots' ) . '">
                        </form>
                  </div>';

            $search_menu_container = '<li class="menu-search hidden-xs">' . $search_menu_content . $search_form . '</li>';

            $items = $items . $search_menu_container;
      }
      return $items;
}
