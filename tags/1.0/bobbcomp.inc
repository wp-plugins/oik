<?php // (C) Copyright Bobbing Wide 2010, 2011
// bobbcomp.inc - Company Information

function bw_get_cms_type() {
  global $bw_cms_type, $bw_cms_version;
  $bw_cms_type = "unknown";
  if ( function_exists( 'is_blog_installed' )) {
    $bw_cms_type = 'WordPress';
     return( $bw_cms_type );       
    
  }   
  if ( function_exists( 'drupal_bootstrap' )) {
    $bw_cms_type = "Drupal"; 
    if (defined( VERSION ) ) {
      $bw_cms_version = VERSION;
      
    return( $bw_cms_type );       
    }  
  }
  exit( "Unknown CMS");
  
  return( $bw_cms_type );       
}

function bw_is_wordpress() {
  return( bw_get_cms_type() == "WordPress" );
}
  
function bw_is_drupal() {
  return( bw_get_cms_type() == "Drupal" );
} 



if ( bw_is_wordpress() ) {
  function bw_get_company( $field ) {
    global $company;
    /* WordPress code */
    global $bw_options;
    /* Need to put some code here to see if it's been loaded */
    $bw_options = get_option( "bw_options" );
    if ( $bw_options === FALSE )
      $option = $company[ $field ] ; 
    else
      $option = $bw_options[ $field ] ;   
    return( $option ); 
  }
}
else {
  /** 
   * I need to decide if I should prefix each field with bw_
   * Decision: I didn't prefix the fields in Drupal settings
   */
  function bw_get_company( $field ) {
    return( variable_get( $field, "" ) );
  }
   
  /** 
   * Dummy implementation of add_filter() so that shortcodes.php can be copied unchanged from WordPress.
   */
  function add_filter() {
   // Dummy implementation of add_filter() so that shortcodes.php can be copied unchanged from WordPress.
  } 

  /**
   * Dummy implementation of add_action so that oik-paypal-shortcodes.inc can be included in Drupal as well as WordPress
   */
  function add_action( $tag, $function_to_add, $priority=NULL, $accepted_args=NULL ) {
  // e.g. add_action( admin_init', array($this, 'bw_pp_admin_init'));
  }
  
  /** 
   * Drupal implementation of site_url using the 'domain' variable 
   * This is to allow for local implementations e.g. qw/contacts
   */
  function site_url( $path=NULL, $scheme='http:' ) {
    $url  = $scheme; 
    $url .= '//';
    $url .= bw_get_company( 'domain' );
    $url .= $path;
    return( $url );
  }  
     
  require_once( "shortcodes.php" );  // This is a copy of the WordPress include specifically for the Drupal version of oik.

}


   


function bw_get_geo( $separator )
{
  $geo = bw_get_company( "lat" );
  $geo.= $separator;
  $geo.= bw_get_company( "long" );
  return( $geo );
}  

function bw_geo()
{
  sp("geo");
  span( "geo");
    e( "Lat." ); 
    span( "latitude" );
    e( bw_get_company( "lat" ));
    epan();
    // I think we should have a space between the lat. and long. values
    e( "&nbsp;");
    e( "Long." );
    span( "longitude" );
    e( bw_get_company( "long") );
    epan();
  epan();
 ep(); 
 return( bw_ret());

}



// **?** use Microformats <br/>t: +44 (0)23 92 410090</p>

function bw_telephone( $atts )
{ 
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Tel',
      'sep' => ': ',
      ), $atts ) );
      
  bw_trace( $prefix, __FUNCTION__, __LINE__, __FILE__, "prefix" );
  bw_trace( $sep, __FUNCTION__, __LINE__, __FILE__, "sep" );
 
     
   $tel =  bw_get_company( "telephone" );
   if ( $tel <> "" )
   {
     sdiv( "tel" );
     span( "type");
     e( $prefix );
     epan();
     e( $sep );
     span( "value" );
     e( $tel );
     epan();
     ediv();
   }
   return( bw_ret());
}

