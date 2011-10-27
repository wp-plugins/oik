<?php

/*
Plugin Name: oik pages
Plugin URI: http://www.oik-plugins.com/oik
Description: [bw_pages] shortcode to summarize child pages 
Version: 1.5
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2010, 2011 Bobbing Wide (email : herb@bobbingwide.com )

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

require_once( 'bobbfunc.inc' );
require_once( 'bobbingwide.inc' );
/* This include will enable oik shortcodes even if the oik base is not enabled. Is this is good idea? */
require_once( 'oik-add-shortcodes.php' );
/* Include functions to determine level of Artisteer theme whilst Artisteer doesn't provide it */
require_once( 'oik-artisteer.php' );


bw_add_shortcode( 'bw_pages', 'bw_pages' );

/**
 * Extract the excerpt from the $post 
 * Note: The function _theme_get_excerpt is not expected to exist. Artisteer doesn't "properly" extract the excerpt
 * so the '_' prefix disables the call to the Artisteer function
 * 
 */
function bw_excerpt( $post_id ) {
  if ( function_exists( '_theme_get_excerpt' ) ) {
  
    global $post;
    $save_post = $post;
    $post = $post_id;
    $excerpt = theme_get_excerpt();
    $post = $save_post; 
    
  } elseif ( empty( $post_id->excerpt ) ) {
    $content = explode( '<!--more-->', $post_id->post_content); 
    $excerpt = $content[0];
  } else {
    $excerpt = $post_id->excerpt;
  }
  return( $excerpt );
}

/**
 * Return an array suitable for passing to image functions to determine the size
 
 * @param mixed string representing the size.
 * if a single integer then make the array square
 * otherwise it's widthxheight or width,height or some other way of specifying width and height
 * so we split at the non numeric value(s) and take the first two integer bits
 */
function bw_get_image_size( $size=100 ) {
  $pattern = "/([\d]+)/";
  preg_match_all($pattern, $size, $thumbnail);
  if ( count( $thumbnail ) < 2 ) 
    $thumbnail[1] = $thumbnail[0];

  bw_trace( $thumbnail, __FUNCTION__, __LINE__, __FILE__, "thumbnail" );
  return( $thumbnail ); 
}
 
/**
 * get the thumbnail of the specified size
 *
 * Note: There is no code to control the size yet.
 */
function bw_thumbnail( $post_id, $atts=NULL ) {

  $thumbnail = bw_array_get( $atts, 'thumbnail', 'thumbnail' );
  switch ( $thumbnail ) {
    case 'thumbnail':
    case 'medium':
    case 'large':
      $torf = TRUE;
      break;
           
    default:
      $torf = bw_validate_torf( $thumbnail );
      if ( $torf ) {
        $thumbnail = 'thumbnail';
      } else {
        $thumbnail = bw_get_image_size( $thumbnail ); 
      }
      break;
  }
    
  if ( function_exists( 'theme_get_post_thumbnail') ) {
    global $post;
    $save_post = $post;
    $post = $post_id;
    
    $thumbnail = theme_get_post_thumbnail();
    $post = $save_post;
    
  } else {
    $thumbnail = bw_get_thumbnail( $post, $thumbnail );
  } 
   
  return( $thumbnail ); 
  // $thumb = get_the_post_thumbnail( $post->ID,
}

/**
 * Format the "post" - basic first version
 *
 */
function bw_format_post( $post, $atts ) {
  setup_postdata( $post );
  
  bw_trace( $post, __FUNCTION__, __LINE__, __FILE__, "post" );
  
  $atts['title'] = get_the_title( $post->ID );
  $read_more = bw_array_get( $atts, "read_more", "read more" );
  
  $in_block = bw_validate_torf( bw_array_get( $atts, "block", TRUE ));
  if ( $in_block ) { 
    e( bw_block( $atts ));
    e( bw_thumbnail( $post, $atts ) );
  }
  else {
    $class = bw_array_get( $atts, "class", "" );
    sdiv( $class );
    e( bw_thumbnail( $post, $atts ) );
    span( "title" );
    strong( $atts['title'] );
    epan();
    br();
  }  

  e( bw_excerpt( $post ) );
  sp();
  art_button( get_permalink( $post->ID ), $read_more, $read_more ); 
  ep(); 
  if ( $in_block )
    e( bw_eblock() ); 
  else {  
    sediv( "cleared" );
    ediv();  
  }    
}


