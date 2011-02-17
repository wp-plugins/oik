<?php

/*
Plugin Name: oik base plugin 
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use shortcode macros for often included key-information 
Author: bobbingwide
Version: 0.3
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
global $bw_options;


//echo '<p>BATa='.$bwapi_trace_test.'=aBAT</p>';

function oik_version() {
  return '0.3';
}

  require_once( "bobbfunc.inc" );
  require_once( "bobblink.inc" );
  require_once( "bobbcomp.inc" );
  require_once( "bwlink.inc" );
  require_once( "bobbgoog.inc" ); 
  
  $bobb_prefix = NULL;
  $bw_echo = NULL;
                    
  $theme = "bobbingwide";     
  $art_theme = NULL;
  $bobb_theme = NULL;    
  
  require_once( "oik-shortc-shortcodes.php" );



/* Shortcodes for each of the more useful "often included key-information" fields 
   in Bobbing Wide's Wonder of WordPress websites
*/
add_shortcode( 'bw', 'bw' );
add_shortcode( 'bw_address', 'bw_address');
add_shortcode( 'bw_mailto', 'bw_mailto' );
add_shortcode( 'bw_email', 'bw_email' );
add_shortcode( 'bw_geo', 'bw_geo' );
add_shortcode( 'bw_telephone', 'bw_telephone' );
add_shortcode( 'bw_fax', 'bw_fax' );
add_shortcode( 'bw_mobile', 'bw_mobile' );
add_shortcode( 'bw_wpadmin', 'bw_wpadmin' );
add_shortcode( 'bw_show_googlemap', 'bw_show_googlemap');
add_shortcode( 'bw_contact', 'bw_contact' );

add_shortcode( 'bw_twitter', 'bw_twitter' );
add_shortcode( 'bw_facebook', 'bw_facebook' );
add_shortcode( 'bw_linkedin', 'bw_linkedin' );
add_shortcode( 'bw_youtube', 'bw_youtube' );
add_shortcode( 'bw_flickr', 'bw_flickr' );
add_shortcode( 'bw_picasa', 'bw_picasa' );


add_shortcode( 'bw_company', 'bw_company' );
add_shortcode( 'bw_business', 'bw_business' );
add_shortcode( 'bw_formal', 'bw_formal' );
add_shortcode( 'bw_slogan', 'bw_slogan' );
add_shortcode( 'bw_alt_slogan', 'bw_alt_slogan' );
add_shortcode( 'bw_admin', 'bw_admin' );
add_shortcode( 'bw_domain', 'bw_domain' );

// add_shortcode( 'div', 'bw_div' );
// add_shortcode( 'ediv', 'bw_ediv' );

add_shortcode( 'clear', 'bw_clear' );


add_filter('widget_text', 'do_shortcode');
add_filter('the_title', 'do_shortcode' ); 
//add_filter('wpbody-content', 'do_shortcode' );

add_filter('get_the_excerpt', 'do_shortcode' );
add_filter('the_excerpt', 'do_shortcode' );
add_filter('the_content', 'do_shortcode' );
//add_filter('get_pages', 'do_shortcode' );


// In which sequence should these go?
// trying api, bobbingwide then bwlink

$bw_options = get_option( 'bw_options' );

wp_enqueue_style( 'oikCSS', WP_PLUGIN_URL . '/oik/oik.css' ); 
wp_enqueue_style( 'bwlinkCSS', WP_PLUGIN_URL . '/oik/bwlink.css' ); 

$customCSS =  bw_get_company( 'customCSS' );
if ( !empty( $customCSS) )
  wp_enqueue_style( 'customCSS', get_theme_root_uri() . $customCSS);


add_action('admin_init', 'oik_options_init' );
add_action('admin_menu', 'oik_options_add_page');

// Init plugin options 
function oik_options_init(){
	register_setting( 'oik_options_options', 'bw_options', 'oik_options_validate' );
}

// Add the options page
function oik_options_add_page() {
	add_options_page('[bw] Options', 'oik options', 'manage_options', 'bw_options', 'oik_options_do_page');
}



