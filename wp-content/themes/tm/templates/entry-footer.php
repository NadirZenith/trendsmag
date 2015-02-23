<footer >
      <div class="nz-thetags" style="margin-top: 20px">
            <?php nz_the_tags( '<i class="fa fa-tags"></i>' ); ?>
      </div>
      <?php
      if ( $post_credits = get_field( 'post_credits' ) ) {
            ?>
            <div class="post-credits text-right">
                  <span class="text-italic">

                        <?php
                        echo $post_credits;
                        ?>
                  </span>
            </div>
            <?php
      }
      ?>
      <div class="clearfix">
            <?php echo nz_fb_comments(); ?>
      </div>
      <div class="clearfix">
            <?php
            nz_get_next_prev_links();
            ?>
      </div>

</footer>
