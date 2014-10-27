<header  role="banner">
      <div class="container site-logo">
            <div class="row">
                  <div class="col-xs-12 col-md-8 col-sm-8">
                        <style>
                              .site-logo img{
                                    /*width: 80%;*/
                              }
                        </style>
                        <h1>
                              <a href="<?php echo get_home_url() ?>" title="TrendsMag">
                                    <img width="420" src="<?php echo nz_get_image_asset( 'logo/white-site-rc1.png' ) ?>" />
                                    <?php
                                    /*
                                      <img height="120" src="<?php echo nz_get_image_asset( 'logo/white-site.png' ) ?>" />
                                      <img height="120" src="<?php echo nz_get_image_asset( 'logo/black-site.png' ) ?>" />
                                      <!--<img height="120" src="<?php echo nz_get_image_asset( 'logo/black-site-rc1.png' ) ?>" />-->
                                      <img height="120" src="<?php echo nz_get_image_asset( 'black-site.png' ) ?>" />
                                     */
                                    ?>
                              </a>
                        </h1>
                  </div>
                  <div class="col-xs-12 col-md-4 col-sm-4">
                        <div class="pull-right" style="margin-top: 60px;">
                              <!--<?php nz_fb_like_iframe( 'https://www.facebook.com/trendsmag.net' ); ?>-->
                              <?php get_template_part( 'templates/nz/social/social-icons-top-2' ); ?>
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
                        <!--<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>-->
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
