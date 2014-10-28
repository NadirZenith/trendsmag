<?php

/**
 *  Get tags like <span class="label label-default label-'{{TAG->slug}}'">tag</span>
 */
function nz_the_tags( $before = "", $after = "", $limit = false ) {
      $tags = get_the_tags();
      if ( is_array( $tags ) ) {
            if ( $limit ) {
                  $tags = array_slice( $tags, 0, $limit );
            }
            echo $before;
            ?>
            <ul class="the-tags">
                  <?php
                  foreach ( $tags as $tag ) {
                        ?>
                        <li>
                              <span class="label label-default label-<?php echo $tag->slug ?>">
                                    <a href="<?php echo get_term_link( $tag ) ?>" class="text-capitalize">
                                          <?php echo $tag->name ?>
                                    </a>
                              </span>
                        </li>
                        <?php
                  }
                  ?>
            </ul>

            <?php
            echo $after;
      }
}

/**
 *      format time
 */
function nz_get_time_elapsed( $post = null ) {
      $post = get_post( $post );

      $before = new DateTime( get_the_time( DateTime::W3C, $post ) );

      $now = new DateTime( "now" );

      if ( $now < $before )
            return;

      $interval = $now->diff( $before );

      $format = _nz_format_elapsed_time( $interval );

      return $format;
}

/**
 * same as above
 */
function _nz_format_elapsed_time( DateInterval$interval ) {
      $format_string = '';

      if ( $interval->y > 1 ) {
            $format_string = __( 'More than' ) . ' ' . $interval->y . ' ' . __( 'year ago' );
      } elseif ( $interval->m > 0 ) {
            if ( $interval->m == 1 ) {
                  $format_string = $interval->m . ' ' . __( 'month ago' );
            } else {
                  $format_string = $interval->m . ' ' . __( 'months ago' );
            }
      } elseif ( $interval->d > 0 ) {
            if ( $interval->d == 1 ) {
                  $format_string = $interval->d . ' ' . __( 'day ago' );
            } else {
                  $format_string = $interval->d . ' ' . __( 'days ago' );
            }
      } elseif ( $interval->h > 0 ) {
            if ( $interval->h == 1 ) {
                  $format_string = $interval->h . ' ' . __( 'hour ago' );
            } else {
                  $format_string = $interval->h . ' ' . __( 'hours ago' );
            }
      } else {
            if ( $interval->i == 1 ) {
                  $format_string = $interval->i . ' ' . __( 'minute ago' );
            } else {
                  $format_string = $interval->i . ' ' . __( 'minutes ago' );
            }
      }
      return $format_string;
}

/**
 * Get terms by post type
 *    returns all terms for a (array) post types
 */
function nz_get_terms_by_post_type( $taxonomy, $post_types = array() ) {
      global $wpdb;

      $post_types = ( array ) $post_types;
      $key = 'get_terms_by_post_type' . md5( $taxonomy . serialize( $post_types ) );
      $results = wp_cache_get( $key );

      if ( false === $results ) {
            $where = " WHERE 1=1";
            if ( !empty( $post_types ) ) {
                  $post_types_str = implode( ',', $post_types );
                  $where.= $wpdb->prepare( " AND p.post_type IN(%s)", $post_types_str );
            }

            $where .= $wpdb->prepare( " AND tt.taxonomy = %s", $taxonomy );

            $query = "
          SELECT t.*, COUNT(*) 
          FROM $wpdb->terms AS t 
          INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id 
          INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id 
          INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id 
          $where
          GROUP BY t.term_id";

            $results = $wpdb->get_results( $query );
            wp_cache_set( $key, $results );
      }

      return $results;
}

/*
  function nz_get_term_link( $termlink, $term ) {

  $post_type = get_post_type();

  $url = home_url( trailingslashit( $post_type ) . 'tag/' . $term->slug );
  //d( $url );

  return $url;
  }
 */

if ( WP_DEBUG ) {

      /**
       * enqueue dev scripts
       */
      function nz_dev_scritps() {
            /* wp_enqueue_style( 'style-name', get_stylesheet_uri() ); */
            /*
              wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/assets/js/dev/jquery.infinitescroll.js', array(), '1.0.0', true );
              wp_enqueue_script( 'nz-dump', get_template_directory_uri() . '/assets/js/dev/log.js', array(), '1.0.0', FALSE );
             */
      }

      add_action( 'wp_enqueue_scripts', 'nz_dev_scritps' );
}

