<?php // (C) Copyright Bobbing Wide 2013

/**
 * Return a list of the jQuery cycle effects 
 * @return string CSV separated jQuery cycle effects - alphabetical order
 */
function bw_cycle_fxs() {
  $fxs = "blindX|blindY|blindZ|cover|curtainX|curtainY|fade|fadeZoom|growX|growY|none|scrollUp|scrollDown|scrollLeft|scrollRight|scrollHorz|scrollVert|shuffle|slideX|slideY|toss|turnUp|turnDown|turnLeft|turnRight|uncover|wipe|zoom|";
  return( $fxs);
}

/***
 * Validate the fx for [bw_cycle] shortcode
 *
 * @param string $fx - required effect
 * @return string - returned value - defaults to "fade" if required is incorrect
 * 
 */
function bw_cycle_validate_fx( $fx ) {
  $fxs = bw_cycle_fxs();
  $pos = stripos( $fxs, "$fx|" );
  if ( $pos === false ) {
    bw_trace2( "Invalid fx" );
    $fx = "fade";
  } else {
    $fx = substr( $fxs, $pos, strlen( $fx ) );
  } 
  // e( "Fx=$fx" ); 
  return( $fx );
}  

/**
 * Implement bw_cycle shortcode that will handle all the things that we've had to do by hand until now
 
   <pre>
   Create the jQuery
     [bw_jq .cycle method=cycle fx=fade script=cycle.all fit=1 width="100%" ]
     
   Create the CSS 
     [bw_css]
       div.cycle { width: 100% !important; }
       div.cycle img { max-width: 100% !important; }
     [/bw_css]
   
   Create the cycle div for the specified class
     [div class="cycle"]
   
   Invoke the shortcode
     [bw_pages etcetera]
     
   Create the end div
   [ediv]
   </pre>
   
  @TODO Doesn't yet build the internal CSS 
  
   
 */ 
function bw_cycle( $atts=null, $content=null, $tag=null ) {
  oik_require( "shortcodes/oik-jquery.php" );
  $class = bw_array_get( $atts, "class", "cycle" );
  $fx = bw_array_get( $atts, "fx", "fade" );
  $fx = bw_cycle_validate_fx( $fx );
  $selector = ".$class";
  bw_jquery_enqueue_script( "cycle.all" );
  bw_jquery_enqueue_style( "cycle.all" );
  $parms = bw_jkv( array( "fx" => $fx, "fit" => 1, "width" => "100%") );
  bw_jquery( $selector, "cycle", $parms, false );
  sdiv( $class );
  $atts['post_type'] = bw_array_get( $atts, "post_type", "attachment" );
  if ( $atts['post_type'] == "attachment" ) {
    oik_require( "shortcodes/oik-attachments.php" );
    e( bw_attachments( $atts ) );
  } else { 
    oik_require( "shortcodes/oik-pages.php" );
    e( bw_pages( $atts ) );
  }  
  ediv( $class ); 
  return( bw_ret() );
}

/**
 * Implement help hook for [bw_cycle] shortcode
 */
function bw_cycle__help( $shortcode="bw_cycle" ) { 
  return( __( "Display pages using jQuery cycle" ) );
}

/**
 * Syntax hook for [bw_cycle] shortcode
 */
function bw_cycle__syntax( $shortcode="bw_cycle" ) {
  $syntax = array( "fx" => bw_skv( "fade", bw_cycle_fxs(), "Cycle transition effects" ) );
  
  oik_require( "shortcodes/oik-pages.php" );
  $pages_syntax = bw_pages__syntax( $shortcode );
  $syntax = array_merge( $syntax, $pages_syntax );
  
  return( $syntax );
} 

/** 
function bw_cycle__example( $shortcode="bw_cycle" ) {
}    
*/ 
