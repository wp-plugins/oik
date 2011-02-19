<?php // (C) Copyright Bobbing Wide 2010, 2011
require_once( "bobblink.inc" );
 

function bw_bob( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="b1 bold">B</span>';
  $bw .= '<span class="o bold">o</span>'; 
  $bw .= '<span class="b2 bold">b</span>';
  $bw .= nullretetag( "span", $class );
  return( $bw );

}

function bw_fob( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W bold">f</span>';
  $bw .= '<span class="i2 bold">o</span>'; 
  $bw .= '<span class="d bold">b</span>';
  $bw .= nullretetag( "span", $class );
  return( $bw );

}

function bw_bing( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="b3 bold">b</span>';
  $bw .= '<span class="i1 bold">i</span>';
  $bw .= '<span class="n bold">n</span>';
  $bw .= '<span class="g bold">g</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}

function bw_wide( $class=NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">W</span>';
  $bw .= '<span class="i2">i</span>';
  $bw .= '<span class="d">d</span>';
  $bw .= '<span class="e">e</span>';
  $bw .= nullretstag( "span", $class ); 
  return( $bw );
} 

function bw_bong( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">b</span>';
  $bw .= '<span class="i2">o</span>';
  $bw .= '<span class="d">n</span>';
  $bw .= '<span class="e">g</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}
function bw_hide( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">h</span>';
  $bw .= '<span class="i2">i</span>';
  $bw .= '<span class="d">d</span>';
  $bw .= '<span class="e">e</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}

function bw_wow ( $class = NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="B1">W</span>';
  $bw .= '<span class="o">o</span>';
  $bw .= '<span class="B2">W</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}

function bw_wow_long ( $class = NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="B1">Wonder</span>';
  $bw .= '<span class="o">of</span>';
  $bw .= '<span class="B2">WordPress</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}


function bw_oik ( $class = NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="b1">o</span>';
  $bw .= '<span class="o">i</span>';
  $bw .= '<span class="b2">k</span>';
  $bw .= nullretstag( "span", $class ); 

  return( $bw );

}

function bw_loik() {
  alink( NULL, "http://www.bobbingwidewebdesign.com/oik", bw_oik(), "Link to the oik plugin") ;
  return( bw_ret());
} 
 

function bw_post() {
  $url = site_url( "/wp-admin/post-new.php" );
  alink( "post", $url, "Add Post", "Add New Post", "" );
  return( bw_ret());
}

function bw_page() {
  $url = site_url( "/wp-admin/post-new.php?post_type=page" );
  alink( "page", $url, "Add Page", "Add New Page", "" );
  return( bw_ret());
}


/* Others we can do are:
 links
 plugins
 users
 dashboard
 
*/


/** Simple function to validate a field as TRUE or FALSE given a big list of strings that represent TRUE 
    Note: No need for the $falses parameter at present
 */
function bw_validate_torf( $field, $trues=",true,yes,1", $falses=NULL ) {
  $torf = FALSE;
  $field = ",".strtolower( $field );
  bw_trace( $field, __FUNCTION__, __LINE__, __FILE__, "field" );
  bw_trace( $trues, __FUNCTION__, __LINE__, __FILE__, "trues" );
  $pos = strpos( $trues, $field );
  bw_trace( $pos, __FUNCTION__, __LINE__, __FILE__, "pos" );
  if ( $pos )
    $torf = TRUE;
    
  return( $torf );  
}


/** Added [bw_plug name="plugin name" link="URL" info="t,y/n/1/0"] shortcode
    Format of the output is something like this.
    
      <a href="wordpress/name" title="$info">$name</a>
      <a href="$link" title="Read bw notes on $name" class="bwlink">(...)</a>

 */
function bw_plug( $atts ) {
  $name = $atts['name'];
  $link = $atts['link'];
  $table = $atts['table']; 
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  
  $table = bw_validate_torf( $table );
  
  bw_trace( $table, __FUNCTION__, __LINE__, __FILE__, "table" );
  
  $plugininfo = bw_get_plugin_info( $name );
  
  bw_trace( $plugininfo, __FUNCTION__, __LINE__, __FILE__, "plugininfo" );
  
  
  if ( !$plugininfo->name ) {
    if ( $table ) {
      bw_format_table( $name, $link, NULL );
    }  
    else {
      bw_format_default( $name, $link );
    } 
  }   
  else {
    if ( $table ) {
      bw_format_table( $name, $link, $plugininfo );
    }  
    else {
      bw_format_link( $name, $link, $plugininfo );
    }  
  }  
  return( bw_ret());  
}


function bw_format_default( $name, $link ) {          
  $title = "Link to the $name plugin on wordpress.org" ;
  alink( NULL, "http://wordpress.org/extend/plugins/".$name, $name, $title );  
  if (empty( $link )) {
    $link = "http://www.bobbingwidewebdesign.com/plugins/$name";
  }
  e( "(" );
  alink( "bwlink", $link, "...", "Link to bobbing wide's notes on ".$name );
  e( ")" ); 
}

    
function bw_format_link( $name, $link, $plugininfo ) {          
  $title = "Link to the $plugininfo->name ($name: $plugininfo->short_description) plugin on wordpress.org" ;
  alink( NULL, "http://wordpress.org/extend/plugins/".$name, $plugininfo->name, $title );  
  if (empty( $link )) {
    $link = "http://www.bobbingwidewebdesign.com/plugins/$name";
  }
  e( "(" );
  alink( "bwlink", $link, "...", "Link to bobbing wide's notes on ".$name );
  e( ")" ); 
}


function tdlink( $class=NULL, $url, $text, $title=NULL, $id=NULL ) {
  stag( "td" );
  alink( $classm, $url, $text, $title, $id );
  etag( "td" );
}  

 

/**
  * Code copied and cobbled from http://snippet.me/wordpress/wordpress-plugin-info-api/
  * having referred to http://ckon.wordpress.com/2010/07/20/undocumented-wordpress-org-plugin-api/
  * get XML information using simple xml load file
  */
function bw_get_plugin_info( $plugin_slug ) {
  $request_url = "http://api.wordpress.org/plugins/info/1.0/$plugin_slug.xml";
  $request_url = urlencode($request_url);
  $response_xml = simplexml_load_file($request_url);
  bw_trace( $response_xml, __FUNCTION__, __LINE__, __FILE__, "response_xml" );
  return $response_xml;
}
 

/* Format the bw_plug output as a table with a number of columns
  1. plugin name - and link to WordPress
  2. plugin slug 
  3. bw link
  4. other stuff
*/  

function bw_format_table( $name, $link, $plugininfo ) {

  stag( "tr");
   
  if ( $plugininfo === FALSE ) {
    td( $name );
    td( "No info available" );
    }
  else {
    stag( "td" );
    strong( $plugininfo->name );
    br();
    e( $plugininfo->short_description );
    etag( "td" );
      
    
    stag( "td" );
    
    $title = "Link to the $plugininfo->name ($name: $plugininfo->short_description) plugin on wordpress.org" ;
    alink( "plugin", "http://wordpress.org/extend/plugins/".$name, $plugininfo->slug, $title );  
    br();
    alink( "home", $plugininfo->homepage, "home", "Link to plugin homepage" ); 
    br();
    alink( "bwlink", $link, "...", "Link to bobbing wide's notes on ".$name );
    etag( "td" );
    
    td( $plugininfo->version . '<br />' . $plugininfo->downloaded . '<br />'. $plugininfo->last_updated );
  } 
  etag("tr");  
}





    
        

