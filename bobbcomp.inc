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
    
    // bw_trace( $bw_options, __FUNCTION__,  __LINE__, __FILE__, "bw_options" );  
    if ( $bw_options === FALSE )
      $option = $company[ $field ] ; 
    else
      $option = $bw_options[ $field ] ; 
      
    // Note: A value that appears to be blank ( == '') may actually be FALSE ( == FALSE )
    // bw_trace( '!' .$option.'!', __FUNCTION__,  __LINE__, __FILE__, "option" );  
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

function bw_geo() {
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

/**
 * return the telephone number in desired HTML markup, if set or passed as number=
 
 * @param array atts
 *   prefix = type of number: free form e.g. Tel, Home, Work, Mob, Cell
 *   sep = separator default ': '
 *   number = telephone number override
 *   tag = 'div' or 'span' or other HTML wrapping tag - with start and and
 *
 * Example:
 * [bw_telephone]
 * [bw_telephone number="023 92 410090" prefix="Portsmouth"]
 *
 */
function _bw_telephone( $atts = NULL ) {
  
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Tel',
      'sep' => ': ',
      'number' => NULL,
      'tag' => 'div',
      ), $atts ) );
      
  bw_trace( $prefix, __FUNCTION__, __LINE__, __FILE__, "prefix" );
  bw_trace( $sep, __FUNCTION__, __LINE__, __FILE__, "sep" );
  $tel =  bw_default_empty_att( $number, "telephone", "" );
  bw_trace( $tel, __FUNCTION__, __LINE__, __FILE__, "tel" );
   
   if ( $tel <> "" )
   {
     stag( $tag,  "tel" );
     span( "type");
     e( $prefix );
     epan();
     e( $sep );
     span( "value" );
     e( $tel );
     epan();
     etag( $tag );
   }
   return( bw_ret());
}


/**
 * Display the telephone number using microformats
 * See ISBN: 978-1-59059-814-6 p. 140
 */
function bw_telephone( $atts = NULL ) { 
  $atts['tag'] = 'div';
  return _bw_telephone( $atts );
}  

/**
 * Display the fax number, if set
 */