function nz_tpl_loop( $options = array() ) {

      $options = array_merge( array(
            'query' => null,
            'container' => array(
                  'tag' => 'ul',
                  'id' => '',
                  'class' => ''
            ),
            'item_container' => array(
                  'tag' => 'li',
                  'id' => '',
                  'class' => ''
            ),
            'item_template' => array(
                  'template_part' => 'templates/nz/archive/list-item'
            )
                ), $options
      );

      if ( is_object( $options[ 'query' ] ) ) {
            $query = $options[ 'query' ];
      } else {
            global $wp_query;
            $query = $wp_query;
      }

      $item_container = nz_get_loop_container( $options[ 'item_container' ] );

      $buffer = '';
      while ( $query->have_posts() ) : $query->the_post();
            ob_start();
            get_template_part( $options[ 'item_template' ][ 'template_part' ] );
            $buffer .= sprintf( $item_container, ob_get_clean() );

      endwhile;

      $container = nz_get_loop_container( $options[ 'container' ] );
      $loop = sprintf( $container, $buffer );

      return $loop;
      ?>
      <!--    LOOP  -->
      <ul class="container_class"><!--   container tag   -->
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                  <li class="item_container_class"><!--         item container tag        -->
                        <!--            item_template            -->
                        <?php get_template_part( 'templates/nz/archive/list-item' ); ?><!-- template part -->
                  </li>
            <?php endwhile; ?>
      </ul>
      <?php
}

function nz_get_loop_container( $options = array() ) {
      $id = ($options[ 'id' ]) ? sprintf( ' id="%s"', $options[ 'id' ] ) : '';
      $class = ($options[ 'class' ]) ? sprintf( ' class="%s"', $options[ 'class' ] ) : '';
//open
      $container = '<' . $options[ 'tag' ] . $id . $class . ' >%s';

//close
      $container .= '</' . $options[ 'tag' ] . '>';

      return $container;
}

class NzTplLoop {

      private $container_options;
      private $item_container_options;
      private $item_template;
      public $query;

      public function __construct( $options ) {

            $options = array_merge( array(
                  'query' => null,
                  'container' => array(
                        'tag' => 'ul',
                        'id' => '',
                        'class' => ''
                  ),
                  'item_container' => array(
                        'tag' => 'li',
                        'id' => '',
                        'class' => ''
                  ),
                  'item_template' => array(
                        'template_part' => 'templates/nz/archive/list-item'
                  )
                      ), $options
            );

            $this->container_options = $options[ 'container' ];
            $this->item_container_options = $options[ 'item_container' ];
            $this->item_template = $options[ 'item_template' ];
            $this->setQuery( $options[ 'query' ] );
      }

      private function _set_defaults() {
            $this->container_options = array(
                  'tag' => 'ul',
                  'id' => '',
                  'class' => ''
            );

            $this->item_container_options = array(
                  'tag' => 'li',
                  'id' => '',
                  'class' => ''
            );

            $this->item_template = array(
                  /** @todo nz change this */
                  'template_part' => 'templates/nz/archive/list-item'
            );
      }

      private function _get_container( $options ) {
            $id = ($options[ 'id' ]) ? sprintf( ' id="%s"', $options[ 'id' ] ) : '';
            $class = ($options[ 'class' ]) ? sprintf( ' class="%s"', $options[ 'class' ] ) : '';
//open
            $container = '<' . $options[ 'tag' ] . $id . $class . ' >%s';

//close
            $container .= '</' . $options[ 'tag' ] . '>';

            return $container;
      }

      public function render() {

            $query = $this->getQuery();

            $item_container = $this->_get_container( $this->item_container_options );
            $buffer = '';
            while ( $query->have_posts() ) : $query->the_post();
                  ob_start();
                  get_template_part( $this->item_template[ 'template_part' ] );
                  $buffer .= sprintf( $item_container, ob_get_clean() );
            endwhile;

            $container = $this->_get_container( $this->container_options );
            $loop = sprintf( $container, $buffer );

            return $loop;
      }

