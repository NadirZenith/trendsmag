
<!-- FRONT PAGE SLIDER -->
<?php
if ( !$wp_query->is_paged() ) {
      echo do_shortcode( '[metaslider id=49]' ); //121, 49
}
?>

<!-- FRONT PAGE LOOP -->

<section class="row" style="margin-top: 40px;">
      <?php if ( have_posts() ): ?>
     
            <?php
            $tpl_loop = array(
                  'container' => array(
                        'tag' => 'ul',
                        'id' => '',
                        'class' => 'col-list infinite-src'
                  ),
                  'item_container' => array(
                        'tag' => 'li',
                        'id' => '',
                        'class' => 'col-md-4 col-sm-6 col-xs-12'
                  ),
                  'item_template' => array(
                        'template_part' => 'templates/nz/archive/list-item'
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
            jQuery(document).on('ready', function(e) {
                  /*
                   * <div class="wrap container">
                   *    <div class="row">
                   *          <ul class="col-list" id="infsc-target" > </ul>
                   *    </div>
                   * </div>
                   */
                  $infinite_scroll_target = $('<div class="wrap container"> <div class="row"> <ul class="col-list" id="infsc-target"> </ul> </div> </div>')

                  $('footer.content-info').append($infinite_scroll_target);


                  $('.infinite-src').infinitescroll({
                        binder: $(window), // $('.infinite-home'), // scroll on this element rather than on the window
                        nextSelector: "nav.post-nav a:first",
                        navSelector: "nav.post-nav",
                        itemSelector: ".infinite-src li",
                        appendCallback: false,
                        errorCallback: function() {
                              console.log('errorCallback')
                        }
                  }, function(list) {
                        $('#infsc-target').append(list);
                  });

            });
      })(jQuery);
</script>
