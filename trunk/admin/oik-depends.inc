<?php

/**
 * Return an associative version of the active plugins array  
*/

function bw_get_all_plugin_names( $active_plugins ) {
  $names = array();
  foreach ( $active_plugins as $key => $value ) {
    $name = basename( $value, '.php' );
    $names[$name] = $value;
  } 
  return( $names ); 

} 


/**
 * Check that the plugins that this plugin is dependent upon are active
 *
 * @param string $plugin - name of the plugin being activated
 * @param string $dependencies - list of plugin dependencies - in whatever order you care
 * Notes: 
 * The list of plugins could include oik - which should be loaded UNLESS this file is being
 * loaded by some other mechanism.
 * $active_plugins is an array that looks like this.
 * bw_plug is able to handle it so we can do the same here
 * EXCEPT bw_plug works at the "top level" not the child plugins
 * (
    [0] => abt-featured-heroes/abt-featured-heroes.php
    [1] => effort/tasks.php
    [2] => fancybox-for-wordpress/fancybox.php
    [3] => oik/oik-bob-bing-wide.php
    [4] => oik/oik-bwtrace.php
    [5] => oik/oik-email-signature.php
    [6] => oik/oik-quicktags.php
    [7] => oik/oik-sc-help.php
    [8] => oik/oik.php
    [9] => types/wpcf.php
)
 */
function oik_lazy_depends( $plugin=null, $dependencies ) {
  $active_plugins = get_option( 'active_plugins' );
  
  bw_trace2( $active_plugins, "active plugins" );
  
  $names = bw_get_all_plugin_names( $active_plugins );
  $depends = explode( ",", $dependencies );
  foreach ( $depends as $depend ) {
    $active = bw_array_get( $names, $depend, null );
    if ( $active ) {
      //
    } else {
      bw_trace2( $depend, "$plugin is dependent upon $depend, which is not active" );
      // We can't trigger errors here as it causes a problem! 
      deactivate_plugins( array( $plugin ) );
    }
  }
  
  
}

