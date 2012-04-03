<?php // (C) Copyright Bobbing Wide 2012

function nggallery__help( $shortcode="nggallery" ) {
  return( "Display a NextGEN gallery" );
}

function nggallery__syntax( $shortcode="nggallery" ) {
  $syntax = array( "id" => bw_skv( null, "<i>id</i>", "Gallery ID. Must be specified." )
                 , "images" => bw_skv( "0", "<i>numeric</i>", "Number of images per page. 0=unlimited" )
                 , "template" => bw_skv( "", "<i>template</i>|carousel|", "Name for a gallery template" ) 
                 );
  return( $syntax );
}

/**
 * Return a callable function that can be invoked using call_user_func()
 *
 * @param object/string $class - class name or actual instance of class name
 * @param string $method - class method name 
 * @returns $function - best attempt at a callable function 
 */
function bw_callablefunction( $class, $method ) {
  if ( is_object( $class ) ) {
    $function = array( $class, $method );
  } else {
    if ( class_exists( $class ) ) {
      $object = new $class();
      $function = array( $object, $method );
      bw_trace2();
    } else {
      $function = $method;
    }
  }
  return( $function );
}

/**
 *
 * 
 * This function will probably work even if the NextGEN is not activated
 *
*/

function nggallery__example( $shortcode="nggallery" ) {
  p( "To display NextGEN gallery with id=1 and the carousel template" );
  //$example = "[$shortcode id=1]";
  //$example = "[$shortcode id=1 template=\"caption\"]";
  $example = "[$shortcode id=1 template=\"carousel\"]";
  
  p ( $example );
  //$function = "NextGEN_shortcodes::show_gallery" ;
  $function = bw_callablefunction( "NextGEN_shortcodes", "show_gallery" );
  bw_add_shortcode_event( 'nggallery', $function, current_filter() );
  e( do_shortcode( $example ));
  alink( null, "http://nextgen-gallery.com/gallery-page/", "Visit the NextGEN Gallery page" );
}

/**
 * Create the snippet for the NextGEN [nggallery] shortcode
 *
 * We have to force the shortcode to expand for this filter
 * I wonder what it was?
*/
 
function nggallery__snippet( $shortcode="nggallery" ) {
  bw_trace2();
  $function = bw_callablefunction( "NextGEN_shortcodes", "show_gallery" );
  //$function = "NextGEN_shortcodes::show_gallery" ;
  //bw_add_shortcode_event( 'nggallery', $function, current_filter() );
  //p( "before snippet" );
  _sc__snippet( $shortcode, "[$shortcode id=1]", $function );
  //p( "After snippet" );
}

