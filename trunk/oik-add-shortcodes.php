<?php 
/* Shortcodes for each of the more useful "often included key-information" fields 
   in Bobbing Wide's Wonder of WordPress websites
*/
add_shortcode( 'bw', 'bw' );
add_shortcode( 'oik', 'bw_oik' );

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
add_shortcode( 'bw_skype', 'bw_skype' );

add_shortcode( 'bw_googleplus', 'bw_google_plus' );
add_shortcode( 'bw_google_plus', 'bw_google_plus' );
add_shortcode( 'bw_google-plus', 'bw_google_plus' );
add_shortcode( 'bw_google', 'bw_google_plus' );


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
add_shortcode( 'bw_tel', 'bw_tel' );
add_shortcode( 'bw_mob', 'bw_mob' );
add_shortcode( 'bw_directions', 'bw_directions' );

add_shortcode( 'ngslideshow', 'NextGEN_shortcodes::show_slideshow' );

//add_shortcode( 'gpslideshow', 'bw_gp_slideshow' );

add_shortcode( 'gpslides', 'bw_gp_slideshow' );
//add_shortcode( 'clever', 'bw_clever' );


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


/* These are dummy functions to demonstrate my appaling understanding of php's OO implementation */
function bw_nobbut() {
}



function bw_wtf() {

  bw_trace( "wtf", __FUNCTION__, __LINE__, __FILE__, "wtf" );
  return( "wtf");

}






