<footer class="content-info" role="contentinfo" >
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
</footer>


<?php wp_footer(); ?>
