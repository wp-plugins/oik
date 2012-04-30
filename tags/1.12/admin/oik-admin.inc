<?php // (C) Copyright Bobbing Wide 2011,2012 

/**
 * Load 'plugin' file if the options checkbox is set on
 *
 * The file extension of the plugin is ".php"
 */
function bw_load_plugin( $set="bw_buttons", $option="oik-button-shortcodes", $plugin=NULL ) {
  $checkbox = bw_get_option( $option, $set );
  bw_trace2( $checkbox, "checkbox" );
  if ( $checkbox == "on"  ) {
    if ( $plugin == NULL ) {
      $plugin = $option.".php" ;
    }  
    bw_trace2( $plugin, "plugin" );
    oik_require( $plugin );
  }
}    

// Init plugin options 
function oik_options_init() {
  register_setting( 'oik_options_options', 'bw_options', 'oik_options_validate' );
  register_setting( 'oik_options_options1', 'bw_options1', 'oik_options_validate' );
  register_setting( 'oik_plugins_options', 'bw_plugins', 'oik_plugins_validate' ); // No validation yet
  register_setting( 'oik_buttons_options', 'bw_buttons', 'oik_plugins_validate' ); // Ditto
  
  bw_load_plugin( "bw_buttons", "oik-paypal-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-button-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-shortc-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-quicktags" );
  
}


/**
 * Load the oik-quicktags jQuery/JavaScript for when TinyMCE or the advanced HTML editor is being used
 * Question: Does this work in full screen?

*/
function bw_load_admin_scripts() {
  wp_register_script( "oik-quicktags", plugin_dir_url( __FILE__). "bw_shortcodes.js", array('quicktags') );  
  wp_enqueue_script( "oik-quicktags" );
}

/**
 * Add the options page
 * Note: To avoid getting the Effort menu duplicated the name of the first submenu item needs to be the same
 * as the main menu item. see http://geekpreneur.blogspot.com/2009/07/getting-unwanted-sub-menu-item-in.html
 * In most "normal" WP menus the main menu gives you the full list
 * Notes: we need to enqueue the oik stylesheets for the oik options page
 */
function oik_options_add_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
 
  // We don't specify the icon here since WordPress doesn't cater for it nicely.
  // It's better as a background image which can be hovered, in focus etc
  // plugins_url( "images/oik-icon.png", __FILE__ ) 

  add_menu_page('[oik] Options', 'oik options', 'manage_options', 'oik_menu', 'oik_menu' );
  
  // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); 
  
  add_submenu_page( 'oik_menu', 'oik overview', 'Overview', 'manage_options', 'oik_menu', 'oik_menu');
  add_submenu_page( 'oik_menu', 'oik options', 'Options', 'manage_options', 'oik_options', 'oik_options_do_page');
  add_submenu_page( 'oik_menu', 'oik options-1', 'More Options', 'manage_options', 'oik_options-1', 'oik_options_do_page_1');
  // add_submenu_page( 'oik_menu', 'oik plugins', 'Plugins', 'manage_options', 'oik_plugins', 'oik_plugins_do_page' );
  add_submenu_page( 'oik_menu', 'oik buttons', 'Buttons', 'manage_options', 'oik_buttons', 'oik_buttons_do_page' );
  add_submenu_page( 'oik_menu', 'oik shortcode help', "Shortcode help", 'manage_options', 'oik_sc_help', "oik_help_do_page" );
  //add_submenu_page( 'oik_menu', 'Trace options', 
}

function oik_callback() {
 p( "This box intentionally left blank" );
 
}

/**
 * Create a postbox widget on the admin pages 
 * Notes: Similar to Yoast's potbox (sic)
 *
 */
function oik_box( $class=NULL, $id=NULL, $title=NULL, $callback='oik_callback' ) {
  if ( $id == NULL ) {
    $id = $callback;
  }  
  sdiv( "postbox $class", $id );
  sdiv( "handlediv", NULL, 'title="Click to toggle"' );
  br();
  ediv();
  h3( $title, "hndle" );
  sdiv( "inside" );
  $callback();
  ediv( "inside" );
  ediv( "postbox" );
}

