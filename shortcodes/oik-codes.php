<?php
if ( defined( 'OIK_CODES_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_CODES_SHORTCODES_INCLUDED', true );
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
oik_require( "includes/oik-sc-help.inc" );

function bw_code_link( $shortcode ) {
  if ( is_admin() ) {
     alink( null, admin_url("admin.php?page=oik_sc_help&amp;code=$shortcode"), $shortcode );
  } else {
    e( $shortcode );
  }  
  e( " - " );
}

function bw_get_shortcode_callback( $shortcode ) {
  global $shortcode_tags; 
  $callback = bw_array_get( $shortcode_tags, $shortcode, null );
  return( $callback ); 
}

/**
 * We need to cater for callbacks which are defined as object and function
     Array
        (
            [0] => AudioShortcode Object
                (
                )

            [1] => audio_shortcode
        )
   Given that $callback is passed in and that is_callable should have already been called
   then we should always expect $callable_name to be set!         

 */
function bw_get_shortcode_function( $shortcode, $callback=null ) {
  global $bw_sc_ev;
  $events = bw_array_get( $bw_sc_ev, $shortcode, null );
  $function = bw_array_get( $events, 'the_content', $callback );
  $callable_name = null;
  if ( !is_callable( $function, false, $callable_name ) ) {
    $callable_name = bw_array_get( $function, 1, $shortcode );
    bw_trace2( $bw_sc_ev, "unexpected result!" ); 
  } 
  return( $callable_name );  
}

function bw_get_shortcode_syntax_link( $shortcode, $callback ) {

  //p( "Shortcode $shortcode, callback $callback" );
  //bw_tablerow( array( $shortcode, $link ) );
  stag( "tr" );
  stag( "td" );
  bw_code_link( $shortcode );
  
  do_action( "bw_sc_help", $shortcode );
  //do_action( "bw_sc_example", $shortcode );
  etag( "td" );
  stag( "td" );
  do_action( "bw_sc_syntax", $shortcode );
  etag( "td" );
  
  stag( "td" );
  $function = bw_get_shortcode_function( $shortcode, $callback );
  $link = "http://www.oik-plugins.com/oik-shortcodes/$shortcode/$function"; 
  alink( NULL, $link, "$shortcode help" );   
  etag( "td");
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
    stag( "table", "widefat" );   
    stag( "thead" ); 
    stag( "tr" );
    th( "Help" );
    th( "Syntax" );
    th( "more oik help" );
    etag( "tr" );
    etag( "thead" );
 
    stag( "tbody" );
  }  
}

/**
 * table footer for bw_codes
 */
function bw_help_etable( $table=true ) { 
  if ( $table ) {
    etag( "tbody" );
    etag( "table" );
  }  
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

/**
 * Produce a table of shortcodes
 * @param array $atts - shortcode parameters
 */
function bw_list_shortcodes( $atts = NULL ) {
  global $shortcode_tags;
  $ordered = bw_array_get( $atts, "ordered", "N" );
  $ordered = bw_validate_torf( $ordered ); 
  //bw_trace2( $shortcode_tags );
  //bw_trace2( $ordered, "ordered" );
  if ( $ordered ) {
    ksort( $shortcode_tags );
  }
  //bw_trace2( $shortcode_tags, "shortcode_tags" );
  add_action( "bw_sc_help", "bw_sc_help" );
  add_action( "bw_sc_example", "bw_sc_example" );
  add_action( "bw_sc_syntax", "bw_sc_syntax" );
  bw_help_table();
  foreach ( $shortcode_tags as $shortcode => $callback ) {
    bw_get_shortcode_syntax_link( $shortcode, $callback );
  }
  bw_help_etable();
}

/** 
 * Display a table of active shortcodes
 * @param array $atts - shortcode parameters
 * @return results of the shortcode
 * @uses bw_list_shortcodes()
 */
function bw_codes( $atts = NULL ) {
  $text = "&#91;bw_codes] is intended to show you all the active shortcodes and give you some help on how to use them. ";
  $text .= "If a shortcode is not listed then it could be that the plugin that provides the shortcode is not activated. ";
  $text .= "Click on the link to find detailed help on the shortcode and its syntax. "; 
  e( $text );  
  $shortcodes = bw_list_shortcodes( $atts );
  return( bw_ret());
} 

/**
 * Display information about a specific shortcode
 * @param array $atts - shortcode parameters
 * @return results of the shortcode
 */
function bw_code( $atts=null, $content=null, $tag=null ) {
  $shortcode = bw_array_get( $atts, "shortcode", null );
  if ( $shortcode ) {
    $help = bw_array_get( $atts, "help", "Y" );
    $syntax = bw_array_get(  $atts,  "syntax", "Y" );
    $example = bw_array_get( $atts, "example", "Y" );
    $live = bw_array_get( $atts, "live", "N" );
    $snippet = bw_array_get( $atts, "snippet", "N" );
    
    $help = bw_validate_torf( $help );
    if ( $help ) {
      p( "Help for shortcode: [${shortcode}]", "bw_code_help" );
      //bw_trace2( $shortcode, "before do_action" );
      do_action( "bw_sc_help", $shortcode );
    }  
    $syntax = bw_validate_torf( $syntax );
    if ( $syntax ) {
      p( "Syntax", "bw_code_syntax" ); 
      do_action( "bw_sc_syntax", $shortcode );
    }  
    $example = bw_validate_torf( $example );
    if ( $example ) {
      p( "Example", "bw_code_example");
      do_action( "bw_sc_example", $shortcode );
    }

    $live = bw_validate_torf( $live ) ;
    if ( $live ) {
      p("Live example", "bw_code_live_example" );
      $live_example = bw_do_shortcode( '['.$shortcode.']' );
      e( $live_example );
    }
    
    $snippet = bw_validate_torf( $snippet );
    if ( $snippet ) {
      p( "Snippet", "bw_code_snippet" );
      do_action( "bw_sc_snippet", $shortcode );
    }
  } else {
    $link_text = bw_array_get( $atts, 0, null );
    if ( $link_text ) {
      bw_code_example_link( $atts );
      
    } else {
      return( bw_code( array( "shortcode" => "bw_code" ) ) );
    }
    
  } 
  
  return( bw_trace2( bw_ret(), "bw_code_return"));
}


/**
 * Create a nicely formatted link to the definition of the shortcode
 *
 * When the shortcode= parameter is not specified then we assume that this is an example
 * that we want to both show AND make a link to the help in oik-plugins.
 * The first word is expected to be the shortcode and the rest are parameters
 * e.g. [bw_code bw_code shortcode=bw_code] 
 * 
 * @param $atts -  shortcode parameters
 * 
 */ 
function bw_code_example_link( $atts ) {
  $shortcode_string = bw_array_get( $atts, 0, null );
  $link_text = "&#91;";
  $link_text .= $shortcode_string; 
  $link_text .= "]";
  $shortcodes = explode( " ", $shortcode_string );
  $shortcode = $shortcodes[0];
  $callback =  bw_get_shortcode_callback( $shortcode );
  $function = bw_get_shortcode_function( $shortcode, $callback );
  $link = "http://www.oik-plugins.com/oik-shortcodes/$shortcode/$function"; 
  alink( "bw_code $shortcode", $link, $link_text, "Link to help for shortcode: $shortcode" );   
}
   

