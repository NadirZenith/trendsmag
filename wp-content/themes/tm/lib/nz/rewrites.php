<?php

class NZ_Rewrite_Files {

      public function __construct() {
            $wp_upload_dir = wp_upload_dir();

            $this->upload_base = str_replace(home_url(), '', $wp_upload_dir['baseurl']);
        
            add_filter( 'nz_get_thumb', array( $this, 'nz_clean_files_urls' ) );

            if ( is_admin() ) {
                  add_action( 'admin_init', array( $this, 'backend' ) );
            }
      }

      public function backend() {

            global $wp_rewrite;

            $roots_new_non_wp_rules = array(
                'files/(.*)/(.*)/(.*)/(.*)\.(jpg|jpeg|png|gif)$' => $this->upload_base . '/cache/$1/$2/$3/$4.$5'
            );

            $wp_rewrite->non_wp_rules = array_merge( $wp_rewrite->non_wp_rules, $roots_new_non_wp_rules );
            return;
      }

      public function nz_clean_files_urls( $img_tag ) {
            if ( strpos( $img_tag, 'wp-content/uploads/' ) > 0 ) {
                  $img_tag = str_replace( 'web/wp-content/uploads/cache/', 'files/', $img_tag );
            }
            return $img_tag;
      }

}

new NZ_Rewrite_Files();

class NZRoutes {

      public $post_types;
      public $tags;

      function __construct() {
            //post_types
            $this->post_types = array( 'news', 'fashion', 'art', 'music', 'street-trend', 'event', 'place-top' );

            add_action( 'post_type_link', array( $this, 'post_type_link' ), 1, 3 );
            add_action( 'post_type_archive_link', array( $this, 'post_type_archive_link' ), 1, 3 );

            //tags
            $this->tags == array( 'post_tags' );

            //generate rewrite
            if ( is_admin() )
                  add_action( 'generate_rewrite_rules', array( $this, 'generate_rewrite_rules' ) );
      }

      /**
       *    Get post type single link (single)
       * @param type $link
       * @param type $post
       * @return type
       */
      function post_type_link( $link, $post = 0 ) {
            if ( in_array( $post->post_type, $this->post_types ) ) {
                  return home_url( $post->post_type . '/' . $post->ID );
            } else {
                  return $link;
            }
      }

      /**
       *    Get post type archive link
       * @param type $link
       * @param type $post_type
       * @return type
       */
      function post_type_archive_link( $link, $post_type ) {
            if ( in_array( $post_type, $this->post_types ) ) {
                  return home_url( $post_type );
            } else {
                  return $link;
            }
      }

      /**
       *    Rewrite rules for post types
       * @return string
       */
      function post_type_rewrite_rules() {
            $rules = array();

            $post_types_regex = '(' . join( '|', $this->post_types ) . ')';
            /* foreach ( $this->post_types as $post_type ) { */
            /* $regex = $post_type . '/?([0-9]+)?$'; */
            /* $regex = $post_types_regex . '/?([0-9]+)?$'; */
            $regex = $post_types_regex . '/?([0-9]+|page)?/?([^/]+)?$';

            /* $redirect = 'index.php?post_type=' . $post_type . '&p=$matches[1]'; */
            /* $redirect = 'index.php?post_type=$matches[1]&p=$matches[2]'; */
            $redirect = 'index.php?post_type=$matches[1]&p=$matches[2]&paged=$matches[3]';

            $rules[ $regex ] = $redirect;
            /* } */
            return $rules;
      }

      /**
       *    Rewrite rules for post types
       *    
       * @return string
       */
      function post_tags_rewrite_rules() {
            $rules = array();
            $post_types_regex = '(' . join( '|', $this->post_types ) . ')';

            //'tag/([^/]+)/page/?([0-9]{1,})/?$'
            //"index.php?tag=$matches[1]&paged=$matches[2]"
            $regex = $post_types_regex . '/?tag/([^/]+)'; ///page?/([^/]+)?$';

            /* $redirect = 'index.php?post_type=$matches[1]&tag=$matches[2]&paged=$matches[3]'; */
            $redirect = 'index.php?post_type=$matches[1]&tag=$matches[2]';

            $rules[ $regex ] = $redirect;
            return $rules;
      }

      /**
       *    Rules for pages ..
       * @return string
       */
      function get_default_rules() {
            $rules = array();

            //PAGES
            $rules[ '(.?.+?)(/[0-9]+)?/?$' ] = 'index.php?pagename=$matches[1]&page=$matches[2]';

            return $rules;
      }

      function generate_rewrite_rules() {
            global $wp_rewrite;

            $rules = $rules = $this->post_tags_rewrite_rules() +
                      $this->post_type_rewrite_rules() +
                      $this->get_default_rules();


            $wp_rewrite->rules = $rules;
            /* df( $wp_rewrite ); */
      }

}

/* new NZRoutes(); */

add_action( 'init', 'nz_add_tags_rules' );

function nz_add_tags_rules() {
      $post_types = array( 'news', 'fashion', 'art', 'music', 'street-trend', 'top-place' );
      $post_types_regex = '(' . join( '|', $post_types ) . ')';

      //'tag/([^/]+)/page/?([0-9]{1,})/?$'
      //"index.php?tag=$matches[1]&paged=$matches[2]"
      $regex = $post_types_regex . '/?tag/([^/]+)'; ///page?/([^/]+)?$';

      /* $redirect = 'index.php?post_type=$matches[1]&tag=$matches[2]&paged=$matches[3]'; */
      $redirect = 'index.php?post_type=$matches[1]&tag=$matches[2]';


      add_rewrite_rule( $regex, $redirect, 'top' );
}

?>