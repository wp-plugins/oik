<?php // (C) Copyright Bobbing Wide 2009-2012
// Functions for the anchor tag...
// because it's more complicated than others

function sa()
{
  bw_echo( "<a" );
}

function ag()
{
  bw_echo( ">" );
}

function ea()
{
  bw_echo( '</a>' );
}

function ahref( $href )
{
  bw_echo( ' href="'.$href.'"');
}

function kv( $keyword, $value=NULL )
{
   if ( $value != NULL )
   
      bw_echo( ' '.$keyword . '="' . $value .'"');
} 

function aid( $id=NULL )
{ 
  kv( "id", $id );
}  

function aclass( $class=NULL )
{
  kv( "class", $class );
}

function aalt( $alt = NULL )
{
  kv( "alt", $alt );
}

function atitle( $title = NULL )
{
  $title = wp_strip_all_tags( $title );
  kv( "title", $title );
} 

function atext( $linktori ) {
   e( $linktori );
}   

/* $linktori is the text or image - see textorimage()
   $url is the fully formed url - 
   $alt - if NULL will use $linktori
   $extra is anything else that needs to go in the <a> tag. e.g. 'onclick=then some javascript' 
*/   

function alink( $class=NULL, $url, $linktori, $alt=NULL, $id=NULL, $extra=NULL ) {
  sa();
  aclass( $class );
  aid( $id );
  ahref( $url );
  if ( is_null( $alt ) )
     $alt = $linktori;
  // Is alt= allowed with XHTML Strict 1.0?    
  // aalt( $alt );
  atitle( $alt );
  e( $extra );
  ag();
  atext( $linktori );
  ea();
}


/* Here the class is associated to a span and not to the anchor 
   the link is followed by a short description.
   This was first used in the 404 error page
*/  

function lialink( $class=NULL, $url, $desc, $short )
{
  stag( "li", NULL, NULL );
  span( $class );
  alink( NULL, $url, $short );
  epan();
  if ( $desc <> NULL )
  {
    e( "&nbsp;-&nbsp;" );
    e( $desc );
  }  
  etag( "li" );
}
  

function aname( $name ) 
{
  sa();
  e( ' name="'. $name . '"' );
  ea();
} 
          
