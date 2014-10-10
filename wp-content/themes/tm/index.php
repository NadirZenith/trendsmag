<!--<?php get_template_part( 'templates/page', 'header' ); ?>-->

<?php if ( !have_posts() ) : ?>
      <div class="alert alert-warning">
            <?php _e( 'Sorry, no results were found.', 'roots' ); ?>
      </div>
      <?php get_search_form(); ?>
<?php endif; ?>

<section class="row" style="margin-top: 40px;">
      <ul>
            <?php while ( have_posts() ) : the_post(); ?>
                  <?php get_template_part( 'templates/nz/archive/list-item-2' ); ?>
            <?php endwhile; ?>
      </ul>
</section>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
      <nav class="post-nav">
            <ul class="pager">
                  <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'roots' ) ); ?></li>
                  <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'roots' ) ); ?></li>
            </ul>
      </nav>
<?php endif; ?>
