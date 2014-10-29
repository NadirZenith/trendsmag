<?php
if ( WP_ENV === 'development' ) {
      define( 'FACEBOOK_APP_ID', '720212671383794' ); // facebook app id development
} else {
      define( 'FACEBOOK_APP_ID', '720182244720170' ); // facebook app id 
}

function nz_facebook_sdk_output() {
      ?>
      <div id="fb-root"></div>

      <script>
            window.fbAsyncInit = function() {
                  FB.init({
                        appId: '<?php echo FACEBOOK_APP_ID ?>',
                        xfbml: true,
                        /*version: 'v1.0'*/
                        version: 'v2.0'
                  });

            };

            (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id))
                        return;
                  js = d.createElement(s);
                  js.id = id;
                  js.src = "//connect.facebook.net/es_LA/sdk.js";
                  fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));



      </script> 
      <?php
}

if ( FACEBOOK_APP_ID ) {
      add_action( 'get_header', 'nz_facebook_sdk_output', 10 );
}

/**
 *    see https://developers.facebook.com/docs/plugins/like-button/
 */
function nz_fb_like_iframe( $url = null ) {
      $url = ($url) ? $url : get_permalink();
      if ( FACEBOOK_APP_ID && $url ) {
            $url = urlencode( $url );
            ?>
            <div class="nz-fblike-iframe">
                  <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $url ?>&amp;width=100&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=<?php FACEBOOK_APP_ID ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
            </div>
            <?php
      }
}

function nz_fb_like( $url = null, $atts = array() ) {
      $url = ($url) ? $url : get_permalink();
      $atts = array_merge(
                array(
                  //standard, button_count, button, box_count
            'layout' => 'button_count',
            'action' => 'like', //recommend
            'show-faces' => 'true',
            'colorscheme' => 'light',
            'share' => 'true',
            'width' => null
                ), $atts
      );
      ?>
      <div class="nz-fblike">
            <div class="fb-like" 
                 data-href="<?php echo $url ?>" 
                 <?php if ( $atts[ 'layout' ] ): ?>
                       data-layout="<?php echo $atts[ 'layout' ] ?>"
                 <?php endif; ?>
                 <?php if ( $atts[ 'like' ] ): ?>
                       data-like="<?php echo $atts[ 'like' ] ?>"
                 <?php endif; ?>
                 <?php if ( $atts[ 'show-faces' ] ): ?>
                       data-show-faces="<?php echo $atts[ 'show-faces' ] ?>"
                 <?php endif; ?>
                 <?php if ( $atts[ 'share' ] ): ?>
                       data-share="<?php echo $atts[ 'share' ] ?>"
                 <?php endif; ?>
                 <?php if ( $atts[ 'width' ] ): ?>
                       data-width="<?php echo $atts[ 'width' ] ?>"
                 <?php endif; ?>
                 >
            </div>
      </div>
      <?php
}

function nz_fb_like_box( $url = null, $atts = array() ) {

      if ( FACEBOOK_APP_ID && $url ) {

            $atts = array_merge(
                      array(
                  'colorscheme' => 'light',
                  'show-faces' => 'true',
                  'header' => 'false',
                  'stream' => 'FALSE',
                  'show-border' => 'FALSE'
                      ), $atts
            );
            $atts[ 'colorscheme' ] = ( in_array( $atts[ 'colorscheme' ], array( 'light', 'dark' ) )) ? $atts[ 'colorscheme' ] : 'light';
            ?>
            <div class="nz-fblikebox">
                  <div class="fb-like-box" 
                       data-href="<?php echo $url ?>" 
                       data-colorscheme="<?php echo $atts[ 'colorscheme' ] ?>" 
                       data-show-faces="<?php echo $atts[ 'show-faces' ] ?>" 
                       data-header="<?php echo $atts[ 'header' ] ?>" 
                       data-stream="<?php echo $atts[ 'stream' ] ?>" 
                       data-show-border="<?php echo $atts[ 'show-border' ] ?>">
                  </div>
            </div>
            <?php
      }
}

function nz_fb_sharer( $url = null, $atts = array() ) {
      $url = ($url) ? $url : get_permalink();
      if ( FACEBOOK_APP_ID && $url ) {
            /*
             * box_count", "button_count", "button", "link", "icon_link", or "icon".
             */
            $atts = array_merge(
                      array(
                  'layout' => 'box_count',
                  'width' => null,
                      ), $atts
            );
            ?>
            <div class="nz-fbsharebutton">
                  <div class="fb-share-button" 
                       data-href="<?php echo $url ?>"
                       <?php if ( $atts[ 'layout' ] ): ?>
                             data-layout="<?php echo $atts[ 'layout' ] ?>"
                       <?php endif; ?>
                       <?php if ( $atts[ 'width' ] ): ?>
                             data-width="<?php echo $atts[ 'width' ] ?>"
                       <?php endif; ?>
                       >
                  </div>
            </div>
            <?php
      }
}

function nz_fb_comments( $url = null, $atts = array() ) {
      $url = ($url) ? $url : get_permalink();
      if ( FACEBOOK_APP_ID && $url ) {
            /*
             * box_count", "button_count", "button", "link", "icon_link", or "icon".
             */
            $atts = array_merge(
                      array(
                  'layout' => 'box_count',
                  'numposts' => 5,
                  'width' => '100%',
                  'colorscheme' => 'light'
                      ), $atts
            );
            ?>

            <div class="nz-fbcomments">
                  <div class="fb-comments"
                       data-href="<?php echo $url ?>"
                       <?php if ( $atts[ 'width' ] ): ?>
                             data-width="<?php echo $atts[ 'width' ] ?>"
                       <?php endif; ?>
                       <?php if ( $atts[ 'numposts' ] ): ?>
                             data-numposts="<?php echo $atts[ 'numposts' ] ?>"
                       <?php endif; ?>
                       <?php if ( $atts[ 'colorscheme' ] ): ?>
                             data-colorscheme="<?php echo $atts[ 'colorscheme' ] ?>"
                       <?php endif; ?>
                       >
                  </div>
            </div>
            <?php
      }
}

function nz_fb_send( $url = null, $atts = array() ) {

      $url = ($url) ? $url : get_permalink();
      if ( FACEBOOK_APP_ID && $url ) {

            /*
             * box_count", "button_count", "button", "link", "icon_link", or "icon".
             */
            $atts = array_merge(
                      array(
                  'layout' => 'box_count',
                  'kid_directed_site' => 'true',
                  'width' => '100%',
                  'colorscheme' => 'light'
                      ), $atts
            );
            ?>
            <div class="nz-fbsend">
                  <div class="fb-send" 
                       data-href="<?php echo $url ?>"
                       <?php if ( $atts[ 'colorscheme' ] ): ?>
                             data-colorscheme="<?php echo $atts[ 'colorscheme' ] ?>"
                       <?php endif; ?>
                       <?php if ( $atts[ 'kid_directed_site' ] ): ?>
                             data-kid_directed_site="<?php echo $atts[ 'kid_directed_site' ] ?>"
                       <?php endif; ?>


                       >

                  </div>
            </div>
            <?php
      }
}
