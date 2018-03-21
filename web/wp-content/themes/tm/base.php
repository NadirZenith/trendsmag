<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
      <?php get_template_part( 'templates/base/head' ); ?>
      <body <?php body_class(); ?> >

            <!--[if lt IE 8]>
              <div class="alert alert-warning">
            <?php _e( 'You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots' ); ?>
              </div>
            <![endif]-->

            <?php
            do_action( 'base_after_body' );
            get_template_part( 'templates/base/header' );
            ?>

            <div class="wrap container" role="document">
                  <div class="content row">
                        <?php
                        /* get_template_part( 'templates/nz/debug/grid' ); */
                        ?>

                        <main class="main <?php echo roots_main_class(); ?>" role="main">
                              <?php
                              include roots_template_path();
                              ?>
                        </main><!-- /.main -->
                        <?php if ( roots_display_sidebar() ) : ?>
                              <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
                                    <?php
                                    include roots_sidebar_path();
                                    ?>
                              </aside><!-- /.sidebar -->
                        <?php endif; ?>
                  </div><!-- /.content -->
            </div><!-- /.wrap -->

            <?php get_template_part( 'templates/base/footer' ); ?>

      </body>
</html>
