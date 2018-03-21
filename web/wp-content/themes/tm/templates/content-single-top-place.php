<?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?>>

            <div class="thumbnail">
                  <?php echo nz_get_image_tag( 1000 ); ?>
            </div>

            <header>
                  <h1 class="entry-title text-center"><?php echo strtoupper( get_the_title() ); ?></h1>
            </header>


            <div class="entry-content text-justify">
                  <?php the_content(); ?>
            </div>

            <?php
            nz_display_map( 'place_address' );

            /*get_template_part( 'templates/entry-footer' );*/
            ?>



            <?php
            /* comments_template( '/templates/comments.php' ); */
            ?>

      </article>

<?php endwhile; ?>

