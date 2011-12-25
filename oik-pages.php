<?php

/*
Plugin Name: oik pages
Plugin URI: http://www.oik-plugins.com/oik
Description: [bw_pages], [bw_list] and [bw_bookmarks] shortcodes to summarize child pages or custom post types
Version: 1.9
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2011 Bobbing Wide (email : herb@bobbingwide.com )

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
bw_add_shortcode( 'bw_list', 'bw_list' );
bw_add_shortcode( 'bw_bookmarks', 'bw_bookmarks' );


/**
 * Return the excerpt from the $post 
 * Note: The function _theme_get_excerpt is not expected to exist. 
 * Artisteer doesn't "properly" extract the excerpt, so the '_' prefix disables the call to the Artisteer function.
 * 
 * @param  post $post_id post from which to extract the excerpt
 * @return string $excerpt the excerpt from the post
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
 * 
 * @param mixed $size string representing the size.
 * if a single integer then make the array square
 * otherwise it's widthxheight or width,height or some other way of specifying width and height
 * so we split at the non numeric value(s) and take the first two integer bits
 * @return array containing width and height
 */
function bw_get_image_size( $size=100 ) {
  $pattern = "/([\d]+)/";
  preg_match_all( $pattern, $size, $thumbnail );
  // bw_trace2( $thumbnail );
  if ( count( $thumbnail[0] ) < 2 ) 
    $thumbnail[0][1] = $thumbnail[0][0];
    
  $size = array( $thumbnail[0][0], $thumbnail[0][1] );  

  // bw_trace( $size, __FUNCTION__, __LINE__, __FILE__, "size" );
  return( $size ); 
}

 
/**
 * Get the thumbnail of the specified size
 *
 */
function bw_thumbnail( $post_id, $atts=NULL ) {
  bw_trace( $post_id, __FUNCTION__, __LINE__, __FILE__, "post_id" );

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
  
  /* Cater for Artisteer themes that already return thumbnails.
     Well we would... but Artisteer only supports the current post
     so we would end up getting the same thumbnail for each post.
  */
    
  if ( function_exists( '_theme_get_post_thumbnail') ) {
    global $post;
    $save_post = $post;
    $post = $post_id;
    
    $thumbnail = theme_get_post_thumbnail();
    $post = $save_post;
    
  } else {
    $thumbnail = bw_get_thumbnail( $post_id, $thumbnail, $atts );
  } 
  return( $thumbnail ); 
}

/** 
 * Create a thumbnail link
 *
 * Create a thumbnail with a link to the post_id specified, either via $post_id or the $atts['link']
 * otherwise just create the image 
 *
 * @param string $thumbnail full HTML for the thumbnail image
 * @param id     $post_id   default post id if not specified in $atts
 * @param array  $atts      shortcode attributes array
 */
function bw_link_thumbnail( $thumbnail, $post_id=NULL, $atts=NULL )  {
  $link_id = bw_array_get( $atts, "link", $post_id );
  if ( $link_id ) {
    $text = bw_array_get( $atts, "title", NULL );
    alink( NULL, get_permalink( $link_id ), $thumbnail, $text, "link-".$link_id );  
  } else {
    e( $thumbnail );
  }
}

/**
 * Format the "post" - basic first version
 *
 * Format the 'post' in a block or div with title, image with link, excerpt and read more button
 *
 * @param object $post - A post object
 * @param array $atts - Attributes array - passed from the shortcode
 * 
 *
 */
