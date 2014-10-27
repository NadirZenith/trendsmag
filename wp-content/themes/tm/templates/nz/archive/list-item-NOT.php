
<article <?php post_class(); ?> >
      <div class="view view-sixth thumbnail" onclick="location.href = '<?php the_permalink() ?>';">

            <?php
            /* echo nz_get_thumb_tag( 360, 250 ); */
            echo nz_get_thumb_tag( 420, 325 );
            ?>

            <div class="mask">
                  <div class="type" >
                        <?php $cat = get_the_category() ?>
                        <?php
                        /* <a href="<?php echo get_category_link( $cat ); ?>"> */
                        echo $cat[ 0 ]->name;
                        /* $category = get_term_link( $cat , 'category' ); */
                        /* var_dump( $category ); */
                        /* </a> */
                        ?>
                  </div>
                  <p class="entry-summary">
                        <?php the_excerpt(); ?>
                  </p>
            </div>
            <div style="color:#fff;padding: 1px 3px;position: absolute; bottom: 0;right: 0; background-color: rgba(255,255,255,0.0)">
                  <?php echo nz_get_time_elapsed(); ?>

            </div>
      </div>
      <div style="position: relative;text-align: center;background-color: rgba(255,255,255,0.5); width: 100%;border: 1px solid #aaa;">

            <span style="position: absolute; left: 0; bottom: 10px;" class="glyphicon glyphicon-tags">
                  
                  
            </span>
            <header class="entry-header" >
                  <h2 class="entry-title" style="color: #fff">
                        <a href="<?php the_permalink(); ?>" style="color: #333"><?php echo strtoupper( get_the_title() ) ?></a>
                  </h2>

            </header>
      </div>

      <div class="" style="font-size:11px; ">
            &nbsp;
            <!--<span style="color: black" class="glyphicon glyphicon-tags"></span>-->
            <!--<?php nz_the_tags( '' ); ?>-->
      </div>

</article>

