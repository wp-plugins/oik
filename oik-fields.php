<?php
if ( defined( 'OIK_FIELDS_INCLUDED' ) ) return;
define( 'OIK_FIELDS_INCLUDED', true );

/*
Plugin Name: oik fields
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-fields
Description:  Field formatting for custom post type meta data using [bw_field] or [bw_fields] shortcodes
Version: 1.17
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2011,2012 Bobbing Wide (email : herb@bobbingwide.com )

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

add_action( "oik_loaded", "oik_fields_init" );

function oik_fields_init() {
  oik_require( "includes/bw_register.inc" );
  oik_require( "bw_metadata.inc" );
  bw_add_shortcode( 'bw_field', 'bw_metadata' );
  bw_add_shortcode( 'bw_fields', 'bw_metadata' );
  // bw_add_shortcode( 'bw_metadata', 'bw_metadata' );
  // bw_add_shortcode( 'bw_table', 'bw_table' );
  //bw_add_shortcode( "bw_meta", "bw_meta" );
  do_action( 'oik_fields_loaded' );
}


/**
 * Theme an array of custom fields
 * 
 * @param array $customfield - array of custom fields
 *
*/
function bw_format_field( $customfield ) {
  bw_trace2();
  foreach ( $customfield as $key => $value ) {
    bw_theme_field( $key, $value );
  }
}

/**
 * format the meta data for the 'post'
 */
function bw_format_meta( $customfields ) {
  bw_trace2();
  foreach  ( $customfields as $key => $customfield ) {
    $cf = array( $key => $customfield[0] );
    bw_format_field( $cf );
  }  
} 

/**
 * Wrapper to get_post_meta
 */
function bw_metadata( $atts = NULL ) {
  $post_id = bw_array_get( $atts, "id", get_the_id());

  $name = bw_array_get( $atts, "name", NULL );
  if ( NULL == $name ) {
    // the_meta();
    $customfields = get_post_custom( $post_id );
    bw_format_meta( $customfields );
  }
  else {
    $name = wp_strip_all_tags( $name, TRUE );
    $names = explode( ",", $name );
    
    foreach ( $names as $name ) {
      $post_meta = get_post_meta( $post_id, $name, FALSE );
      bw_trace2( $post_meta );
      $customfields = array( $name => $post_meta ); 
      bw_format_meta( $customfields );
    }
  }  
  
  return( bw_ret() );

}

/**
 * Theme a custom field  
 * 
 * @param string $key - field name e.g. _txn_amount
 * @param mixed $value - post metadata value
 * @param array $field - the field structure if defined using bw_register_field()
 *
 * 
 * 
 */
function bw_theme_field( $key, $value, $field=null ) {
  bw_trace2();
  $type = bw_array_get( $field, "#field_type", null );
  // Try for a theming function named "bw_theme_field_$type_$key 
  
  $funcname = bw_funcname( "bw_theme_field_${type}", $key );
  // If there isn't a generic one for the type 
  // nor a specific one just try for the field
  
  if ( $funcname == "bw_theme_field_" && $type ) { 
    $funcname = bw_funcname( "bw_theme_field_", $key );
  }  
  bw_trace2( $funcname, "funcname chosen", false );
  
  if ( is_callable( $funcname ) ) {
    call_user_func( $funcname,  $key, $value, $field );
  } else {
    _bw_theme_field_default( $key, $value, $field );
  }
} 

function bw_theme_field__post_title( $key, $value, $field ) {
  bw_theme_field__title( $key, $value, $field );
}  

function bw_theme_field__title( $key, $value, $field ) {
  $post = bw_array_get( $field, "post", null );
  if ( $post ) { 
    $link = get_permalink( $post->ID );
    alink( "title", $link, $value );
  }
}
 
function bw_theme_field__excerpt( $key, $value, $field ) {
  sepan( $key, $value );
} 


/** 
 *   Default theming of metadata based on field name ( $key )
 *   or content? ( $value )
 */   

function _bw_theme_field_default( $key, $value ) {

  $funcname = "_bw_theme_field_default_" . $key;
  if ( function_exists( $funcname ) ) {
    $funcname( $key, $value );
  } else {
    // this could be a function called _bw_theme_field_default__unknown_key
    span( "metadata $key" );
    span( $key ); 
    e( $key );
    epan( $key );
    span( "value" );
    e( $value );
    epan( "value" ); 
    epan( "metadata $key" );
  }  
}

