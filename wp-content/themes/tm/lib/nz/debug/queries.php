<?php

/*add_action( 'pre_get_posts', 'nz_facebook_page_tab' );*/

function nz_facebook_page_tab( $query ) {

      if (
                !$query->is_main_query() ||
                !$query->is_page( 'sobre-nosotros' ) ||
                is_admin()
      )
            return;

      add_filter( 'roots/wrap_base', 'nz_fb_page_tab_output' );
      /*add_action( 'wp_print_styles', 'my_deregister_styles', 100 );*/
      /*add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );*/
}

function nz_fb_page_tab_output() {
      return 'facebook-tab.php';
}

function my_deregister_styles() {
      global $wp_styles;
      $wp_styles = array();
}

function my_deregister_javascript() {
      global $wp_scripts;
      $wp_scripts = array();
}
