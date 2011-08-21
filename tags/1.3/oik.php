<?php

/*
Plugin Name: oik base plugin 
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: Easy to use shortcode macros for often included key-information 
Version: 1.3
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
global $bw_options;


//echo '<p>BATa='.$bwapi_trace_test.'=aBAT</p>';
/* All of the oik plugins and many of the common functions include calls to bw_trace so we
   need to include it
*/   
    
  require_once( 'bwtrace.inc' );
  require_once( "bobbfunc.inc" );
  require_once( "bobblink.inc" );
  require_once( "bobbcomp.inc" );
  require_once( "bwlink.inc" );
  require_once( "bobbgoog.inc" ); 
  
function oik_version() {
  return bw_oik_version();
}
  
  $bobb_prefix = NULL;
  $bw_echo = NULL;
                    
  $theme = "bobbingwide";     
  $art_theme = NULL;
  $bobb_theme = NULL;    
  
  require_once( "oik-shortc-shortcodes.php" );
  require_once( "oik-add-shortcodes.php" );

  add_filter('widget_text', 'do_shortcode');
  add_filter('the_title', 'do_shortcode' ); 
  //add_filter('wpbody-content', 'do_shortcode' );
  add_filter('wp_footer', 'do_shortcode' );

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
function oik_options_init() {
  register_setting( 'oik_options_options', 'bw_options', 'oik_options_validate' );
}

// Add the options page
function oik_options_add_page() {
  add_options_page('[oik] Options', 'oik options', 'manage_options', 'bw_options', 'oik_options_do_page');
}

// Draw the oik options page 
function oik_options_do_page() {
  require_once( "bobbforms.inc" );
  sdiv( "column span-15 wrap" );
  h2( bw_oik(). " shortcode options" );
  e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_options');     
  
  stag( 'table class="form-table"' );
  bw_flush();
  settings_fields('oik_options_options'); 
  
  textfield( "bw_options[telephone]", 50, "Telephone [bw_telephone] / [bw_tel]", $options['telephone']  );
  textfield( "bw_options[fax]", 50, "Fax [bw_fax]", $options['fax']  );
  textfield( "bw_options[mobile]", 50, "Mobile [bw_mobile] / [bw_mob]", $options['mobile']  );
  
  textfield( "bw_options[company]", 50, "Company [bw_company]", $options['company']  );
  textfield( "bw_options[business]", 50, "Business [bw_business]", $options['business']  );
  textfield( "bw_options[formal]", 50, "Formal [bw_formal]", $options['formal']  );
  
  textfield( "bw_options[main-slogan]", 50, "Main slogan [bw_slogan]", $options['main-slogan']  );
  textfield( "bw_options[alt-slogan]", 50, "Alt. slogan [bw_alt_slogan]", $options['alt-slogan']  );
  
  textfield( "bw_options[contact]", 50, "Contact [bw_contact]", $options['contact']  );
  textfield( "bw_options[email]", 50, "Email [bw_mailto]/[bw_email]", $options['email']  );
  textfield( "bw_options[admin]", 50, "Admin [bw_admin]", $options['admin']  );
  textfield( "bw_options[contact-link]", 50, "Contact button page permalink [bw_contact_button]", $options['contact-link'] );
  textfield( "bw_options[contact-text]", 50, "Contact button text ", $options['contact-text'] );
  textfield( "bw_options[contact-title]", 50, "Contact button tooltip", $options['contact-title'] );

  
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
                       
  textfield( "bw_options[lat]", 50, "Latitude [bw_geo] [bw_directions]", $options['lat']  );
  textfield( "bw_options[long]", 50, "Longitude", $options['long']  );
  
  // ABQIAAAAEraXBMl-kX5b-Swk0AR98BQiFdr9vy7axdrApFjkJGV6ZRaqtxRqjZfTaNvU9q3jxZ50yMHK-mrzag
  textfield( "bw_options[google_maps_api_key]", 87, "Google Maps API key [bw_show_googlemap]", $options['google_maps_api_key']  );
  textfield( "bw_options[width]", 10, "Google Map width", $options['width']  );
  textfield( "bw_options[height]", 10, "Google Map height", $options['height']  );
  

  textfield( "bw_options[domain]", 50, "Domain [bw_domain] [bw_wpadmin]", $options['domain']  );
  textfield( "bw_options[customCSS]", 50, "Custom CSS in theme directory " . get_theme_root_uri(), $options['customCSS'] );
  
  textfield( "bw_options[twitter]", 50, "Twitter URL [bw_twitter]", $options['twitter'] );
  textfield( "bw_options[facebook]", 50, "Facebook URL [bw_facebook]", $options['facebook'] );
  textfield( "bw_options[linkedin]", 50, "LinkedIn URL [bw_linkedin]", $options['linkedin'] );
  textfield( "bw_options[googleplus]", 50, "Google Plus URL [bw_googleplus]", $options['googleplus'] );
  textfield( "bw_options[youtube]", 50, "YouTube URL [bw_youtube]", $options['youtube'] );
  textfield( "bw_options[flickr]", 50, "Flickr URL [bw_flickr]", $options['flickr'] );
  textfield( "bw_options[picasa]", 50, "Picasa URL [bw_picasa]", $options['picasa'] );
  textfield( "bw_options[skype]", 50, "Skype Name [bw_skype]", $options['skype'] );
  
  
  textfield( "bw_options[paypal-email]", 50, "PayPal email [bw_paypal]", $options['paypal-email'] );
  
  $upload_dir = wp_upload_dir();
  $baseurl = $upload_dir['baseurl'];
    
  textfield( "bw_options[logo-image]", 50, "Logo image [bw_logo] in uploads: " . $baseurl, $options['logo-image'] );
  textfield( "bw_options[qrcode-image]", 50, "QR code image [bw_qrcode] in uploads", $options['qrcode-image'] );
    
  tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 

  etag( "table" ); 			
  etag( "form" );
  
  ediv(); 
  sdiv("column span-6 wrap last");
  
  h2( "Usage notes" );
  p("Use the shortcode options in your pages, widgets and titles. e.g." );
  p("[bw_telephone] for your telephone number" );
  p( bw_telephone() );
  p("[bw_address] to print your address" );
  p( bw_address());
  p( "[bw_follow_me] for ALL your Follow me buttons" );
  p( bw_follow_me() );
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

//echo '<p>BAT='.$bwapi_trace_test.'=BAT</p>';
//bwapi_trace_test( 'oik' );




