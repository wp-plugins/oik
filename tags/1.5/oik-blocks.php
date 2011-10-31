<?php // (C) Copyright Bobbing Wide 2011

/*
Plugin Name: oik blocks
Plugin URI: http://www.oik-plugins.com/oik
Description: Easy to use shortcode macro for blocks in content [bw_block] [bw_eblock] 
Version: 1.5
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
/* This include will enable oik shortcodes even if the oik base is not enabled. Is this is good idea? */
require_once( 'oik-add-shortcodes.php' );
/* Include functions to determine level of Artisteer theme whilst Artisteer doesn't provide it */
require_once( 'oik-artisteer.php' );

function bw_block_func( $shortcode ) {
  if ( function_exists( 'bw_artisteer_version' ) ) {
    $art_version = bw_artisteer_version();
  } else {
    $art_version = FALSE; 
  }
  
  //if ( $art_version == FALSE ) 
  //  bw_trace( $art_version, __FUNCTION__,  __LINE__, __FILE__, "art_version is FALSE" ); 
  //else   
  //  bw_trace( $art_version, __FUNCTION__,  __LINE__, __FILE__, "art_version is not FALSE" );  
  
  if ( $art_version == FALSE ) {
    require_once( "bw_block.inc" );
  } else {
    require_once( "bw_block_" . $art_version. ".inc" );
  }
  return $shortcode . '_' . $art_version;
}  

bw_add_shortcode( 'bw_block', 'bw_block' );
bw_add_shortcode( 'bw_eblock', 'bw_eblock' );

function bw_block( $atts=NULL ) {
  $func = bw_block_func( "bw_block" );
  return( $func( $atts ) );
}

function bw_eblock( $atts=NULL ) {
  $func = bw_block_func( "bw_eblock" );
  return( $func( $atts ) );
}
