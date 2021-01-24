
<section class="row">
      <?php if ( have_posts() ): ?>
            <?php
            $tpl_loop = array(
                  'container' => array(
                        'tag' => 'ul',
                        'id' => '',
                        'class' => 'col-list'
                  ),
                  'item_container' => array(
                        'tag' => 'li',
                        'id' => '',
                        'class' => 'col-sm-2 col-md-2 col-xs-6'
                  ),
                  'item_template' => array(
                        'template_part' => 'templates/nz/archive/top-place-list-item'
                  )
            );

            /* echo nz_tpl_loop( $tpl_loop ); */

            global $wp_query;
            $query = &$wp_query;
            ?>

            <ul class="container_class col-list"><!--   container tag   -->
                  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <li class="item_container_class col-sm-2 col-md-2 col-xs-6"><!--         item container tag        -->

                              <article <?php post_class(); ?> >
                                    <div class="view view-sixth thumbnail" onclick="location.href = '<?php the_permalink() ?>';">
                                          <?php
                                          /* echo nz_get_thumb_tag( 360, 250 ); */
                                          if ( has_post_thumbnail() ) {
                                                echo nz_get_thumb_tag( 420, 325 );
                                          } else {
                                                ?>
                                                <img width="420" height="325" src="<?php echo nz_get_image_asset( 'defaults/gallery.jpg' ) ?>" />
                                                <?php
                                          }
                                          ?>

                                          <div class="mask">
                                                <!--                                                
                                                                                                <div class="type" >
                                                                                                      <a href="<?php echo get_post_type_archive_link( get_post_type( get_the_ID() ) ); ?>">
                                                <?php echo get_post_type_object( get_post_type( get_the_ID() ) )->labels->name; ?>
                                                                                                      </a>
                                                                                                </div>
                                                -->
                                                <p class="entry-summary">
                                                      <?php the_excerpt(); ?>
                                                </p>
                                          </div>
                                    </div>
                                    <div>
                                          <?php nz_the_tags( 'in' ); ?>
                                    </div>

                                    <header class="entry-header" style="text-align: center">
                                          <h2 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php echo strtoupper( get_the_title() ) ?></a>
                                          </h2>
                                    </header>

                              </article>
                        </li>
                  <?php endwhile; ?>
            </ul>

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
