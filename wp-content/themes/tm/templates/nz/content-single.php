<?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?>>
            <div class="thumbnail">
                  <?php echo nz_get_image_tag( 1000 ); ?>
            </div>
            <?php get_template_part( 'templates/entry-meta' ); ?>
            <header>
                  <h1 class="entry-title text-justify"><?php echo strtoupper( get_the_title() ); ?></h1>
            </header>
            <div class="entry-content text-justify">
                  <?php the_content(); ?>
            </div>
            <footer>

                  <div class="next-prev-links">
                        <div class="prev text-center">
                              <?php
                              /* previous_post_link( 'Previous post: %link', '[ %title ]' ); */
                              ?>
                              <?php
                              $pst = get_adjacent_post( false, '', true );
                              if ( $pst ) {
                                    ?>
                                    <a href="<?php echo get_permalink( $pst ) ?>">
                                          <span style="font-size: 30px;">Anterior</span>
                                          <br>
                                          <span><?php echo $pst->post_title ?></span>
                                    </a>
                                    <?php
                              }
                              ?>



                        </div>
                        <div class="next text-center">
                              <?php
                              /* next_post_link( 'Next post: %link', '[ %title ]' ); */
                              ?>

                              <?php
                              $pst = get_adjacent_post( false, '', false );
                              if ( $pst ) {
                                    ?>
                                    <a href="<?php echo get_permalink( $pst ) ?>">
                                          <span style="font-size: 30px;">Siguiente</span>
                                          <br>
                                          <span><?php echo $pst->post_title ?></span>
                                    </a>
                                    <?php
                              }
                              ?>



                        </div>
                  </div>
            </footer>
            <?php comments_template( '/templates/comments.php' ); ?>

      </article>

<?php endwhile; ?>

<?php
$args = array(
      'post_type' => 'event',
      'posts_per_page' => 3,
      'order' => 'ASC',
);
$query = new WP_Query( $args );
$tpl_loop = array(
      'query' => $query,
      'container' => array(
            'tag' => 'ul',
            'id' => '',
            'class' => 'col-list list-related'
      ),
      'item_container' => array(
            'tag' => 'li',
            'id' => '',
            'class' => 'col-md-4 col-sm-6 col-xs-12'
      ),
      'item_template' => array(
            'template_part' => 'templates/nz/archive/related-list-item'
      )
);
?>
<section class="row clearfix" >
      <div class="col-md-12">

            <hr style="color: black; border-color: black;">
            <span style="color: black" class="glyphicon glyphicon-tags">&nbsp;</span>
            <?php nz_the_tags( '' ); ?>

            
            <div class="list-heading">
                  <h3 class="list-head ">
                        CONTENIDOS RELACIONADOS
                  </h3>
                  <!--<hr>-->
                  <div class="arrow"></div>
            </div>

            <?php

            $loop = new NzTplLoop( $tpl_loop );

            echo $loop->render();
            ?>

      </div>

</section>