function scolumn( $class=NULL, $id=null ) {
  sdiv( "metabox-holder" );
  sdiv( "postbox-container $class", $id  );
  sdiv( "meta-box-sortables ui-sortable" );
}
  
function ecolumn( ) {
  ediv( "meta-box-sortables" );
  ediv( "postbox-container" );
  ediv( "metabox-holder" );
} 


function oik_menu_header( $title="Overview", $class="w70pc" ) {

  oik_require( "bobbforms.inc" );
  oik_require( "shortcodes/oik-bob-bing-wide.php" );
  oik_enqueue_stylesheets();
  oik_enqueue_scripts();
  sdiv( "wrap" ); 
  //bw_flush();
  $loik = bw_loik();
  h2( "$loik $title" ); 
  scolumn( $class );
  
}
  
function oik_menu_footer() {
  ecolumn();
  ediv( "wrap");
} 

function oik_shortcode_options( ) {

  //p( "Here we list the things that oik can do" );
  //p( "here we list the shortcode sets" );
  p( "oik provides sets of lazy smart shortcodes that you can use just about anywhere in your WordPress site." );
 
  p( "You enter your common information, such as contact details, slogans, location information, PayPal payment information and your social networking and bookmarking information using oik Options" );
  p( "If required, you enter alternative information using More options" );
  
  alink( "button-primary", admin_url("admin.php?page=oik_options"), "Options", "Enter your common information" );
  e( "&nbsp;" );
  alink( "button-secondary", admin_url("admin.php?page=oik_options-1"), "More options", "Enter additional information" );
  
  p( "Discover the shortcodes that you can use in your content and widgets using Shortcode help" );
  
  alink( "button-secondary", admin_url( "admin.php?page=oik_sc_help"), "Shortcode help", "Discover shortcodes you can use" );
  
  p( "Choose the helper buttons that help you to insert shortcodes when editing your content" );
  alink( "button-secondary", admin_url( "admin.php?page=oik_buttons"), "Buttons", "Select TinyMCE and HTML edit helper buttons" );

  
}


function oik_custom_css_box() {
  $theme = get_current_theme();
  // p( "Note: This only works when the file is in the current theme directory." );
  p( "To style the output from shortcodes you can create and edit a custom CSS file for your theme ($theme)." );
  p( "Use the [bw_editcss] shortcode to create the <b>edit CSS</b> link anywhere on your website." ); 
  p( "Note: If you change themes then you will start with a new custom CSS file." );
  p( "You should save your custom CSS file before updating theme $theme." );
  

  // p( "$theme in " . get_stylesheet_directory()  );
  
  $options = get_option('bw_options');     
  $customCSS = bw_array_get( $options, 'customCSS', NULL );
  if ( $customCSS ) {
    p( "Click on this button to edit your custom CSS file.");
    oik_custom_css( $theme );
  } else {
    p( "You have not defined a custom CSS file." );
    
    alink( "button-secondary", admin_url("admin.php?page=oik_options"), "Name your custom CSS file", "Enter the name of your custom CSS file on the Options page" );
  }
}

function oik_custom_css( $theme=null ) {
  $options = get_option('bw_options');     
  $customCSS = bw_array_get( $options, 'customCSS', NULL );
  if ( $customCSS ) {
    $sanfile = sanitize_file_name( $customCSS );
    // Should we check the sanitized file name with the original ?
    bw_create_file( get_stylesheet_directory(), $sanfile, plugin_dir_path( __FILE__ ) . 'custom.css' );  
    bw_edit_custom_css_link( $sanfile, $theme );
  }    
} 

function oik_optional_plugins() {
  $options = get_option( 'bw_plugins' );
  p( "oik comes with a set of companion plugins. Activate these when you find a need for them." );
  sul();
  li( "email signature" );
  li( "custom header image" );
  li( "oik sidebar" );
  li( "oik fields" );
  li( "oik trace - " );
  li( "oik action trace" );
  
 li( "oik bbpress - strip tags from bbPress forum title tooltips" );
 li( "oik bob bing wide shortcodes - activate this plugin to enable the <code>[bw_plug]</code> shortcode" );
 li( "oik BuddyPress signup email - Send sign up verification emails via site admin for verification before accepting a user" );
  eul();
  
  //bw_flush();
 

}

