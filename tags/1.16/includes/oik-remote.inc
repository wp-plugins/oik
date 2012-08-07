<?php // (C) Copyright Bobbing Wide 2012

/**
 * Wrapper to wp_remote_get
 * @param string $url with parameters already added
 * @return decoded result - a json object OR null 
 */ 
function bw_remote_get( $url ) {
  $request = wp_remote_get( $url );
  if ( is_wp_error ($request ) ) {
    bw_trace2( $request, "request is_wp_error" );
    $result = null;
  } else {
    $json = wp_remote_retrieve_body( $request );
    bw_trace2( $json );
    if ( empty( $json ) ) {
      $result = null;
    } else {
      $result = json_decode( $json );
    }  
  }
  bw_trace2( $result, "result" );
  return( $result );
}


