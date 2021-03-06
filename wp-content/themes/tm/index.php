
<?php
//FRONT PAGE SLIDER
if ( $wp_query->is_front_page() && !$wp_query->is_paged() ) {
      ?>
      <section class="row nz-slider" style="margin-top: 20px;">
            <?php
            echo do_shortcode( '[metaslider id=18]' ); //121, 49
            ?>
      </section>
      <?php
}
?>

<!-- FRONT PAGE LOOP -->

<section class="row">
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
