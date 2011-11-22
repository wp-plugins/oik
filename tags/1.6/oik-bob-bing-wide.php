<?php

/*
Plugin Name: oik bob bing wide shortcodes
Plugin URI: http://www.oik-plugins.com/oik
Description: Easy to use shortcode macros for bob/fob bing/bong wide/hide wow, WoW and WOW, oik and loik, etcetera
Version: 1.6
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
// If we include oik.php then we effectively activate the oik plugin
// is this a good or a bad thing? 

// require_once( 'oik.php') ;
require_once( 'bobbfunc.inc' );
require_once( 'bobbingwide.inc' );
require_once( 'oik-add-shortcodes.php' );

function oik_bob_bing_wide_api_version() {
  return bw_oik_version();
}


/* Shortcodes for each of the more useful bobbingwide babbles  */
bw_add_shortcode( 'bob', 'bw_bob' );
bw_add_shortcode( 'fob', 'bw_fob' );

bw_add_shortcode( 'bing', 'bw_bing' );
bw_add_shortcode( 'bong', 'bw_bong' );

bw_add_shortcode( 'wide', 'bw_wide' );
bw_add_shortcode( 'hide', 'bw_hide' );

bw_add_shortcode( 'wow', 'bw_wow' );
bw_add_shortcode( 'WoW', 'bw_wow' );
bw_add_shortcode( 'WOW', 'bw_wow_long');

bw_add_shortcode( 'oik', 'bw_oik' );  
bw_add_shortcode( 'loik', 'bw_loik' ); // Link to the plugin  
bw_add_shortcode( 'OIK', 'bw_oik_long'); // Spells out often included key-information

bw_add_shortcode( 'bw_page', 'bw_page' );
bw_add_shortcode( 'bw_post', 'bw_post' );
bw_add_shortcode( 'bw_plug', 'bw_plug' );
bw_add_shortcode( 'bw_module',  'bw_module' );

bw_add_shortcode( 'bp', 'bw_bp' );   // BuddyPress
bw_add_shortcode( 'lwp', 'bw_lwp' ); // Link to WordPress.org 
bw_add_shortcode( 'lbp', 'bw_lbp' ); // Link to BuddyPress.org 
bw_add_shortcode( 'wpms', 'bw_wpms' );   // WordPress Mu;tisite
bw_add_shortcode( 'lwpms', 'bw_lwpms' ); // Link to WordPress multisite - .org
bw_add_shortcode( 'drupal', 'bw_drupal' );   // Drupa;
bw_add_shortcode( 'ldrupal', 'bw_ldrupal' ); // Link to Drupal.org
bw_add_shortcode( 'artisteer', 'bw_art' ); // Artisteer
bw_add_shortcode( 'lartisteer', 'bw_lart' ); // Link to artisteer.com 

bw_add_shortcode( 'lbw', 'bw_lbw'); // Link to Bobbing Wide

// This is just a bit of code to help determine if a fix to shortcodes has been implemented or not

add_shortcode( 'wp-1', 'wp1');
add_shortcode( 'wp-2', 'wp2');

function wp1( $atts=NULL) {
  return( 'wp1 done');
}
  
function wp2( $atts=NULL) {
  return( 'wp2 done');
}  
function wp3( $atts=NULL) {
  return( 'wp3 done');
}  


bw_add_shortcode( 'wp', 'bw_wp' );   // WordPress
add_shortcode( 'wp-3', 'wp3');
