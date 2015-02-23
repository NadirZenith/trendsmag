<?php
while ( have_posts() ) : the_post();
      global $post;
      ?>
      <article <?php post_class(); ?>>
            <header>
                  <h1 class="entry-title">
                        <?php echo get_the_title(); ?>
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
                  <div class="pull-left" >
                        <?php echo nz_fb_like(); ?>
                  </div>
                  <div class="pull-left" style="padding-left: 15px;">
                        <?php get_template_part( 'templates/sharer' ); ?>
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

