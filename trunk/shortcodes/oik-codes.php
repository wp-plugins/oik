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
oik_require( "includes/oik-sc-help.inc" );

/**
 * The reason this code is not working at present is because when we invoke the shortcode  
   it returns bw_ret() which also includes the output from the previous call to this function
   so we need to p() the result as well
   OR flush the p()s before returning
*/     

function bw_get_shortcode_syntax_help( $shortcode, $callback ) {
  global $bw_sc_ev, $bw_sc_syntax;
  p( $shortcode );
  $bw_sc_syntax = "&#91;$shortcode"; 
  if ( $callback == "bw_shortcode_event" ) {
    bw_trace2( $callback );
    $sc_callback = $bw_sc_ev[$shortcode]['the_content'];
    bw_trace2( $sc_callback, "sc_callback" );
    if ( $sc_callback ) { 
      if ( function_exists( $sc_callback )) { 
        $result = $sc_callback( NULL, NULL, $shortcode );
        $bw_sc_syntax .= "]" ;
      } else {
        $result = "";
        $bw_sc_syntax .= "] contextual help not available";
      }  
    } else {
      $bw_sc_syntax .= "the_content event not defined for this shortcode" ;
    }
      
    p( $bw_sc_syntax );
  } else {
    p( "$shortcode (not oik) ");
  } 
  bw_flush(); 
}

function bw_get_shortcode_syntax_link( $shortcode, $callback ) {

  //p( "Shortcode $shortcode, callback $callback" );
  //bw_tablerow( array( $shortcode, $link ) );
  stag( "tr" );
  stag( "td" );
  $link = "http://www.oik-plugins.com/oik-shortcodes/$shortcode";
  alink( NULL, $link, "$shortcode help" );   
  etag( "td");
  stag( "td" );
  do_action( "bw_sc_syntax", $shortcode );
  etag( "td" );
  stag( "td" );
  do_action( "bw_sc_help", $shortcode );
  do_action( "bw_sc_example", $shortcode );
  etag( "td" );
  //bw_td( $shortcode );
  //bw_td( $link );
  etag( "tr" );
}



/**
 * table header for bw_codes
 *
 * <table>
 * <tbody>
 * <tr>
 * <th>Shortcode</th>
 * <th>Help link</th>
 * <th>Syntax</th>
 * </tr>
*/
function bw_help_table( $table=true ) {
  if ( $table ) {
    stag( "table" );
    stag( "tbody" );
    stag( "tr" );
    th( "Shortcode" );
    th( "Syntax" );
    th( "Help" );
    etag( "tr" );
  }  
}

/**
 * table footer for bw_plug 
 */
function bw_help_etable( $table=true ) { 
  if ( $table ) {
    etag( "tbody" );
    etag( "table" );
  }  
}



/* Instead of coding bw_array_get 
   or bw_array_get_dcb 
   we called bw_sc_parm which determines what to do depending in the value of the global $bw_sc_help;
   if $bw_sc_help then we return the help for the shortcode rather than expand the shortcode.
   This also relies on there being code to "fail" to expand the shortcode
    
*/
function bw_sc_parm( $atts, $key, $value, $default=NULL ) {
  global $bw_sc_help, $bw_sc_syntax;
  if ( $bw_sc_help ) {
    if ( $default ) {
      $value = $default( $value );
    }  
    $bw_sc_syntax .= " $key='$value'";
  } 
  $value = bw_array_get_dcb( $atts, $key, $value, $default );
  return( $value );
}


/**
 * Return an associative array of shortcodes and their one line descriptions (help)
 *
 * @param array $atts - attributes - currently unused
 * @return array - associative array of shortcode => description
 *
 * The array is ordered by shortcode
 * @uses _bw_lazy_shortcode_help() rather than
*/ 

function bw_shortcode_list( $atts=null ) {
  global $shortcode_tags; 
  
  foreach ( $shortcode_tags as $shortcode => $callback ) {
    $schelp = _bw_lazy_sc_help( $shortcode );
    $sc_list[$shortcode] = $schelp;
  }
  ksort( $sc_list );
  return( $sc_list );
}  


  
function bw_list_shortcodes( $atts = NULL ) {
  global $shortcode_tags, $bw_sc_help;
  if ( !$bw_sc_help ) { 
    $bw_sc_help = TRUE;
    foreach ( $shortcode_tags as $shortcode => $callback ) {
      //bw_get_shortcode_syntax_help( $shortcode, $callback );
    }
    $bw_sc_help = FALSE;
  }
  $ordered = bw_array_get( $atts, "ordered", "N" );
  $ordered = bw_validate_torf( $ordered ); 
  bw_trace2( $shortcode_tags );
  bw_trace2( $ordered, "ordered" );
  
  if ( $ordered ) {
    ksort( $shortcode_tags );
  }
  bw_trace2( $shortcode_tags, "shortcode_tags" );
  add_action( "bw_sc_help", "bw_sc_help" );
  add_action( "bw_sc_example", "bw_sc_example" );
  add_action( "bw_sc_syntax", "bw_sc_syntax" );
  
  
  bw_help_table();
  foreach ( $shortcode_tags as $shortcode => $callback ) {
    bw_get_shortcode_syntax_link( $shortcode, $callback );
  }
  bw_help_etable();

  
}


function bw_codes( $atts = NULL ) {
  $text = "&#91;bw_codes] is intended to show you all the active shortcodes and give you some help on how to use them. ";
  $text .= "If a shortcode is not listed then it could be that the plugin that provides the shortcode is not activated. ";
  $text .= "Click on the link to find detailed help on the shortcode and its syntax. "; 
  e( $text );  
  $shortcodes = bw_list_shortcodes( $atts );

  return( bw_ret());
} 

function bw_code( $atts = NULL ) {
  $shortcode = bw_array_get( $atts, "shortcode", 'bw_code' );
  $help = bw_array_get( $atts, "help", "Y" );
  $syntax = bw_array_get(  $atts,  "syntax", "Y" );
  $example = bw_array_get( $atts, "example", "Y" );
  $live = bw_array_get( $atts, "live", "N" );
  $snippet = bw_array_get( $atts, "snippet", "N" );
  

  //add_action( "bw_sc_help", "bw_sc_help", null ,2 );
  //add_action( "bw_sc_example", "bw_sc_example" );
  //add_action( "bw_sc_syntax", "bw_sc_syntax" );
  
  $help = bw_validate_torf( $help );
  if ( $help ) {
    p( "Help for shortcode: [${shortcode}]" );
    //bw_trace2( $shortcode, "before do_action" );
    do_action( "bw_sc_help", $shortcode );
  }  
  $syntax = bw_validate_torf( $syntax );
  if ( $syntax ) {
    p( "Syntax" ); 
    do_action( "bw_sc_syntax", $shortcode );
  }  
  $example = bw_validate_torf( $example );
  if ( $example ) {
    p( "Example");
    
    do_action( "bw_sc_example", $shortcode );
  }
  

  $live = bw_validate_torf( $live ) ;
  if ( $live ) {
    p("Live example" );
    $live_example = bw_do_shortcode( '['.$shortcode.']' );
    e( $live_example );
  }
  
  $snippet = bw_validate_torf( $snippet );
  if ( $snippet ) {
    do_action( "bw_sc_snippet", $shortcode );
  }

  return( bw_trace2( bw_ret(), "bw_code_return"));
} 
   