function bw_fax( $atts = NULL ) {
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

function bw_mobile( $atts = NULL ) {
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

function bw_emergency( $atts = NULL ) {
  bw_trace( $atts, __FUNCTION__, __LINE__, __FILE__, "atts" );
  extract( shortcode_atts( array(
      'prefix' => 'Emergency',
      'sep' => ': ',
      'class' => 'emergency'
      ), $atts ) );
      
  $emergency = bw_get_company( "emergency" ) ;
  if ( $emergency <> "" )
  {
    sdiv( "tel " . $class );
    span( "type");
    e( $prefix );
    epan();
    e( $sep );
    span( "value" );
    e( $emergency );
    epan();
    ediv();
  }
  return( bw_ret());
}

// Notes: Using class=email for Microformat

/* use [bw_email] - for an inline mailto link 
   or [bw_mailto] for a more formal mailto link
*/   

function bw_email( $atts = NULL )
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


/**
 * Return address using Microformats
 */
function bw_address( $atts = NULL ) {
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


function bw_follow( $atts = NULL ) {
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

function bw_tel( $atts = NULL ) {
  $atts['tag'] = 'span';
  return _bw_telephone( $atts );
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


/**
 * Produce a Follow me button for each of these social networks:  Twitter, Facebook, LinkedIn, GooglePlus, YouTube, Flickr
*/
function bw_follow_me( $atts = NULL ) {
  $networks = array( 'Twitter', 'Facebook', 'LinkedIn', 'GooglePlus', 'YouTube', 'Flickr' );
  foreach ( $networks as $network ) {
    $atts['network'] = $network;
    bw_follow_e( $atts );
  }
  return( bw_ret());
}

/** 
 * bw_oik() is needed here since it's used in the oik admin pages
 *   
 */
function bw_oik ( $class = NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="b1">o</span>';
  $bw .= '<span class="o">i</span>';
  $bw .= '<span class="b2">k</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
}

/** 
 * bw_oik_long - spells out Often Included Key-information
 *   
 */
function bw_oik_long( $class = NULL ) {
  $bw = nullretstag( "span", $class ); 
  $bw .= '<span class="B1">O</span>';
  $bw .= '<span class="b1">ften </span>';
  $bw .= '<span class="o">Included </span>';
  $bw .= '<span class="b2">Key-information</span>';
  $bw .= nullretetag( "span", $class ); 
  return( $bw );
}


/**
 * Display the company logo with a link if required
 * Notes: the attribute defaulting needs to be improved 
*/ 
function bw_logo( $atts ) {
  $link = $atts['link'];
  $text = $atts['text'];
  $width = $atts['width'];
  $height = $atts['height'];


  $upload_dir = wp_upload_dir();
  $baseurl = $upload_dir['baseurl'];
  
  $logo_image = bw_get_company( "logo-image" );
  $company = bw_get_company( "company" );
  $image_url = $baseurl . $logo_image;
  
  $image = retimage( NULL, $image_url, $company, $width, $height );
  if ( $link ) {
    alink( NULL, $link, $image, $company );
  }  
  else {
    e( $image );  
  }  
  return( bw_ret());
    
}


/**
 * Display the QR code file with a link if required
 * Notes: the attribute defaulting needs to be improved 
*/ 
function bw_qrcode( $atts ) {
  $link = $atts['link'];
  $text = $atts['text'];
  $width = $atts['width'];
  $height = $atts['height'];


  $upload_dir = wp_upload_dir();
  $baseurl = $upload_dir['baseurl'];
  
  $logo_image = bw_get_company( "qrcode-image" );
  $company = bw_get_company( "company" );
  $image_url = $baseurl . $logo_image;
  
  $image = retimage( NULL, $image_url, "QR code for " . $text , $width, $height );
  if ( $link ) {
    alink( NULL, $link, $image, $company );
  }  
  else {
    e( $image );  
  }  
  return( bw_ret());
    
}

/**
 * Start a div tag
 * Use in conjunction with ediv to add custom divs in pages, posts or blocks
 * e.g. [div class="blah"]blah goes here[ediv]
 */
function bw_sdiv( $atts ) {
  $class = $atts['class'];
  $id = $atts['id'];
  sdiv( $class, $id );
  return( bw_ret());
}

/**
 * End a div tag 
 */ 
function bw_ediv( $atts ) {
  ediv();
  return( bw_ret());
}

/**  
 * Create an empty div for a particular set of classes, id or both
 * e.g. [sediv class="bd-100"] 
 */
function bw_sediv( $atts ) {
  $class = $atts['class'];
  $id = $atts['id'];
  sediv( $class, $id );
  return( bw_ret());
}

 
/** 
 * Display the company abbreviation using an abbr tag
 */
function bw_abbr( $atts = NULL ) {
  $abbr = bw_get_company( "abbr" );
  $company = bw_get_company( "company" );
  abbr( $company, $abbr );
  return( bw_ret());
}
  
/** 
 * Display the company abbreviation using an acronym tag
 * there is a subtle difference between the two: abbr and acronym
 * see (for example) http://www.benmeadowcroft.com/webdev/articles/abbr-vs-acronym/   
 */
function bw_acronym( $atts = NULL ) {
  $abbr = bw_get_company( "abbr" );
  $company = bw_get_company( "company" );
  acronym( $company, $abbr );
  return( bw_ret());
}


/**
 * Set a default value for an empty attribute value from the oik option or a hardcoded value
 * @param bw_value - value passed... if not set then
 * @param bw_field - get the oik option value - this is the field name of the oik option - e.g. 'company'
 * @param bw_default - the (hardcoded) default value if the oik option is not set
 *
 * e.g. 
 * $width = bw_default_empty_att( $width, "width", "100%" );
 * 
*/
function bw_default_empty_att( $bw_value=NULL, $bw_field=NULL, $bw_default=NULL ) {
  $val = $bw_value;
  bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "field" );
  if ( empty( $val )) {
    bw_trace( $bw_field, __FUNCTION__, __LINE__, __FILE__, "bw_field" );
    $val = bw_get_company( $bw_field );
    bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value" );
    if ( empty( $val ))
      $val = $bw_default;
  } 
  bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value" );
  return( $val );
}



/** 
 * Return the array[index] or a default value if not set
 */
if ( !function_exists( 'bw_array_get' ) ) { 
  function bw_array_get( $array = array(), $index, $default=NULL ) {
    if ( isset( $array[$index] ) || ( is_array( $array) && array_key_exists( $index, $array ) ) )  {
      $value = $array[$index];
    } else {
      $value = $default;
    } 
    // bw_trace( $value, __FUNCTION__,  __LINE__, __FILE__, "value" ); 
    return( $value );
  }
}


/**
 * Set a default value for an empty array[ index]
 * @param bw_array - array containing the value
 * @param bw_index - index to check... if not set then 
 * @param bw_field - get the oik option value - this is the field name of the oik option - e.g. 'company'
 * @param bw_default - the (hardcoded) default value if the oik option is not set
 *
 * e.g. 
 * $width = bw_default_empty_arr( $atts, "width", "width", "100%" );
 * 
*/
function bw_default_empty_arr( $bw_array=NULL, $bw_index=NULL, $bw_field=NULL, $bw_default=NULL ) {
  $val = bw_array_get( $bw_array, $bw_index, NULL );
  if ( empty( $val )) {
    bw_trace( $bw_field, __FUNCTION__, __LINE__, __FILE__, "bw_field" );
    $val = bw_get_company( $bw_field );
    bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value" );
    if ( empty( $val ))
      $val = $bw_default;
  } 
  bw_trace( $val, __FUNCTION__, __LINE__, __FILE__, "value" );
  return( $val );
}

