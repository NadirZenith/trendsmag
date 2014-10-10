<footer class="content-info" role="contentinfo" >
      <div class="container-fluid" style="padding-bottom: 20px;">
            <?php
            if ( has_nav_menu( 'footer_navigation' ) ) :
                  wp_nav_menu(
                            array(
                                  'theme_location' => 'footer_navigation',
                                  'menu_class' => 'nav navbar-nav',
                                  'menu_id' => 'main-menu-footer'
                            )
                  );
            endif;
            /*dynamic_sidebar( 'sidebar-footer' );*/
            ?>
      </div>
</footer>


<?php wp_footer(); ?>
