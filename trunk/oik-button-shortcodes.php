<?php
/*
Plugin Name: oik [bw_button] shortcodes
Plugin URI: http://www.bobbingwidewebdesign.com/2011/01/28/oik-button-shortcodes-plugin
Description: [oik] button shortcode - Call to action style buttons for Artisteer themes
Author: Herb Miller
Version: 0.1
Author URI: http://www.bobbingwide.com/content/herb-miller

Notes & Limitations: tbc
  
  
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


function art_button( $linkurl, $text, $title=NULL, $class=NULL  )
{
  sp();
  span("art-button-wrapper" );
  sepan("art-button-l l");
  sepan("art-button-r r");
  //alink( "art-button", "contact-us.php", "Contact " .bw_get_company( "company" ) . "  now" ) ;
  //$linkurl = bw_expand_link( $linkurl );
  alink( "button art-button " . $class , $linkurl, $text, $title ) ;
  epan();
  ep();
}


function bw_button_shortcodes($atts) {
  $link = $atts['link'];
  $text = $atts['text'];
  $title = $atts['title']; 
  $class = $atts['class'];
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  art_button( $link, $text, $title, $class ); 

  return( bw_ret());  
}

} // end of class; 

$bwbutton = new BWbutton();

?>