<section class="row">
      <?php if ( have_posts() ): $first = TRUE ?>
            <?php while ( have_posts() ) : the_post(); ?>
                  <?php
                  $event_date = new DateTime();
                  $event_date->setTimestamp( get_post_meta( get_the_ID(), 'event_begin_date', true ) );
                  $event_date->setTime( 0, 0, 0 );
                  if ( $event_date != $control_date ) {
                        if ( !$first )
                              echo '</ul>';
                        echo '<h1 class="event-day ">';
                        /* echo '<hr>'; */
                        echo $event_date->format( 'l d/m/y' );
                        echo '</h1>';
                        echo '<ul class="event-list">';
                        $first = FALSE;
                  }
                  ?>

                  <li> <?php get_template_part( 'templates/nz/archive/event-list-item' ); ?> </li>
                  <?php $control_date = $event_date; ?>
                  <?php
            endwhile;
            echo '</ul>';
            ?>
      <?php endif; ?>
</section>

<?php
return;
?>

event_begin_date string (10) "1411221600"
event_end_date	string (10) "1411243200"
event_price	"0"
event_price_conditions	"free"
event_place_name	"disco"
event_place_direction	"a:3:{s:7:"address";s:43:"Carrer de la Princesa, 30, Barcelona, Spain";s:3:"lat";s:10:"41.3857137";s:3:"lng";s:17:"2.180961000000025";}"
event_confirmation_email	"albertino05@gmail.com"
event_featured	"0"

_gform-form-id	"5"
_gform-entry-id	"5"

_thumbnail_id	"160"
_edit_lock	"1410976543:1"
_edit_last	"1"

_event_begin_date	"field_54124819e9275"
_event_end_date	"field_54124862e9276"
_event_price	"field_541248a8d988a"
_event_price_conditions	"field_541248d6d988b"
_event_place_name	"field_541248f9d988c"
_event_place_direction	"field_54124920d988d"
_event_confirmation_email	"field_541249acd988e"
_event_featured	"field_541249f6d988f"

