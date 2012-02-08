<?php // (C) Copyright Bobbing Wide 2010-2012
require_once( "bobblink.inc" );
require_once( "bobbcomp.inc" );
 

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
  $bw .= nullretetag( "span", $class ); 

  return( $bw );

}

function bw_wide( $class=NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">W</span>';
  $bw .= '<span class="i2">i</span>';
  $bw .= '<span class="d">d</span>';
  $bw .= '<span class="e">e</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
} 

function bw_bong( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">b</span>';
  $bw .= '<span class="i2">o</span>';
  $bw .= '<span class="d">n</span>';
  $bw .= '<span class="e">g</span>';
  $bw .= nullretetag( "span", $class ); 

  return( $bw );

}
function bw_hide( $class = NULL)
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="W">h</span>';
  $bw .= '<span class="i2">i</span>';
  $bw .= '<span class="d">d</span>';
  $bw .= '<span class="e">e</span>';
  $bw .= nullretetag( "span", $class ); 

  return( $bw );

}

function bw_wow ( $class = NULL )
{
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="B1">W</span>';
  $bw .= '<span class="o">o</span>';
  $bw .= '<span class="B2">W</span>';
  $bw .= nullretetag( "span", $class ); 

  return( $bw );

}

/* These are non-translatable */
function bw_wow_long ( $class = NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="B1">Wonder</span>';
  $bw .= ' ';
  $bw .= '<span class="o">of</span>';
  $bw .= ' ';
  $bw .= '<span class="B2">WordPress</span>';
  $bw .= nullretetag( "span", $class ); 

  return( $bw );

}

/**
 * Create a simple link to a website
 * 
 * @param array $atts - shortcode attributes
 *  site = prefix of the site. e.g. www.cwiccer or twenty-tens
 *  s = suffix = des for webdesign and dev for webdevelopment
 *  t = tld = defaults to .com
 *
 * The primary purpose of this is to produce the fancy text for Bobbing Wide
 * but it can be used for other sites if you specify site='your domain'
 */
function bw_lbw( $atts=NULL ) {
  $sites = array( 'bw' => "" ,
                  'des' => "webdesign",
                  'dev' => "webdevelopment"
                  
                );   
  $s = bw_default_empty_att( $atts['s'], NULL, "bw" );
  $tld = bw_default_empty_att( $atts['t'], NULL, ".com" );
  $site = bw_array_get( $atts, 'site', "www.bobbingwide" );
  if ( $site == 'www.bobbingwide' ) {
     $text = "www." . bw();
     $title = 'Visit the Bobbing Wide website: ';
  } else {
    $text = $site; 
    $title = 'Visit the website: ';
  }     
  $site .= $sites[ $s ];
  $site .= $tld;
  
  if ( $sites[ $s ] ) 
    $text .= '<b>' . $sites[ $s ] . '</b>';
  $text .= $tld;  
   
  alink( 'url', "http://" . $site, $text, $title . $site ) ;
  return( bw_ret());

}

function bw_loik() {
  alink( NULL, "http://www.oik-plugins.com/oik", bw_oik(), "Link to the oik plugin") ;
  return( bw_ret());
} 

function bw_wp( ) {
  $bw = nullretstag( "span", "wordpress"); 
  $bw .= '<span class="word">Word</span>';
  $bw .= '<span class="press">Press</span>';
  $bw .= nullretetag( "span", "wordpress" ); 
  return( $bw );
}

function bw_bp( ) {
  $bw = nullretstag( "span", "buddypress"); 
  $bw .= '<span class="buddy">Buddy</span>';
  $bw .= '<span class="bpress">Press</span>';
  $bw .= nullretetag( "span", "buddypress" ); 
  return( $bw );
}


function bw_lwp() {
  alink( NULL, "http://www.wordpress.org", bw_wp(), "Visit WordPress.org" ); 
  return( bw_ret());
}

function bw_lwpms() {
  alink( NULL, "http://www.wordpress.org", bw_wpms(), "Visit WordPress.org for MultiSite" ); 
  return( bw_ret());
}

function bw_lbp() {
  alink( NULL, "http://www.buddypress.org", bw_bp(), "Visit BuddyPress.org" ); 
  return( bw_ret());
}


function bw_ldrupal() {
  alink( NULL, "http://www.drupal.org", bw_drupal(), "Visit Drupal.org" ); 
  return( bw_ret());
}

function bw_lart() {
  alink( NULL, "http://www.artisteer.com", bw_art(), "Visit Artisteer.com" ); 
  return( bw_ret());
}

function bw_wpms() {
  $bw = bw_wp();
  $bw .= ' ';
  $bw .= '<span class="multisite">Multisite</span>';
  return( $bw );
}
  
