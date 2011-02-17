<?php // (C) Copyright Bobbing Wide 2010, 2011
// bobbcomp.inc - Company Information

function bw_get_company( $field ) 
{
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
   
function bw_set_company( $field, $value=NULL ) 
{
   global $company;
   $company[ $field ] = $value; 
}   

function bw_company_tel( $telephone = NULL, $fax = NULL, $mobile= NULL )   
{

   bw_set_company( "telephone", $telephone );
   bw_set_company( "fax", $fax );
   bw_set_company( "mobile", $mobile );
}

function bw_company_job( $company = NULL, $business = NULL, $formal = NULL )   
{
   //global $header_title, $header_subtitle;

   bw_set_company( "company", $company );
   bw_set_company( "business", $business );
   bw_set_company( "formal", $formal );
   
   //$header_title = bw_get_company( "company" );
   //$header_subtitle = bw_get_company( "business" );
     
}

function bw_company_slogans( $main_slogan                     // "main-slogan" 
                           , $alt_slogan                      // "alt-slogan "
                           )
{
   bw_set_company( "main-slogan", $main_slogan );
   bw_set_company( "alt-slogan", $alt_slogan );
}

function bw_company_contacts( $contact = NULL, $email = NULL, $admin= NULL )
{
   bw_set_company( "contact", $contact );
   bw_set_company( "email", $email );
   bw_set_company( "admin", $admin ); 
}

                                   
// extended-address e.g.  1 Fernwood House
// street-address   e.g.  45-47 London Road                            
// locality         e.g   Cowplain
// region           e.g.  WATERLOOVILLE, HANTS                         
// postal-code      e.g.  PO8 8H                        
// country-name     e.g.  UK                          


function bw_company_address( $extended_address=NULL, $street_address=NULL, $locality=NULL, $region=NULL, $postal_code=NULL, $country_name=NULL )
{
  bw_set_company( "extended-address", $extended_address );
  bw_set_company( "street-address", $street_address  );
  bw_set_company( "locality", $locality  );
  bw_set_company( "region", $region );
  bw_set_company( "postal-code", $postal_code );   
  bw_set_company( "country-name", $country_name );

}

function bw_company_geo( $lat, $long, $google_api_key, $betterbyfar="betterbyfar" )
{
  bw_set_company( "lat", $lat );
  bw_set_company( "long", $long );
  bw_set_company( "google_maps_api_key", $google_api_key );
  bw_set_company( "betterbyfar", $betterbyfar );
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
    //br();
    e( "Long." );
    span( "longitude" );
    e( bw_get_company( "long") );
    epan();
  epan();
 ep(); 
 return( bw_ret());

}


function bw_set_servers( $domain, $parked )
{
  bw_set_company( "domain", $domain );
  bw_set_company( "parked", $parked );
}   
  
function bw_set_verification( $domain, $google, $yahoo, $bing )
{
  // we pass domain in case we need to set domain specific values - save this as vdomain rather than overwrite domain
  bw_set_company( "vdomain", $domain );
  bw_set_company( "google", $google );
  bw_set_company( "yahoo", $yahoo );
  bw_set_company( "bing", $bing );
}   
  
  


// **?** use Microformats <br/>t: +44 (0)23 92 410090</p>

function bw_telephone( $prefix = "Tel")
{
   $tel =  bw_get_company( "telephone" );
   if ( $tel <> "" )
   {
     sdiv( "tel" );
     span( "type");
     $prefix = "Tel";
     e( $prefix );
     epan();
     e(":");
     span( "value" );
     e( $tel );
     epan();
     ediv();
   }
   return( bw_ret());
}

function bw_fax( $prefix = "Fax")
{
  $fax = bw_get_company( "fax" );
  if ( $fax <> "" )
  { 
    sdiv( "tel" );
    span( "type");
    $prefix = "Fax";
    e( $prefix );
    epan();
    e(":");
    span( "value" );
    e( $fax );
    epan();
    ediv();
  }
  return( bw_ret());
}

function bw_mobile( $prefix = NULL )
{
  $mobile = bw_get_company( "mobile" ) ;
  if ( $mobile <> "" )
  {
    sdiv( "tel" );
    span( "type");
    $prefix = "Mobile";
    e( $prefix );
    epan();
    e(":&nbsp;");
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

function bw_email( $prefix = NULL, $primary=TRUE )
{
  span("email");
  
  //$prefix = "Email:&nbsp;";
  //e( $prefix );
  //if ( $primary )
     $email = bw_get_company( "email" ); 
  //else
  //   $email = bw_get_company( "admin" );   
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


function bw_follow( $social_network = "Facebook" ) {
  $lc_social = strtolower( $social_network );
  $social = bw_get_company( $lc_social );
  
  alink( $social_network, $social, $social_network, "Follow me on ".$social_network );
  return( bw_ret());
}  

function bw_twitter() {
  return( bw_follow( "Twitter" ));  
}

function bw_facebook() {
  return( bw_follow( "Facebook" ));
}

function bw_linkedin() {  
  return( bw_follow( "LinkedIn" ));
} 
   
function bw_youtube() {  
  return( bw_follow( "YouTube" ));
}
    
function bw_flickr() {  
  return( bw_follow( "Flickr" ));
}
    
function bw_picasa() {  
  return( bw_follow( "Picasa" ));
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

  

