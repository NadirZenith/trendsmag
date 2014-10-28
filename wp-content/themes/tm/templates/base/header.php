<style>
      .site-logo {
      }
      .site-logo img{
            width: 95%;
      }
</style>
<header  role="banner">
      <div class="container site-logo2 banner">
            <div class="row hidden-xs">
                  <div class="col-xs-10 col-md-5 col-sm-7">
                        <h1 class="site-logo text-hide">
                              <a href="<?php echo get_home_url() ?>" title="TrendsMag">
                                    <img src="<?php echo nz_get_image_asset( 'logo/white-site-rc1.png' ) ?>" /> TrendsMag
                              </a>
                        </h1>
                  </div>
                  <div class="col-xs-12 pull-right col-md-4 col-sm-4">
                        <div id="top-social-zone" class="pull-right" >
                              <?php nz_fb_like_iframe( 'https://www.facebook.com/trendsmag.net' ); ?>
                              <?php get_template_part( 'templates/nz/social/social-icons-top' ); ?>
                        </div>
                  </div>
            </div>
      </div>

      <div class="navbar navbar-default" >
            <div class="container">
                  <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                        </button>
                        <div id="mobile-site-logo" class="hidden-sm hidden-md hidden-lg text-hide">
                               <a href="<?php echo get_home_url() ?>" title="TrendsMag">
                                     <img width="200" src="<?php echo nz_get_image_asset( 'logo/white-site-rc1.png' ) ?>" /> TrendsMag
                              </a>
                        </div>
                        <?php
                        /*
                          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                         */
                        ?>
                  </div>
                  <nav class="collapse navbar-collapse" role="navigation">
                        <?php
                        if ( has_nav_menu( 'primary_navigation' ) ) :
                              wp_nav_menu(
                                        array(
                                              'theme_location' => 'primary_navigation',
                                              'menu_class' => 'nav navbar-nav nav-justified',
                                              'menu_id' => 'main-menu-top'
                                        )
                              );
                        endif;
                        ?>
                  </nav>
            </div>
      </div>
</header>



<?php
return;
?>
<ul class="nav navbar-nav nav-justified" id="menu-primary-navigation">
      <li class="menu-fashion">
            <a href="http://lab.dev/trendsmag/fashion">FASHION</a>
      </li>
      <li class="menu-noticias">
            <a href="http://lab.dev/trendsmag/news">NOTICIAS</a>
      </li>
      <li class="dropdown menu-agenda"><a href="http://lab.dev/trendsmag/events" data-target="#" data-toggle="dropdown" class="dropdown-toggle">AGENDA <b class="caret"></b></a>
            <ul class="dropdown-menu">
                  <li class="menu-subir-evento"><a href="http://lab.dev/trendsmag/subir-evento">Subir Evento</a></li>
            </ul>
      </li>
      <li class="menu-search hidden-xs">
            <a style="font-size:20px;" href="#" class="search glyphicon glyphicon-search"></a>
            <div class="menu-search-form-wrapper">
                  <form action="http://lab.dev/trendsmag/" class="" method="get" role="search">
                        <input type="search" placeholder="Search" name="s" value="" class="search-field form-control">
                  </form>
            </div>
      </li>
</ul>