// Draw the oik options page 
function oik_options_do_page() {
  require_once( "bobbforms.inc" );
  sdiv( "column span-15 wrap" );
  h2( bw(). " shortcode options" );
  e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_options');     
  stag( "table" );
  bw_flush();
  settings_fields('oik_options_options'); 
  
    textfield( "bw_options[telephone]", 50, "Telephone [bw_telephone]", $options['telephone']  );
    textfield( "bw_options[fax]", 50, "Fax [bw_fax]", $options['fax']  );
    textfield( "bw_options[mobile]", 50, "Mobile [bw_mobile]", $options['mobile']  );
    
    textfield( "bw_options[company]", 50, "Company [bw_company]", $options['company']  );
    textfield( "bw_options[business]", 50, "Business [bw_business]", $options['business']  );
    textfield( "bw_options[formal]", 50, "Formal [bw_formal]", $options['formal']  );
    
    textfield( "bw_options[main-slogan]", 50, "Main slogan [bw_slogan]", $options['main-slogan']  );
    textfield( "bw_options[alt-slogan]", 50, "Alt. slogan [bw_alt_slogan]", $options['alt-slogan']  );
    
    textfield( "bw_options[contact]", 50, "Contact [bw_contact]", $options['contact']  );
    textfield( "bw_options[email]", 50, "Email [bw_mailto]/[bw_email]", $options['email']  );
    textfield( "bw_options[admin]", 50, "Admin [bw_admin]", $options['admin']  );
    
    // extended-address e.g.  Bobbing Wide
    // street-address   e.g.  41 Redhill Road
    // locality         e.g   Rowlands Castle
    // region           e.g.  HANTS
    // postal-code      e.g.  PO9 6DE                        
    // country-name     e.g.  UK 


    textfield( "bw_options[extended-address]", 50, "Extended-address [bw_address]", $options['extended-address']  );
    textfield( "bw_options[street-address]", 50, "Street-address", $options['street-address']  );
    textfield( "bw_options[locality]", 50, "Locality", $options['locality']  );
    textfield( "bw_options[region]", 50, "Region", $options['region']  );
    textfield( "bw_options[postal-code]", 50, "Post code", $options['postal-code']  );
    textfield( "bw_options[country-name]", 50, "Country name", $options['country-name']  );
                         
    textfield( "bw_options[lat]", 50, "Latitude [bw_geo]", $options['lat']  );
    textfield( "bw_options[long]", 50, "Longitude", $options['long']  );
    
    // ABQIAAAAEraXBMl-kX5b-Swk0AR98BQiFdr9vy7axdrApFjkJGV6ZRaqtxRqjZfTaNvU9q3jxZ50yMHK-mrzag
    textfield( "bw_options[google_maps_api_key]", 87, "Google Maps API key [bw_show_googlemap]", $options['google_maps_api_key']  );
    textfield( "bw_options[width]", 10, "Google Map width", $options['width']  );
    textfield( "bw_options[height]", 10, "Google Map height", $options['height']  );
    

    textfield( "bw_options[domain]", 50, "Domain [bw_domain] [bw_wpadmin]", $options['domain']  );
    textfield( "bw_options[customCSS]", 50, "Custom CSS (in theme directory " . get_theme_root_uri(), $options['customCSS'] );
    
    textfield( "bw_options[twitter]", 50, "Twitter URL [bw_twitter]", $options['twitter'] );
    textfield( "bw_options[facebook]", 50, "Facebook URL [bw_facebook]", $options['facebook'] );
    textfield( "bw_options[linkedin]", 50, "LinkedIn URL [bw_linkedin]", $options['linkedin'] );
    textfield( "bw_options[youtube]", 50, "YouTube URL [bw_youtube]", $options['youtube'] );
    textfield( "bw_options[flickr]", 50, "Flickr URL [bw_flickr]", $options['flickr'] );
    textfield( "bw_options[picasa]", 50, "Picasa URL [bw_picasa]", $options['picasa'] );
    
    textfield( "bw_options[paypal-email]", 50, "PayPal email [bw_paypal]", $options['paypal-email'] );
    
    
tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 

  etag( "table" ); 			
  etag( "form" );
  
  ediv(); 
  sdiv("column span-5 last");
  p("Use the shortcode options in your pages, widgets and titles. e.g." );
  p("[bw_address] to print your address" );
  p( bw_address());
  p("For more information:" );
  art_button( "http://www.bobbingwidewebdesign.com/oik", "oik documentation", "Read the documentation for the oik plugin" );
   
  ediv(); 
  bw_flush();
}


// Sanitize and validate input. Accepts an array, return a sanitized array.
function oik_options_validate($input) {
	// Our first value is either 0 or 1
	//$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	//$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}

    
require_once( 'bwtrace.inc' );
//echo '<p>BAT='.$bwapi_trace_test.'=BAT</p>';
bwapi_trace_test( 'oik' );




