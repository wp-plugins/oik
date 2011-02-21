<?php

/*
Plugin Name: oik bob bing wide shortcodes
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use shortcode macros for bob/fob bing/bong wide/hide wow, WoW and WOW
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
function oik_bob_bing_wide_api_version() {
  return '0.4';
}
require_once( 'bobbingwide.inc' );


/* Shortcodes for each of the more useful bobbingwide babbles  */
add_shortcode( 'bob', 'bw_bob' );
add_shortcode( 'fob', 'bw_fob' );

add_shortcode( 'bing', 'bw_bing' );
add_shortcode( 'bong', 'bw_bong' );

add_shortcode( 'wide', 'bw_wide' );
add_shortcode( 'hide', 'bw_hide' );

add_shortcode( 'wow', 'bw_wow' );
add_shortcode( 'WoW', 'bw_wow' );
add_shortcode( 'WOW', 'bw_wow_long');

add_shortcode( 'oik', 'bw_oik' );  
add_shortcode( 'loik', 'bw_loik' ); // Link to the plugin  

add_shortcode( 'bw_page', 'bw_page' );
add_shortcode( 'bw_post', 'bw_post' );
add_shortcode( 'bw_plug', 'bw_plug' );


