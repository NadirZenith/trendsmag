<?php

function nz_media_queries_debug_output() {
      ?>
      <div id="nz-debug-media-queries-wrapper">
            <style>
                  #nz_debug_bar {position:fixed;font-size:12px;bottom:50px;right:0px;text-shadow: 0 1px #333;cursor:default;width: 250px;z-index: 1000;transition: all 0.3s linear;-moz-transition: all 0.3s linear;-webkit-transition: all 0.3s linear;-o-transition: all 0.3s linear;}
                  #nz_debug_bar {background:rgba(0,0,0,0.6);border:3px solid #eee;outline:1px solid #fff;padding: 5px 10px;margin:10px;color:#fff;-moz-box-shadow: inset 0 0 3px #333, 0 0 4px rgba(0,0,0,0.4);-webkit-box-shadow: inset 0 0 3px #333, 0 0 4px rgba(0,0,0,0.4);box-shadow: inset 0 0 3px #333, 0 0 4px rgba(0,0,0,0.4);line-height:20px;}
                  #nz_debug_bar a {color:#66b9de;text-decoration:none;}
                  #nz_debug_bar span {color:#66b9de;text-decoration:none;}
                  
                  #nz_debug_bar:hover{width:450px;}
                  #nz_debug_bar:hover #nz-db-more {height:450px;}
                  
                  #nz-db-more{height:0px;overflow:auto;transition: all 0.3s linear;-moz-transition: all 0.3s linear;-webkit-transition: all 0.3s linear;-o-transition: all 0.3s linear;}
                  #nz-db-more span

            </style>
            <div id="nz_debug_bar" >

                  <div class="visible-xs"><span> XS </span>- max-width:767 px  </div>
                  <div class="visible-sm"><span> SM </span>- min-width:768 px  </div>
                  <div class="visible-md"><span> MD </span>- min-width:992 px  </div>
                  <div class="visible-lg"><span> LG </span>- min-width:1200 px </div>
                  <div id="nz-debug-width"><span> px </span></div>
                  <div id="nz-db-more">
                        <?php
                        nz_dump_print();
                        ?>
                  </div>
            </div>
            <script>
                  (function($) {

                        $(window).on('resize', function() {
                              $window = $(this);
                              $('#nz-debug-width span').html($window.innerWidth() + 'px');
                              /*
                               console.log($window.innerWidth());
                               console.log($window.outerWidth());
                               console.log($window.width());
                               */
                        });

                        $(window).resize();

                  })(jQuery);
            </script>
      </div>
      <?php
}

add_action( 'wp_footer', 'nz_media_queries_debug_output' );
?>

<?php
return;
?>

<style>
      @media(max-width:767px){}
      @media(min-width:768px){}
      @media(min-width:992px){}
      @media(min-width:1200px){}
</style>