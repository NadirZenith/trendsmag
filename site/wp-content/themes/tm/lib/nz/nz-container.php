<?php

global $nz;
$nz = new \Pimple\Container();

$nz[ 'shortcode.gform' ] = function($nz) {
      return '[gravityform id="%d" title="false" description="false" ajax=%d]';
};

global $nz_dump_more;
$nz_dump_more = array();
