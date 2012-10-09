<?php
if ( defined( 'OIK_BLOCKS_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_BLOCKS_SHORTCODES_INCLUDED', true );
/*

    Copyright 2010-2012 Bobbing Wide (email : herb@bobbingwide.com )

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

/**
 * Return $new_version if the $array variable $index is defined else $art_version
 */
function bw_art_level( $art_version, $array = array(), $index, $new_version ) {
  if ( isset( $array[$index] ) || ( is_array( $array) && array_key_exists( $index, $array ) ) )  {
    $version = $new_version;
  } else {
    $version = $art_version;
  } 
  // bw_trace( $version, __FUNCTION__,  __LINE__, __FILE__, "version" ); 
  return( $version );
}    

/**
 * Detect Artisteer version, if applicable
 *  
 * Detect if an Artisteer theme is in use, and if so, what version to use for [bw_block]
 * Case: 69753 http://www.artisteer.com/?p=support_c&e=C02yqRkbEMNE-KVHmylmVlfjS2U28Q7oa
 *
 *  art_version version     array[index] to check for 
 *  ----------- ----------- ------------------------------------------------
 *  31          3.1         theme_default_options[ theme_posts_headline_tag] 
 *  30          3.0         theme_default_options[ theme_show_headline ]
 *  25          2.5.0.31067 art_config[ theme  ]
 *  na          none        n/a
 *
 * If the oik base plugin is activated we look at the value set for art-version.
 * Store art-version as 'na' when it's not applicable ( not Artisteer)  - the value is returned as FALSE at runtime
 * so that the correct code for [bw_block] expansion is used.
 *
 * Notes:
 * - The value for art-version does not get updated automatically when a theme is updated.
 * - So if a theme is changed the user may have to change this manually
 * - If the value is set in art-version then we don't bother performing run-time checking
 * - we start with the most recent version of Artisteer first
 * - This function cannot be called when the shortcode is registered since we don't yet know anything about the theme.
 * - So we use lazy evaluation.
*/ 
function bw_artisteer_version() {
  global $theme_default_options, $art_config;
  // bw_trace( $theme_default_options, __FUNCTION__,  __LINE__, __FILE__, "theme_default_options" );  
  $art_version = FALSE;
  
  $art_version = bw_get_option( 'art-version' );
  
  if ( $art_version == FALSE )
    $art_version = bw_art_level( $art_version, $theme_default_options, 'theme_posts_headline_tag', '31' );
    
  if ( $art_version == FALSE )
    $art_version = bw_art_level( $art_version, $theme_default_options, 'theme_show_headline', '30' );
    
  if ( $art_version == FALSE )
    $art_version = bw_art_level( $art_version, $art_config, 'theme', '25' );
  
  if ( $art_version == 'na' )
    $art_version = FALSE;
    
  bw_trace( $art_version, __FUNCTION__,  __LINE__, __FILE__, "art_version" );  
  return $art_version;
}  

function bw_block_func( $shortcode ) {
  if ( function_exists( 'bw_artisteer_version' ) ) {
    $art_version = bw_artisteer_version();
  } else {
    $art_version = FALSE; 
  }
  if ( $art_version == FALSE ) {
    oik_require( "bw_block.inc" );
  } else {
    oik_require( "bw_block_" . $art_version. ".inc" );
  }
  return $shortcode . '_' . $art_version;
}  

function bw_block( $atts=NULL ) {
  $func = bw_block_func( "bw_block" );
  return( $func( $atts ) );
}

function bw_eblock( $atts=NULL ) {
  $func = bw_block_func( "bw_eblock" );
  return( $func( $atts ) );
}


function bw_block__syntax( $shortcode="bw_block" ) {
  $syntax = array( "title" => bw_skv( "", "<i>title</i>", "block title" )
                 , "level" => bw_skv( "h3", "<i>tag</i>", "HTML tag for heading" )
                 , "framed" => bw_skv( "true", "false|Y|N", "Use Artisteer styled frame" )
                 , "class" => bw_skv( "", "<i>CSS classes</i>", "CSS classes for block" )
                 , "prefix" => bw_skv( "art-", "", "CSS class prefix" )
                 );
  return( $syntax );
}