/** 
 * Default function to display a field of name "bw_header_image"
 * 
 * A 'bw_header image' field contains the full file name of the image to be used as the header image
 * It's not exactly related to "custom header image" but could be.
 */
function _bw_theme_field_default_bw_header_image( $key, $value ) {
  image( $key, $value );
} 

/**
 * Template tag to return the header image for a specific page
 *
 *
 * If none is specified then it doesn't return anything
 * so should we then call custom_header logic?
 */
if ( !(function_exists( "bw_header_image" ))) {
 
  function bw_header_image() {
    return( bw_metadata( array( "name" => "bw_header_image" )));
  } 
}

/** 
 * Format a custom column on admin pages 
 * implements "manage_${post_type}_posts_custom_column" action for oik/bw custom post types
 */
if ( !function_exists( "bw_custom_column" ) ) {


function bw_custom_column_admin( $column, $post_id ) {
  bw_custom_column( $column, $post_id );
  bw_flush();
}  


function bw_custom_column( $column, $post_id ) {
  $data = get_post_meta( $post_id, $column );
  bw_format_custom_column( $column, $data );
  
  //bw_theme_field( $column, $data[0] ); 
  //bw_flush();  
  
}  
}






/**
 * Note: money_format does not work in Windows
 *
*/
function bw_theme_field_currency( $key, $value ) {
  if ( count( $value ) )
    e( sprintf( "%.2f", $value[0] ));
}


function bw_theme_field_numeric( $key, $value ) {
  if ( count( $value ) )
    e( $value[0] );
}

function bw_theme_field_date( $key, $value ) {
  if ( count( $value ) )
    e( bw_format_date( $value[0] ) );
}


function bw_theme_field_select( $key, $value, $field ) {
  e( bw_return_field_select( $key, $value, $field ) );
}

function bw_return_field_select( $key, $value, $field ) {
  bw_trace2();
  $args = bw_array_get( $field, '#args', null );
  if ( $args ) {
    $select = bw_array_get( $args, '#options', null );
  } 
  $val = bw_array_get( $value, 0, $value );
  if ( null != $val ) { 
    $result = bw_array_get( $select, $val, $val );   
  } else {
    $result = $value;
  }  
  
  return( $result );  
}

function bw_theme_field_noderef( $key, $value ) {
 $v0 = bw_array_get( $value, 0, $value );
 e( get_the_title( $v0 ));
}

function bw_theme_field_URL( $key, $value ) {
  $link = retlink( null, $value[0], $value[0] );
  e( $link );
   
}

function bw_theme_field_text( $key, $value ) {
  if ( count( $value ) )
    e( $value[0] );
}


/** 
 * format a custom column on the admin page IF the column is defined in bw_fields
 *
 * @param string $column - the column name - e.g. _pp_url
 * @param string $data - the column's data value e.g. http://www.oik-plugins.com/oik-plugins/oik-fields
 * 
 (
    [0] => _cookie_category
    [1] => Array
        (
            [0] => 1
        )

    [2] => Array
        (
            [#field_type] => select
            [#title] => Cookie category
            [#args] => Array
                (
                    [#options] => Array
                        (
                            [0] => None
                            [1] => Strictly necessary
                            [2] => Performance
                            [3] => Functionality
                            [4] => Targeting/Advertising
                        )

                )

        )

)
*/
function bw_format_custom_column( $column=null, $data=null ) {
  global $bw_fields; 
  $field = bw_array_get( $bw_fields, $column, null );
  if ( $field ) {
    bw_theme_field( $column, $data, $field );
  }  
  //bw_flush();  
}     


/**
 * Simple wrapper to the_meta() for displaying the meta data 
 * The best way of displaying this would be to put it into a text widget
 * then it would work regardless of the content being displayed
 *
 */
function bw_meta( $atts = null ) {
  the_meta();
  return;  
}

add_action( "oik_admin_menu", "oik_fields_admin_menu" );

/**
 * Relocate the plugin to become its own plugin and set the plugin server
 */
function oik_fields_admin_menu() {
  oik_register_plugin_server( __FILE__ );
  bw_add_relocation( 'oik/oik-fields.php', 'oik-fields/oik-fields.php' );
}
