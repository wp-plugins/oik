<?php 
/**
 * Return the path of the oik base plugin
 *
 * Use oik_path to find where oik is installed
 * 
 */
if (!function_exists( 'oik_path' )) {
  function oik_path( $file = NULL) {
    return( WP_PLUGIN_DIR . '/oik/' . $file );
  }
}
 
/**
 * invoke require_once on an oik include file or other file
 */
 
if (!function_exists( 'oik_require' )) {
  function oik_require( $include_file = "bobbfunc.inc" ) {
    require_once( oik_path( $include_file ) ); 
  }  
}    
