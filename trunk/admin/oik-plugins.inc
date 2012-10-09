<?php

  
/**
  $option = 'bw_plugins'; 
  $options = bw_form_start( $option, 'oik_plugins_options' );
  bw_checkbox_arr( "bw_plugins", "oik trace", $options, 'oik-bwtrace' ); 
  bw_checkbox_arr( "bw_plugins", "oik email signature", $options, 'oik-email-signature' );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 
  etag( "table" ); 			
  etag( "form" );
  bw_flush();
  
}
*/


/**
 * oik plugins settings page 
 *
 * Processing depends on the button that was pressed. There should only be one!
 * 
 * Selection                       Validate? Perform action        Display preview Display add  Display edit Display select list
 * ------------------------------- --------  -------------------   --------------- ------------ ------------ -------------------
 * preview_plugin                    No        n/a                   Yes             -            -            -
 * delete_plugin                     No        delete selected plugin  -               -            -            Yes
 * edit_plugin                       No        n/a                   -               -            Yes          Yes
 *
 * _oik_plugins_edit_settings      Yes       update selected plugin  -               -            Yes          Yes
 * _oik_plugins_add_plugin
 * _oik_plugins_add_settings
 * 
*/
function oik_lazy_plugins_server_settings() {
  oik_menu_header( "plugin server settings", "w100pc" );
  $validated = false;
  
  $preview_plugin = bw_array_get( $_REQUEST, "preview_plugin", null );
  $delete_plugin = bw_array_get( $_REQUEST, "delete_plugin", null );
  $edit_plugin = bw_array_get( $_REQUEST, "edit_plugin", null );
  
  /** These plugins override the ones from the list... but why do we need to do it? 
   * Do we have to receive the others in the $_REQUEST **?**
   *
  */
  $oik_plugins_edit_settings = bw_array_get( $_REQUEST, "_oik_plugins_edit_settings", null );
  $oik_plugins_add_settings = bw_array_get( $_REQUEST, "_oik_plugins_add_settings", null );
  $oik_plugins_add_plugin = bw_array_get( $_REQUEST, "_oik_plugins_add_plugin", null );
  if ( $oik_plugins_add_plugin || $oik_plugins_add_settings ) {
    $preview_plugin = null;
    $delete_plugin = null;
    $edit_plugin = null; 
  }  
  
  
  if ( $preview_plugin ) {
    oik_box( NULL, NULL, "Preview", "oik_plugins_preview" );
  } 
  
  if ( $delete_plugin ) { 
    _oik_plugins_delete_settings( $delete_plugin );
  }  

  if ( $edit_plugin ) {
    global $bw_plugin;
    $bw_plugins = get_option( "bw_plugins" );
    $bw_plugin = bw_array_get( $bw_plugins, $edit_plugin, null );
    $bw_plugin['plugin'] = $edit_plugin; 
    bw_trace2( $bw_plugin );
  }
  if ( $oik_plugins_edit_settings ) {  
    $validated = _oik_plugins_settings_validate( false );
  }  
  
  if ( $oik_plugins_add_settings ) {
    $validated = _oik_plugins_settings_validate( true );
  }
  
  if ( $oik_plugins_add_plugin || ( $oik_plugins_add_settings && !$validated )  ) {
    oik_box( NULL, NULL, "Add new", "oik_plugins_add_settings" );
  }
  
  if ( $edit_plugin || $oik_plugins_edit_settings || $validated ) {
    oik_box( null, null, "Edit plugin", "oik_plugins_edit_settings" );
  }
  oik_box( NULL, NULL, "Settings", "oik_plugins_settings" );
  oik_menu_footer();
  bw_flush();
}

/** 
 * Display a current settings
 */
function _oik_plugins_settings_row( $plugin, $server, $apikey, $expiration ) {
  $row = array();
  $row[] = $plugin;
  $row[] = $server . "&nbsp;"; //itext( "server[$plugin]", 100, $server ); //esc_html( stripslashes( $server ) )); //iarea( $plugin, 100, $server, 10 );
  $row[] = $apikey . "&nbsp;"; //itext( "apikey[$plugin]", 26, $apikey );
  // $row[] = itext( "expand[$plugin]", $expand, true );
  $links = retlink( null, admin_url("admin.php?page=oik_plugins&amp;preview_plugin=$plugin"), "Preview" );
  $links .= "&nbsp;";
  $links .= retlink( null, admin_url("admin.php?page=oik_plugins&amp;delete_plugin=$plugin"), "Delete" ); 
  $links .= "&nbsp;";
  $links .= retlink( null, admin_url("admin.php?page=oik_plugins&amp;edit_plugin=$plugin"), "Edit" );   
  $row[] = $links;
  bw_tablerow( $row );
}

function _oik_plugins_settings_table() {
  $bw_plugins = get_option( "bw_plugins" );
  if ( is_array( $bw_plugins) && count( $bw_plugins )) {
    foreach ( $bw_plugins as $plugin => $plugin_data ) {
      //$plugin = bw_array_get( $plugin, "plugin", null );
      $server = bw_array_get( $plugin_data, "server", "&nbsp;" );
      $apikey = bw_array_get( $plugin_data, "apikey", null );
      $expiration = bw_array_get( $plugin_data, "expiration", null );
      _oik_plugins_settings_row( $plugin, $server, $apikey, $expiration );
    }
  }  
}

/**
 * Check if it already exists as a settings
 * If not then add to the options using bw_update_option() 
 * then empty out the plugin field for the next one
 *
 */
