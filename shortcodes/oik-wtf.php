<?php
if ( defined( 'OIK_WTF_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_WTF_SHORTCODES_INCLUDED', true );

/*
    Copyright 2012 Bobbing Wide (email : herb@bobbingwide.com )

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

/** 
 * return the raw content fully escaped but with unexpanded shortcodes of the current post 
 *
 * @param mixed $atts - parameters to the shortcode 
 * @return string the "raw" content - that could be put through WP-syntax
 */
function bw_wtf( $atts=null ) { 
  global $post;
  bw_trace2( $post, "post" ); 
  $escaped_content = esc_html( $post->post_content );
  stag( 'p', null, null, 'lang=HTML" escaped="true"' );
  e( $escaped_content );
  etag( "p" );
  return( bw_ret() );

}
