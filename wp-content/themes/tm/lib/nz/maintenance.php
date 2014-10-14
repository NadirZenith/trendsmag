<?php
 
add_filter( 'aiowps_site_lockout_template_include', 'nz_get_lockout_template' );

function nz_get_lockout_template() {
      return locate_template( 'templates/lockout-template.php' )
;
}