function bw_fax( $atts )
{
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Fax',
      'sep' => ': ',
      ), $atts ) );
      
  $fax = bw_get_company( "fax" );
  if ( $fax <> "" )
  { 
    sdiv( "tel" );
    span( "type");
    e( $prefix );
    epan();
    e( $sep );
    span( "value" );
    e( $fax );
    epan();
    ediv();
  }
  return( bw_ret());
}

function bw_mobile( $atts )
{

  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Mobile',
      'sep' => ': ',
      ), $atts ) );
      
  $mobile = bw_get_company( "mobile" ) ;
  if ( $mobile <> "" )
  {
    sdiv( "tel" );
    span( "type");
    e( $prefix );
    epan();
    e( $sep );
    span( "value" );
    e( $mobile );
    epan();
    ediv();
  }
  return( bw_ret());
}

// Notes: Using class=email for Microformat

/* use [bw_email] - for an inline mailto link 
   or [bw_mailto] for a more formal mailto link
*/   

function bw_email( $atts )
{
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Email',
      'sep' => ': ',
      'index' => 'email',
      ), $atts ) );

  span("email");
  
  e( $prefix );
  e( $sep );
  $email = bw_get_company( $index ); 
  alink( NULL, "mailto:". $email, $email, "Send email to: " . $email );
  epan();
  
  return( bw_ret() );
}

/* [bw_mailto] is for a mailto link with a prefix ( in a paragraph )
*/
function bw_mailto( $prefix = NULL, $primary=TRUE )
{
  sp("email");
  $prefix = "Email:&nbsp;";
  e( $prefix );
  //if ( $primary )
     $email = bw_get_company( "email" ); 
  //else
  //   $email = bw_get_company( "admin" );   
  alink( NULL, "mailto:". $email, $email, "Send email to: " . $email );
  ep();
  
  // **?** <p>e: <a href="mailto:info@bobbingwide.com" alt="Send email to: info@bobbingwide.com">info@bobbingwide.com</a>
  // alink( 
  return( bw_ret() );
}


// Using Microformat for address information

function bw_address()
{
  sdiv("adr" );
  
    sdiv("type");
    e( "Work" );
    ediv();
    
    sdiv("extended-address");
    e( bw_get_company( "extended-address" ) );
    ediv();
    
    sdiv("street-address");
    e( bw_get_company( "street-address" ) );
    ediv();  
    
    sdiv("locality");
    e( bw_get_company( "locality" ) );
    ediv();      
    
    sdiv("region");
    e( bw_get_company( "region" ) );
    ediv();      
    
    sdiv("postal-code");
    e( bw_get_company( "postal-code" ) );
    ediv();
       
    span("country-name");
    e( bw_get_company( "country-name" ) );
    epan();
  
  ediv();
  return( bw_ret() );
  
  
}

/* Return a link to the site's wp-admin 
*/
function bw_wpadmin() {
  $site = bw_get_company( "domain" );
  
  e( "Site:&nbsp; ");
  alink( NULL, "http://". $site . "/wp-admin", $site, "Website: " . $site );
  return( bw_ret() );
  
}


function bw_contact() {
  $contact = bw_get_company( "contact" );
  return( $contact );
} 


function bw_follow( $atts ) {
  $social_network = $atts['network'];
  $text = $atts['text'];
  
  $lc_social = strtolower( $social_network );
  $social = bw_get_company( $lc_social );
  bw_trace( $text, __FUNCTION__, __LINE__, __FILE__ , "text" );
  if ( $text ) {
    $text = $social_network;
  }  
  alink( $social_network, $social, $text, "Follow me on ".$social_network );
       
  return( bw_ret());
}  

function bw_twitter( $atts ) {
  $atts['network'] = "Twitter" ;
  return( bw_follow( $atts ));  
}

function bw_facebook( $atts ) {
  $atts['network'] = "Facebook" ;
  return( bw_follow( $atts ));
}

function bw_linkedin( $atts ) { 
  $atts['network'] = "LinkedIn";  
  return( bw_follow( $atts ));
} 
   
function bw_youtube( $atts ) { 
  $atts['network'] = "YouTube";  
  return( bw_follow( $atts ));
}
    
function bw_flickr( $atts) {
  $atts['network'] = "Flickr";  
  return( bw_follow( $atts ));
}  
  