function oik_tinymce_buttons() {
  //p( "Select the buttons you want to be able to use when editing content using TinyMCE Visual edit or HTML" );
  $options = get_option( 'bw_buttons' );
  bw_form( "options.php" );
  stag( 'table', "form-table" );
  bw_flush();
  settings_fields('oik_buttons_options'); 
  $imagefile_bw = retimage( NULL, plugin_dir_url(__FILE__ ).'bw-bn-icon.gif', "Button shortcodes" );
  $imagefile_pp = retimage( NULL, plugin_dir_url( __FILE__ ).'bw-pp-icon.gif', "PayPal shortcodes" );
  $imagefile_sc = retimage( NULL, plugin_dir_url( __FILE__ ).'bw-sc-icon.gif', "ALL shortcodes" );
  bw_checkbox_arr( "bw_buttons", $imagefile_bw . " Button shortcodes", $options, 'oik-button-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", $imagefile_pp . " PayPal shortcodes", $options, 'oik-paypal-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", $imagefile_sc . " ALL shortcodes", $options, 'oik-shortc-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", "[] quicktag for HTML editor", $options, "oik-quicktags" );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 
  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}

function oik_documentation() {
  p("For more information:" );
  sul();
  stag( "li" );
  alink( null, "http://www.oik-plugins.com/tutorial/getting-started-with-oik-plugins/", "Getting started" );
  stag( "li" );
  alink( NULL,  "http://www.oik-plugins.com/oik/oik-faq", "Frequently Asked Questions" );
  etag( "li" );
  stag( "li" );
  alink( NULL, "http://wordpress.org/tags/oik?forum_id=10", "Forum" );
  etag( "li" );
  eul();
  sp();
  art_button( "http://www.oik-plugins.com", "oik documentation", "Read the documentation for the oik plugin" );
  ep();
} 

function oik_support() {
  oik_require( "shortcodes/oik-paypal.php" );
  p( "Support the development of ". bw_oik(). " by making a donation to ". bw_lbw() );
  e ( bw_pp_shortcodes( array( "type" => "donate", "email" => "herb@bobbingwide.com" )) );
}

/**
 * What jQuery scripts do we need to make the page work as if they were dashboard widgets?
 * Where do we find out what all the others do?
 * Each of the default scripts that we enqueue gets added to the list of scripts loaded by wp-admin/load-scripts.php
 * Except when 'SCRIPT_DEBUG' is true; then each script is loaded separately
  
 * dashboard enables postbox toggling
 * It's not necessary to add most of these as they are pre-requisites 
 * e.g. dashboard is dependent upon jquery, admin-comments and postbox
 *
 * @see wp-includes/script-loader.php
 */
function oik_enqueue_scripts() {

  //wp_enqueue_style( 'wp-pointer' ); 
  //wp_enqueue_script( 'jquery-ui' ); 
  //wp_enqueue_script( 'jquery-ui-core' ); 
  //wp_enqueue_script( 'jquery-ui-widget' ); 
  //wp_enqueue_script( 'jquery-ui-mouse' ); 
  //wp_enqueue_script( 'jquery-ui-sortable' );
  //wp_enqueue_script( 'postbox' );
  //wp_enqueue_script( 'wp-ajax-response' );
  //wp_enqueue_script( 'wp-lists' );
  //wp_enqueue_script( 'jquery-query' );
  wp_enqueue_script( 'dashboard' );
  
  //wp_enqueue_script( 'jquery-ui-draggable' );
  //wp_enqueue_script( 'jquery-ui-droppable' );
  //wp_enqueue_script( 'jquery-ui-tabs' );
  //wp_enqueue_script( 'jquery-ui-selectable' );
  //wp_enqueue_script( 'wp-pointer' ); 
  //wp_enqueue_script( 'utils' );
}  


