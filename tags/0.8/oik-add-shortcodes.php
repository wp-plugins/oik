<?php 
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
add_shortcode( 'bw_skype', 'bw_skype' );


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

add_shortcode( 'gpslideshow', 'bw_gp_slideshow' );


function bw_gp_slideshow( $atts ) {
  $Gallery = new Gallery();
  $content = $Gallery->embed( $atts );
  return $content;
}



/*
function bw_gp_slider( $atts ) {
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

*/

