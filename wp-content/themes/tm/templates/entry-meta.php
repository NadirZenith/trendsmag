<div class="entry-meta text-right">
      <span class="byline author vcard" >
            <!--<?php echo __( 'By', 'roots' ); ?> -->
            <i class="fa fa-user"></i>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="fn">
                  <?php echo get_the_author(); ?>
            </a>
      </span>
      &nbsp;
      <time class="published" datetime="<?php echo get_the_time( 'c' ); ?>">
            <!--<i class="fa fa-clock-o"></i>-->
            <?php echo get_the_date( 'd/m/Y' ); ?>
      </time>
</div>