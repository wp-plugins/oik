<?php
/*
Plugin Name: oik base plugin 
Plugin URI: http://www.oik-plugins.com/oik
Description: Lazy smart shortcodes for displaying often included key-information and other WordPress content
Version: 2.0-alpha.0322
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2010-2013 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/
require_once( "oik_boot.inc" );

/* All of the oik plugins and many of the common functions include calls to bw_trace(), bw_trace2() or bw_backtrace() so we need to include bwtrace.inc
*/   
  require_once( 'bwtrace.inc' );
  require_once( "bobbfunc.inc" );
  require_once( "bobbcomp.inc" );

/**
 * Return the oik_version
 * 
 * @returns string oik base plugin version number - from the WordPress plugin template
 */  
function oik_version() {
  return bw_oik_version();
}


  require_once( "oik-add-shortcodes.php" );

  add_filter('widget_text', 'do_shortcode');
  add_filter('the_title', 'do_shortcode' ); 
  //add_filter('wpbody-content', 'do_shortcode' );
  add_filter('wp_footer', 'do_shortcode' );

  add_filter('get_the_excerpt', 'do_shortcode' );
  add_filter('the_excerpt', 'do_shortcode' );
  // The big question is... do we need to add this filter 
  // or can we rely on it having been already added
  // Well it all depends on how add_filter works **?**
  // add_filter('the_content', 'do_shortcode', 11 );
  //add_filter('get_pages', 'do_shortcode' );

  //$bw_options = get_option( 'bw_options' );

  //add_action('wp_print_styles', 'oik_enqueue_stylesheets');
  add_action('wp_enqueue_scripts', 'oik_enqueue_stylesheets');
  add_action('init', 'oik_main_init' );
  
  add_action( 'wp_ajax_oik_ajax_list_shortcodes', 'oik_ajax_list_shortcodes' );
  add_action( 'wp_ajax_oik_ajax_load_shortcode_syntax', 'oik_ajax_load_shortcode_syntax' );
  add_action( 'wp_ajax_oik_ajax_load_shortcode_help', 'oik_ajax_load_shortcode_help' );
  //add_action( 'admin_enqueue_scripts', 'bw_button_options' );
  

  add_filter( "attachment_fields_to_edit", "oik_attachment_fields_to_edit", null, 2 ); 
  add_filter( "attachment_fields_to_save", "oik_attachment_fields_to_save", null, 2 );
  
  

/** 
 * Implement 'wp_enqueue_scripts' action enqueue the oik.css and $customCSS stylesheets as required
 *
 * oik.css contains styles for oik shortcodes. It is embedded if not specifically excluded.
 * $customCSS is embedded only if selected on oik options
 * If you want some of oik.css then copy the contents into custom.css and exclude oik.css
 *
 * Note: bwlink.css contains styles for the bobbingwide and oik branding colours
 * It is now only enqueued by the oik-bob-bing-wide plugin
 * 
 */
function oik_enqueue_stylesheets() {
  $oikCSS = bw_get_option( 'oikCSS' );
  // bw_trace2( $oikCSS, "oikCSS" );
  if ( !$oikCSS ) {
    wp_enqueue_style( 'oikCSS', WP_PLUGIN_URL . '/oik/oik.css' ); 
  }
  $customCSS =  bw_get_option( 'customCSS' );
  if ( !empty( $customCSS) ) {
    $customCSSurl = get_stylesheet_directory_uri() . '/' .  $customCSS;
    // bw_trace( $customCSSurl, __FUNCTION__, __LINE__, __FILE__, "customCSSurl");
    wp_register_style( 'customCSS', $customCSSurl );
    wp_enqueue_style( 'customCSS' );
  }
} 

