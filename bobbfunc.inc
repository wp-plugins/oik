<?php // Copyright Bobbing Wide 2009, 2011
// bobbfunc.inc

function bw_oik_version() {  
  return( '1.0' );
}  

function bw_echo( $string ) {
  global $bwecho;
  $bwecho.=$string;
}

function bw_flush() {
  global $bwecho;
  echo $bwecho;
  //bw_trace( "inside bw_flush" );
  //bw_trace( $bwecho );
  //bw_trace( "after" );
  $bwecho = NULL;
}

function bw_ret() {
  global $bwecho;
  $bwret = $bwecho;
  $bwecho = NULL;
  //bw_trace( __FUNCTION__ );
  return( $bwret );
}


function retimage( $class, $jpg, $title, $width=NULL, $height=NULL )
{
    $img = '<img class="' .  $class . '" ';  
    $img .= 'src="' .  bw_expand_link( $jpg ) . '" ';
    if ( !is_null( $width))
      $img .= 'width="' . $width . '" ';
    if ( !is_null( $height))
      $img .= 'height="' . $height . '" ';
    $img .= 'title="' . $title . '" ';
    $img .= 'alt="' . $title . '" ';
    $img .= " />";
    return( $img );
}
 
function image( $class, $jpg, $title, $width=NULL, $height=NULL )
{
  $img = retimage( $class, $jpg, $title, $width, $height ); 
  bw_echo( $img );
}
 

// *?** Need to create a link where I can add the prefix but the link text is nice

/*
function createlink( $file, $text )
{
 bw_echo( '<a href="' . $file . '">' . $text . '</a>' );
} 

function checkout( $url, $text)
{
   createlink( $url, $text);
}

function checkoutid( $url, $text, $id)
{
   bw_echo( '<a id="' .$id . '" href="' . $url . '" alt="' .$text . '" title="' .$text .'">' . $text . '</a>' );
}


function menulink( $file, $text )
{
  bw_echo( '<li>' );
  createlink( $file, $text );
  bw_echo( '</li>' );
}
*/

function retstag( $tag, $class=NULL, $id=NULL ) 
{   
  $stag = '<' . $tag ;
  if ( $class <> NULL )
     $stag.= ' class="' . $class. '"';
  if ( $id <> NULL )
     $stag.= ' id="' . $id. '"';
  $stag.= '>';
  return( $stag );
}


function nullretstag( $tag, $class=NULL )
{
   $ret = '';
   if ( $class <> NULL )
      $ret = retstag( $tag, $class );
   return( $ret );     
} 


function stag( $tag, $class=NULL, $id=NULL )
{
  bw_echo( retstag( $tag, $class, $id ));
}

function sol( $class=NULL, $id=NULL )
{
   stag( "ol", $class, $id );
}        


/* renamed uls to sul to be consistent with stag */ 
   
function sul( $class=NULL, $id=NULL )
{
   stag( "ul", $class, $id );
}        

function sdiv( $class=NULL, $id=NULL )
{
   stag( "div", $class, $id );
}

function eol()
{
   bw_echo( '</ol>' );
}
   

function eul()
{
   bw_echo( '</ul>' );
}

function ediv()
{
   bw_echo( '</div>' );
}

/* sediv creates a dummy div which is used for placing graphics using backhground images in CSS */
function sediv( $class=NULL, $id=NULL )
{
   sdiv( $class, $id );
   ediv();
}   

function ep()
{
  bw_echo( '</p>' );
}

function nullretetag( $tag, $class=NULL ) 
{
  $ret = '';
  if ( $class <> NULL )
     $ret = retetag( $tag );
  return( $ret );   
}

function retetag( $tag )
{
   return( '</'.$tag.'>');
}  

function etag( $tag )
{
  //  bw_echo( '</'.$tag.'>'."\n";
  bw_echo( '</'.$tag.'>' );
}    

function sp( $class=NULL, $id=NULL )
{
   stag( "p", $class, $id );
} 

function p( $text=NULL, $class=NULL, $id=NULL )
{
   sp( $class, $id );
   if ( !is_null( $text ))
     bwt( $text );
   etag( "p" );
}

