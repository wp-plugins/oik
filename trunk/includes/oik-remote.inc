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

/**
 * Return the result if the response code is 200 ( OK ) 
 * @param $result from wp_remote_post()
 * @return 
 */
function bw_retrieve_result( $request ) {
  $response_code = wp_remote_retrieve_response_code( $request );
  if ( $response_code == 200 ) {
    $response = wp_remote_retrieve_body( $request );
    bw_trace2( $response, $response_code );
    if ( empty( $response ) ) {
      $result = null;
    } else {
      $result = maybe_unserialize( $response ); //json_decode( $json );
    }
  } else {
    bw_trace2( $response_code, "unexpected response_code" );
    $response_message = wp_remote_retrieve_response_message( $request );
    bw_trace2( $response_message, "response_message" );
    $result = null;
  }
  return( $result );      
}

/**
 * Wrapper to wp_remote_post
 * @param string $url the request URL
 * @param array $args - array of args including body array 
 * @return unserialized result or null
 */ 
function bw_remote_post( $url, $args ) {
  $request = wp_remote_post( $url, $args );
  if ( is_wp_error ($request ) ) {
    bw_trace2( $request, "request is_wp_error" );
    $result = null;
  } else {
    $result = bw_retrieve_result( $request );
  }
  bw_trace2( $result, "result" );
  return( $result );
}

/**
 * Update site_transient_update_plugins for each of our plugins
 * 
 * On the second call to this function we perform our own checks to see if the plugins have been updated.
 * 
 * The response array is updated for each plugin with a new version.
 * 
 * 
 * @param array $transient - structure as in example below
 * @return array $transient - with updates to the response array
 *
 * $plugin_slug is the path and plugin name e.g. oik/oik.php 
 *
 *  [last_checked] => 1342601824
 *  [checked] => Array
 *      (
 *          [backwpup/backwpup.php] => 2.1.11
 *          [oik-pro/oik-altapi.php] => 1.0
 *      )
 *
 *  [response] => Array
 *      (
 *          [backwpup/backwpup.php] => stdClass Object
 *              (
 *                  [id] => 8736
 *                  [slug] => backwpup
 *                  [new_version] => 2.1.12
 *                  [url] => http://wordpress.org/extend/plugins/backwpup/
 *                  [package] => http://downloads.wordpress.org/plugin/backwpup.2.1.12.zip
 *              )
 *      )
 *
 */
function oik_lazy_altapi_check( $transient ) {
  bw_backtrace();
  static $checks = 0;
  static $responses = array();
  static $responses_built = false;
  $checks++;
  bw_trace2( $checks, "checks" );
  if ( !$responses_built ) {
    $checked = bw_array_get( $transient, "checked", null );
    if ( $checked ) {
      foreach ( $checked as $plugin => $version ) {
        $response = oik_check_for_update( $plugin, $version );
        if ( $response && !is_wp_error( $response ) ) {
          $responses[$plugin] = $response;
        }  
      } 
      $responses_built = true;
    }
  }
  if ( $responses_built ) {
    foreach ( $responses as $plugin => $response ) {      
      $transient->response[$plugin] = $response;
    }
    bw_trace2( $responses, "transient updated" );
  }  
  return( $transient );  
}


/**
 * Check an oik-plugins server for an updated plugin 
 * @param string $plugin plugin name e.g. oik-edd/oik-edd.php
 * @param string $version currently installed version e.g 1.03
 * @return $response if there is a new version else null
 *
 * Note: We pass the API key even if it doesn't get used in the server
 *
 */
function oik_check_for_update( $plugin, $version ) {
  bw_trace2();
  $response = null;
  $plugin_settings = oik_query_plugins_server( bw_get_slug( $plugin ) );
  if ( $plugin_settings ) {
    $url = bw_array_get( $plugin_settings, 'server', null );
    $url .= '/plugins/update-check/';
    $apikey = bw_array_get( $plugin_settings, 'apikey', null );
    $body = array( "action" => "update-check" 
                 , "plugin_name" => $plugin 
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
        if( version_compare( $result->new_version, $version, '>' ) ) {
          $response = $result;  
          bw_trace2();
        }  
      }  
    } 
  }
  return( $response );    
}


/**
 * Determine if this is one of "our" plugins
 *
 * @param mixed $args - object or array expected to contain "slug"
 * @return string $server - URL to connect with 
 *
 * Note: Can we trust slug? Could it be "plugin/plugin-file.php" or just "plugin"
 * It may depend upon the $action
 *
 */
function oikp_our_plugin( $args ) {
  $args_slug = bw_array_get( $args, "slug", null );
  if ( $args_slug ) {
    $plugin_settings = oik_query_plugins_server( $args_slug );
    $server = bw_array_get( $plugin_settings, 'server', null );
  }  
  else 
    $server = null;
  return( $server );
} 

/**
 * Implement "plugin_information" for our own plugins
 

    stdClass Object
        (
            [slug] => backwpup
            [per_page] => 24
        )

 */
function oik_lazy_pluginsapi( $false, $action, $args ) {
  bw_trace2();
  $response = false; 
  if ( $action == "plugin_information" ) {
    $url = oikp_our_plugin( $args);      
    /* We have to exclude the version number (i.e. exclude 1.0 from plugins/info/1.0/ ) since the server end's permalink structure does not expect it */
    if ( $url ) { 
      $url .= "/plugins/info/";
      $post_args =  array( 'timeout' => 15
                         , 'body' => array('action' => $action, 'request' => serialize($args))
                         );
      $response = bw_remote_post( $url, $post_args ); 
    }  
  }
  bw_trace2( $response, "response", false );
  return( $response );
}