function oik_menu() {
  oik_menu_header( "overview", "w70pc" );
  oik_box( NULL, NULL, "Shortcode options", "oik_shortcode_options" );
  oik_box( NULL, NULL, "Custom CSS", "oik_custom_css_box" );
  oik_box( NULL, NULL, "Optional plugins", "oik_optional_plugins" );
  ecolumn();
  scolumn( "w30pc" );
  oik_box( NULL, NULL, "oik documentation", "oik_documentation" );
  oik_box( NULL, NULL, "support oik", "oik_support" );
  oik_menu_footer();
  bw_flush();
}


// Draw the oik buttons page

function oik_buttons_do_page() {
  oik_menu_header( "button selection" );
  oik_box( NULL, NULL, "TinyMCE buttons", "oik_tinymce_buttons" );
  oik_menu_footer();
  bw_flush();
}  


/** 
 * Draw the oik plugins page
 *
 * This page is under construction **?** Herb 2012/04/24
*/ 
function oik_plugins_do_page() {
  oik_menu_header( "plugin selection" );
  
  //e( '<form method="post" action="options.php">' );
  oik_box( null, null, "choose optional function to enable", "oik_plugin_selection" );
  oik_menu_footer();
  bw_flush();
}

function oik_plugin_selection() {  
  bw_form( "options.php" );
  $options = get_option('bw_plugins');
  stag( 'table', "form-table" );
  bw_flush();
  settings_fields('oik_plugins_options'); 
  // function bw_checkbox( $name, $text, $value=1, $args=NULL ) {
  bw_checkbox_arr( "bw_plugins", "oik trace", $options, 'oik-bwtrace' ); 
  bw_checkbox_arr( "bw_plugins", "oik email signature", $options, 'oik-email-signature' );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 
  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}  
  

/** 
 * Draw the oik options page 
*/
function oik_options_do_page() {
  oik_menu_header( "shortcode options", "w60pc" );
  oik_box( null, null, "Often included key information", "oik_main_shortcode_options" );
  ecolumn();
  scolumn( "w40pc" );
  oik_box( null, null, "Usage notes", "oik_usage_notes" );
  oik_menu_footer();
  bw_flush();
} 
 
