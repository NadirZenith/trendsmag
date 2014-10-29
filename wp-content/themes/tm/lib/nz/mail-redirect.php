<?php

function nz_mail_redirect( $wp ) {
      if (
                is_404() && $wp->request == 'mail'
      ) {
            wp_redirect( 'https://mail.zoho.com/portal/trendsmag' );
      }
}

add_action( 'wp', 'nz_mail_redirect' );
?>