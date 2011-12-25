<?php
/*
This file implements the class to create the oik ShortCodes button for tiny MCE
This button allows oik users to choose what they want included from the [bw_shortcode] range of oik shortcodes

Notes & Limitations: 
  
  
*/

if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );
require_once( "bobbfunc.inc" ); 

class BWShortc
{
	function __construct() {
		// add_action('admin_menu', array($this, 'bw_button_create_menu'));
		add_action('admin_init', array($this, 'bw_button_admin_init'));
		add_shortcode('bw_button', array($this, 'bw_button_shortcodes'));
	}
	
	function bw_button_admin_init() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'filter_mce_button'));
			add_filter('mce_external_plugins', array($this, 'filter_mce_plugin'));
		}
	}
	
	function filter_mce_button($buttons) {
		array_push($buttons, '|', 'bwshortc_button' );
		return $buttons;
	}
	
	function filter_mce_plugin($plugins) {
		$plugins['bwshortc'] = plugin_dir_url( __FILE__ ) . 'oik_shortc_plugin.js';
		return $plugins;
	}
        

} // end of class; 

$bwshortc = new BWShortc();

?>