function bw_output( $field ) {
  $fieldvalue = bw_get_company( $field );
  span( $field );
  e( $fieldvalue );
  epan();
  return( bw_ret() );
}

function bw_company() {
  return( bw_output( "company" ));
} 

function bw_business() {
  return( bw_output( "business" ));
} 

function bw_formal() {
  return( bw_output( "formal" ));
} 

function bw_slogan() {
  return( bw_output( "main-slogan" ));
}
 
function bw_alt_slogan() {
  return( bw_output( "alt-slogan" ));
}
 
function bw_admin() {
  return( bw_output( "admin" ));
}
 
function bw_domain() {
  return( bw_output( "domain" ));
} 

function bw_clear() {
  sediv( "cleared" );
  return( bw_ret());
}  


/**
 * Skype Online Material: the Skype buttons and widgets available for download on the 
 * Skype Website at http://www.skype.com/share/buttons/ 
 * as such may be changed from time to time by Skype in its sole discretion.  
*/
function bw_skype( $atts ) {
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Skype name',
      'sep' => ': ',
      ), $atts ) );
      
  bw_trace( $prefix, __FUNCTION__, __LINE__, __FILE__, "prefix" );
  bw_trace( $sep, __FUNCTION__, __LINE__, __FILE__, "sep" );
 
     
   $tel =  bw_get_company( "skype" );
   if ( $tel <> "" )
   {
     sdiv( "skype" );
     span( "type");
     e( $prefix );
     epan();
     e( $sep );
     span( "value" );
     e( $tel );
     epan();
     ediv();
   }
   return( bw_ret());
}

function bw_tel()
{
   $tel =  bw_get_company( "telephone" );
   if ( $tel <> "" )
   {
     span( "tel" );
     sepan( "type", "work " );
     span( "value" );
     e( $tel );
     epan();
     epan();
   }
   return( bw_ret());
}

function bw_mob()
{
   $mob =  bw_get_company( "mobile" );
   if ( $mob <> "" )
   {
     span( "tel" );
     sepan( "type", "cell " );
     span( "value" );
     e( $mob );
     epan();
     epan();
   }
   return( bw_ret());
}


/**
 * Generate a button to get directions from Google Maps e.g.
 * http://maps.google.co.uk/maps?f=d&hl=en&daddr=50.887856,-0.965113
 *
 */
function bw_directions() {
  $lat = bw_get_company( "lat" );
  $long = bw_get_company( "long");
  $company = bw_get_company( "company" );
  $extended = bw_get_company( "extended-address" );
  $postcode = bw_get_company( "postal-code" );
  $link = "http://maps.google.co.uk/maps?f=d&hl=en&daddr=" . $lat . "," . $long;  
  $text = "Google directions";
  $title = "Get directions to " . $company;
  if ( $extended && ($company <> $extended) )
    $title .= " - " . $extended;
  if ( $postcode )
    $title .= " - " . $postcode;
  $class = NULL;
  art_button( $link, $text, $title, $class ); 
  return( bw_ret());
}


function bw_google_plus( $atts ) { 
  $atts['network'] = "GooglePlus";  
  return( bw_follow( $atts ));
} 




function bw_follow_e( $atts ) {
  $social_network = $atts['network'];
  $text = $atts['text'];
  $email = $atts['email'];
  
  $lc_social = strtolower( $social_network );
  $social = bw_get_company( $lc_social );
  if ( $social ) {
    bw_trace( $text, __FUNCTION__, __LINE__, __FILE__ , "text" );
    $imagefile = plugins_url( 'images/'. $lc_social . '_48.png', __FILE__ );
    
    $image = retimage( NULL, $imagefile, $social_network );
    alink( NULL, $social, $image, "Follow me on ".$social_network );
  }     
  //return( bw_ret());
} 



function bw_follow_me( $atts ) {
  $networks = array( 'Twitter', 'Facebook', 'LinkedIn', 'GooglePlus', 'YouTube', 'Flickr' );
  foreach ( $networks as $network ) {
    $atts['network'] = $network;
    bw_follow_e( $atts );
  }
  return( bw_ret());
}



