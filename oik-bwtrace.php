<?php

/*
Plugin Name: oik-bwtrace 
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use trace macros for oik plugins
Author: bobbingwide
Version: 0.2
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
global $bw_trace_options, $bw_trace_on, $bw_trace_level;


$bwapi_trace_test = 'bw_trace';

function oik_bwtrace_version() {
  return '0.2';
  
}

require_once( 'bwtrace.inc');
require_once( 'bobbfunc.inc' );



function this_plugin_first() {
	// ensure path to this file is via main wp plugin path
	$wp_path_to_this_file = preg_replace('/(.*)plugins\/(.*)$/', WP_PLUGIN_DIR."/$2", __FILE__);
	$this_plugin = plugin_basename(trim($wp_path_to_this_file));
	$active_plugins = get_option('active_plugins');
	$this_plugin_key = array_search($this_plugin, $active_plugins);
	if ($this_plugin_key) { // if it's 0 it's the first plugin already, no need to continue
		array_splice($active_plugins, $this_plugin_key, 1);
		array_unshift($active_plugins, $this_plugin);
		update_option('active_plugins', $active_plugins);
	}
}



if (function_exists( "add_action" )) {
  bw_trace_plugin_startup();
}

function bw_trace_plugin_startup() {


  add_action("activated_plugin", "this_plugin_first");


  /* Shortcodes for each of the more useful APIs */
  add_shortcode( 'bwtron', 'bw_trace_on' );
  add_shortcode( 'bwtroff', 'bw_trace_off');

  add_filter('widget_text', 'do_shortcode');
  add_filter('the_title', 'do_shortcode' ); 
  add_filter('wpbody-content', 'do_shortcode' );


  $bw_trace_options = get_option( 'bw_trace_options' );

  $bw_trace_level = $bw_trace_options[ 'trace']; 
  if ( $bw_trace_level > '0' ) {
    bw_trace_on();
  }
  else {
    bw_trace_off();  
  } 

  $bw_trace_reset = $bw_trace_options[ 'reset']; 
  if ( $bw_trace_reset > '0' ) {
    bw_trace_reset();
  }
  else {
    // Don't reset the trace file
  } 


  //$bw_trace_errors = $bw_trace_options[ 'errors']; 
  //bw_trace_errors( $bw_trace_errors );

  // bw_trace_log( "Trace log starting"  );

  if ( $bw_trace_level > '0' ) {
    bw_trace( ABSPATH . $bw_trace_options['file'], __FUNCTION__, __LINE__, __FILE__ );
    bw_trace( bw_getlocale(), __FUNCTION__, __LINE__, __FILE__ );
    bw_trace( $_GET, __FUNCTION__, __LINE__, __FILE__ );  
  } 

  add_action('admin_init', 'bw_trace_options_init' );
  add_action('admin_menu', 'bw_trace_options_add_page');

}

// Init plugin options to white list our options
function bw_trace_options_init(){
	register_setting( 'bw_trace_options_options', 'bw_trace_options', 'bw_trace_options_validate' );
}

// Add menu page
function bw_trace_options_add_page() {
	add_options_page('[bw] Trace Options', 'BW Trace Options', 'manage_options', 'bw_trace_options', 'bw_trace_options_do_page');
}



// Draw the menu page itself
function bw_trace_options_do_page() { 
  require_once( "bobbforms.inc" );

  sdiv( "column span-10 wrap" );
  h2( bw(). " trace options" );
  e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_trace_options');     
  stag( "table" );
  bw_flush();
  settings_fields('bw_trace_options_options'); 
  
  textfield( "bw_trace_options[file]", 60, "Trace file", $options['file']  );
  textfield( "bw_trace_options[trace]", 1 ,"Trace level (1=on)", $options['trace'] );
  textfield( "bw_trace_options[reset]", 1 ,"Trace reset (1=each txn)", $options['reset'] );
  textfield( "bw_trace_options[errors]", 1 ,"Trace errors (0=no,-1=all,1=E_ERROR,2=E_WARNING,4=E_PARSE, etc)", $options['errors'] );
  
    
  tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 

  etag( "table" ); 			
  etag( "form" );
  
  ediv(); 
  sdiv("column span-5 last");
  p("Use [bwtron] to turn trace on and [bwtroff] to turn it off" );
  ediv();      
  bw_flush();
}


// Sanitize and validate input. Accepts an array, return a sanitized array.
function bw_trace_options_validate($input) {
	// Our first value is either 0 or 1
	//$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	//$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}




