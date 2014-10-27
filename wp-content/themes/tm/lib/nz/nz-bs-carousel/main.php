<?php
global $nz_bs_carousel;
$nz_bs_carousel = 0;

function nz_bs_carousel( $wp_query ) {
      global $nz_bs_carousel;
      $nz_bs_carousel ++;

      $miniatures = 4;
      ?>
      <?php
      /* global $wp_query; */
      $query = &$wp_query;
      if ( $query->have_posts() ) :
            ?>
            <!-- Wrapper for slides -->
            <div id="nz_bs_carousel_<?php echo $nz_bs_carousel ?>" class="carousel slide" data-ride="carousel">

                  <!-- images & title -->
                  <div class="carousel-inner">
                        <?php
                        $first = true;
                        $miniatures --;
                        $count = 1;
                        while ( $query->have_posts() && $query->current_post < ($miniatures) ):
                              $query->the_post();
                              ?>
                              <a href="<?php the_permalink() ?>" class="item <?php echo ($first) ? "active" : null ?>">
                                    <?php
                                    $id = get_post_thumbnail_id();
                                    $path = get_attached_file( $id );

                                    $args = array(
                                          'width' => 700,
                                          'height' => 350,
                                          'crop' => TRUE,
                                          'crop_from_position' => 'center,center',
                                          'resize' => true,
                                          'watermark_options' => array(),
                                          'cache' => true,
                                          'default' => null,
                                          'jpeg_quality' => 80,
                                          'resize_animations' => true,
                                          'return' => 'url',
                                          'background_fill' => null
                                    );
                                    $image = new WP_Thumb( $path, $args );

                                    $args = $image->getArgs();

                                    extract( $args );
                                    $image_src = $image->returnImage();
                                    ?>
                                    <img src="<?php echo $image_src; ?>"/>

                                    <span class="carousel-caption">
                                          <?php the_title() ?>
                                    </span>
                              </a>

                              <?php
                              $count ++;
                              $first = false;
                        endwhile;
                        ?>
                  </div>

                  <?php $query->rewind_posts(); ?>

                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                        <?php
                        $first = true;
                        $count = 1;
                        while ( $query->have_posts() && $query->current_post < $miniatures ):
                              $query->the_post();
                              ?>
                              <li data-target="#nz_bs_carousel_<?php echo $nz_bs_carousel ?>" data-slide-to="<?php echo $count - 1 ?>" class="<?php echo ($first) ? "active" : null ?>">
                                    <?php
                                    $thumb = nz_get_thumb( get_post_thumbnail_id(), 185, 160 );
                                    $img_tag = nz_get_img_tag( $thumb[ 0 ], get_the_title() );
                                    echo $img_tag;
                                    ?>
                              </li>

                              <?php
                              $count ++;
                              $first = false;
                        endwhile;
                        ?>
                  </ol>



                  <?php
                  /*
                    <!-- Controls -->
                    <a class="left carousel-control" href="#nz_bs_carousel_<?php echo $nz_bs_carousel ?>" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#nz_bs_carousel_<?php echo $nz_bs_carousel ?>" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                   */
                  ?>
            </div>
            <?php
      endif;
      ?>


      <?php
      return;
      if ( $query->have_posts() ) :

            while ( $query->have_posts() ): $query->the_post();
                  d( 'oh yes oh yes' );
            endwhile;
      endif;
}