function hn( $text, $level, $class, $id )
{
   stag( "h".$level, $class, $id );
   bwt( $text );
   etag( "h".$level );
}

function h1( $text, $class=NULL, $id=NULL )
{
   hn( $text, "1", $class, $id );
  
}

function h2( $text, $class=NULL, $id=NULL )
{
   hn( $text, "2", $class, $id );
  
}

function h3( $text, $class=NULL, $id=NULL )
{
   hn( $text, "3", $class, $id );
  
}

function h4( $text, $class=NULL, $id=NULL )
{
   hn( $text, "4", $class, $id );
  
}

function h5( $text, $class=NULL, $id=NULL )
{
   hn( $text, "5", $class, $id );
  
}

function h6( $text, $class=NULL, $id=NULL )
{
   hn( $text, "6", $class, $id );
  
}


/** Function e() replaces the original t() function used in Bobbing Wide custom code
 *   since for Drupal t() is already defined for translatable text
 *  Function bwt() does a similar job but also performs some strange filtering if required.
 */  
function bwt( $text = NULL )
{
   global $bbboing;  

   if ( !is_null( $text ))
   {
     if ( $bbboing )
        bw_echo( $bbboing( $text ));
     else
       bw_echo( $text ) ;
   }    
}

/**
 * @func e for bw_echo( if not NULL
 */
function e( $text = NULL )
{
  if ( !is_null( $text ))
    bw_echo( $text );
}

function br( $text=NULL )
{
   bw_echo( '<br />' );
   bwt( $text ); 
}   

function hr()
{
  bw_echo( '<hr />' );
}  
  

function say( $text )   
{
  isay ($text, "EN" );
}

function isay( $text, $lang=NULL )
{
  e( $text );  
} 

// Instead of function li( use function lit( - List Item Text

function lit( $text, $class=NULL, $id=NULL )
{
  stag( "li", $class, $id );
  bwt( $text );
  etag( "li" );
}

/* decided to write a helper function */
function li( $text )
{
   lit( $text );   
} 

// Note: here we omit the 's' of span to make it easier to type
function span( $class=NULL, $id=NULL )
{
  stag( "span", $class, $id );
}

function epan()
{
  etag( "span" );
}  

function sepan( $class=NULL, $text=NULL )
{
   span( $class );
   e( $text );
   epan();
}


/* table data */

function td( $data, $class=NULL, $id=NULL )
{
  stag( "td", $class, $id );
  e( $data );
  etag( "td" );
} 

/* table heading */
function th( $data, $class=NULL, $id=NULL )
{
  stag( "th", $class, $id );
  e( $data );
  etag( "th" );
}         
        
  


function big_button( $class, $link, $text, $alt)
{
   sdiv( "big_button_" .$class );
   sp();
   
   // createlink( $url, $text );
   $url = $link ; 
   
   sa();
   // No id parm 
   aclass();
   ahref( $url );
   //aalt( $alt );
   atitle( $alt );    
   ag();

   e( $text );  
   ea();
   ep(); 
   ediv();
   //ediv();
}

function button( $class, $link, $text, $alt)
{
   
   // createlink( $url, $text );
   stag( "span",  "big_button_" .$class );
   $url = $link ; 
   
   sa();
   // No id parm 
   aclass();
   ahref( $url );
   atitle( $alt );    

   ag();     

   e( $text );  
   ea();
   etag( "span" );    
   stag( "span", "end_button_" . $class );
   //e( "&nbsp;*&nbsp;");
   etag( "span" );     
       

}

function sbutton( $class, $link, $text, $alt)
{
   
   stag( "span",  "big_button_" .$class );
   // createlink( $url, $text );
   $url = $link ; 
   
   sa();
   // No id parm 
   aclass();
   ahref( $url );
   atitle( $alt );    

   ag();     

   e( $text );  
   ea();    
   etag( "span" );    
   stag( "span", "end_button_" . $class );
   e( "&nbsp;");
   etag( "span" );     

}



// This routine finds the subdirectory under which this local version of the website is installed
// we need to remove this from index lookups but add it to links! 
// Example: on betterbfar in the twentyte directory it's set:
// $docroot_suffix = "/twentyte/" ;

