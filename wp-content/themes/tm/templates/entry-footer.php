<footer >
      <div class="nz-thetags">
            <?php nz_the_tags( '<i class="fa fa-tags"></i>' ); ?>
      </div>
      <div class="post-credits text-right">
            <?php
            if ( $post_credits = get_field( 'post_credits' ) ) {
                  ?>
                  <span class="text-italic">

                        <?php
                        echo $post_credits;
                        ?>
                  </span>
                  <?php
            }
            ?>
      </div>
      <div class="clearfix">
            comments
            <?php nz_fb_comments(); ?>
      </div>
      <div class="clearfix">
            <?php
            nz_get_next_prev_links();
            ?>
      </div>

</footer>

<?php return; ?>
<?php
/* echo nz_get_time_elapsed(); */
/* &nbsp; */
?>