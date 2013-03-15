<?php // (C) Copyright Bobbing Wide 2012, 2013

/**
 * Implement [bw_geo] shortcode
 *
 */
function bw_geo( $atts=null, $content=null, $tag=null ) {
  //$alt = bw_array_get( $atts, "alt", null );
  sp("geo");
  span( "geo");
    e( "Lat." ); 
    span( "latitude" );
    e( bw_get_option_arr( "lat", "bw_options", $atts ) );
    epan();
    // I think we should have a space between the lat. and long. values
    e( "&nbsp;");
    e( "Long." );
    span( "longitude" );
    e( bw_get_option_arr( "long", "bw_options", $atts ) );
    epan();
  epan();
  ep(); 
  return( bw_ret());
}

/**
 * Implement the [bw_directions] shortcode to generate a button to get directions from Google Maps 
 * 
 * e.g. * http://maps.google.co.uk/maps?f=d&hl=en&daddr=50.887856,-0.965113
 *
 */
function bw_directions( $atts=null ) {
  $lat = bw_get_option_arr( "lat", "bw_options", $atts );
  $long = bw_get_option_arr( "long", "bw_options", $atts );
  $company = bw_get_option_arr( "company", "bw_options", $atts );
  $extended = bw_get_option_arr( "extended-address", "bw_options", $atts );
  $postcode = bw_get_option_arr( "postal-code", "bw_options", $atts );
  $link = "http://maps.google.co.uk/maps?f=d&hl=en&daddr=" . $lat . "," . $long;  
  $text = "Google directions";
  $title = "Get directions to " . $company;
  if ( $extended && ($company <> $extended) )
    $title .= " - " . $extended;
  if ( $postcode )
    $title .= " - " . $postcode;
  $class = NULL;
  art_button( $link, $text, $title, $class ); 
  return( bw_ret());
}

