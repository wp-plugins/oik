<?php // (C) Copyright Bobbing Wide 2010-2013

/**
 * create a styled follow me button
 * 
 * @param array atts - array of shortcode attributes
 * 
 * network= the name of the social network - this gets lowercased to choose the button class and the oik option field
 * url = override of who to follow. value defaults to the oik option for the network
 * me = who to follow - defaults to "me"
 * text = currently ignored 
 */
function bw_follow( $atts=null ) {
  $social_network = bw_array_get( $atts, 'network', 'Facebook' );
  $lc_social = strtolower( $social_network );
  $social = bw_array_get( $atts, 'url', null );
  if ( !$social ) {
    $social = bw_get_option_arr( $lc_social, null, $atts );
  }
  if ( $social ) {
    $social = bw_social_url( $lc_social, $social );
  }  
  $me = bw_get_me( $atts );
  $imagefile = oik_url( 'images/'. $lc_social . '_48.png' );
  $image = retimage( NULL, $imagefile, "Follow $me on ".$social_network );
  alink( NULL, $social, $image, "Follow $me on ".$social_network );
  return( bw_ret());
}

/**
 * Return the preferred scheme for the social network
 * @param string $lc_social - lower case name of the social network
 * @return string scheme - either http or https - without "://"
 */
function _bw_social_scheme( $lc_social ) {
  $schemes = array( "facebook" => "https"
                  , "google" => "https" 
                  , "picasa" => "https" 
                  );
  $scheme = bw_array_get( $schemes, $lc_social, "http" );
  return( $scheme );
}

/**
 * Return the preferred hostname for the social network
 * @param string $lc_social - lower case name of the social network
 */
function _bw_social_host( $lc_social ) {
  $hosts = array( "google" => "profiles.google.com"
                , "picasa" => "picasaweb.google.com"  
                );
  $host = bw_array_get( $hosts, $lc_social, "www.${lc_social}.com" );
  return( $host );
}

/**
 * Return the URL for the social network 
 * 
 * @param string $lc_social - lower case version of the social network name
 * @param string $social - stored value - may only be the user name - e.g. the Twitter username without @
 * @return string $social_url - that might work
 */
function bw_social_url( $lc_social, $social ) {
  $url = parse_url( $social );
  $social_url = bw_array_get_dcb( $url, "scheme", $lc_social, "_bw_social_scheme" );
  $social_url .= "://";
  $social_url .= bw_array_get_dcb( $url, "host", $lc_social, "_bw_social_host" );
  $path = "/"; 
  $path .= bw_array_get( $url, "path", "$social" );
  $path = str_replace( "//", "/", $path );
  $social_url .= $path;
  return( $social_url );
}  

/**
 * Implement [bw_twitter] shortcode 
 */
function bw_twitter( $atts=null ) {
  $atts['network'] = "Twitter" ;
  return( bw_follow( $atts ) );  
}

/**
 * Implement [bw_facebook] shortcode 
 */
function bw_facebook( $atts=null ) {
  $atts['network'] = "Facebook" ;
  return( bw_follow( $atts ) );
}

/**
 * Implement [bw_linkein] shortcode 
 */
function bw_linkedin( $atts=null ) { 
  $atts['network'] = "LinkedIn";  
  return( bw_follow( $atts ) );
} 
   
/**
 * Implement [bw_youtube] shortcode 
 */
function bw_youtube( $atts=null ) { 
  $atts['network'] = "YouTube";  
  return( bw_follow( $atts ) );
}

/**
 * Implement [bw_picasa] shortcode 
 */
function bw_picasa( $atts=null ) { 
  $atts['network'] = "Picasa";  
  return( bw_follow( $atts ) );
}
    
/**
 * Implement [bw_flickr] shortcode 
 */
function bw_flickr( $atts=null ) {
  $atts['network'] = "Flickr";  
  return( bw_follow( $atts ));
}

/**
 * Implement [bw_google] shortcode 
 */
function bw_google_plus( $atts=null ) { 
  $atts['network'] = "GooglePlus";  
  return( bw_follow( $atts ));
}

/**
 * Produce a 'follow me' button if there is a value for the selected social network
 * 
 * @param array $atts - parameters
 * Note: $atts['network'] and $atts['me'] are expected to have been set by the calling routine.
 */ 
function bw_follow_e( $atts=null ) {
  $social_network = $atts['network'];
  $lc_social = strtolower( $social_network );
  $social = bw_get_option_arr( $lc_social, null, $atts );
  if ( $social ) {
    $social = bw_social_url( $lc_social, $social );
    $me = bw_array_get( $atts, "me", "me" );
    $imagefile = oik_url( 'images/'. $lc_social . '_48.png' );
    $image = retimage( NULL, $imagefile, "Follow $me on ".$social_network );
    alink( NULL, $social, $image, "Follow $me on ".$social_network );
  }     
}

/**
 * Implement [bw_follow_me] shortcode
 *
 * Produce a Follow me button for each of these social networks:  Twitter, Facebook, LinkedIn, GooglePlus, YouTube, Flickr
 * 
 * @param array $atts - array of parameters
 * @return string - a set of "Follow me" links for the social networks.
 */
function bw_follow_me( $atts=null ) {
  $networks = array( 'Twitter', 'Facebook', 'LinkedIn', 'GooglePlus', 'YouTube', 'Flickr' );
  $atts['me'] = bw_get_me( $atts ); 
  foreach ( $networks as $network ) {
    $atts['network'] = $network;
    bw_follow_e( $atts );
  }
  return( bw_ret());
}