/**
 * List sub-pages of the current or selected page 
 *
 * This function is designed to replace the functionality of [bw_plug name='extended-page-lists'] and other plugins that list pages
 * It works in conjunction with Artisteer blocks - to enable the page list to be styled as a series of blocks
 * Well, that's the plan
 * [bw_pages class="classes for bw_block" 
 *   post_type='page'
 *   post_parent 
 *   orderby='title'
 *   order='ASC'
 *   posts_per_page=-1
 *   block=true or false
 *   thumbnail=specification - see bw_thumbnail
 */
function bw_pages( $atts = NULL ) {
  
  // $block_atts = array( "class"=> $class, );
  
  // Copy the atts from the shortcode to create the array for the query
  // removing the class and title parameter that gets passed to bw_block()
  
  $attr = $atts;
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  bw_trace( $attr, __FUNCTION__, __LINE__, __FILE__, "attr" );
  
  //unset( $attr['class'] );
  //unset( $attr['title'] );
  
  /* Set default values if not already set */
  
  $attr['post_type'] = bw_array_get( $attr, 'post_type', 'page' );
  if ( $attr['post_type'] == 'page' )
    $attr['post_parent'] = bw_array_get( $attr, "post_parent", $GLOBALS['post']->ID );
  $attr['numberposts'] = bw_array_get( $attr, "numberposts", -1 );
  $attr['orderby'] = bw_array_get( $attr, "orderby", "title" );
  $attr['order'] = bw_array_get( $attr, "order", "ASC" );
  $attr['category'] = bw_array_get( $attr, "category", NULL );
  $attr['exclude'] = bw_array_get( $attr, "exclude", $GLOBALS['post']->ID );
  $posts = get_posts( $attr );
  bw_trace( $posts, __FUNCTION__, __LINE__, __FILE__, "posts" );
  
  foreach ( $posts as $post ) {
    bw_format_post( $post, $atts );
    //p( "this is a post" );
    //e( $post->ID );
  }
  
  return( bw_ret() );
}  
  

/** 
 * get the post thumbnail 
 */
 
function bw_get_thumbnail( $post_id = null, $size = 'thumbnail' ) {
 

  /* Return Value: An array containing:
       $image[0] => attachment id
       $image[1] => url
       $image[2] => width
       $image[3] => height
  */
  $return_value = FALSE;
  if ($post_id == Null) 
    $post_id = get_the_id();
  
  bw_trace( $post_id, __FUNCTION__, __LINE__, __FILE__, "post_id" );
  
  If ( function_exists('get_post_thumbnail_id') && $thumb_id = get_post_thumbnail_id( $post_id ) ) {
    $return_value = array_merge( array( $thumb_id ), (array) wp_get_attachment_image_src( $thumb_id, $size ) );
  }  
  elseif ( $arr_thumb = bw_get_attached_image( $post_id, 1, 'rand', $size )) {
    $return_value = $arr_thumb[0];
  }  
  bw_trace( $return_value, __FUNCTION__, __LINE__, __FILE__, "return_value" ); 
  
}

/**
 * get the attached image
 */
function bw_get_attached_image( $post_id = null, $number = 1, $orderby = 'rand', $image_size = 'thumbnail') {

  bw_trace( $post_id, __FUNCTION__, __LINE__, __FILE__, "post_id" ); 

  If ($post_id == Null) $post_id = get_the_id();
  $number = IntVal ($number);
  $arr_attachment = get_posts (Array( 'post_parent'    => $post_id,
                                      'post_type'      => 'attachment',
                                      'numberposts'    => $number,
                                      'post_mime_type' => 'image',
                                      'orderby'        => $orderby ));
  
  // Check if there are attachments
  If (Empty($arr_attachment)) return False;
  
  // Convert the attachment objects to urls
  ForEach ($arr_attachment AS $index => $attachment){
    $arr_attachment[$index] = Array_Merge ( Array($attachment->ID), (Array) wp_get_attachment_image_src($attachment->ID, $image_size));
    /* Return Value: An array containing:
         $image[0] => attachment id
         $image[1] => url
         $image[2] => width
         $image[3] => height
    */
  }
  
  bw_trace( $arr_attachment, __FUNCTION__, __LINE__, __FILE__, "arr_attachment" );
  
  return $arr_attachment;
}
