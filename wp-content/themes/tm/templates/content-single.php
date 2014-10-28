<?php while ( have_posts() ) : the_post(); ?>

      <?php
      /* d(  pll_current_language()); */
      global $post;
      /*
        if ( $post_id = pll_get_post( $post->ID, pll_current_language() ) ) { // get translated post (in current language) if exists
        $post = get_post( $post_id );
        setup_postdata( $post );
        }
       */
      ?>
      <article <?php post_class(); ?>>
            <header>
                  <h1 class="entry-title">
                        <?php echo get_the_title() ; ?>
                  </h1>
            </header>
            <div class="thumbnail">
                  <?php echo nz_get_image_tag( 1000 ); ?>
            </div>

            <?php
            //time & author
            get_template_part( 'templates/entry-meta' );
            ?>

            <div class="clearfix" style="margin-top: 20px; margin-bottom: 20px; ">
                  <div class="pull-left">
                        <?php nz_tt_tweet(); ?>
                  </div>
                  <div class="pull-left">
                        <?php nz_fb_like(); ?>
                  </div>
                  <div class="pull-left">
                        <?php nz_fb_send(); ?>
                  </div>
            </div>
            <div class="entry-content text-justify">
                  <?php the_content(); ?>
            </div>
            <?php get_template_part( 'templates/entry-footer' ); ?>

            <?php
            /* comments_template( '/templates/comments.php' ); */
            ?>

      </article>

<?php endwhile; ?>

