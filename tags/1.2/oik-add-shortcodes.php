<?php 

  require_once( 'bwtrace.inc' );
/* Shortcodes for each of the more useful "often included key-information" fields 
   in Bobbing Wide's Wonder of WordPress websites
*/

function bw_gp_slideshow( $atts, $hmm=NULL, $tag=NULL ) {
  if ( 'the_content' == current_filter() )
  {
    $Gallery = new Gallery();
    $content = $Gallery->embed( $atts );
  }
  else
    $content = '[' . $tag . ']';  
  return $content;
}


/* An advanced shortcode processor needs to know the context in which 
   the shortcode is being expanded. There are times when we don't want to show the
   HTML since this may include information that would cause CSS to
   do some unexpected styling - so that needs to be stripped
   but there are other times when we do want this to happen
   This function is an experimental / exploratory function
   to find out what needs to be done, when, where and how.
*/   
function bw_clever( $atts, $hmm=NULL, $tag=NULL ) {
  /* The current_filter function lets us know why the shortcode is being expanded
     but we also need to know the purpose.
     
     e.g. the_title is used in a multitude of places
     when displayed on a post, page or widget we may want the text nicely formatted
     but in a page list we want plain text - with no shortcode expansion OR expanded but not styled
     How do we decide the best approach to this problem?
     
  */   
  $cf = current_filter();
  bw_trace( $cf, __FUNCTION__, __LINE__, __FILE__, "current_filter" );
 
  $admin = is_admin();
  return( $tag );
}  




function bw_gp_slides( $atts ) {
  $content = __FUNCTION__;
  $content .= __LINE__;
  $content .= function_exists( 'embed' );
  
  $content .= __LINE__;
  
  // $content = Gallery::embed( $atts );
  
  $Gallery = new Gallery();
  
  $content .= __LINE__;
  $content .= $Gallery->embed( $atts );
  
  $content .= __LINE__;
  return $content;

}

/**
 * Set a default value for an empty attribute value from the oik option or a hardcoded value
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
 * These are dummy functions to demonstrate my appaling understanding of php's OO implementation 
*/
function bw_nobbut() {
  return "";
}



function bw_wtf() {

  bw_trace( "wtf", __FUNCTION__, __LINE__, __FILE__, "wtf" );
  return( "what the f*ck");

}

/** 
 * Expand a shortcode if the function is defined for the event
 *
 * If the function is not defined then simply return the tag inside []'s
*/ 
function bw_shortcode_event( $atts, $hmm=NULL, $tag=NULL ) {
  global $bw_sc_ev, $bw_sc_ev_pp;
  
  $cf = current_filter();
  if ( empty( $cf ) ) { $cf = 'wp_footer'; }
  
  bw_trace( $cf, __FUNCTION__, __LINE__, __FILE__, "current_filter" );
  bw_trace( $tag, __FUNCTION__, __LINE__, __FILE__, "tag" ); 
  if ( isset( $bw_sc_ev[ $tag ][ $cf ] ))  {
    $shortcodefunc = $bw_sc_ev[ $tag ][ $cf ];
    $result = $shortcodefunc( $atts, $hmm, $tag );   
  } else {
    $result = '[' . $tag . ']';
  }
  

  bw_trace( $result, __FUNCTION__, __LINE__, __FILE__, "result" );
  if ( isset( $bw_sc_ev_pp[ $tag ][ $cf ] ))  {
    $ppfunc = $bw_sc_ev_pp[ $tag ][ $cf ];
    $result = $ppfunc( $result, $cf ); 
      
    bw_trace( $result, __FUNCTION__, __LINE__, __FILE__, "result" );
  }
  
  return $result;  
  
}

/** 
 * bw_strip_tags() is equivalent to esc_attr( strip_tags() )
 * but it also gets passed the current_filter - future use
*/
function bw_strip_tags( $string, $current_filter=NULL ) {
  $rstring = $string;
  $rstring = strip_tags( $rstring );
  $rstring = esc_attr( $rstring );
  return $rstring;
}

/** 
 * bw_admin_strip_tags() strips tags if the content is being displayed on an admin page 
 * but it also gets passed the current_filter - future use
*/
function bw_admin_strip_tags( $string, $current_filter=NULL ) {

  bw_trace( $string, __FUNCTION__, __LINE__, __FILE__, "string" );
  $rstring = $string;
  if ( is_admin() ) {
    $rstring = bw_strip_tags( $rstring, $current_filter );
  }
  return $rstring;
}

 

/**
 * Add a shortcode function for a specific set of events
 *
 * This is a wrapper API for add_shortcode() that will affect how shortcodes are expanded during do_shortcode() processing.
 * Instead of calling the shortcode expansion function directly we always invoke bw_shortcode_event()
 * bw_shortcode_event() checks to see if the shortcode should be expanded in the context.
 * The $postprocess parameter is a function name for performing post processing of the $result in certain contexts
 * Possible functions are
 *   bw_strip_tags 
 *   tbc
*/
function bw_add_shortcode_event( $shortcode, $function=NULL, $eventlist='the_content,widget_text,the_title', $postprocess=NULL ) {
  global $bw_sc_ev, $bw_sc_ev_pp;
  bw_trace( $shortcode, __FUNCTION__, __LINE__, __FILE__, "shortcode" );
 
  
  if ( $function == NULL ) {
    $function = $shortcode;
  }
  $events = explode( ",", $eventlist );
  foreach ( $events as $event )  {
    $bw_sc_ev[ $shortcode][ $event ] = $function;
    if ( $postprocess != NULL ) {
      $bw_sc_ev_pp[ $shortcode][ $event ] = $postprocess;
    }
  }  
  // bw_trace( $bw_sc_ev, __FUNCTION__, __LINE__, __FILE__, "bw_sc_ev" );

  add_shortcode( $shortcode, "bw_shortcode_event" );
  
  
}

