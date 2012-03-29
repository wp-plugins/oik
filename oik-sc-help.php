<?php

/*
Plugin Name: oik shortcode help
Plugin URI: http://www.oik-plugins.com/oik
Description: Shortcode help
Version: 2.0
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

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

$bw_sc_help = FALSE;

//add_action( "init", "oik_init" );
add_action( "oik_loaded", "oik_sc_help_init" );


function oik_sc_help_init() { 
  // oik_require( "bobbfunc.inc" );
  bw_add_shortcode( "bw_codes", "bw_codes", oik_path( "shortcodes/oik-codes.php") , false );
  bw_add_shortcode( "bw_code", "bw_code", oik_path( "shortcodes/oik-codes.php") , false ); 
}


/**
 * Need to find out more about other shortcodes and 
 * then find a way of capturing the registration information for a shortcode
 * it should be possible to find the plugin that implements the shortcode
 * but we might not know the location of the function that we can call 
 * if the shortcode is a lazy shortcode.
 */
 
function bw_sc_help( $shortcode="oik" ) {
  oik_require( "includes/oik-sc-help.inc" );
  bw_lazy_sc_help( $shortcode );
}

function bw_sc_syntax( $shortcode="oik" ) {
  oik_require( "includes/oik-sc-help.inc" );
  bw_lazy_sc_syntax( $shortcode );
}

function bw_sc_example( $shortcode="oik" ) {
  oik_require( "includes/oik-sc-help.inc" );
  bw_lazy_sc_example( $shortcode );
}

function bw_sc_snippet( $shortcode="oik" ) {
  oik_require( "includes/oik-sc-help.inc" );
  bw_lazy_sc_snippet( $shortcode );
}





