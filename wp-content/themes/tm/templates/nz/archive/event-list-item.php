<article <?php post_class(); ?>>
      <div class="col-md-12">
            <header>
                  <h2 class="entry-title text-uppercase">
                        <a class="text-nowrap" href="<?php the_permalink(); ?>">
                              <?php the_title() ?>
                        </a>
                  </h2>
            </header>
      </div>
      <?php
      $begin_date = new DateTime();
      $begin_date->setTimestamp( get_post_meta( get_the_ID(), 'event_begin_date', true ) );
      ?>
      <time class="published thumb-detail" datetime="<?php echo date( 'c', $event_begin_timestamp ); ?>">
            <span class="fa fa-clock-o"></span>
            <?php echo $begin_date->format( 'l d/m/y H:i' ); ?>
            <?php
            if ( $end_ts = get_post_meta( get_the_ID(), 'event_end_date', true ) ) {

                  $end_date = new DateTime();
                  $end_date->setTimestamp( $end_ts );
                  $duration = $begin_date->diff( $end_date );
                  ?>
                  to
                  <?php
                  if ( $duration->days < 1 ) {
                        echo $end_date->format( 'H:i' );
                  } else {
                        echo $end_date->format( 'l d/m/y H:i' );
                  }
            }

            if ( $event_city = get_post_meta( get_the_ID(), 'event_city', TRUE ) ) {
                  echo ' en ' . $event_city;
            }
            ?>
      </time>
      <div class="col-md-6 entry-summary text-justify">
            <?php the_excerpt(); ?>
            <?php
            /*
              <p>
              <span style="color: black" class="fa fa-tags">&nbsp;</span>
              <?php nz_the_tags( '' ); ?>
              </p>
             */
            ?>
      </div>
      <div class="col-md-6">
            <a class="thumbnail" href="<?php the_permalink(); ?>">
                  <?php echo nz_get_thumb_tag( 400, 275 ) ?>
            </a>
      </div>
</article>
