<?php 
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
//oik_require( "includes/bw_posts.inc" );


// Init plugin options to white list our options
function bw_trace_options_init(){
	register_setting( 'bw_trace_options_options', 'bw_trace_options', 'bw_trace_options_validate' );
}

function bw_action_options_init(){
	register_setting( 'bw_action_options_options', 'bw_action_options', 'bw_action_options_validate' );
}

// Add menu page
function bw_trace_options_add_page() {
	add_options_page('oik trace options', 'oik trace options', 'manage_options', 'bw_trace_options', 'bw_trace_options_do_page');
}


// Add menu page
function bw_action_options_add_page() {
	add_options_page('oik action options', 'oik action options', 'manage_options', 'bw_action_options', 'bw_action_options_do_page');
}

/** 
 * Settings page for oik actions logging
 */
 
function bw_action_options_do_page() {
  oik_require( "bobbforms.inc" );
  oik_enqueue_stylesheets();
  sdiv( "column span-14 wrap" );
  h2( bw_oik(). " action options" );
  e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_action_options');     
 
  stag( 'table class="form-table"' );
  bw_flush();
  settings_fields('bw_action_options_options'); 
  
//  textfield( "bw_action_options[file]", 60, "Action file", $options['file']  );
  
//function bw_textfield( $name, $len, $text, $value, $class=null, $extras=null ) {
  bw_textfield_arr( "bw_action_options", "Action file", $options, 'file', 60 );
  bw_checkbox_arr( "bw_action_options", "Trace actions", $options, 'actions' );
//  tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 
  
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 

  etag( "table" ); 			
  etag( "form" );
  
  ediv(); 
  sediv( "clear" );
  sdiv("column span-14 wrap");
  
  h2( "Notes about " . bw_oik() . " actions" );
  p( "The actions output produced by " .bw_oik(). " actions can be used to find the sequence that actions are performed" );
  p( "It needs to be used in conjunction with the trace facility.");
  p( "The oik actions should <b>not</b> need to be activated on a live site");
  p( "If you do need to activate it, only do so for a short period of time." );
 
  p( "You will need to specify the action file name (e.g. bwaction.loh )" );
  p( "Set actions to 'on' when you want to trace action processing, 'off' otherwise");
  p( "The trace action log is reset at the same time as the trace log" );
  
  p( "You may find the most recent trace action output at..." );
  $bw_action_url = bw_trace_url( 'bw_action_options' );
  
  alink( NULL, $bw_action_url, $bw_action_url, "View action output in your browser.");
  
  p("For more information:" );
  art_button( "http://www.oik-plugins.com/oik-actions", bw_oik() . " documentation", "Read the documentation for oik actions" );
  ediv(); 
  
  oik_require( "admin/oik-bwaction.inc" ); 
  bw_action_summary();  
  bw_flush();
 
  

}

// Draw the menu page itself
function bw_trace_options_do_page() { 
  oik_require( "bobbforms.inc" );
  
  oik_enqueue_stylesheets();

  sdiv( "column span-14 wrap" );
  h2( bw_oik(). " trace options" );
  e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_trace_options');     
 
  stag( 'table class="form-table"' );
  bw_flush();
  settings_fields('bw_trace_options_options'); 
  
  // textfield( "bw_trace_options[file]", 60, "Trace file", $options['file']  );
  bw_textfield_arr( "bw_trace_options", "Trace file", $options, 'file', 60 );
  
  bw_checkbox_arr( "bw_trace_options", "Trace enabled", $options, 'trace' );
  bw_checkbox_arr( "bw_trace_options", "Reset trace file every transaction", $options, 'reset' );
  bw_checkbox_arr( "bw_trace_options", "Include trace record count", $options, 'count' );
  bw_checkbox_arr( "bw_trace_options", "Include timestamp", $options, 'date' );
  bw_checkbox_arr( "bw_trace_options", "Fully qualified file names", $options, 'qualified' );

  //textfield( "bw_trace_options[trace]", 1 ,"Trace level (1=on)", $options['trace'] );
  //textfield( "bw_trace_options[reset]", 1 ,"Trace reset (1=each txn)", $options['reset'] );
  // Trace error processing is not yet enabled.
  // textfield( "bw_trace_options[errors]", 1 ,"Trace errors (0=no,-1=all,1=E_ERROR,2=E_WARNING,4=E_PARSE, etc)", $options['errors'] );
  
  //textfield( "bw_trace_options[count]", 1 ,"Trace count (1=include)", $options['count'] );
  //textfield( "bw_trace_options[date]", 1 ,"Trace date (1=include)", $options['date'] );
  //textfield( "bw_trace_options[qualified]", 1 ,"Fully qualified file names (1=include)", $options['qualified'] );
  
  
    
  
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 

  etag( "table" ); 			
  etag( "form" );
  
  ediv(); 
  sediv( "clear" );
  sdiv("column span-14 wrap");
  
  h2( "Notes about " . bw_oik() . " trace" );
  p("The tracing output produced by " .bw_oik(). " trace can be used for problem determination.");
  p("It's not for the faint hearted.");
  p("The oik-bwtrace plugin should <b>not</b> need to be activated on a live site");
  p("If you do need to activate it, only do so for a short period of time." );
 
  p("You will need to specify the trace file name (e.g. bwtrace.loh )" );
  p("Set trace level to 1 when you want to trace processing. 0 otherwise");
  p("If you want to clear the trace output set trace reset to 1, save changes, then set it back to 0");
  
  p("You may find the most recent trace output at..." );
  $bw_trace_url = bw_trace_url();
  
  alink( NULL, $bw_trace_url, $bw_trace_url, "View trace output in your browser.");
  p("If you want to trace processing within some content you can use two shortcodes");
  p("Use [bwtron] to turn trace on and [bwtroff] to turn it off" );
  
  p("For more information:" );
  art_button( "http://www.oik-plugins.com/oik", bw_oik() . " documentation", "Read the documentation for the oik plugin" );
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

/** 
 *  Validate the bw_action_options
 * Note: If this function does not exist then no value is returned and the options don't get saved
 * WordPress does not produce a warning message. 
*/ 
function bw_action_options_validate( $input ) {
  return $input;
}  

function bw_trace_url( $option='bw_trace_options') {
  
  $options = get_option( $option ); 
  $file = bw_array_get( $options, 'file', "$option.loh" );    
  
  $bw_trace_url = get_site_url( NULL, $file );
  return( $bw_trace_url );

}