function oik_main_shortcode_options() {
  bw_form( "options.php" );
  
  // e( '<form method="post" action="options.php">' ); 
  $options = get_option('bw_options');     
  
  stag( 'table class="form-table"' );
  bw_flush();
  settings_fields('oik_options_options'); 
  
  textfield( "bw_options[telephone]", 50, "Telephone [bw_telephone] / [bw_tel]", $options['telephone']  );
  textfield( "bw_options[fax]", 50, "Fax [bw_fax]", $options['fax']  );
  textfield( "bw_options[mobile]", 50, "Mobile [bw_mobile] / [bw_mob]", $options['mobile']  );
  textfield( "bw_options[emergency]", 50, "Emergency [bw_emergency]", $options['emergency']  );
  
  textfield( "bw_options[company]", 50, "Company [bw_company]", $options['company']  );
  textfield( "bw_options[business]", 50, "Business [bw_business]", $options['business']  );
  textfield( "bw_options[formal]", 50, "Formal [bw_formal]", $options['formal']  );
  textfield( "bw_options[abbr]", 50, "Abbreviation [bw_abbr]", $options['abbr']  );
  
  
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
  
  textarea( "bw_options[gmap_intro]", 50, "Google Maps intro text for [bw_show_googlemap]", $options['gmap_intro'], 5 );
  textfield( "bw_options[width]", 10, "Google Map width", $options['width']  );
  textfield( "bw_options[height]", 10, "Google Map height", $options['height']  );
  

  textfield( "bw_options[domain]", 50, "Domain [bw_domain] [bw_wpadmin]", $options['domain']  );
  textfield( "bw_options[customCSS]", 50, "Custom CSS in theme directory " . get_stylesheet_directory_uri(), $options['customCSS'] );
  
  textfield( "bw_options[twitter]", 50, "Twitter URL [bw_twitter]", $options['twitter'] );
  textfield( "bw_options[facebook]", 50, "Facebook URL [bw_facebook]", $options['facebook'] );
  textfield( "bw_options[linkedin]", 50, "LinkedIn URL [bw_linkedin]", $options['linkedin'] );
  textfield( "bw_options[googleplus]", 50, "Google Plus URL [bw_googleplus]", $options['googleplus'] );
  textfield( "bw_options[youtube]", 50, "YouTube URL [bw_youtube]", $options['youtube'] );
  textfield( "bw_options[flickr]", 50, "Flickr URL [bw_flickr]", $options['flickr'] );
  textfield( "bw_options[picasa]", 50, "Picasa URL [bw_picasa]", $options['picasa'] );
  textfield( "bw_options[skype]", 50, "Skype Name [bw_skype]", $options['skype'] );
  
  
  textfield( "bw_options[paypal-email]", 50, "PayPal email [bw_paypal]", $options['paypal-email'] );
  textfield( "bw_options[paypal-country]", 2, "PayPal country", $options['paypal-country'] );
  textfield( "bw_options[paypal-currency]", 2, "PayPal currency", $options['paypal-currency'] );
  
  $upload_dir = wp_upload_dir();
  $baseurl = $upload_dir['baseurl'];
    
  textfield( "bw_options[logo-image]", 50, "Logo image [bw_logo] in uploads: " . $baseurl, $options['logo-image'] );
  textfield( "bw_options[qrcode-image]", 50, "QR code image [bw_qrcode] in uploads", $options['qrcode-image'] );
  textfield( "bw_options[art-version]", 50, "Artisteer version 31/30/25/na [bw_art_version]", $options['art-version'] );
  

  $options['yearfrom'] = bw_array_get_dcb( $options, "yearfrom", NULL, "bw_get_yearfrom" );
  textfield( "bw_options[yearfrom]", "4", "Copyright from year (used in [bw_copyright])", $options['yearfrom'] );
    
  //tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 
  
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 

  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}

function oik_usage_notes() {
  oik_require( "includes/oik-sc-help.inc" );
  p( "Use the shortcodes in your pages, widgets and titles. e.g." );
  bw_invoke_shortcode( "bw_contact", null, "Display your contact name" );
  bw_invoke_shortcode( "bw_telephone", null, "Display your telephone number." );     
  bw_invoke_shortcode( "bw_address", null, "Display your address." );
  bw_invoke_shortcode( "bw_email", null, "Display your email address." );

  bw_invoke_shortcode( "bw_show_googlemap", null, "Display a Googlemap for your primary address." );
  bw_invoke_shortcode( "bw_directions", null, "Display a button for obtaining directions to your address." );
  bw_invoke_shortcode( "bw_follow_me", null, "Show all your <b>Follow me</b> buttons" );
  
  p( "For more information about the shortcodes you can use select <b>Shortcode help</b>" );
  
  alink( "button-secondary", admin_url( "admin.php?page=oik_sc_help"), "Shortcode help", "Discover shortcodes you can use" );
  

  bw_flush();
}


/** 
 * Draw the oik options-1 page
 *
 * This page is for additional fields to enable multiple sets of bw_options
 * $alt = 1;
*/
function oik_options_do_page_1() {
  oik_menu_header( "extra shortcode options", "w60pc" );
  oik_box( null, null, "alternative values using alt=1", "oik_extra_shortcode_options" );
  ecolumn();
  scolumn( "w40pc" );
  oik_box( null, null, "usage notes", "oik_extra_usage_notes" );
  oik_menu_footer();
  bw_flush();
}
  
