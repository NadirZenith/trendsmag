


<?php
$post_type = get_post_type();
if ( $post_type == 'event' ) {
      get_template_part( 'templates/content', 'single-event' );
} elseif ( $post_type == 'top-place' ) {
      get_template_part( 'templates/content', 'single-top-place' );
} else {
      get_template_part( 'templates/content', 'single' );
}
?>




<section class="row " style="margin-top: 15px;">
      <div class="col-md-12">



            <div class="list-heading">
                  <h3 class="list-head ">
                        CONTENIDOS RELACIONADOS
                  </h3>
                  <!--<hr>-->
                  <div class="arrow"></div>
            </div>

            <?php
            
            nz_related_content();
            ?>

      </div>

</section>