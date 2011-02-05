<?php

/*
Plugin Name: oik sidebar
Plugin URI: http://www.bobbingwidewebdesign.com/content/oik
Description: Applies widget wrangler sidebar functionality to Artisteer themes
Author: bobbingwide
Version: 0.1
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2011 Bobbing Wide (email : herb@bobbingwide.com )

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
global $oik_options;

function oik_sidebar_api_version() {
  return '0.1';
}

function bw_dynamic_sidebar( $name ) {
  
  global $art_widget_args, $art_sidebars;
  // Add Widget Wrangler sidebars: _before and _after
  // Note: We believe that dynamic_sidebar exists as this was pre-requisite to calling this routine
  // but we can';t be sure that widget wrangler is activated so don't call it if it's not.
   
  $wwsb = function_exists( 'ww_dynamic_sidebar' );
  
  
  bw_trace( $wwsb, __FUNCTION__, __LINE__, __FILE__ );
  bw_trace( $name, __FUNCTION__, __LINE__, __FILE__, 'name' );

  if ( $wwsb ) {
    $success_b = ww_dynamic_sidebar($name.'_before');
    
    bw_trace( $success_b, __FUNCTION__, __LINE__, __FILE__ );
    
  }
  $success = dynamic_sidebar($art_sidebars[$name]['id']);
  
  if ( $wwsb ) {
    $success_a = ww_dynamic_sidebar($name.'_after');
    bw_trace( $success_a, __FUNCTION__, __LINE__, __FILE__ );
  }
  return( $success );
}

