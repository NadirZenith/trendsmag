<?php while ( have_posts() ) : the_post(); ?>

      <?php
      d(  pll_current_language());
      global $post;
      if ( $post_id = pll_get_post( $post->ID, pll_current_language() ) ) { // get translated post (in current language) if exists
            /*$post = get_post( $post_id );*/
            /*setup_postdata( $post );*/
      }
      ?>
      <article <?php post_class(); ?>>
            <div class="thumbnail">
                  <?php echo nz_get_image_tag( 1000 ); ?>
            </div>

            <?php get_template_part( 'templates/entry-meta' ); ?>

            <header>
                  <h1 class="entry-title text-justify"><?php echo strtoupper( get_the_title() ); ?></h1>
            </header>

            <div class="entry-content text-justify">
                  <?php the_content(); ?>
            </div>
            <?php get_template_part( 'templates/entry-footer' ); ?>

            <?php
            /* comments_template( '/templates/comments.php' ); */
            ?>

      </article>

<?php endwhile; ?>