function oik_extra_shortcode_options() {
  bw_form( "options.php" );
  $alt = "1";
  $option = "bw_options$alt";
  $options = get_option( $option );     
  stag( 'table class="form-table"' );
  bw_flush();
  settings_fields("oik_options_options$alt");

  bw_textfield_arr( $option, "Contact [bw_contact alt=1]", $options, 'contact', 50 );
  bw_textfield_arr( $option, "Email [bw_email alt=1]", $options, 'email', 50 );
  bw_textfield_arr( $option, "Telephone [bw_telephone alt=1]", $options, 'telephone', 50 );
  bw_textfield_arr( $option, "Mobile [bw_mobile alt=1]", $options, 'mobile', 50 );
  
  bw_textfield_arr( $option, "Extended-address [bw_address alt=1]", $options, 'extended-address', 50 );
  bw_textfield_arr( $option, "Street-address", $options, 'street-address', 50 );
  bw_textfield_arr( $option, "Locality", $options, 'locality', 50 );
  bw_textfield_arr( $option, "Region", $options, 'region', 50 );
  bw_textfield_arr( $option, "Post Code", $options, 'postal-code', 50 );
  bw_textfield_arr( $option, "Country name", $options, 'country-name', 50 );
  
  bw_textarea_arr( $option, "Google Maps introductory text for [bw_show_googlemap alt=1]", $options, 'gmap_intro', 50 );
  bw_textfield_arr( $option, "Latitude [bw_geo alt=1] [bw_directions alt=1]", $options, 'lat', 50 );
  bw_textfield_arr( $option, "Longitude [bw_show_googlemap alt=1]", $options, 'long', 50 );
  
  /* these will come later - better to set them against the user rather than the site 
  
  textfield( "bw_options[twitter]", 50, "Twitter URL [bw_twitter]", $options['twitter'] );
  textfield( "bw_options[facebook]", 50, "Facebook URL [bw_facebook]", $options['facebook'] );
  textfield( "bw_options[linkedin]", 50, "LinkedIn URL [bw_linkedin]", $options['linkedin'] );
  textfield( "bw_options[googleplus]", 50, "Google Plus URL [bw_googleplus]", $options['googleplus'] );
  textfield( "bw_options[youtube]", 50, "YouTube URL [bw_youtube]", $options['youtube'] );
  textfield( "bw_options[flickr]", 50, "Flickr URL [bw_flickr]", $options['flickr'] );
  textfield( "bw_options[picasa]", 50, "Picasa URL [bw_picasa]", $options['picasa'] );
  textfield( "bw_options[skype]", 50, "Skype Name [bw_skype]", $options['skype'] );
  
  
  textfield( "bw_options[paypal-email]", 50, "PayPal email [bw_paypal]", $options['paypal-email'] );
  textfield( "bw_options[paypal-country]", 2, "PayPal country", $options['paypal-country'] );
  textfield( "bw_options[paypal-currency]", 2, "PayPal currency", $options['paypal-currency'] );
  
  */
 
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 

  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}  
  
function oik_extra_usage_notes() {
  oik_require( "includes/oik-sc-help.inc" );
  p( "Use the shortcodes in your pages, widgets and titles. e.g." );
  bw_invoke_shortcode( "bw_contact", "alt=1", "Display your alternative contact name." );
  bw_invoke_shortcode( "bw_email", "alt=1 prefix=e-mail", "Display your alternative email address, with a prefix of 'e-mail'." );
  bw_invoke_shortcode( "bw_telephone", "alt=1", "Display your alternative telephone number." );
  bw_invoke_shortcode( "bw_address", "alt=1", "Display your alternative address." );
  bw_invoke_shortcode( "bw_show_googlemap", "alt=1", "Display a Googlemap for your alternative address." );
  bw_invoke_shortcode( "bw_directions", "alt=1", "Display directions to the alternative address." );
  bw_flush();
}

function oik_plugins_validate( $input ) {
  return $input;
}  


// Sanitize and validate input. Accepts an array, return a sanitized array.


function oik_options_validate( $input ) {
  $customCSS = bw_array_get( $input, 'customCSS', NULL );
  if ( $customCSS ) {
    $sanfile = sanitize_file_name( $customCSS );
    // Should we check the sanitized file name with the original ?
    bw_create_file( get_stylesheet_directory(), $sanfile, plugin_dir_path( __FILE__ ) . 'custom.css' );  
  }
  
  return $input;
}

