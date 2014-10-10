<?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?>>


            <div class="col-lg-6">

                  <div class="thumbnail">
                        <?php echo nz_get_image_tag( 1000 ); ?>
                  </div>
<!--                  -->
            </div>
            <div class="col-lg-6 ">
<!--                  -->
                  <?php get_template_part( 'templates/event-meta' ); ?>

                  <header>
                        <h1 class="entry-title text-justify"><?php echo strtoupper( get_the_title() ); ?></h1>
                  </header>


                  <div class="entry-content text-justify">
                        <?php the_content(); ?>
                  </div>

            </div>
             <div class="clearfix visible-xs-block2"></div>
            <div>

                  <?php
                  nz_display_map( 'event_place_direction' );
                  get_template_part( 'templates/entry-footer' );//next_prev , tags, related
                  ?>
            </div >



            <?php
            /* comments_template( '/templates/comments.php' ); */
            ?>

      </article>

<?php endwhile; ?>

