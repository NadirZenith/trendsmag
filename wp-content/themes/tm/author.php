
<section class="row">
      <div class="col-xs-12">
            <h1 class="h4">
                  <?php $curauth = (isset( $_GET[ 'author_name' ] )) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>
                  <?php
                  if ( $curauth ) {
                        ?>
                        Articulos de <a href="<?php echo get_permalink( get_page_by_path( 'sobre-nosotros' ) ) ?>">
                              <b>
                                    <?php
                                    echo $curauth->get( 'display_name' );
                                    ?>
                              </b>
                        </a>
                        <?php
                  }
                  ?>
            </h1>
      </div>
      <?php if ( have_posts() ): ?>

            <?php
            $tpl_loop = array(
                  'container' => array(
                        'tag' => 'ul',
                        'id' => '',
                        'class' => 'nz-posts-list-1 infinite-src'
                  ),
                  'item_container' => array(
                        'tag' => 'li',
                        'id' => '',
                        'class' => 'col-xs-12 col-sm-6 col-md-4 col-lg-4'
                  ),
                  'item_template' => array(
                        'template_part' => 'templates/nz/archive/nz-posts-list-1-item'
                  )
            );

            echo nz_tpl_loop( $tpl_loop );
            ?>


      <?php endif; ?>
</section>


<!-- FRONT PAGE PAGER ??-->
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

      <nav class="post-nav">
            <ul class="pager">
                  <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'roots' ) ); ?></li>
                  <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'roots' ) ); ?></li>
            </ul>
      </nav>
<?php endif; ?>

<script>
      (function($) {
            //nz-posts-list-1 js
            $(document).on('click', '.slideup-trig', function(e) {

                  e.preventDefault();
                  var $btn = $(e.currentTarget);

                  $box = $btn.next('.slideup-box');
                  $box.css("bottom", "3px");


            });

            $(document).on('mouseleave', 'article', function(e) {
                  var $article = $(e.currentTarget);

                  var $box = $article.find('.slideup-box');

                  $box.css('bottom', "-100%");
            });

      })(jQuery); // Fully reference jQuery after this point.
</script>
