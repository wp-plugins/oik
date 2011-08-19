<?php // (C) Copyright Bobbing Wide 2011


/*
Plugin Name: oik tides
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use shortcode macro for tide times [bw_tides]
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


/**
  * Code copied and cobbled from http://snippet.me/wordpress/wordpress-plugin-info-api/
  * having referred to http://ckon.wordpress.com/2010/07/20/undocumented-wordpress-org-plugin-api/
  * get XML information using simple xml load file
  */
function bw_get_tide_info( $tide_url ) {
  $request_url = urlencode($tide_url);
  $response_xml = simplexml_load_file($request_url);
  bw_trace( $response_xml, __FUNCTION__, __LINE__, __FILE__, "response_xml" );
  return $response_xml;
}

add_shortcode( 'bw_tides', 'bw_tides' );


/**
 * Obtain tide information using the shortcode [bw_tides tide_url='tide feed xml url']
 * The format of the feed is expected to be as in the following output from bw_trace
 
 

C:\apache\htdocs\wordpress\wp-content\plugins\oik\oik-tides.php(45:0) 2011-04-29T12:11:51+00:00 bw_get_tide_info  response_xml SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [version] => 2.0
        )

    [channel] => SimpleXMLElement Object
        (
            [title] => Chichester Harbour Tide Times
            [link] => http://www.tidetimes.org.uk/Chichester_Harbour.html
            [description] => Chichester Harbour tide times.
            [lastBuildDate] => Fri, 29 Apr 2011 00:25:00 GMT
            [language] => en-gb
            [item] => SimpleXMLElement Object
                (
                    [title] => Chichester Harbour tide times for 29th April 2011
                    [link] => http://www.tidetimes.org.uk/Chichester_Harbour.html
                    [guid] => http://www.tidetimes.org.uk/Chichester_Harbour.html
                    [pubDate] => Fri, 29 Apr 2011 00:25:00 GMT
                    [description] => Tide times and height information for<br/>Chichester Harbour on 29th April 2011.<br/><br/>01:58 - Low Tide, 1.6m<br/>09:14 - High Tide, 3.9m<br/>14:17 - Low Tide, 1.5m<br/>21:36 - High Tide, 4.2m<br/><br/>
                )

        )

)

as of 4th May the tideinfo->channel->item->description appeared to have additional Google Ad stuff


C:\apache\htdocs\wordpress\wp-content\plugins\oik\oik-tides.php(45:0) 2011-05-04T03:17:51+00:00 bw_get_tide_info  response_xml SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [version] => 2.0
        )

    [channel] => SimpleXMLElement Object
        (
            [title] => Chichester Harbour Tide Times
            [link] => http://www.tidetimes.org.uk/Chichester_Harbour.html
            [description] => Chichester Harbour tide times.
            [lastBuildDate] => Tue, 3 May 2011 00:08:00 GMT
            [language] => en-gb
            [item] => SimpleXMLElement Object
                (
                    [title] => Chichester Harbour Tide Times for 4th May 2011
                    [link] => http://www.tidetimes.org.uk/Chichester_Harbour.html
                    [guid] => http://www.tidetimes.org.uk/Chichester_Harbour.html
                    [pubDate] => Tue, 3 May 2011 00:08:00 GMT
                    [description] => <b>Chichester Harbour Tide Times:</b><br/>High Tides: 00:50 (4.50m), 13:13 (4.50m)<br/>Low Tides: 06:06 (1.00m), 18:18 (1.20m).<br/><a href="http://www.tidetimes.org.uk/Chichester_Harbour.html" title="Chichester Harbour Tide Times">http://www.tidetimes.org.uk/Chichester_Harbour.html</a><br/><br/><script type="text/javascript"> google_ad_client = "ca-pub-4314088479570355"; google_ad_slot = "4669933729"; google_ad_width = 234; google_ad_height = 60; </script><script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                )

        )

)
 
*/

function bw_time_of_day_secs() {
  extract( localtime( time(), true ));
  $secs = ((($tm_hour * 60) + $tm_min) * 60) + $tm_sec;
  bw_trace( $secs, __FUNCTION__, __LINE__, __FILE__, 'secs' );
  return( $secs );
}  


/**
 * display information about high and low tides obtained from www.tidetimes.org.uk
 * the data is stored as transient data until midnight, after which we expect new figures for the next day
 * If the site is going to display more than one set of tide information then you will need to indicate
 * a special code for storing the information. I would have liked to have extracted the location from the
 * tideurl but got distracted with set_transient crashing when passed a SimpleXML object.
 */                                                                        
function bw_tides( $atts ) {

  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, 'atts');
  extract( shortcode_atts( array(
      'tideurl' => 'http://www.tidetimes.org.uk/Chichester_Harbour.rss',
      'store' => '1', 
      ), $atts ) );
      
  bw_trace( $tideurl, __FUNCTION__, __LINE__, __FILE__, 'tideurl' );
  bw_trace( $store, __FUNCTION__, __LINE__, __FILE__, 'store' ); 
  
  $desc = get_transient( 'bw_tides_desc_'. $store );
  $title = get_transient( 'bw_tides_title_'. $store );      
  $link = get_transient( 'bw_tides_link_'. $store );
  
  if ( $desc === FALSE || $title === FALSE || $link === FALSE  ) {
    $tideinfo = bw_get_tide_info( $tideurl );
    $channel = $tideinfo->channel;    
    bw_trace( $channel, __FUNCTION__, __LINE__, __FILE__, 'channel');
    $link = (string) $channel->link;   
    bw_trace( $desc, __FUNCTION__, __LINE__, __FILE__, 'desc');

    /* We may need to strip some unwanted advertising which appears in an anchor tag <a */
    $desc = $channel->item->description;
    $desc = preg_replace('/<a (.*?)<\/a>/', "\\2", $desc);
    $allowed = array( 'b' => array(),
                      'br' =>  array()
                    );  
    $desc = wp_kses( $desc, $allowed );
    $title = (string) $channel->item->title;  
    // $title = $channel->item->title;   uncomment this to cause set_transient to fail
    
    $secs = bw_time_of_day_secs();
    $secs = 86400 - $secs;
    set_transient( "bw_tides_desc_" . $store, $desc, $secs);
    set_transient( "bw_tides_title_" . $store, $title, $secs);
    set_transient( "bw_tides_link_" . $store, $link, $secs);
  }
  else {
     // We got all the data from the transient store     
  }  

  bw_trace( $desc, __FUNCTION__, __LINE__, __FILE__, 'desc');
  bw_trace( $title, __FUNCTION__, __LINE__, __FILE__, 'title');
  bw_trace( $link, __FUNCTION__, __LINE__, __FILE__, 'link');

  alink( "tides", $link , $desc , $title ); 
  
  
  return( bw_ret());

}