function bw_get_docroot_suffix()
{
  $docroot_suffix = "/";
  if ( $_SERVER['SERVER_NAME'] == bw_get_company( "betterbyfar") )
  {
     $exdr = explode( '/', $_SERVER["DOCUMENT_ROOT"] );
     $exsf = explode( '/', $_SERVER['SCRIPT_FILENAME'] );
     
     $docroot_suffix = '/' . $exsf[ count( $exdr) ] . '/';
     
     // bw_debug( "_SERVER[DOCUMENT_ROOT]: " . $_SERVER["DOCUMENT_ROOT"] );
     // bw_debug( "_SERVER[REQUEST_URI]: " .  $_SERVER['REQUEST_URI'] );  
     // bw_debug( "_SERVER[SCRIPT_FILENAME]: " . $_SERVER['SCRIPT_FILENAME'] );
  
     // bw_debug( "docroot_suffix: " . $docroot_suffix );
  }
  return( $docroot_suffix );
}

/* This gets us to the right place when the link is from a sub-directory
   but it doesn't add anthing when the link is of form
     http:
     https:
     ftp:
     mailto: 
*/     
function bw_expand_link( $linkurl )
{
   if ( strpos( $linkurl, ':' ) == 0  )
      $linkurl = bw_get_docroot_suffix() . $linkurl;
   return( $linkurl) ;   
}

// Note: Any bw_debug's before the DOCTYPE and the page goes into quirks mode
// where's the earliest we can put these then? = perhaps in comments?
function bw_get_page()
{
  $page = "";
  if ( !isset( $_GET['page'] ))
  {
     $page = $_SERVER['REQUEST_URI'];
     //bw_debug( "SERVER request uri: " . $page );
     if ( $page != $_SERVER['SCRIPT_NAME'] )
     {
        //bw_debug( "SCRIPT_NAME:" . $_SERVER['SCRIPT_NAME'] . " not the same as the REQUEST_URI:". $page . ", using SCRIPT_NAME" );
        $page = $_SERVER['SCRIPT_NAME'];  
     }   
  }   
  else
     $page = $_GET['page'];   
  //bw_debug( "bw_get_page: " . $page );   
  
  // Now we need to reduce this to the part of the page that we really want
  // on betterbyfar there may be an unwanted subdirectory
  // on real servers this subdirectory will not be present
  // how do we find out what the subdirectory is? 
  

  // bw_debug( "page before:" . $page ); 
  $docroot_suffix = bw_get_docroot_suffix();
  
  if ( $docroot_suffix <> '/' )
    $page = str_replace( $docroot_suffix, NULL, $page );
  else  
    $page = ltrim( $page, $docroot_suffix );   
  // bw_debug( "page after: " . $page );
   
  return $page;
}  


function bw_prefix_require( $file )
{
  global $bobb_prefix;
  
  $file = $bobb_prefix . $file ;
  require( $file );
}


function strong( $text, $class=NULL, $id=NULL )
{
   stag( "strong", $class, $id ) ;
   e( $text );
   etag( "strong" );    
}

function em( $text, $class=NULL, $id=NULL )
{
   stag( "em", $class, $id ) ;
   e( $text );
   etag( "em" );    
}

function blockquote( $text, $class=NULL, $id=NULL )
{
   stag( "blockquote", $class, $id ) ;
   e( $text );
   etag( "blockquote" );    
}

function quote( $text, $class=NULL, $id=NULL )
{
   stag( "quote", $class, $id ) ;
   e( $text );
   etag( "quote" );    
}

  
function c( $text )
{
  bw_echo( '<!--' . $text . '-->' );
} 

function bw_debug_on()
{
  global $bw_debug_on;
  $bw_debug_on = TRUE;
}

function bw_debug_off()
{
  global $bw_debug_on;
  $bw_debug_on = FALSE;
}     
     

function bw_debug( $text )
{
  global $oktop, $bw_debug_on;
  if ($bw_debug_on)
  {
    if ( $oktop )
      p( $bw_debug_on . $text );
    else
      c( $text ); 
  }     
}

