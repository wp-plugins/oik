<?php // (C) Copyright Bobbing Wide 2011

/*
Plugin Name: oik blocks
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use shortcode macro for blocks in content [bw_block] [bw_eblock]
Version: 1.2
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

bw_add_shortcode( 'bw_block', 'bw_block' );
bw_add_shortcode( 'bw_eblock', 'bw_eblock' );


function bw_block( $atts ) { 
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'art-',
      'level' => 'h3',
      'title' => NULL, 
      'framed' => true,
      'class' => NULL,
      ), $atts ) );
  /* We can't pass the prefix or heading level yet */   
  /* the block is enclosed in a div which can be used to control the width and depth 
     We save the div_class just in case it's needed in the bw_eblock processing
     Actually, this is a bit daft. Since it is possible to nest blocks within blocks
     the saved value will be that of the most recently nested blocks. So if we wanted to be able to do something with 
     it we would need to manage a stack.
     
  */ 
  $framed = bw_validate_torf( $framed );  
  global $div_class;
  $div_class = $class;
  sdiv( $class ); 
  sartblock( $title, $framed );
  return( bw_ret());

}

function bw_eblock( $atts ) {
  eartblock();
  return( bw_ret());
}

function bw_header( $atts ) {
  extract( shortcode_atts( array(
      'prefix' => 'art-',
      'level' => 'h3',
      'title' => NULL, 
      'link' => NULL
      ), $atts ) );
  artblockheader( $title );
  return( bw_ret());
}



function artblockheader( $title=NULL, $link=NULL, $icon=NULL ) {
  if ( $title ) {  
    sdiv( "art-blockheader");
    //sdivslr( "art-header-tag-icon" );
    h3( $title, "t" );
    //sdiv( "t" );
    //t( $title );
    ediv();
  }
} 

function artblockheaderNoIcon( $title ) {  
  sdiv( "art-blockheader");
  sdivslr( "t" );
  //h3( $title );
  t( $title );
  ediv();
  ediv();
}      


function artblockframe()
{
  sediv( "art-block-tl" );
  sediv( "art-block-tr" );
  sediv( "art-block-bl" );
  sediv( "art-block-br" );
  sediv( "art-block-tc" );
  sediv( "art-block-bc" );
  sediv( "art-block-cl" );
  sediv( "art-block-cr" );
  sediv( "art-block-cc" );
} 
 
  
function sartblock( $title=NULL, $framed=TRUE )
{
   sdiv( "art-block" );
     if ($framed )
     {
        artblockframe();
     }   
     artblockheader( $title );
     sdiv( "art-blockcontent" );
     sdiv( "art-blockcontent-body ");
}


function eartblock( $contentFunc = NULL ) 
{

   if ( !is_null( $contentFunc ))      
     $contentFunc();
   ediv();
   ediv();
   ediv();
    global $div_class;
   ediv( $div_class );
   
}  

