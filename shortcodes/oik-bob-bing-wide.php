<?php // (C) Copyright Bobbing Wide 2010-2014
if ( !defined( 'OIK_BOB_BING_WIDE_SHORTCODES_INCLUDED' ) ) {
define( 'OIK_BOB_BING_WIDE_SHORTCODES_INCLUDED', true );

/*
    Copyright 2010-2014 Bobbing Wide (email : herb@bobbingwide.com )

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

oik_require( "bobbcomp.inc" );

function bw_bob( $class = NULL) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_b1 bold">b</span>';
  $bw .= '<span class="bw_o bold">o</span>'; 
  $bw .= '<span class="bw_b2 bold">b</span>';
  $bw .= nullretetag( "span", $class );
  return( $bw );

}

function bw_fob( $class = NULL) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_W bold">f</span>';
  $bw .= '<span class="bw_i2 bold">o</span>'; 
  $bw .= '<span class="bw_d bold">b</span>';
  $bw .= nullretetag( "span", $class );
  return( $bw );

}

function bw_bing( $class = NULL) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_b3 bold">b</span>';
  $bw .= '<span class="bw_i1 bold">i</span>';
  $bw .= '<span class="bw_n bold">n</span>';
  $bw .= '<span class="bw_g bold">g</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
}

function bw_wide( $class=NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_w">w</span>';
  $bw .= '<span class="bw_i2">i</span>';
  $bw .= '<span class="bw_d">d</span>';
  $bw .= '<span class="bw_e">e</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
} 

function bw_bong( $class = NULL) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_w">b</span>';
  $bw .= '<span class="bw_i2">o</span>';
  $bw .= '<span class="bw_d">n</span>';
  $bw .= '<span class="bw_e">g</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
}

function bw_hide( $class = NULL) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_w">h</span>';
  $bw .= '<span class="bw_i2">i</span>';
  $bw .= '<span class="bw_d">d</span>';
  $bw .= '<span class="bw_e">e</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );

}

function bw_wow ( $class = NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_B1">W</span>';
  $bw .= '<span class="bw_o">o</span>';
  $bw .= '<span class="bw_B2">W</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
}

/* These are non-translatable */
function bw_wow_long ( $class = NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="bw_B1">Wonder</span>';
  $bw .= ' ';
  $bw .= '<span class="bw_o">of</span>';
  $bw .= ' ';
  $bw .= '<span class="bw_B2">WordPress</span>';
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
  $s = bw_array_get( $atts, 's', "bw" );
  $tld = bw_array_get( $atts, 't', ".com" );
  $site = bw_array_get( $atts, 'site', "www.bobbingwide" );
  if ( $site == 'www.bobbingwide' ) {
     $text = $site;
     $title = 'Visit the Bobbing Wide website: ';
  } else {
    $text = $site; 
    $title = 'Visit the website: ';
  }     
  $site_s = bw_array_get( $sites, $s, NULL );
  $site .= $site_s;
  $site .= $tld;
  
  if ( $site_s ) 
    $text .= '<b>' . $site_s. '</b>';
  $text .= $tld;  
   
  $link = retlink( 'url', "http://" . $site, $text, $title . $site ) ;
  return( $link );

}

function bw_loik( $atts=null) {
  return( retlink( "bw_loik", "http://www.oik-plugins.com/oik", bw_oik(), "Link to the oik plugin")) ;
} 

function bw_wp( $suffix=false ) {
  $bw = nullretstag( "span", "wordpress"); 
  $bw .= '<span class="bw_word">Word</span>';
  $bw .= '<span class="bw_press">Press</span>';
  if ( $suffix ) {
    $bw .= '<span class="bw_dotorg">.org</span>';
  }
  $bw .= nullretetag( "span", "wordpress" ); 
  return( $bw );
}

function bw_bp( ) {
  $bw = nullretstag( "span", "buddypress"); 
  $bw .= '<span class="bw_buddy">Buddy</span>';
  $bw .= '<span class="bw_bpress">Press</span>';
  $bw .= nullretetag( "span", "buddypress" ); 
  return( $bw );
}


function bw_lwp() {
  alink( "bw_lwp", "http://www.wordpress.org", bw_wp( true ), "Visit WordPress.org" ); 
  return( bw_ret());
}

function bw_lwpms() {
  alink( "bw_lwpms", "http://www.wordpress.org", bw_wpms(), "Visit WordPress.org for MultiSite" ); 
  return( bw_ret());
}

/**
 * Display the "Proudly powered by WordPress" link to WordPress.org
 * <a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress</a>
*/
function bw_power( $atts=null ) {
  alink( "bw_power", "http://www.wordpress.org", __("Proudly powered by WordPress"), __("Semantic Personal Publishing Platform" ) );
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

function bw_wpms( $suffix=false ) {
  $bw = bw_wp( $suffix );
  $bw .= ' ';
  $bw .= '<span class="bw_multisite">Multisite</span>';
  return( $bw );
}
  
function bw_drupal() {
  $bw = '<span class="bw_drupal">Drupal</span>';
  return( $bw );
} 
 
function bw_art( $atts=null, $content=null, $tag=null ) {
  $bw = '<span class="bw_artisteer">Artisteer</span>';
  $version = bw_array_get( $atts, 0, null );
  if ( $version ) {
    oik_require( "shortcodes/oik-blocks.php" );
    $current_setting = bw_artisteer_version( false );
    $actual_setting = bw_artisteer_version( true );
    $bw .= " current=$current_setting";
    $bw .= " actual=$actual_setting";
  }
  return( $bw );
}  


/** 
 * Create an Add Post button. If the text parameter is passed create "Add Post" regardless of the text
 * 
 * Others we can consider doing are: links, plugins, users, dashboard
 * but it's not really necessary with WordPress 3.2.1 and above since there's an admin menu once you're logged in.
 *
*/
function bw_post( $atts ) {
  $text = bw_array_get( $atts, 'text', "Add Post" );
  $img = retimage( null, oik_url( 'images/post_48.png'), $text );
  
  if ( bw_is_wordpress() )
     $url = site_url( "/wp-admin/post-new.php" );
  else 
     $url = site_url( '/node/add/blog' );   
  alink( null, $url, $img, $text );
  return( bw_ret());
}

/** 
 * Create an Add Page button. Similar code to bw_post()
 */
function bw_page( $atts ) {
  $text = bw_array_get( $atts, 'text', "Add Page" );
  $img = retimage( null, oik_url( 'images/page_48.png'), $text );

  if ( bw_is_wordpress() )
    $url = site_url( "/wp-admin/post-new.php?post_type=page" );
  else
    $url = site_url( '/node/add/page' );  
  alink( null, $url, $img, $text);
  return( bw_ret());
}

/** 
 * Create an Edit (custom) CSS button. Similar code to bw_addpost()
 */
function bw_editcss( $atts=null ) {
  oik_require( "admin/oik-admin.inc" );
  $theme = bw_get_theme();
  oik_custom_css( $theme );
  return( bw_ret());
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
 *
 */
function bw_get_plugins() {
  require_once( ABSPATH . "wp-admin/includes/plugin.php" );
  $plugins = get_plugins();
  bw_trace2( $plugins );
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
  //bw_get_plugins();
  return( $names );
}

/**
 * Syntax for bw_plug shortcode
*/ 
function bw_plug__syntax( $shortcode='bw_plug' ) {
  $syntax = array( "name" => bw_skv( 'oik', "<i>plugin-a,plugin-b</i>", "names of plugins to summarise" )
                 , "table" => bw_skv( 'Y', 'N|t|f|1|0', "Show detailed information. Defaults to 'Y' if more than one plugin is listed" )
                 , "option" => bw_skv( '', "active_plugins", "Summarise the activated plugins" )
                 , "link" => bw_skv( 'n', "y|<i>URL</i>", "URL for where to find additional information" )
                 , "banner" => bw_skv( null, "y|j|p", "Display the plugin banner image" )
                 );
  return( $syntax );
}

/**
 * Get the URL structure for the notes page
 * $link can be "true" or "false" or an URL
 * If there is a defined notes_page this value should become the default on the bw_array_get() 
 * NOT the 'n' we're now setting it to. 
 * So we need to reset that logic AND provide the admin page
 * **?** we'll leave this for oik-bob-bing-wide v2 Herb 2012/11/08
 */   
function bw_get_notes_page_url( $link ) {
  $torf = bw_validate_torf( $link );
  if ( $torf ) {
    $link = bw_get_option( "notes_page", "bw_bobbingwide" );  // **?** Not yet implemented
    if ( !$link ) {
      $link = "http://www.bobbingwidewebdesign.com/plugins";  // For some backward compatability
    }  
  } else {
    // It's false so it could have been an URL
    if ( false === strpos( $link, "http" ) ) {
      $link = null;
    }
  }
  bw_trace2( $link, "link", false );
  return( $link );
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
function bw_plug( $atts=null, $content=null, $tag=null ) {
  $name = bw_array_get_from( $atts, 'name,0', 'oik' );
  $link = bw_array_get( $atts, 'link', 'n' );
  $table = bw_array_get( $atts, 'table', NULL ); 
  $option = bw_array_get( $atts, 'option', NULL );
  $banner = bw_array_get( $atts, 'banner', null );
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  
  $table = bw_validate_torf( $table );
  $link = bw_get_notes_page_url( $link );
  
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
  
    $plugininfo = bw_get_plugin_info_cache2( $name );
    bw_trace( $plugininfo, __FUNCTION__, __LINE__, __FILE__, "plugininfo" );
    
    if ( is_wp_error( $plugininfo ) || !$plugininfo || !$plugininfo->name ) {
      if ( $table ) {
        bw_format_plug_table( $name, $link, FALSE );
      }  
      else {
        bw_format_default( $name, $link );
      } 
    }   
    else {
      if ( $table ) {
        bw_format_plug_table( $name, $link, $plugininfo );
      }  
      else {
        bw_format_link( $name, $link, $plugininfo, $banner );
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
 * <th>Plugin links: download,homepage</th>
 * <th>Version, total downloads, last update</th>
 * </tr>
*/
function bw_plug_table( $table=false ) {
  if ( $table ) {
    stag( "table" );
    stag( "tbody" );
    stag( "tr" );
    th( "Plugin name and description" );
    th( "Plugin links" );
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

/**
 * We don't know about this plugin so we assume it's a WordPress one
 * WordPress will do its 404 processing to help us
 * The link to the notes page, if required, may have difficult too
 */
function bw_format_default( $name, $link ) { 
  $title = "Link to the $name plugin on wordpress.org" ;
  alink( NULL, "http://wordpress.org/extend/plugins/".$name, $name, $title );  
  bw_link_notes_page( $name, $link, "(", ")" );
}

/**
 * Get the banner file URL 
 *
 * We have a couple of places where we can find the information about the banner image to display: homepage and oik_server
 * If oik_server contains /oik-plugins/ then we should be able to replace it with /banner/
 * otherwise we have to work from the homepage, stripping anything after /oik-plugins/
 * and replacing it with /banner/$name
 * This is because the oik-plugins server returns the full URL of the oik-plugins page
 * 
 *  
 * Deliver an oik-plugins style image from the oik-plugins server
        // $file = $plugininfo->oik_server ."/banner/" . $name; 
 */
function bw_get_banner_file_URL( $name, $plugininfo ) {
  bw_trace2( );
  $pos = strpos( $plugininfo->oik_server, "/oik-plugins/" );
  if ( $pos === false ) {
    $pos = strpos( $plugininfo->homepage, "/oik-plugins/" );
    if  ( $pos === false ) {
      $file = null;
    } else {
      $file = substr( $plugininfo->homepage, 0, $pos );
      $file .= "/banner/$name";
    }  
  } else {    
    $file = str_replace( "/oik-plugins/", "/banner/", $plugininfo->oik_server );
  }
  bw_trace2( $file, "file" );
  return( $file );
}  

/**
 * Create a plugin banner link 
 */ 
function bw_link_plugin_banner( $name, $plugininfo, $banner ) {
  if ( $banner ) {    
    switch ( strtolower( substr( $banner, 0, 1) ) ) {
      case 'y':
        $file = bw_get_banner_file_URL( $name, $plugininfo );
        if ( $file ) {
          $image = retimage( "bw_banner", $file, $name );
          //alink( "bw_banner", $plugininfo->oik_server, $image, $file );
          // 2014/03/01 - trying homepage again.
          alink( "bw_banner", $plugininfo->homepage, $image, $file );
        } else {
          bw_trace2( "Cannot determine banner file URL" );
        }  
        break;   
      
      case 'p':
        // Deliver a .png style banner image from WordPress.org
        $banner_type = ".png";
        $file = "http://s-plugins.wordpress.org/$name/assets/banner-772x250$banner_type";
        $image = retimage( "bw_banner", $file, $name );
        alink( "bw_banner", "http://wordpress.org/extend/plugins/$name", $image, $file );   
        break;
    
      case 'j':
      default:
        // Deliver a .jpg banner image from WordPress.org
        
        $banner_type = ".jpg"; 
        $file = "http://s-plugins.wordpress.org/$name/assets/banner-772x250$banner_type";
        $image = retimage( "bw_banner", $file, $name );
        alink( "bw_banner", "http://wordpress.org/extend/plugins/$name", $image, $file );   
        break;
    
    }
  }
}

/**
 * Format a link or links to the plugin
 * 
 * When formatting two links they appear as: plugin(notes)
 * 
 * @param string $name - the plugin name
 * @param string $link - link to the notes page URL
 * @param object $plugininfo - plugininfo object - which may also contain oik_server
 */    
function bw_format_link( $name, $link, $plugininfo, $banner=null ) {
  if ( $banner ) {
    sdiv( "bw_plug" );
  } else { 
    span( "bw_plug" );
  }  
  bw_link_plugin_banner( $name, $plugininfo, $banner ); 
  bw_link_plugin_download( $name, $plugininfo );          
  bw_link_notes_page( $name, $link, "(", ")" );
  if ( $banner ) {
    ediv();
  } else {
    epan();
  }  
}

function tdlink( $class=NULL, $url, $text, $title=NULL, $id=NULL ) {
  stag( "td" );
  alink( $classm, $url, $text, $title, $id );
  etag( "td" );
}  

 
/**
 * Cache load of plugin info
 * 
 * - If no response then try our registered plugins
 * - If we can find the server then we try talking to that
 * - If no response then try WordPress 
 * - 
 * Rather than assume it's a WordPress plugin we can check if we know about it
 * by looking in the plugin directory
 *  
*/ 
function bw_get_plugin_info_cache( $plugin_slug ) {
  bw_trace2();
  gobang();

  $response_xml = wp_cache_get( "bw_plug", $plugin_slug );
  if ( empty( $response_xml )) {
    $response = bw_get_oik_plugins_info( $plugin_slug );
    if ( $response ) {
      $response_xml = $response; 
    } else {
      $response_xml = bw_get_plugin_info( $plugin_slug );
    }  
    if ( !empty( $response_xml ) ) {
      wp_cache_set( "bw_plug", $response_xml, $plugin_slug, 43200 );
    }  
  } else {
    bw_trace2( $response_xml, "response_xml from cache" );
  }
  return $response_xml;
}

/**
 * 
 * Some strings cause simplexml_load_string() to produce warning message
 *
 * Warning: simplexml_load_string(): Entity: line 2: parser error : Entity 'rarr' not defined 
 *
 * e.g. The &rarr; from Human Made's wordpressbackup plugin
 *
 *   [Description] => Simple automated backups of your WordPress powered website. 
 *   Once activated you&#8217;ll find me under <strong>Tools &rarr; Backups</strong>. 
 *   <cite>By <a href="http://hmn.md/" title="Visit author homepage">Human Made Limited</a>.</cite>
 *
 * This can be fixed by converting unrecognised entities to numeric entities.
 * e.g   &rarr; becomes &#nnnn; 
 *
 * @link http://stackoverflow.com/questions/3805050/xml-parser-error-entity-not-defined    
 * 
 * @param string $response_xml - the raw XML which may contain HTML entities
 * @return string XML with HTML entities converted to numeric entities 
 */
function _bw_tidy_response_xml( $response_xml ) {
  $response_xml = ent2ncr( $response_xml );
  return( $response_xml );
}

/**
 * Cache load of plugin info - new version
 * 
 * - If no response then try our registered plugins
 * - If we can find the server then we try talking to that
 * - If no response then try WordPress 
 * - 
 * Rather than assume it's a WordPress plugin we can check if we know about it
 * by looking in the plugin directory
 * 
 */ 
function bw_get_plugin_info_cache2( $plugin_slug ) {
  bw_trace2();
  $response_xml = wp_cache_get( "bw_plug2", $plugin_slug );
  if ( empty( $response_xml )) {
    $response = bw_get_oik_plugins_info( $plugin_slug );
    if ( $response ) {
      $response_xml = null;
    } else {
      $response_xml = bw_get_plugin_info2( $plugin_slug );
    }  
    if ( !empty( $response_xml ) ) {
      $response_xml = _bw_tidy_response_xml( $response_xml ); 
      wp_cache_set( "bw_plug2", $response_xml, $plugin_slug, 43200 );
    }  
  } else {
    bw_trace2( $response_xml, "response_xml from cache" );
  }
  bw_trace2( $response_xml, "response_xml" );
  
  if ( $response_xml ) {
    $simple_xml = simplexml_load_string( $response_xml );   
  } else {  
    $simple_xml = $response;
  }  
  return ($simple_xml );
}


/**
 * Get defined plugin server
 */
function bw_get_defined_plugin_server( $plugin_slug ) {
  $plugin = bw_get_option( $plugin_slug, "bw_plugins" );
  bw_trace2( $plugin, "plugin", false );
  if ( $plugin ) { 
    $server = bw_array_get_dcb( $plugin, "server", null, "oik_get_plugins_server" );
    if ( !$server ) {
      $server = oik_get_plugins_server();
    }
  } else {
    $server = null;
  }
  bw_trace2( $server, "plugin server" );
  return( $server );
}

/**
 * Return information on an oik-plugins plugin.
 * 
 * perhaps we should switch to the php serialized version... it could be easier **?**
 * 
 * @param string $plugin_slug - the plugin slug e.g. oik-fields
 * @return object - a plugininfo structure
 * 
 */
function bw_get_oik_plugins_info( $plugin_slug ) {
  oik_require( "admin/oik-admin.inc" );
  oik_require( "includes/oik-remote.inc" );
  $server = bw_get_defined_plugin_server( $plugin_slug ); 
  if ( $server ) {
    oik_register_plugin_server( $plugin_slug, $server );
    $result = oik_lazy_pluginsapi( false, "plugin_information", array( "slug" => $plugin_slug) );
    if ( $result ) {
      $result->oik_server = $server;
    }
  } else {
    $result = false; 
  }
  bw_trace2( $result ); 
  return( $result ); 
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

/**
 *  bw_get_plugin_info2(4) plugin_data Array
(
    [Name] => oik-nivo-slider
    [PluginURI] => http://www.oik-plugins.com/oik-plugins/oik-nivo-slider/
    [Version] => 1.9
    [Description] => [nivo] shortcode for the Nivo slider using oik <cite>By <a href="http://www.bobbingwide.com" title="Visit author homepage">bobbingwide</a>.</cite>
    [Author] => <a href="http://www.bobbingwide.com" title="Visit author homepage">bobbingwide</a>
    [AuthorURI] => http://www.bobbingwide.com
    [TextDomain] => 
    [DomainPath] => 
    [Network] => 
    [Title] => <a href="http://www.oik-plugins.com/oik-plugins/oik-nivo-slider/" title="Visit plugin homepage">oik-nivo-slider</a>
    [AuthorName] => bobbingwide
)

These come from the readme.txt file

Requires at least: 3.5
Tested up to: 3.6


<?xml version="1.0" encoding="utf-8"?>
<plugin>
<name type="string">
<![CDATA[ oik-nivo-slider ]]></name>
<slug type="string"><![CDATA[ oik-nivo-slider ]]></slug>
<version type="string"><![CDATA[ 1.8 ]]> </version>
<author type="string">  <![CDATA[<a href="http://www.bobbingwide.com">bobbingwide</a> ]]> </author>
<author_profile type="string"><![CDATA[ http://profiles.wordpress.org/bobbingwide ]]>    </author_profile>   <contributors type="array">  <bobbingwide type="string">  <![CDATA[ http://profiles.wordpress.org/bobbingwide ]]>
</bobbingwide>
</contributors>
<requires type="string">
<![CDATA[ 3.3 ]]>
</requires>
<tested type="string">
<![CDATA[ 3.5.2 ]]>
</tested>


<rating type="double">73.4</rating>
<num_ratings type="integer">12</num_ratings>
<downloaded type="integer">56775</downloaded>

<last_updated type="string">
<![CDATA[ 2013-02-21 ]]>
</last_updated>
<added type="string">
<![CDATA[ 2012-04-11 ]]>
</added>
<homepage type="string">
<![CDATA[
http://www.oik-plugins.com/oik-plugins/oik-nivo-slider/
]]>
</homepage>
*/

/**
 *
 */
function bw_add_xml_child( &$xml, $plugin_data, $src, $target=null ) {
  if ( !$target ) {
    $target = strtolower( $src );
  }  
  $value = bw_array_get( $plugin_data, $src, null ); 
  $xml->addChild( $target, $value ); 
}  
 
/**
 * Get local plugin info XML
 *
 * Loads the plugin information from the plugin file, if available
 * If the PluginURI is not wordpress.org then either set 
 * oik_server if defined or set plugin_server to "unknown"
 * 
 * @param string $plugin_slug - the name of the plugin we're looking for
 * @return array consisting of xml_string and server
 */
function bw_get_local_plugin_xml( $plugin_slug ) {
  $xml_string = null;
  $server = null;
  $plugin_data = bw_get_plugin_data( $plugin_slug );
  if ( $plugin_data ) {
    $pluginURI = bw_array_get( $plugin_data, "PluginURI", null );
    $url = parse_url( $pluginURI );
    if ( $url['host'] != "wordpress.org" ) { 
    
      $xml = new SimpleXmlElement( "<plugin></plugin>" );
      //$plugin = $xml->plugin;
      
      bw_trace2( $xml );
      bw_add_xml_child( $xml, $plugin_data, "Name" ) ;
      bw_add_xml_child( $xml, $plugin_data, "Name", "slug" );
      bw_add_xml_child( $xml, $plugin_data, "Version" );
      bw_add_xml_child( $xml, $plugin_data, "PluginURI", "homepage" );
      bw_add_xml_child( $xml, $plugin_data, "Description", "short_description" );
      $server = bw_get_defined_plugin_server( $plugin_slug ); 
      if ( $server ) {
        $plugin_data["PluginURI"] = "$server/oik-plugins/$plugin_slug/";
        bw_add_xml_child( $xml, $plugin_data, "PluginURI", "oik_server" );
      } else {
        // don't set oik_server yet
        $xml->addChild( "plugin_server", "unknown" ); 
      } 
      $readme_data = bw_get_readme_data( $plugin_slug ); 
      bw_add_xml_child( $xml, $readme_data, "Tested" );
      bw_add_xml_child( $xml, $readme_data, "Last_updated" );
      
      $xml_string = $xml->asXML();
    }  
  } else {
    // Never mind - assume WordPress.org ?
  }   
  return( array( $xml_string, $server) );  
} 

/** 
 * Obtain the "Tested up to" information and, if available "Last updated" from the readme.txt file
 * e.g. 
 *  Tested up to: 3.6
 *  Last updated: some form of date string
 * 
 */
function bw_get_readme_data( $plugin_slug ) {
  require_once( ABSPATH . "wp-admin/includes/plugin.php" );
  $file = oik_path( "readme.txt" , $plugin_slug ); 
  if ( file_exists( $file ) ) {
    $headers = array( "Tested" => "Tested up to" 
                    , "Last_updated" => "Last updated" 
                    );
    $readme_data = get_file_data( $file, $headers, 'plugin' );
    if ( !$readme_data['Last_updated'] ) {
      $readme_data['Last_updated'] = bw_format_date( filemtime( $file ));
    }
  } else {
    $readme_data = null;
  }    
  bw_trace2( $readme_data, "readme_data" );
  return( $readme_data );
}  

/** 
 *
 */
function bw_get_plugin_data( $plugin_slug ) {

  require_once( ABSPATH . "wp-admin/includes/plugin.php" );
  $file = oik_path( "$plugin_slug.php" , $plugin_slug ); 
  if ( file_exists( $file ) ) {
    $plugin_data = get_plugin_data( $file );
  } else {
    $plugin_data = null;
  }    
  bw_trace2( $plugin_data, "plugin_data" );
  return( $plugin_data );
}

/**
 * Analyze the response from bw_remote_get2()
 *
 * WordPress.org may reply with an empty XML block
 * which is going to be less than 70 characters
 *
   <?xml version="1.0" encoding="utf-8"?>
   <plugin>
   <NULL /></plugin>
 
 * @param string $response_xml2 from wordpress.org
 * @param string $response_xml from the plugin data  
 * @returns string - the wordpress.org string if it contains data  
 */
function bw_analyze_response_xml2( $response_xml2, $response_xml ) {
  if ( $response_xml2 && strlen( $response_xml2 ) >= 70 ) {
    bw_trace2( $response_xml2, "response_xml2" );
    $response_xml = $response_xml2;
  }
  return( $response_xml );
}

/** 
 * Get plugin information in XML format for cacheing
 *
 * If the plugin is installed locally we can obtain the information from the plugin data
 * BUT this doesn't necessarily tell us if it's hosted on WordPress.org
 * 
 * A null response from bw_get_local_plugin_xml() tells us it's either hosted on wordpress.org OR we don't know about the plugin.
 * 
 * If the oik_server is set then we don't bother accessing WordPress.org but point to the oik server.
 * For plugins that are dual hosted ( wordpress.org and an oik server) then it all depends on what's in the current setting for the plugin server.
 *
 * response_xml oik_server action
 * ------------ ---------- ---------------------------------
 * null         null       find information from wordpress.org
 * null         set        NOT possible
 * set          null       possibly find information from wordpress.org
 * set          set        don't bother
 *
 */
function bw_get_plugin_info2( $plugin_slug ) {
  list( $response_xml, $oik_server ) = bw_get_local_plugin_xml( $plugin_slug );
  //bw_trace( $response_xml, __FUNCTION__, __LINE__, __FILE__, "response_xml" );
  if ( $oik_server ) {
    // We found the plugin information and also know that it's an oik server
  } else {
    // We may have found the plugin information OR believe it's wordpress.org
    // let's check wordpress.org. If we find some information overwrite what we already know.
    $request_url = "http://api.wordpress.org/plugins/info/1.0/$plugin_slug.xml";
    $response_xml2 = bw_remote_get2( $request_url ); //, null );
    $response_xml = bw_analyze_response_xml2( $response_xml2, $response_xml );
  }
  //bw_trace( $response_xml, __FUNCTION__, __LINE__, __FILE__, "response_xml" );
  return $response_xml;
}

/**
 * Create a link to the plugin's download page
 *
 * The link to the download page is determined from a number of fields in the plugininfo structure
 * which get set as we're trying to find out about the plugin.
 *
 * oik_server  plugin_server  link to set 
 * ----------  -------------  -------------------------
 * null        "unknown"      $homepage - since this is neither a wordpress.org or "oik" plugin
 * null        not set        wordpress.org/extend/plugins/$name
 * set         n/a            oik_server 
 *
 * @param string $name - the plugin slug name e.g. oik, jetpack, woocommerce
 * @param mixed $plugininfo - some form of SimpleXMLElement Object 
 * @return string - the download page URL... which may have a trailing slash
 * 
 */
function bw_link_plugin_download( $name, $plugininfo ) {
  $title = "Link to the $plugininfo->name ($name: $plugininfo->short_description) plugin" ;
  $download_page = bw_array_get( $plugininfo, "oik_server", null );
  if ( !$download_page ) {
    $plugin_server = bw_array_get( $plugininfo, "plugin_server", null );
    if ( $plugin_server == "unknown" ) {
      $download_page = bw_array_get( $plugininfo, "homepage", null );
    } else { 
      $download_page = "http://wordpress.org/extend/plugins/".$name;
    }
  } else {
    $download_page = bw_array_get( $plugininfo, "homepage", $download_page );
  }
  alink( "plugin", $download_page , $plugininfo->slug, $title );
  return( $download_page );  
}

/** 
 * Create a link to the notes page.
 */
function bw_link_notes_page( $name, $link, $lp=null, $rp=null ) {
  if ( $link ) {
    $link .= "/";
    $link .= $name;
    e( $lp );
    alink( "bwlink", $link, "...", "Link to notes on ".$name );
    e( $rp ); 
  }  
}

/** Format the bw_plug output as a table with a number of columns
 * 1. plugin name and short description
 * 2. link to plugin, link to plugin's home page, link to [bw]'s notes on the plugin
 * 3. other stuff: version, number times downloaded, last update date, tested up to WP x.x.xx 
 */  
function bw_format_plug_table( $name, $link, $plugininfo ) {
  stag( "tr");
  if ( $plugininfo === FALSE ) {
    td( $name );
    td( "No info available" );
    td( "&nbsp;" );
    }
  else {
    stag( "td" );
    strong( $plugininfo->name );
    br();
    e( $plugininfo->short_description );
    etag( "td" );
    stag( "td" );
    $download_page = bw_link_plugin_download( $name, $plugininfo );
    if ( $download_page != $plugininfo->homepage ) {
      br();
      alink( "home", $plugininfo->homepage, "home", "Link to plugin homepage" ); 
    }  
    br();
    bw_link_notes_page( $name, $link );
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
  $name = bw_array_get( $atts, 'name', "oik" );
  $link = bw_array_get( $atts, 'link', "http://www.bobbingwide.com" );
  $table = bw_array_get( $atts, 'table', "n" ); 
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  
  $table = bw_validate_torf( $table );
  
  bw_trace( $table, __FUNCTION__, __LINE__, __FILE__, "table" );
  
  $moduleinfo = bw_get_module_info( $name );
  
  bw_trace( $moduleinfo, __FUNCTION__, __LINE__, __FILE__, "moduleinfo" );
  
  bw_format_modlink( $name, $link, $moduleinfo );
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

/**
 * No longer needed - ticket #17657 has been fixed 
function wp1( $atts=NULL) {
  return( 'wp1 done');
} 
function wp2( $atts=NULL) {
  return( 'wp2 done');
}  
function wp3( $atts=NULL) {
  return( 'wp3 done');
}  
*/

} /* End if !defined() */
