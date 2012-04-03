<?php
/**
Plugin Name: oik quicktags
Description: quicktags for the HTML editor
Version: 1.11
*/

 add_action( "admin_init", "bw_load_admin_scripts" );

if ( is_admin() ) {

 

function bw_load_admin_scripts() {
  //wp_register_script( "oik-quicktags", plugin_dir_url( __FILE__). "oik_quicktags.js", array('quicktags') );  
  //wp_enqueue_script( "oik-quicktags" );
  
  wp_register_script( "oik-quicktags", plugin_dir_url( __FILE__). "bw_shortcodes.js", array('quicktags') );  
  wp_enqueue_script( "oik-quicktags" );


}
}