function _oik_plugins_add_settings( $plugin ) {
  $field = bw_array_get( $plugin, "plugin", null );
  
  //global $settings_tags;
  //$plugin_exists = bw_array_get( $settings_tags, $plugin, false );
  //if ( $plugin_exists ) {
  //  p( "settings $plugin already defined, try another plugin" );   
  //  $ok = false;
  //
  //} else {
    unset( $plugin['plugin'] );
    bw_update_option( $field, $plugin, "bw_plugins" );
    // We don't need to add the settings now! 
    $plugin['plugin'] = "";
    $ok = true;
  //}
  return( $ok ); 
}

function _oik_plugins_update_settings( $plugin ) {
  $field = bw_array_get( $plugin, "plugin", null );
  if ( $plugin ) { 
    unset( $plugin['plugin'] );
    bw_update_option( $field, $plugin, "bw_plugins" );
  } else {
    //gobang();
  }  
    
}

function _oik_plugins_delete_settings( $plugin ) {
  bw_delete_option( $plugin, "bw_plugins" );
}  


/**
 * plugin must not be blank
 */
function oik_diy_validate_plugin( $plugin ) {
  $valid = isset( $plugin );
  if ( $valid ) { 
    $plugin = trim( $plugin );
    $valid = strlen( $plugin ) > 0;
  } 
  if ( !$valid ) { 
    p( "settings must not be blank" );   
  }  
  return $valid;
}
    
/**
 
 */
function _oik_plugins_settings_validate( $add_plugin=true ) {

  global $bw_plugin;
  $bw_plugin['plugin'] = bw_array_get( $_REQUEST, "plugin", null );
  $bw_plugin['server'] = bw_array_get( $_REQUEST, "server", null );
  $bw_plugin['apikey'] = bw_array_get( $_REQUEST, "apikey", null );
  $bw_plugin['expiration'] = bw_array_get( $_REQUEST, "expiration", null );
  
  $ok = oik_diy_validate_plugin( $bw_plugin['plugin'] );
  
  // validate the fields and add the settings IF it's OK to add
  // $add_plugin = bw_array_get( $_REQUEST, "_oik_plugins_add_settings", false );
  if ( $ok ) {
    if ( $add_plugin ) {
      $ok = _oik_plugins_add_settings( $bw_plugin );  
    } else {
      $ok = _oik_plugins_update_settings( $bw_plugin );
    }
  }  
  return( $ok );
}

function oik_plugins_settings() {
  $default_plugin_server = oik_get_plugins_server();
  $link = retlink( null, $default_plugin_server, $default_plugin_server , "default oik plugins server" );
  p( "The default oik plugins server is currently set to: " . $link );
  bw_form();
  stag( "table", "widefat" );
  stag( "thead");
  bw_tablerow( array( "plugin", "server", "apikey", "expiration", "Preview link" ));
  etag( "thead");
  _oik_plugins_settings_table();
  bw_tablerow( array( "", "<input type=\"submit\" name=\"_oik_plugins_add_plugin\" value=\"Add plugin\" class=\"button-primary\"/>") ); 
  etag( "table" );
  etag( "form" );
  // bw_flush();
} 

function oik_plugins_add_settings( ) {
  global $bw_plugin;
  bw_form();
  stag( "table", "wide-fat" );
  bw_textfield( "plugin", 20, "plugin", $bw_plugin['plugin'] );
  bw_textfield( "server", 100, "server", stripslashes( $bw_plugin['server'] ) );
  bw_textfield( "apikey", 26, "apikey", $bw_plugin["apikey"] );
  //bw_textfield( "expiration", "expiration date", $bw_plugin["expiration"] );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"_oik_plugins_add_settings\" value=\"Add new plugin\" class=\"button-primary\"/>") ); 
  etag( "table" );
  etag( "form" );
}

function oik_plugins_edit_settings( ) {
  global $bw_plugin;
  bw_form();
  stag( "table", "wide-fat" );
  
  bw_tablerow( array( "plugin", $bw_plugin['plugin'] . ihidden( 'plugin', $bw_plugin['plugin']) ) );
  bw_textfield( "server", 100, "server", stripslashes( $bw_plugin['server'] ), 10 );
  bw_textfield( "apikey", 26, "apikey?", $bw_plugin["apikey"] );
  //bw_checkbox( "expiration", "expiration", $bw_plugin["expiration"] );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"_oik_plugins_edit_settings\" value=\"Change plugin\" class=\"button-primary\"/>") ); 
  etag( "table" );
  etag( "form" );
}

function oik_plugins_preview() {
  $preview_plugin = bw_array_get( $_REQUEST, "preview_plugin", null );
  if ( $preview_plugin ) {
    // Preview the plugin from the remote server ? What does this mean? Validate the apikey perhaps?
  }
}



if ( !function_exists( "bw_update_option" ) ) {
/** Set the value of an option field in the options group
 *
 * @param string $field the option field to be set
 * @param mixed $value the value of the option
 * @param string $options - the name of the option field
 * @return mixed $value
 *
 * Parms are basically the same as for update_option
 */
function bw_update_option( $field, $value=NULL, $options="bw_options" ) {
  $bw_options = get_option( $options );
  $bw_options[ $field ] = $value;
  bw_trace2( $bw_options );
  update_option( $options, $bw_options );
  return( $value );
}


/** Remove an option field from a set
 *
 * @param string $field the option field to be removed
 * @param string $options - the name of the options set
 * @return mixed $value - current values for the options
 *
 */
function bw_delete_option( $field, $options="bw_options" ) {
  $bw_options = get_option( $options );
  unset( $bw_options[ $field ] );
  // bw_trace2( $bw_options );
  update_option( $options, $bw_options );
  return( $options );
}
}