/** 
 * Implement the 'init' action
 * 
 * start oik and let oik dependent plugins know it's OK to use the oik API
*/
function oik_main_init() {
  add_action( 'admin_menu', 'oik_admin_menu' );
  add_action( "activate_plugin", "oik_load_plugins" );
  add_action( 'network_admin_menu', "oik_network_admin_menu" );
  add_action( "network_admin_notices", "oik_network_admin_menu" );
  bw_load_plugin_textdomain();
  do_action( 'oik_loaded' );
}

/**
 * Implement the 'admin_menu' action
 *
 * Note: This comes before 'admin_init' and after '_admin_menu'
 *
*/ 
function oik_admin_menu() {
  require_once( 'admin/oik-admin.inc' );
  oik_options_add_page();
  add_action('admin_init', 'oik_admin_init' );
  do_action( 'oik_admin_menu' );
}

/** 
 * Implement the 'network_admin_menu'/'network_admin_notices' action for multisite
 * 
 * network_admin_menu is used to determine if plugins need updating
 * network_admin_notices is used in plugin dependency checking
 */
function oik_network_admin_menu() {
  static $actioned = null;
  if ( !$actioned ) { 
    $actioned = current_filter();
    require_once( 'admin/oik-admin.inc' );
    oik_options_add_page();
    add_action('admin_init', 'oik_admin_init' );
    do_action( 'oik_admin_menu' );
  } else {
    bw_trace2( $actioned, "actioned" );
  }   
}
 

/**
 * Implement 'admin_init'
*/
function oik_admin_init() {
  oik_options_init();
}

function oik_ajax_list_shortcodes() {
  oik_require( 'shortcodes/oik-codes.php' );
  $sc_list = bw_shortcode_list();
  $sc_json = json_encode( $sc_list );   
  bw_trace2( $sc_json );
  echo $sc_json;
  die(); 
}

function oik_ajax_load_shortcode_syntax() {
  oik_require( "includes/oik-sc-help.inc" );
  $shortcode = bw_array_get( $_REQUEST, 'shortcode', 'oik' );
  $sc_syntax = _bw_lazy_sc_syntax( $shortcode );
  $sc_json = json_encode( $sc_syntax );   
  bw_trace2( $sc_json, "sc_json" );
  echo $sc_json;
  die();
}

function oik_ajax_load_shortcode_help() {
  oik_require( "includes/oik-sc-help.inc" );
  $shortcode = bw_array_get( $_REQUEST, 'shortcode', 'oik' );
  bw_trace2( $shortcode, "shortcode" );
  $sc_help = bw_lazy_sc_example( $shortcode );
  bw_trace2( $sc_help, "sc_help" );
  echo $sc_help;
  bw_flush();
  die();
}


/**
 * Add the custom image link using the same method as the Portfolio slideshow plugin which used the method documented here:
 * @link http://wpengineer.com/2076/add-custom-field-attachment-in-wordpress/
 *
 * This is the method that adds fields to the form. Paired with 'attachment_fields_to_save'
 */
function oik_attachment_fields_to_edit( $form_fields, $post) { 
  bw_trace2( $form_fields ); 
//  gobang();
  $form_fields['bw_image_link'] = array(  
			"label" => __( "oik custom image link URL" ),  
			"input" => "text",
			"value" => get_post_meta( $post->ID, "_bw_image_link", true )  
		); 
  // This doesn't work since the url uses the [html] field instead of [value]
  // $form_fields['url']['value'] = get_post_meta( $post->ID, "_oik_nivo_image_link", true );   
  return $form_fields;  
}

/**
 * Save the "oik custom image link URL"
 * We save the value even if it's blanked out.
 * Note: The custom meta field is prefixed with an underscore but the field name is not.
 * Paired with 'attachment_fields_to_edit'
 */ 
function oik_attachment_fields_to_save( $post, $attachment) { 
  bw_trace2();
  //gobang();   
  $link = bw_array_get( $attachment, "bw_image_link", null ) ;
  //$link = bw_array_get( $attachment, "url", null ) ;

  update_post_meta( $post['ID'], '_bw_image_link', $link );  
  return $post;  
}
        






