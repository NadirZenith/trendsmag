<?php

add_filter( 'wp_nav_menu_items', 'nz_add_menu_logo_item', 10, 2 );

function nz_add_menu_logo_item( $items, $args ) {

      if ( $args->theme_location == "primary_navigation" ) {

            $class = is_front_page() ? 'active ' : '';

            $menu_original = '<li class="' . $class . 'menu-tm">'
                      . '<a href="http://lab.dev/trendsmag/">TM'
                      . '<img src="' . nz_get_image_asset( 'logo/white-menu-rc1.png' ) . '"/>'
                      /* . '<img src="'.  nz_get_image_asset( 'logo-mini-v2.png').'"/>' */
                      . '</a>'
                      . '</li>';

            $items = $menu_original . $items;
      }
      return $items;
}
