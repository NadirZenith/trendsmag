<div class="aside-item">
      <?php nz_fb_like(); ?>
</div>
<div class="aside-item">
      <?php nz_tt_tweet(); ?>

</div>
<div class="aside-item">
      <?php nz_fb_like_box( 'https://www.facebook.com/Trendencias.Magazine' ); ?>
</div>
<?php dynamic_sidebar( 'sidebar-primary' ); ?>


<script>
/*      
 * */
      jQuery(function($) {
            $("aside.sidebar").stick_in_parent({
                  offset_top: 70
            });
            // call my method

      });
</script>