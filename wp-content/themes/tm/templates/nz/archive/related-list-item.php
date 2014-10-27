
<article <?php post_class(); ?> >
      <div class="thumbnail">
            <?php
            /* echo nz_get_thumb_tag( 360, 250 ); */
            echo nz_get_thumb_tag( 420, 325 );
            ?>
      </div>
      <div>
            <header class="entry-header" style="text-align: center">
                  <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php echo strtoupper( get_the_title() ) ?></a>
                  </h2>
            </header>
      </div>

      <div class="mask">
            <div class="type" >
                  <a href="<?php echo get_post_type_archive_link( get_post_type( get_the_ID() ) ); ?>">
                        <?php echo get_post_type_object( get_post_type( get_the_ID() ) )->labels->name; ?>
                  </a>
            </div>
            <p class="entry-summary">
                  <?php the_excerpt(); ?>
            </p>
      </div>
      <!--
      
            <div class="" style="font-size:11px; margin-top: 5px;">
      <?php echo nz_get_time_elapsed(); ?>
      <?php nz_the_tags( 'in' ); ?>
            </div>
      -->



</article>