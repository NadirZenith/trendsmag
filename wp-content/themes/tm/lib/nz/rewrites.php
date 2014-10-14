<?php

class NZ_Rewrite_Files {

      public function __construct() {
            add_filter( 'nz_get_thumb', array( $this, 'nz_clean_files_urls' ) );

            if ( is_admin() ) {
                  add_action( 'admin_init', array( $this, 'backend' ) );
            }
      }

      public function backend() {

            global $wp_rewrite;

            $roots_new_non_wp_rules = array(
                  /**
                   * @todo nz get web/wp-content/uploads/ dynamicaly
                   *                   */
                  'files/(.*)/(.*)/(.*)/(.*)\.(jpg|jpeg|png|gif)$' => 'web/wp-content/uploads' . '/cache/$1/$2/$3/$4.$5'
                      /* 'files/(.*)/(.*)/(.*)\.(jpg|jpeg|png|gif)$' => 'wp-content/uploads' . '/cache/$1/$2/$3.$4' */
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

/**
 * dump wp rewrite
 */
/* add_action( 'wp_footer', 'nz_dump_wp_rewrite' ); */

/* function nz_dump_wp_rewrite() {
  global $wp_rewrite;

  d( $wp_rewrite);
  } */

return;
?>
default rules:
'news/?$' => string (24) "index.php?post_type=news"

'news/feed/(feed|rdf|rss|rss2|atom)/?$' => string (41) "index.php?post_type=news&feed=$matches[1]"

'news/(feed|rdf|rss|rss2|atom)/?$' => string (41) "index.php?post_type=news&feed=$matches[1]"

'news/page/([0-9]{1,})/?$' => string (42) "index.php?post_type=news&paged=$matches[1]"

'fashion/?$' => string (27) "index.php?post_type=fashion"

'fashion/feed/(feed|rdf|rss|rss2|atom)/?$' => string (44) "index.php?post_type=fashion&feed=$matches[1]"

'fashion/(feed|rdf|rss|rss2|atom)/?$' => string (44) "index.php?post_type=fashion&feed=$matches[1]"

'fashion/page/([0-9]{1,})/?$' => string (45) "index.php?post_type=fashion&paged=$matches[1]"

'art/?$' => string (23) "index.php?post_type=art"

'art/feed/(feed|rdf|rss|rss2|atom)/?$' => string (40) "index.php?post_type=art&feed=$matches[1]"

'art/(feed|rdf|rss|rss2|atom)/?$' => string (40) "index.php?post_type=art&feed=$matches[1]"

'art/page/([0-9]{1,})/?$' => string (41) "index.php?post_type=art&paged=$matches[1]"

'music/?$' => string (25) "index.php?post_type=music"

'music/feed/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?post_type=music&feed=$matches[1]"

'music/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?post_type=music&feed=$matches[1]"

'music/page/([0-9]{1,})/?$' => string (43) "index.php?post_type=music&paged=$matches[1]"

'street-trend/?$' => string (32) "index.php?post_type=street-trend"

'street-trend/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?post_type=street-trend&feed=$matches[1]"

'street-trend/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?post_type=street-trend&feed=$matches[1]"

'street-trend/page/([0-9]{1,})/?$' => string (50) "index.php?post_type=street-trend&paged=$matches[1]"

'place-top/?$' => string (29) "index.php?post_type=place-top"

'place-top/feed/(feed|rdf|rss|rss2|atom)/?$' => string (46) "index.php?post_type=place-top&feed=$matches[1]"

'place-top/(feed|rdf|rss|rss2|atom)/?$' => string (46) "index.php?post_type=place-top&feed=$matches[1]"

'place-top/page/([0-9]{1,})/?$' => string (47) "index.php?post_type=place-top&paged=$matches[1]"

'category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (52) "index.php?category_name=$matches[1]&feed=$matches[2]"

'category/(.+?)/(feed|rdf|rss|rss2|atom)/?$' => string (52) "index.php?category_name=$matches[1]&feed=$matches[2]"

'category/(.+?)/page/?([0-9]{1,})/?$' => string (53) "index.php?category_name=$matches[1]&paged=$matches[2]"

'category/(.+?)/?$' => string (35) "index.php?category_name=$matches[1]"

'tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?tag=$matches[1]&feed=$matches[2]"

'tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?tag=$matches[1]&feed=$matches[2]"

'tag/([^/]+)/page/?([0-9]{1,})/?$' => string (43) "index.php?tag=$matches[1]&paged=$matches[2]"

'tag/([^/]+)/?$' => string (25) "index.php?tag=$matches[1]"

'type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (50) "index.php?post_format=$matches[1]&feed=$matches[2]"

'type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (50) "index.php?post_format=$matches[1]&feed=$matches[2]"

'type/([^/]+)/page/?([0-9]{1,})/?$' => string (51) "index.php?post_format=$matches[1]&paged=$matches[2]"

'type/([^/]+)/?$' => string (33) "index.php?post_format=$matches[1]"

'news/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'news/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'news/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'news/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'news/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?news=$matches[1]&feed=$matches[2]"

'news/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?news=$matches[1]&feed=$matches[2]"

'news/([^/]+)/page/?([0-9]{1,})/?$' => string (44) "index.php?news=$matches[1]&paged=$matches[2]"

'news/([^/]+)/comment-page-([0-9]{1,})/?$' => string (44) "index.php?news=$matches[1]&cpage=$matches[2]"

'news/([^/]+)(/[0-9]+)?/?$' => string (43) "index.php?news=$matches[1]&page=$matches[2]"

'news/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'news/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'news/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'news/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'fashion/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'fashion/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'fashion/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'fashion/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'fashion/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (46) "index.php?fashion=$matches[1]&feed=$matches[2]"

'fashion/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (46) "index.php?fashion=$matches[1]&feed=$matches[2]"

'fashion/([^/]+)/page/?([0-9]{1,})/?$' => string (47) "index.php?fashion=$matches[1]&paged=$matches[2]"

'fashion/([^/]+)/comment-page-([0-9]{1,})/?$' => string (47) "index.php?fashion=$matches[1]&cpage=$matches[2]"

'fashion/([^/]+)(/[0-9]+)?/?$' => string (46) "index.php?fashion=$matches[1]&page=$matches[2]"

'fashion/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'fashion/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'fashion/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'fashion/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'art/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'art/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'art/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'art/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'art/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?art=$matches[1]&feed=$matches[2]"

'art/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?art=$matches[1]&feed=$matches[2]"

'art/([^/]+)/page/?([0-9]{1,})/?$' => string (43) "index.php?art=$matches[1]&paged=$matches[2]"

'art/([^/]+)/comment-page-([0-9]{1,})/?$' => string (43) "index.php?art=$matches[1]&cpage=$matches[2]"

'art/([^/]+)(/[0-9]+)?/?$' => string (42) "index.php?art=$matches[1]&page=$matches[2]"

'art/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'art/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'art/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'art/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'music/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'music/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'music/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'music/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'music/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (44) "index.php?music=$matches[1]&feed=$matches[2]"

'music/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (44) "index.php?music=$matches[1]&feed=$matches[2]"

'music/([^/]+)/page/?([0-9]{1,})/?$' => string (45) "index.php?music=$matches[1]&paged=$matches[2]"

'music/([^/]+)/comment-page-([0-9]{1,})/?$' => string (45) "index.php?music=$matches[1]&cpage=$matches[2]"

'music/([^/]+)(/[0-9]+)?/?$' => string (44) "index.php?music=$matches[1]&page=$matches[2]"

'music/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'music/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'music/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'music/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'street-trend/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'street-trend/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'street-trend/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'street-trend/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'street-trend/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (51) "index.php?street-trend=$matches[1]&feed=$matches[2]"

'street-trend/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (51) "index.php?street-trend=$matches[1]&feed=$matches[2]"

'street-trend/([^/]+)/page/?([0-9]{1,})/?$' => string (52) "index.php?street-trend=$matches[1]&paged=$matches[2]"

'street-trend/([^/]+)/comment-page-([0-9]{1,})/?$' => string (52) "index.php?street-trend=$matches[1]&cpage=$matches[2]"

'street-trend/([^/]+)(/[0-9]+)?/?$' => string (51) "index.php?street-trend=$matches[1]&page=$matches[2]"

'street-trend/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'street-trend/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'street-trend/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'street-trend/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'place-top/[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'place-top/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'place-top/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'place-top/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'place-top/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (48) "index.php?place-top=$matches[1]&feed=$matches[2]"

'place-top/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (48) "index.php?place-top=$matches[1]&feed=$matches[2]"

'place-top/([^/]+)/page/?([0-9]{1,})/?$' => string (49) "index.php?place-top=$matches[1]&paged=$matches[2]"

'place-top/([^/]+)/comment-page-([0-9]{1,})/?$' => string (49) "index.php?place-top=$matches[1]&cpage=$matches[2]"

'place-top/([^/]+)(/[0-9]+)?/?$' => string (48) "index.php?place-top=$matches[1]&page=$matches[2]"

'place-top/[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'place-top/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'place-top/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'place-top/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'.*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\.php$' => string (18) "index.php?feed=old"

'.*wp-app\.php(/.*)?$' => string (19) "index.php?error=403"

'.*wp-register.php$' => string (23) "index.php?register=true"

'feed/(feed|rdf|rss|rss2|atom)/?$' => string (27) "index.php?&feed=$matches[1]"

'(feed|rdf|rss|rss2|atom)/?$' => string (27) "index.php?&feed=$matches[1]"

'page/?([0-9]{1,})/?$' => string (28) "index.php?&paged=$matches[1]"

'comments/feed/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?&feed=$matches[1]&withcomments=1"

'comments/(feed|rdf|rss|rss2|atom)/?$' => string (42) "index.php?&feed=$matches[1]&withcomments=1"

'search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (40) "index.php?s=$matches[1]&feed=$matches[2]"

'search/(.+)/(feed|rdf|rss|rss2|atom)/?$' => string (40) "index.php?s=$matches[1]&feed=$matches[2]"

'search/(.+)/page/?([0-9]{1,})/?$' => string (41) "index.php?s=$matches[1]&paged=$matches[2]"

'search/(.+)/?$' => string (23) "index.php?s=$matches[1]"

'author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (50) "index.php?author_name=$matches[1]&feed=$matches[2]"

'author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (50) "index.php?author_name=$matches[1]&feed=$matches[2]"

'author/([^/]+)/page/?([0-9]{1,})/?$' => string (51) "index.php?author_name=$matches[1]&paged=$matches[2]"

'author/([^/]+)/?$' => string (33) "index.php?author_name=$matches[1]"

'([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$' => string (80) "index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches …"

'([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$' => string (80) "index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches …"

'([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$' => string (81) "index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches …"

'([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$' => string (63) "index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches …"

'([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$' => string (64) "index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matche …"

'([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$' => string (64) "index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matche …"

'([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$' => string (65) "index.php?year=$matches[1]&monthnum=$matches[2]&paged=$match …"

'([0-9]{4})/([0-9]{1,2})/?$' => string (47) "index.php?year=$matches[1]&monthnum=$matches[2]"

'([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?year=$matches[1]&feed=$matches[2]"

'([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?year=$matches[1]&feed=$matches[2]"

'([0-9]{4})/page/?([0-9]{1,})/?$' => string (44) "index.php?year=$matches[1]&paged=$matches[2]"

'([0-9]{4})/?$' => string (26) "index.php?year=$matches[1]"

'.?.+?/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'.?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'.?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'.?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (47) "index.php?pagename=$matches[1]&feed=$matches[2]"

'(.?.+?)/(feed|rdf|rss|rss2|atom)/?$' => string (47) "index.php?pagename=$matches[1]&feed=$matches[2]"

'(.?.+?)/page/?([0-9]{1,})/?$' => string (48) "index.php?pagename=$matches[1]&paged=$matches[2]"

'(.?.+?)/comment-page-([0-9]{1,})/?$' => string (48) "index.php?pagename=$matches[1]&cpage=$matches[2]"

'(.?.+?)(/[0-9]+)?/?$' => string (47) "index.php?pagename=$matches[1]&page=$matches[2]"

'[^/]+/attachment/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"

'([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?name=$matches[1]&feed=$matches[2]"

'([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (43) "index.php?name=$matches[1]&feed=$matches[2]"

'([^/]+)/page/?([0-9]{1,})/?$' => string (44) "index.php?name=$matches[1]&paged=$matches[2]"

'([^/]+)/comment-page-([0-9]{1,})/?$' => string (44) "index.php?name=$matches[1]&cpage=$matches[2]"

'([^/]+)(/[0-9]+)?/?$' => string (43) "index.php?name=$matches[1]&page=$matches[2]"

'[^/]+/([^/]+)/?$' => string (32) "index.php?attachment=$matches[1]"

'[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => string (49) "index.php?attachment=$matches[1]&feed=$matches[2]"

'[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => string (50) "index.php?attachment=$matches[1]&cpage=$matches[2]"