/**
 * Create a file with the specified name in the specified directory 
 * @param string base - the base path for the file name - may be absolute
 * @param string path - the rest of the file name - as specified by the user
 * @param string default - the fully qualified filename of the base source file to copy
 */
function bw_create_file( $base, $path, $default ) {
  $target = path_join( $base, $path );
  
  if ( !file_exists( $target ) ) {
     // create an empty file - or copy the original  
     // $info = pathinfo( $target );
     // $name = basename( $target );
     if ( $default ) {
        $success = copy( $default, $target );
     } else {
       // write an empty file
       $resource = fopen( $target, 'xb' );
       fclose( $resource );
     }
  }
}


/** 
 * Link to allow the custom CSS file to be edited 
 * @param string $customCSS Name of the custom.css file. Probably 'custom.css' 
 *
 * Note: you can't specify a relative path to this file. If you do you may see this message
 *
 *   Sorry, can't edit files with ".." in the name. 
 *   If you are trying to edit a file in your WordPress home directory, you can just type the name of the file in.
 *
 * With WPMS, the link takes you to style.css rather than custom.css. Don't know why! 
 * Actually, it's a bit more complex... the theme may be shared by multiple sites
 * so we need to further qualify the custom.css file
 * As a workaround just give it a different name than custom.css and hope for the best
 * it should really include the site ID or something
 * Note: note sure what authority is needed to view/edit the theme files.
 * 
 * For MultiSite the admin_url() is wrong - but we can use network_admin_url() for both
 * 
 * http://rowlandscastlewebdesign.com/wp-admin/network/theme-editor.php?
 * file=/home/rcwdcom/public_html/wp-content/themes/wpg0216/custom.css&theme=wpg0216&a=te&scrollto=0
 */ 
function bw_edit_custom_css_link( $customCSS, $theme ) {
  
  if ( $customCSS != NULL ) {
    $link = network_admin_url( "theme-editor.php" );
    $link .= '?file=';
    //$link .= 'oik/custom.css';
    $link .= path_join( get_stylesheet_directory(), $customCSS );
    $link .= "&theme=$theme";
    $img = retimage( null, oik_url( 'images/editcss_48.png') , "Edit custom CSS" );
    alink( null, $link, $img, "Edit custom CSS" ); 
  }
}  


function oik_load_plugins() {
  oik_require( "admin/oik-depends.inc" );
}  


/**
 * Display help information for all the active shortcodes
 *
 * When a shortcode is selected for further display then we invoke the __example and __snippet routine
 * **?** For some reason, when the shortcode is 'nivo' the columns get wide than normal. Don't yet know why Herb 2012/04/26
*/ 
function oik_help_do_page() {
  oik_menu_header( "shortcode help", "w95pc" );
  oik_box( null, null, "About shortcodes", "oik_code_about" );
  
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  if ( $shortcode ) {
    oik_box( null, NULL, "$shortcode - more information", "oik_code_example" );
    oik_box( null, null, "$shortcode - snippet", "oik_code_snippet" ); 
  }
  oik_require( "shortcodes/oik-codes.php" );
  oik_box( null, null, "Shortcode summary", "oik_code_table" );
  oik_menu_footer();
  bw_flush();
}  

function oik_code_about() {

  p( "This page lists all the currently active shortcodes. To find out more information about a shortcode click on the shortcode name." );
  p( "Depending on how the shortcode is implemented you will either be shown some more information with one or more examples, or an 'oik generated example.' "); 
  p( "You will also be shown the HTML snippet for the example. There should be no need to do anything with this output." );
  
  p( "For further information click on the links in the <b>more oik help</b> column" );
  
}
/** 
 * Display an example of the shortcode, which may be oik generated
 */
function oik_code_example() {
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  do_action( "bw_sc_example", $shortcode );
}

  
/** 
 * Display the snippet the shortcode, which may be oik generated
 */
function oik_code_snippet() {
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  do_action( "bw_sc_snippet", $shortcode );
}  
  
  
function oik_code_table() {

  $shortcodes = bw_list_shortcodes( array( "ordered" => "y") );
}  