function bw_theme_image( $file )
{
  global $theme;
  $filename = bw_get_docroot_suffix();
  $filename.= "/themes/";
  $filename.= $theme;
  $filename.= "/";
  $filename.=$file;
  return( $filename) ;
} 


/* Function: bw_image_link
   Purpose: To display an image as a link 
*/   
function bw_image_link( $link 
                      , $image
                      , $imagetext
                      , $width=302
                      , $height=227
                      )
{
  $linktext = bw_get_linktext( $link );
  $a = '<a title="';
  $a.= $linktext;
  $a.= '" href="';
  $a.= bw_expand_link( $link );
  $a.= '">';
  bw_echo( $a . "\n" );
  
  image( ""
       , $image
       , $imagetext
       , $width
       , $height
       );
  etag( "a" );
 
} 


function bw( $bw_class_prefix=NULL ) {  

      if ( is_null( $bw_class_prefix )) 
         $cp = ' class="';
      else
         $cp = ' class="' . $bw_class_prefix;
           
      $bw  = '<em' .$cp .'b1">B</em>';
      $bw .= '<em' .$cp .'o">o</em>'; 
      $bw .= '<em' .$cp .'b2">b</em>';
      $bw .= '<em' .$cp .'b3">b</em>';
      $bw .= '<em' .$cp .'i1">i</em>';
      $bw .= '<em' .$cp .'n">n</em>';
      $bw .= '<em' .$cp .'g">g</em>';
      $bw .= '<em' .$cp .'space">&nbsp;</em>';
      $bw .= '<em' .$cp .'W">W</em>';
      $bw .= '<em' .$cp .'i2">i</em>';
      $bw .= '<em' .$cp .'d">d</em>';
      $bw .= '<em' .$cp .'e">e</em>';
      
         
      return $bw;
}
  
  

  
//function ebw( $bw_class_prefix=NULL ) {
//     bw_echo( bw( $bw_class_prefix ) );
//}

/** 
 * echo Bobbing Wide inside a theme's template file
 */
function ebw( $bw_class_prefix=NULL )
{
   echo bw( $bw_class_prefix );
}

require_once( "bobbcomp.inc" );

if ( bw_is_wordpress() ) {
  /**
    * In WordPress Artisteer provides code to deal with buttons
    * but in Drupal it needs more wrapping.
    */
  function art_button( $linkurl, $text, $title=NULL, $class=NULL  ) {
    alink( "button " . $class , $linkurl, $text, $title ) ;
  }
}
else {
  function art_button( $linkurl, $text, $title=NULL, $class=NULL  ) {
    span("art-button-wrapper" );
    sepan("art-button-l l");
    sepan("art-button-r r");
    alink( "button art-button " . $class , $linkurl, $text, $title ) ;
    epan();
  }
}



/*  default logic
  set a default value if the value is not set
*/
function bw_default( $value, $default=NULL ) {
  $val = $value;
  
  bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value before" );
  if ( empty( $val ))
    $val = $default;
  bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value returned" );
  return( $val );
}    
  
/* 
  Gallery logic
  
  The gallery shortcode allows media to be displayed
  Here we take values from the page's metadata
   gallery-columns = 1,2, etc
   gallery-size = 'thumbnail', 'medium', 'large', 'full'
  and apply them to the gallery shortcode
  If the meta data is not set in the post the default values are:
  
  
  [gallery columns="1" size="medium"] 
  
  For more information on gallery see http://codex.wordpress.org/Gallery_Shortcode
  For more information on sizes see WordPress admin panel under Settings > Media
  
*/
function bw_gallery() {

  c( "gallery processing");
  global $post;
  bw_trace( $post, __FUNCTION__, __LINE__, __FILE__, "post" );
 
  $columns = get_post_meta( $post->ID, "gallery-columns", true );
  $columns = bw_default( $columns, "1");
  $size = get_post_meta( $post->ID, "gallery-size", true );
  $size = bw_default( $size, "medium" );
   
  $gallery_options = array( 'columns' => $columns, 'size' => $size );
  e( gallery_shortcode( $gallery_options ));


}
