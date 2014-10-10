<div class="aside-item text-center">
      <?php $post_type = get_post_type(); ?>
      <h1 class="text-capitalize"><?php echo $post_type ?></h1>
      <?php
      $terms = get_terms_by_post_type( 'post_tag', $post_type );
      add_filter( 'term_link', 'nz_get_term_link', 10, 2 );

      if ( $terms ) {
            ?>
            <ul class="text-capitalize">
                  <?php
                  foreach ( $terms as $term ) {
                        ?>
                        <li>
                              <a href="<?php echo get_term_link( $term ) ?>"><?php echo $term->name ?></a>
                        </li>
                        <?php
                  }
                  ?>
            </ul>
            <?php
      }
      ?>
</div>
<?php

