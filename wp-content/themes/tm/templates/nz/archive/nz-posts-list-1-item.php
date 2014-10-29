<?php
$css = ($css) ? '' : 'active';
?>
<article <?php post_class(); ?> >
      <div class="thumb">
            <?php
            echo nz_get_thumb_tag( 420, 325 );
            /* echo nz_get_thumb_tag( 420, 305 ); */
            ?>
      </div>
      <div class="slide-block">
            <header>
                  <h2 class="entry-header" >
                        <a href="<?php the_permalink(); ?>" ><?php echo get_the_title() ?></a>
                  </h2>
            </header>
            <footer class="text-center">
                  <strong>
                        <?php
                        $cat = get_the_category();
                        echo $cat[ 0 ]->name;
                        ?>
                  </strong>
                  -
                  <em>
                        <?php
                        echo get_the_date();
                        /* echo nz_get_time_elapsed(); */
                        ?>
                  </em>
                  <br>


            </footer>

      </div>
      <div class="entry-summary" onclick="location.href = '<?php the_permalink() ?>';">
            <?php the_excerpt(); ?>
      </div>

      <div class="shadow-bottom"></div>
      <?php
      /*
        <a href="#" class="slideup-trig">
        <i class="fa fa-lg fa-share-alt"></i>
        </a>
        <div class="slideup-box">
        <div class="share-box">
        <a href="javascript:window.open(
        'https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>',
        '_blank',
        'width=400,
        height=500');
        void(0);">
        <i class="fa fa-lg fa-facebook"></i>
        </a>
        <a href="javascript:window.open(
        'http%3A%2F%2Fwww.facebook.com%2Fshare.php%3Fu%3Dhttp%3A%2F%2Fferalmotion.com%2Fshare%3Fwatch%3Dfd5f0c2',
        '_blank',
        'width=400,
        height=500');
        void(0);">
        FBshare
        </a>
        <a href="#sharer" class="">
        <i class="fa fa-lg fa-twitter"></i>
        </a>
        <a href="#sharer" class="">
        <i class="fa fa-lg fa-pinterest"></i>
        </a>
        </div>
       */
      ?>      

</div>

</article>