function bw_drupal() {
  $bw = '<span class="drupal">Drupal</span>';
  return( $bw );
} 
 
function bw_art() {
  $bw = '<span class="artisteer">Artisteer</span>';
  return( $bw );
}  


/** 
  * Create an Add Post button. If the text parameter is passed create "Add Post" regardless of the text
  */
function bw_post( $atts ) {
  $text = bw_array_get( $atts, 'text', NULL );
  
  if ( bw_is_wordpress() )
     $url = site_url( "/wp-admin/post-new.php" );
  else 
     $url = site_url( '/node/add/blog' );   
  if ( $text ) {
    $text = "Add Post";
  }    
  alink( "post", $url, $text, "Add New Post", "" );
  return( bw_ret());
}

/** 
 * Create an Add Page button. Similar code to bw_post()
 */
function bw_page( $atts ) {
  $text = bw_array_get( $atts, 'text', NULL );

  if ( bw_is_wordpress() )
    $url = site_url( "/wp-admin/post-new.php?post_type=page" );
  else
    $url = site_url( '/node/add/page' );  
  if ( $text ) {
    $text = "Add Page";
  }
  alink( "page", $url, $text, "Add New Page", "" );
  return( bw_ret());
}


/* Others we can consider doing are:
 links
 plugins
 users
 dashboard
 but its not really necessary with WordPress 3.2.1 since there's an admin menu once you're logged in.
 
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


/**
 * Extract unique plugin names from an array of plugins
 *
 * given an array of (active) plugin names return a list of the uniquely downloadable plugins
*/ 
 
function bw_get_unique_plugin_names( $plugins ) {
  $names = array();
  foreach ( $plugins as $plugin ) {
    $name = explode( "/", $plugin );
    // bw_trace( $name, __FUNCTION__, __LINE__, __FILE__, "name" ); 
    $names[$name[0]] = $name[0];
  }
  // bw_trace( $names, __FUNCTION__, __LINE__, __FILE__, "names" );
  sort( $names ); 
  return( $names );            
}

/**
 * get a simple list of plugin names satisfying the option value
 * Note: 'active-plugins' is the only value you can currently use
 *
 */
function bw_plug_list_plugins( $option='active_plugins' ) {
  $plugins = get_option( $option );
  bw_trace( $plugins, __FUNCTION__, __LINE__, __FILE__, "plugins" );
  
  $names = bw_get_unique_plugin_names( $plugins );
  return( $names );
}

/** 
 * Return what might be the plugin name with hyphens and lowercase chars
 * 
 * Strip any tags - the WordPress UI likes adding <br />'s where we don't want them
 */
 
function bw_plugin_namify( $name ) {
  $name = trim( $name );
  $name = str_replace( ' ', '-', $name );
  $name = str_replace( '_', '-', $name );
  $name = strtolower( $name );
  
  return( bw_trace2( $name ) ); 
}  

