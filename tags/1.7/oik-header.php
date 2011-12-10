<?php

/*
Plugin Name: oik custom header image
Plugin URI: http://www.oik-plugins.com/oik
Description: custom page header image selection 
Version: 1.7
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2010, 2011 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

require_once( 'bobbfunc.inc' );
require_once( 'bobbingwide.inc' );

add_action( 'wp_footer', 'bw_page_header_style' );

/** 
 * Dynamically add CSS for the header background image if the custom field is set
 *
 * For an artisteer theme you can change the header image by adding some extra CSS eg
 * body.page-id-11 div.art-header { background-image: url('images/logo7-business.jpg'); }     
 *
 * Note: The selector is currently coded for Artisteer themes
 * We also assume that the whole of the background image is to be changed.
 * So we turn off the display of the div.art-headerobject as well.
 * 
 * Also added support for pages with themes that use div id='header'
 */
function bw_page_header_style() {
  $post_id = get_the_id();
  $post_meta = get_post_meta( $post_id, '_bw_header_image', TRUE );
  bw_trace2( $post_meta );
  if ( $post_meta ) {
    $header_image = $post_meta ;
    e('<style type="text/css">');
    
    e( "body.postid-$post_id div.art-header, body.page-id-$post_id div.art-header, body.page-id-$post_id div#header { background-image: url('$header_image'); } " );
    e( "div.art-headerobject { display: none; } ");
    e('</style>');
    echo( bw_ret());
  }  
} 
  
if ( is_admin() ) {
  require_once( 'admin/oik-header.inc' );
}