function bw_format_post( $post, $atts ) {
  setup_postdata( $post );
  
  bw_trace( $post, __FUNCTION__, __LINE__, __FILE__, "post" );
  
  $atts['title'] = get_the_title( $post->ID );
  $read_more = bw_array_get( $atts, "read_more", "read more" );
  $thumbnail = bw_thumbnail( $post->ID, $atts );
  
  $in_block = bw_validate_torf( bw_array_get( $atts, "block", TRUE ));
  if ( $in_block ) { 
    e( bw_block( $atts ));
    sdiv( "avatar alignleft" );
    bw_link_thumbnail( $thumbnail, $post->ID, $atts );
    ediv();
  } else {
    $class = bw_array_get( $atts, "class", "" );
    sdiv( $class );
    sdiv( "avatar alignleft" );
    bw_link_thumbnail( $thumbnail, $post->ID, $atts );
    ediv();
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
 * Format the "post" - in a simple list item list
 */
function bw_format_list( $post, $atts ) {
  setup_postdata( $post );
  
  // bw_trace( $post, __FUNCTION__, __LINE__, __FILE__, "post" );
  $title = get_the_title( $post->ID );
  stag( 'li' );
  alink( NULL, get_permalink( $post->ID ), $title );
  etag( 'li' );
  
}


/**
 * List sub-pages of the current or selected page 
 *
 * This function is designed to replace the functionality of the [bw_plug name='extended-page-lists'] plugin and other plugins that list pages.
 * It works in conjunction with Artisteer blocks - to enable the page list to be styled as a series of blocks
 * Well, that's the plan
 *
 * [bw_pages class="classes for bw_block" 
 *   post_type='page'
 *   post_parent 
 *   orderby='title'
 *   order='ASC'
 *   posts_per_page=-1
 *   block=true or false
 *   thumbnail=specification - see bw_thumbnail
 *   customcategoryname=custom category value  
 */
function bw_pages( $atts = NULL ) {
  $posts = bw_get_posts( $atts );
  bw_trace( $posts, __FUNCTION__, __LINE__, __FILE__, "posts" );
  
  foreach ( $posts as $post ) {
    bw_format_post( $post, $atts );
  }
  
  return( bw_ret() );
} 

/**
 * Force the thumbnail size to be what we asked for
 * 
 * wp_attachment_get_image_src() can sometimes attempt to return a $thumbnail where the
 * width and height don't match what we asked for.
 * 
 * The values of $thumbnail[1] and $thumbnail[2] are used to set the width and height values on the <img> tag
 * We choose to reset these to the values first thought of. 
 * 
 * Note: The side effect of this is that the images get reshaped rather than being cropped.
 * It's up to the web designer to set the sizes for thumbnail, small, medium and large
 * and/or upload images that will scale nicely for the chosen figures. 
 */
function bw_force_size( $thumbnail, $size ) {
  if ( is_array( $size ) ) {
  
    $thumbnail[1] = $size[0];
    $thumbnail[2] = $size[1];
  }  
  return( $thumbnail );
}
  

/** 
 * get the post thumbnail 
 * Returns the HTML for the thumbnail image which can then be wrapped in a link if required
 * @param integer $post_id - the id of the content for which the thumbnail is required
 *                defaults to the current post id
 * @param mixed  $size - the required image size: either a preset or specified in an array
 * @atts  array  array of key value pairs that may be needed
 * 
 *  Return Value: An array containing:
 *    $image[0] => url
 *    $image[1] => width
 *    $image[2] => height
 *
 */
function bw_get_thumbnail( $post_id = null, $size = 'thumbnail', $atts=NULL ) {
  $return_value = FALSE;
  if ($post_id == null) 
    $post_id = get_the_id();
  
  bw_trace( $post_id, __FUNCTION__, __LINE__, __FILE__, "post_id" );
  
  if ( has_post_thumbnail( $post_id ) ) {
    //bw_trace( $size, __FUNCTION__, __LINE__, __FILE__, "size" );
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
  }
  elseif ( function_exists('get_post_thumbnail_id') && $thumb_id = get_post_thumbnail_id( $post_id ) ) {
    // bw_trace( $thumb_id, __FUNCTION__, __LINE__, __FILE__, "thumb_id" );
    $thumbnail =  wp_get_attachment_image_src( $thumb_id, $size ) ;
  }  
  elseif ( $arr_thumb = bw_get_attached_image( $post_id, 1, 'rand', $size )) {
    //bw_trace( $arr_thumb, __FUNCTION__, __LINE__, __FILE__, "arr_thumb" );
    $thumbnail = $arr_thumb[0];
  } 
  // bw_trace( $thumbnail, __FUNCTION__, __LINE__, __FILE__, "thumbnail" ); 
  if ( $thumbnail[0] ) {
    $text = bw_array_get( $atts, "title", NULL );
    $thumbnail = bw_force_size( $thumbnail, $size );
    
    $return_value = retimage( "bw_thumbnail", $thumbnail[0], $text , $thumbnail[1], $thumbnail[2] );  
  }
  bw_trace( $return_value, __FUNCTION__, __LINE__, __FILE__, "return_value" ); 
  return( $return_value );
}

/**
 * get the attached image 
 *
 * Return an array of images attached to a specific post ID
 *
 *   
 * Return Value: An array containing:
 *       $image[0] => url
 *       $image[1] => width
 *       $image[2] => height
 *       $image[3] => attachment id
 */
function bw_get_attached_image( $post_id = null, $number = 1, $orderby = 'rand', $image_size = 'thumbnail') {

  if ($post_id == null) 
    $post_id = get_the_id();
  bw_trace( $post_id, __FUNCTION__, __LINE__, __FILE__, "post_id" ); 
  $number = intval( $number );
  
  $arr_attachment = get_posts (array( 'post_parent'    => $post_id,
                                      'post_type'      => 'attachment',
                                      'numberposts'    => $number,
                                      'post_mime_type' => 'image',
                                      'orderby'        => $orderby ));
  
  foreach ( $arr_attachment as $index => $attachment ) {
    $arr_attachment[$index] = array_merge ( (array) wp_get_attachment_image_src($attachment->ID, $image_size), array($attachment->ID) );
  }
  
  bw_trace( $arr_attachment, __FUNCTION__, __LINE__, __FILE__, "arr_attachment" );
  
  return $arr_attachment;
}


/**
 * List sub-pages of the current or selected page - in a simple list 
 *
 * Same as bw_pages but producing a simple list of links to the content type
 *
 *
 * [bw_list class="classes for the list" 
 *   post_type='page'
 *   post_parent 
 *   orderby='title'
 *   order='ASC'
 *   posts_per_page=-1
 *   block=true or false
 *   thumbnail=specification - see bw_thumbnail
 *   customcategoryname=custom category value  
 */
function bw_list( $atts = NULL ) {
  
  $posts = bw_get_posts( $atts );
  
  sul( bw_array_get( $atts, 'class', 'bw_list' ));
  
  foreach ( $posts as $post ) {
    bw_format_list( $post, $atts );
  }
  eul();
  
  return( bw_ret() );
} 


/**
 * Get the list of categories for this "post" as a string of slugs separated by commas 
 */
function bw_get_categories() {
  global $post;
  $categories = get_the_category( $post->ID );
  $cats = '';
  foreach ( $categories as $category ) {
    $cats .= $category->slug;
    $cats .= ' ';
  }  
  $cats = trim( $cats );
  $cats = str_replace( ' ',',', $cats );
  return bw_trace2( $cats );
}

/**
 * Wrapper to get_posts() 
 * 
 * When no parameters are passed processing should depend upon the context
 * e.g for a 'page' it should list the child pages
 *     for a 'post' it should show related posts in the same category as the current post
 * 
 * # $atts       $post->     Default
 *   post_type   post_type   processing
 * - ---------   ---------   -----------------------------------
 * 1 -           page        list child pages - first level only
 * 2 -           post        list related posts - same categories
 * 3 -           custom      none
 * 4 page        page        as 1.
 * 5 page        post        ?
 * 6 page        custom      ?
 * 7 post        page        ?
 * 8 post        post        as 2.
 * 9 post        custom      ?
 * 10-12 custom  any         ?
 *
 * As you can see from the table above the default behaviour for listing posts on pages and vice-versa is not (yet) defined
 */
function bw_get_posts( $atts = NULL ) {
  
  // Copy the atts from the shortcode to create the array for the query
  // removing the class and title parameter that gets passed to bw_block()
 
  $attr = $atts;
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  //bw_trace( $attr, __FUNCTION__, __LINE__, __FILE__, "attr" );
  /* Set default values if not already set */
  
  // Set the post_type attribute - initially default to NULL
  $attr['post_type'] = bw_array_get( $attr, 'post_type', $GLOBALS['post']->post_type );
  
  // Only default post_parent for post_type of 'page' 
  // This allows [bw_pages] to be used without parameters on a page
  // and to be used to list 'page's from other post types.
  // 
  if ( $attr['post_type'] == 'page' ) {
    $attr['post_parent'] = bw_array_get( $attr, "post_parent", $GLOBALS['post']->ID );
  }
  
  if ( $attr['post_type'] == 'post' ) {
    $attr['category_name'] = bw_array_get( $attr, "category_name", NULL );
    if ( NULL == $attr['category_name'] ) {
      $categories = bw_get_categories();
      $attr['category_name'] = $categories;
    }  
  }
        
  $attr['numberposts'] = bw_array_get( $attr, "numberposts", -1 );
  $attr['orderby'] = bw_array_get( $attr, "orderby", "title" );
  $attr['order'] = bw_array_get( $attr, "order", "ASC" );
  
  // Regardless of the post type, exclude the current post, 
  // Note: This could also be improved **?**
  $attr['exclude'] = bw_array_get( $attr, "exclude", $GLOBALS['post']->ID );
  
  bw_trace( $attr, __FUNCTION__, __LINE__, __FILE__, "attr" );
  
  // if ( $attr['post_type'] == 'post' ) {
    $posts = get_posts( $attr );
  // } else {
  //  $posts = get_pages( $attr );
  // }  
  bw_trace( $posts, __FUNCTION__, __LINE__, __FILE__, "posts" );
  return( $posts );
  
}


/**
 * Wrapper to wp_list_bookmarks() 
 *
 * which replaces get_links()
 */
function bw_bookmarks( $atts = NULL ) {
  // Copy the atts from the shortcode to create the array for the query
  // removing the class and title parameter that gets passed to bw_block()
 
  $attr = $atts;
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  //bw_trace( $attr, __FUNCTION__, __LINE__, __FILE__, "attr" );
  /* Set default values if not already set */
  
  $attr['limit'] = bw_array_get( $attr, "numberposts", -1 );
  $attr['orderby'] = bw_array_get( $attr, "orderby", "name" );
  $attr['order'] = bw_array_get( $attr, "order", "ASC" );
  $attr['category_name'] = bw_array_get( $attr, "category_name", NULL );
  // $attr['exclude'] = bw_array_get( $attr, "exclude", $GLOBALS['post']->ID );
  $attr['echo'] = 0;
  
  bw_trace( $attr, __FUNCTION__, __LINE__, __FILE__, "attr" );
  $posts = wp_list_bookmarks( $attr );
  bw_trace( $posts, __FUNCTION__, __LINE__, __FILE__, "posts" );
  return( $posts );
  
}

  
