<?php
/*
Plugin Name: oik [bw_button] shortcodes
Plugin URI: http://www.oik-plugins.com/oik
Description: [oik] button shortcodes - Call to action style buttons for Artisteer themes
Version: 1.5
Author: bobbingwide
Author URI: http://www.bobbingwide.com/content/herb-miller

Notes & Limitations: 
  
  
*/

if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );
require_once( "bobbfunc.inc" );        

class BWButton
{
	function __construct() {
		// add_action('admin_menu', array($this, 'bw_button_create_menu'));
		add_action('admin_init', array($this, 'bw_button_admin_init'));
		add_shortcode('bw_button', array($this, 'bw_button_shortcodes'));
                add_shortcode('bw_contact_button', array($this, 'bw_contact_button'));

	}
	
	function bw_button_admin_init() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'filter_mce_button'));
			add_filter('mce_external_plugins', array($this, 'filter_mce_plugin'));
		}
	}
	
	function filter_mce_button($buttons) {
		array_push($buttons, '|', 'bwbutton_button' );
		return $buttons;
	}
	
	function filter_mce_plugin($plugins) {
		$plugins['bwbutton'] = plugin_dir_url( __FILE__ ) . 'oik_button_plugin.js';
		return $plugins;
	}
        
/*  [bw_button link="" text="" title="" class="" ]
  bw_button_shortcodes calls art_button 
  art_button includes redundant classes for Artisteer 2.x and 3
  
*/




function bw_button_shortcodes($atts) {
  $link = $atts['link'];
  $text = $atts['text'];
  $title = $atts['title']; 
  $class = $atts['class'];
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  art_button( $link, $text, $title, $class ); 
  return( bw_ret());  
}

/* Create a Contact me button
   
  Create a contact me button which links to the contact form page.
  Parameters are:
    [bw_contact_button link='URL' text='button text' title='button tooltip text']
  
  Defaults:
  Field      option field used    hardcoded default
  link       bw_contact_link      /contact/
  text       bw_contact_text      Contact
  title      bw_contact_title     Contact $contact
  
  
*/  
function bw_contact_button( $atts ) {
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  $contact = bw_default_empty_att( NULL, "contact", "me" );
  

  $link = bw_default_empty_arr( $atts, 'link', "contact-link", "/contact/" ); 
  
  bw_trace( $link, __FUNCTION__, __LINE__, __FILE__, "link" );
  $text = bw_default_empty_arr( $atts, 'text', "contact-text", "Contact" );
  $title = bw_default_empty_arr( $atts, 'title', "contact-title", "Contact " . $contact);
   
  $class = bw_array_get( $atts, 'class', NULL ) . "contact" ;
  art_button( $link, $text, $title, $class ); 
  
  return( bw_ret());  
}

} // end of class; 

$bwbutton = new BWbutton();