/**
 * Add a shortcode that safely expands in admin page titles
 * but is properly expanded in content and widget text
 * Note: settings_page_bw_email_signature is included to allow the shortcodes to be shown on the "oik email signature" page
*/
function bw_add_shortcode( $shortcode, $function=NULL ) {
  bw_add_shortcode_event( $shortcode, $function, 'the_content,widget_text,wp_footer,settings_page_bw_email_signature' );
  bw_add_shortcode_event( $shortcode, $function, 'the_title', 'bw_admin_strip_tags' );
}  

bw_add_shortcode_event( "bw_wtf");
bw_add_shortcode_event( "bw_wtf", NULL, "the_title", "bw_strip_tags" );

bw_add_shortcode_event( 'bw_ngslideshow', 'NextGEN_shortcodes::show_slideshow', 'the_content,widget_text' );

bw_add_shortcode_event( 'bw_directions', 'bw_directions', 'the_content,widget_text' );

//add_shortcode( 'bw', 'bw' );
bw_add_shortcode_event( "bw", "bw", 'the_content,widget_text,wp_footer' );
bw_add_shortcode_event( "bw", "bw", 'the_title', 'bw_admin_strip_tags' );

bw_add_shortcode_event( 'oik', 'bw_oik' );
bw_add_shortcode_event( "oik", "bw_oik", 'the_title', 'bw_admin_strip_tags' );


bw_add_shortcode( 'bw_address', 'bw_address');
bw_add_shortcode( 'bw_mailto', 'bw_mailto' );
bw_add_shortcode( 'bw_email', 'bw_email' );
bw_add_shortcode( 'bw_geo', 'bw_geo' );
bw_add_shortcode( 'bw_telephone', 'bw_telephone' );
bw_add_shortcode( 'bw_fax', 'bw_fax' );
bw_add_shortcode( 'bw_mobile', 'bw_mobile' );
bw_add_shortcode( 'bw_wpadmin', 'bw_wpadmin' );
bw_add_shortcode( 'bw_show_googlemap', 'bw_show_googlemap');
bw_add_shortcode( 'bw_contact', 'bw_contact' );

bw_add_shortcode( 'bw_twitter', 'bw_twitter' );
bw_add_shortcode( 'bw_facebook', 'bw_facebook' );
bw_add_shortcode( 'bw_linkedin', 'bw_linkedin' );
bw_add_shortcode( 'bw_youtube', 'bw_youtube' );
bw_add_shortcode( 'bw_flickr', 'bw_flickr' );
bw_add_shortcode( 'bw_picasa', 'bw_picasa' );
bw_add_shortcode( 'bw_skype', 'bw_skype' );

bw_add_shortcode( 'bw_googleplus', 'bw_google_plus' );
bw_add_shortcode( 'bw_google_plus', 'bw_google_plus' );
bw_add_shortcode( 'bw_google-plus', 'bw_google_plus' );
bw_add_shortcode( 'bw_google', 'bw_google_plus' );


bw_add_shortcode( 'bw_company', 'bw_company' );
bw_add_shortcode( 'bw_business', 'bw_business' );
bw_add_shortcode( 'bw_formal', 'bw_formal' );
bw_add_shortcode( 'bw_slogan', 'bw_slogan' );
bw_add_shortcode( 'bw_alt_slogan', 'bw_alt_slogan' );
bw_add_shortcode( 'bw_admin', 'bw_admin' );
bw_add_shortcode( 'bw_domain', 'bw_domain' );

// bw_add_shortcode( 'div', 'bw_div' );
// bw_add_shortcode( 'ediv', 'bw_ediv' );

bw_add_shortcode( 'clear', 'bw_clear' );
bw_add_shortcode( 'bw_tel', 'bw_tel' );
bw_add_shortcode( 'bw_mob', 'bw_mob' );
//add_shortcode( 'bw_directions', 'bw_directions' );

bw_add_shortcode( 'ngslideshow', 'NextGEN_shortcodes::show_slideshow' );

//add_shortcode( 'gpslideshow', 'bw_gp_slideshow' );

bw_add_shortcode( 'gpslides', 'bw_gp_slideshow' );
//add_shortcode( 'clever', 'bw_clever' );
bw_add_shortcode( 'bw_follow_me', 'bw_follow_me' );


//bw_add_shortcode( 'bw_logo', 'bw_logo' );
bw_add_shortcode_event( 'bw_logo', 'bw_logo', 'the_content,widget_text,settings_page_bw_email_signature' );
bw_add_shortcode_event( 'bw_qrcode', 'bw_qrcode', 'the_content,widget_text,settings_page_bw_email_signature');










