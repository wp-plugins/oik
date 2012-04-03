<?php
/*
This file implements the class to create the oik ShortCodes button for tiny MCE
This button allows oik users to choose what they want included from any shortcode that 
is currently active, including the PayPal and oik button shortcodes.
  
*/
add_filter( 'mce_buttons', 'bw_shortc_filter_mce_button' );
add_filter( 'mce_external_plugins', 'bw_shortc_filter_mce_plugin' );

//bw_button_options();


	
function bw_shortc_filter_mce_button( $buttons ) {
  array_push( $buttons, 'bwshortc_button' );
  return $buttons;
}
	
function bw_shortc_filter_mce_plugin( $plugins ) {
  $plugins['bwshortc'] = plugin_dir_url( __FILE__ ) . 'oik_shortc_plugin.js';
  return $plugins;
}

function bw_button_options() {
  wp_enqueue_script( 'bw_shortcodes', 'bw_shortcodes.js' );

  // $data = array( 'some_string' => __( 'Some string to translate' ) );
  oik_require( "shortcodes/oik-codes.php" );
  $data = bw_shortcode_list();
  wp_localize_script( 'bw_shortcodes', 'bw_shortcodes', $data ); 
}  
