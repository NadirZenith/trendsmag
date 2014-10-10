
<article <?php post_class(); ?> >
      <!--<article >-->
      <div class="view view-sixth thumbnail" onclick="location.href = '<?php the_permalink() ?>';">
            <?php
            /* echo nz_get_thumb_tag( 360, 250 ); */
            echo nz_get_thumb_tag( 420, 325 );
            ?>

            <div class="mask">
                  <div class="type" >
                        <?php $cat = get_the_category() ?>
                              <?php
                        /*<a href="<?php echo get_category_link( $cat ); ?>">*/
                              echo $cat[ 0 ]->name;
                              /*$category = get_term_link( $cat , 'category' );*/
                              /*var_dump( $category );*/
                        /*</a>*/
                              ?>
                  </div>
                  <p class="entry-summary">
                        <?php the_excerpt(); ?>
                  </p>
            </div>
      </div>
      <div class="" style="font-size:11px; margin-top: 5px;">
            <?php echo nz_get_time_elapsed(); ?>
            &nbsp;
            <span style="color: black" class="glyphicon glyphicon-tags"></span>
            <?php nz_the_tags( '' ); ?>
      </div>

      <header class="entry-header" style="text-align: center">
            <h2 class="entry-title">
                  <a href="<?php the_permalink(); ?>"><?php echo strtoupper( get_the_title() ) ?></a>
            </h2>
      </header>


</article>