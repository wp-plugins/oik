<?php // (C) Copyright Bobbing Wide 2012, 2013
gobang();
/**
 * 
 * @link http://clark-technet.com/2010/12/wordpress-self-hosted-plugin-update-api
 * @link 
 * 
 * http://wordpress.org/extend/themes/download/custom-community.1.14.zip…
 */
 
/**
 * 
//Use this section to provide updates for a child theme
//If using on child theme be sure to prefix all functions properly to avoid 
//function exists errors

if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('stylesheet'));
    $theme_version = $theme_data->Version;  
} else {
    $theme_data = get_theme_data( get_stylesheet_directory() . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('stylesheet');


if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('template'));
    $theme_version = $theme_data->Version;  
} else {
    $theme_data = get_theme_data( TEMPLATEPATH . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('template');

*/
 

/**
 * Check an oik-plugins server for an updated theme 
 * @param string $theme theme name e.g. oik-edd/oik-edd.php
 * @param string $version currently installed version e.g 1.03
 * @return $response if there is a new version else null
 *
 * Note: We pass the API key even if it doesn't get used in the server
 *
 */
function oik_check_for_theme_update( $theme, $version ) {
  bw_trace2();
  $response = null;
  $theme_settings = oik_query_plugins_server( bw_get_slug( $theme ) );
  if ( $theme_settings ) {
    $url = bw_array_get( $theme_settings, 'server', null );
    $url .= '/themes/update-check/';
    $apikey = bw_array_get( $theme_settings, 'apikey', null );
    $body = array( "action" => "update-check" 
                 , "theme_name" => $theme 
                 , "version" => $version
                 , "apikey" => $apikey
                 );
    $args = array( "body" => $body );
    $result = bw_remote_post( $url, $args ); 
    if ( $result ) {
      bw_trace2( $result );
      if ( is_wp_error( $result ) ) {
          $response = $result;
      } else { 
        //bw_trace2( $result->new_version, "$version!", false ); 
        //$vc = version_compare( $result->new_version, $version, ">" );
        //bw_trace2( $result->new_version, "new version", false );
        //bw_trace2( $version, "old version", false );
        //bw_trace2( $vc, "vc result", false );
        if( isset( $result->new_version ) && version_compare( $result->new_version, $version, '>' ) ) {
          $response = $result;  
          bw_trace2();
        }  
      }  
    } 
  }
  return( $response );    
}