      public function getQuery() {

            if ( !$this->query ) {
                  global $wp_query;
                  $this->query = $wp_query;
            }

            return $this->query;
      }

      public function setQuery( $query ) {
            $this->query = $query;
      }

}

function nz_get_next_prev_links() {
      ?>
      <div class="next-prev-links">

            <div class="prev text-center">
                  <?php
                  /* previous_post_link( 'Previous post: %link', '[ %title ]' ); */
                  ?>
                  <?php
                  $pst = get_adjacent_post( false, '', true );
                  if ( $pst ) {
                        ?>
                        <a href="<?php echo get_permalink( $pst ) ?>">
                              <span class="h3">Anterior</span>
                              <br>
                              <span class="h4"><?php echo $pst->post_title ?></span>
                        </a>
                        <?php
                  }
                  ?>
            </div>

            <div class="next text-center">
                  <?php
                  /* next_post_link( 'Next post: %link', '[ %title ]' ); */
                  ?>

                  <?php
                  $pst = get_adjacent_post( false, '', false );
                  if ( $pst ) {
                        ?>
                        <a href="<?php echo get_permalink( $pst ) ?>">
                              <span class="h3">Siguiente</span>
                              <br>
                              <span class="h4"><?php echo $pst->post_title ?></span>
                        </a>
                        <?php
                  }
                  ?>
            </div>
      </div>
      <?php
}

function nz_display_map( $field ) {
      if ( $mapa = get_post_meta( get_the_ID(), $field, true ) ) {
            ?>  
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=true"></script>

            <style>
                  #map-canvas {
                        border: 1px solid black;
                        border-radius: 5px;
                        height: 300px;
                        width: 90%;
                        margin: 15px auto;
                  }
            </style>
            <script>

                  function initialize() {
                        var myLatlng = new google.maps.LatLng(<?php echo $mapa[ 'lat' ] ?>, <?php echo $mapa[ 'lng' ] ?>);
                        var mapOptions = {
                              zoom: 16,
                              center: myLatlng
                        }
                        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                        var marker = new google.maps.Marker({
                              position: myLatlng,
                              map: map,
                              title: '<?php the_title() ?>'
                        });
                  }

                  google.maps.event.addDomListener(window, 'load', initialize);

            </script>
            <div id="map-canvas"></div>
            <div style="text-align:center">
                  <?php echo $mapa[ 'address' ] ?>
            </div>
            <?php
      }
}

function nz_get_container_from_field( $class, $before, $custom_field, $wrapper = '%s' ) {
      if ( $custom_field_data = get_post_meta( get_the_ID(), $custom_field, true ) ) {
            ?>
            <div class="<?php echo $class; ?>">
                  <?php if ( $before ): ?>
                        <?php echo $before; ?>
                  <?php endif; ?>
                  <?php
                  /* echo $custom_field_data; */
                  echo sprintf( $wrapper, $custom_field_data );
                  ?>
            </div>
            <?php
      }
}

function nz_get_container_from_string( $class, $before, $string, $after = NULL ) {
      ?>
      <div class="<?php echo $class; ?>">
            <?php if ( $before ): ?>
                  <?php echo $before; ?>
            <?php endif; ?>
            <?php
            echo $string;
            ?>
            <?php if ( $after ): ?>
                  <?php echo $after; ?>
            <?php endif; ?>
      </div>
      <?php
}

function nz_related_content() {

      $args = array(
            'post_type' => get_post_type(),
            'posts_per_page' => 3,
            'order' => 'ASC',
      );
      $query = new WP_Query( $args );
      $tpl_loop = array(
            'query' => $query,
            'container' => array(
                  'tag' => 'ul',
                  'id' => '',
                  'class' => 'nz-posts-list-1'
            ),
            'item_container' => array(
                  'tag' => 'li',
                  'id' => '',
                  'class' => 'col-md-6 col-sm-12 col-xs-12'
            ),
            'item_template' => array(
                  'template_part' => 'templates/nz/archive/nz-posts-list-1-item'
            )
      );
      $loop = new NzTplLoop( $tpl_loop );

      echo $loop->render();
}
