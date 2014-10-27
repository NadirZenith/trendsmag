<?php 
/*
<div class="aside-item">
      <?php nz_fb_like(); ?>
</div>
<div class="aside-item">
      <?php nz_tt_tweet(); ?>

</div>
*/
?>
<div class="aside-item">
      <?php nz_fb_like_box( 'https://www.facebook.com/trendsmag.net' ); ?>
</div>
<?php 
/*
<div class="aside-item">
      <?php nz_fb_sharer( 'https://www.facebook.com/trendsmag.net' ); ?>
</div>
<div class="aside-item">
      <a href="whatsapp://send?text=Hello%2C%20World!">
            whatsapp
      </a>
</div>
 */
?>

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