/** Added [bw_plug name="plugin name" link="URL" table="t/f,y/n,1/0"] shortcode
 *   Format of the output is something like this.
 *   
 *     <a href="wordpress/name" title="$info">$name</a>
 *     <a href="$link" title="Read bw notes on $name" class="bwlink">(...)</a>
 *
 * When the table parameter is set to true then the data is formatted in a table. A table header and footer is added.
 * Instead of coding
 * [bw_plug name='oik' table='y'][bw_plug name='wordpress-google-plus-one-button' table='y']
 * simplify it to 
 * [bw_plug name='oik,wordpress-google-plus-one-button' table='y']
 * In fact - you can omit the table= parameter since it's forced when there's more than one name.
 * 
*/
function bw_plug( $atts ) {
  $name = bw_array_get( $atts, 'name', 'oik' );
  $link = bw_array_get( $atts, 'link', NULL );
  $table = bw_array_get( $atts, 'table', NULL ); 
  $option = bw_array_get( $atts, 'option', NULL );
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  
  $table = bw_validate_torf( $table );
  
  bw_trace( $table, __FUNCTION__, __LINE__, __FILE__, "table" );
  
  if ( !empty( $option ) ) {
    $names = bw_plug_list_plugins( $option );
  } else {
    $name = wp_strip_all_tags( $name, TRUE );
    $names = explode( ",", $name );
  }
  
  // Force table format if there is more than one plugin name listed
  if ( count( $names) > 1 )
    $table = TRUE;
  
  bw_plug_table( $table );

  foreach ( $names as $name ) {
  
    $name = bw_plugin_namify( $name );
  
    $plugininfo = bw_get_plugin_info_cache( $name );
  
    bw_trace( $plugininfo, __FUNCTION__, __LINE__, __FILE__, "plugininfo" );
  
    
    if ( !$plugininfo->name ) {
      if ( $table ) {
        bw_format_table( $name, $link, FALSE );
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
  } 
  bw_plug_etable( $table ); 
  return( bw_ret());  
}

/**
 * table header for bw_plug
 *
 * <table>
 * <tbody>
 * <tr>
 * <th>Plugin name and description</th>
 * <th>Plugin links: WP,homepage,bw notes</th>
 * <th>Version, total downloads, last update</th>
 * </tr>
*/
function bw_plug_table( $table=false ) {
  if ( $table ) {
    stag( "table" );
    stag( "tbody" );
    stag( "tr" );
    th( "Plugin name and description" );
    th( "Plugin links: WP,homepage,bw notes" );
    th( "Version, total downloads, last update, tested" );
    etag( "tr" );
  }  
}

/**
 * table footer for bw_plug 
 */
function bw_plug_etable( $table=false ) { 
  if ( $table ) {
    etag( "tbody" );
    etag( "table" );
  }  
}


function bw_format_default( $name, $link ) {          
  $title = "Link to the $name plugin on wordpress.org" ;
  alink( NULL, "http://wordpress.org/extend/plugins/".$name, $name, $title );  
  if (empty( $link )) {
    $link = "http://www.bobbingwidewebdesign.com/plugins/$name";
  }
  e( "(" );
  alink( "bwlink", $link, "...", "Read bobbing wide's notes on ".$name );
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
 * Cache load of plugin info
 *  
*/ 
function bw_get_plugin_info_cache( $plugin_slug ) {

  $response_xml = wp_cache_get( "bw_plug", $plugin_slug );
  if ( empty( $response_xml )) {
    $response_xml = bw_get_plugin_info( $plugin_slug );
    if ( !empty( $response_xml ) ) {
      wp_cache_set( "bw_plug", $response_xml, $plugin_slug, 43200 );
    }  
  }
  return $response_xml;
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
 

/** Format the bw_plug output as a table with a number of columns
 * 1. plugin name and short description
 * 2. link to plugin, link to plugin's home page, link to [bw]'s notes on the plugin
 * 3. other stuff: version, number times downloaded, last update date, tested up to WP x.x.xx 
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
    
    if (empty( $link )) {
      $link = "http://www.bobbingwidewebdesign.com/plugins/$name";
    }
    alink( "bwlink", $link, "...", "Link to bobbing wide's notes on ".$name );
    etag( "td" );
    
    td( $plugininfo->version . '<br />' . $plugininfo->downloaded . '<br />'. $plugininfo->last_updated . '<br />' . $plugininfo->tested );
  } 
  etag("tr");  
}


/**
 * Load module information for a Drupal module
 * **?** TBD No idea how to get this information at present
 * perhaps I just load it from a bobbingwidewebdevelopment.com/rss feed
 * Drupal.org probably needs to know the node id of the module before it can show detailed stuff.
 */
function bw_get_module_info( $name ) {
  $moduleinfo->name = $name;
  $moduleinfo->short_description = $name;
  return( $moduleinfo );
}


/** 
 * Added [bw_mod name="module name" link="URL" table="t,y/n/1/0"] shortcode
 */
function bw_module( $atts ) {
  $name = $atts['name'];
  $link = $atts['link'];
  $table = $atts['table']; 
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  
  $table = bw_validate_torf( $table );
  
  bw_trace( $table, __FUNCTION__, __LINE__, __FILE__, "table" );
  
  $moduleinfo = bw_get_module_info( $name );
  
  bw_trace( $moduleinfo, __FUNCTION__, __LINE__, __FILE__, "moduleinfo" );
  
  bw_format_modlink( $name, $link, $moduleinfo );
  /*
  if ( !$plugininfo->name ) {
    if ( $table ) {
      bw_format_table( $name, $link, FALSE );
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
  */ 
  return( bw_ret());  
}


/**
  * Create a link to the Drupal module
  * (http://drupal.org/project/
  */
function bw_format_modlink( $name, $link, $moduleinfo ) {  
        
  $title = "Link to the $moduleinfo->name ($name: $moduleinfo->short_description) module on drupal.org" ;
  alink( NULL, "http://drupal.org/project/".$name, $moduleinfo->name, $title );  
  if (empty( $link )) {
    $link = "http://www.bobbingwidewebdevelopment.com/modules/$name";
  }
  e( "(" );
  alink( "bwlink", $link, "...", "Link to bobbing wide's notes on ".$name );
  e( ")" ); 
}






    
        

