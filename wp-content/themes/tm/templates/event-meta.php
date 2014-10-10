<?php
$begin_date = new DateTime();
$begin_date->setTimestamp( get_post_meta( get_the_ID(), 'event_begin_date', true ) );
?>
<time class="published text-left" datetime="<?php echo $begin_date->format( 'l d/m/y H:i' ); ?>">

      <span class="glyphicon glyphicon-time"></span>

      <?php
      //begin date
      echo $begin_date->format( 'l d/m/y H:i' );

      //end date
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

      //where
      if ( $event_city = get_post_meta( get_the_ID(), 'event_city', TRUE ) ) {
            echo ' en ' . $event_city;
      }
      ?>

</time>
<?php
/* echo nz_the_tags( 'in' ) */
?>
<!--
<div class="byline author vcard pull-right" >
<?php echo __( 'By', 'roots' ); ?> 
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="fn">
<?php echo get_the_author(); ?>
      </a>
</div>
-->
<div class="row clearfix event-meta">
      
      <div>
            
      </div>
      
      
      <?php
      $class = 'col-lg-12 col-sm-12 col-xs-12 col-md-12';
      $wrapper = '<strong>%s</strong>';
      nz_get_container_from_field($class, '<span>Price: </span>', 'event_price',$wrapper);
      ?>

      <?php
      nz_get_container_from_field($class, '<span>Conditions: </span>', 'event_price_conditions',$wrapper);
      ?>

      <?php
      nz_get_container_from_field($class, '<span>Place: </span>', 'event_place_name',$wrapper);
      ?>


      <?php
      if ( $mapa = get_post_meta( get_the_ID(), 'event_place_direction', true ) ) {
            nz_get_container_from_string( $class, '<span>Address: </span><a href="#map-canvas" title="Ver mapa">', sprintf( '<strong> %s </strong>', $mapa[ 'address' ] ), '</a>' );
      }
      if ( $event_place = get_post_meta( get_the_ID(), 'event_place_name', true ) ) {
            /* d($event_place     ); */
      }
      ?>


</div>