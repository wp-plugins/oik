<?php
/*
    Copyright 2012, 2013 Bobbing Wide (email : herb@bobbingwide.com )

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
 * Implement the [bw_wtf] shortcode 
 * 
 * return the raw content fully escaped but with unexpanded shortcodes of the current post 
 *
 * @param mixed $atts - parameters to the shortcode 
 * @return string the "raw" content - that could be put through WP-syntax
 */
function bw_wtf( $atts=null, $content=null, $tag=null ) { 
  if ( $content ) {
      $escaped_content = esc_html( $content );
  } else {     
    global $post;
    bw_trace2( $post, "post" ); 
    if ( $post ) {
      $escaped_content = esc_html( $post->post_content );
    } else {
      $escaped_content = "[bw_wtf] - nothing to see";
    }
  }
  $event = bw_array_get_from( $atts, "event,0", "hover" );
  $effect = bw_array_get_from( $atts, "effect,1", "slideToggle" );
  $text = bw_array_get_from( $atts, "text,2", "$event to $effect source" );
  oik_require( "includes/bw_jquery.inc" );
  bw_jquery_af( "div.bw_wtf", $event , "p.bw_wtf", $effect );
  sdiv( "bw_wtf" );
  p( $text );
  stag( 'p', "bw_wtf", null, 'lang=HTML" escaped="true" style="display:none;"' );
  e( $escaped_content );
  etag( "p" );
  ediv();
  return( bw_ret() );
}
