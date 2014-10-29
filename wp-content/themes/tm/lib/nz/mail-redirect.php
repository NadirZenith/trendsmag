<?php

function nz_mail_redirect( $wp ) {
      if (
      /* is_404() && $wp->request == 'mail' */
                is_page( 'mail' )
      ) {
            global $wp_query;
            d( $wp_query );
      }

      wp_redirect( 'https://mail.zoho.com/portal/trendsmag' );
}

/*add_action( 'wp', 'nz_mail_redirect' );*/
?>