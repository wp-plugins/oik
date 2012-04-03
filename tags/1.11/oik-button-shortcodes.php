<?php
/*
-Plugin Name: oik button on TinyMCE
-Plugin URI: http://www.oik-plugins.com/oik
-Description: Add the oik button for inserting call to action buttons 
-Version: 1.11
-Author: bobbingwide
-Author URI: http://www.bobbingwide.com/content/herb-miller

Notes & Limitations: 
  
  
*/

/**
 * This file is loaded during oik_options_init which is called to process admin_init
 * so we can't add processing for this action... just do it
 * Note: We assume that the current user can edit content. 
 * If they can't then the filters won't get called.
 */

add_filter( 'mce_buttons', 'bw_filter_mce_button' );
add_filter( 'mce_external_plugins', 'bw_filter_mce_plugin' );

 
/**
 * Add the bwbutton_button to the array of Tiny MCE buttons
 */       
function bw_filter_mce_button( $buttons ) {
  array_push( $buttons, 'bwbutton_button' );
  return $buttons;
}
 
/**
 * Add the jQuery code to be executed when the bwbutton_button is clicked
 * Note: The _button suffix is not used... not quite sure where the linkage is
 * @see http://codex.wordpress.org/TinyMCE_Custom_Buttons
*/
function bw_filter_mce_plugin($plugins) {
  $plugins['bwbutton'] = plugin_dir_url( __FILE__ ) . 'oik_button_plugin.js';
  return $plugins;
}
        

