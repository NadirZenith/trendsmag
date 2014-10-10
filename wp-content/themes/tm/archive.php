
<?php
global $wp_query;
//show only on first page
if ( !$wp_query->is_paged() ) {
      ?>
      <section class="row ">
            <div class="col-xs-12">
                  <?php
                  nz_bs_carousel( $wp_query );
                  $wp_query->current_post = 3;
                  ?>
            </div>
      </section>
      <?php
}
?>

<section class="row">
      <?php if ( have_posts() ): ?>
            <?php
            $tpl_loop = array(
                  'query' => $wp_query,
                  'container' => array(
                        'tag' => 'ul',
                        'id' => '',
                        'class' => 'col-list'
                  ),
                  'item_container' => array(
                        'tag' => 'li',
                        'id' => '',
                        'class' => 'col-sm-4 col-md-4 col-xs-12'
                  ),
                  'item_template' => array(
                        'template_part' => 'templates/nz/archive/list-item'
                  )
            );

            echo nz_tpl_loop( $tpl_loop );
            ?>

      <?php endif; ?>

</section>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
      <nav class="post-nav">
            <ul class="pager">
                  <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'roots' ) ); ?></li>
                  <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'roots' ) ); ?></li>
            </ul>
      </nav>
<?php endif; ?>
<?php
return;
$resource = "image.jpeg";
$width = 100;
$height = 100;

$old_image = ImageCreateFromJPEG( $resource );
$new_image = imagecreatetruecolor( $width, $height );
imagecopyresized( $new_image, $old_image, $dest_x, $dest_y, 0, 0, $width, $width, $original_width, $original_height );
ImageJPEG( $new_image, "$updir" . $id . '_' . "$thumb_beforeword" . "$img" );
?>