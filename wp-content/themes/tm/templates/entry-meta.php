<time class="published text-left" datetime="<?php echo get_the_time( 'c' ); ?>">
      <span style="" class="glyphicon glyphicon-time"></span>
      <?php echo get_the_date(); ?>
</time>
<?php
/* echo nz_the_tags( 'in' ) */
?>
<div class="byline author vcard pull-right" >
      <?php echo __( 'By', 'roots' ); ?> 
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="fn">
            <?php echo get_the_author(); ?>
      </a>
</div>
