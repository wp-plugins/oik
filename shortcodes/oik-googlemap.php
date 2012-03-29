<?php // (C) Copyright Bobbing Wide 2010-2012

/*
 * set the Google map marker
*/
function bw_gmap_marker( $title ) {
  bw_echo( 'var marker = new google.maps.Marker({ position: latlng, title:"' . $title . '"});' );
  bw_echo( 'marker.setMap( map );' );
}

/*
 * set the Google map Info Window
*/
function bw_gmap_infowindow( $title, $postcode ) {
  bw_echo( "var contentString = '". $title . " " . $postcode . "';" );   
  bw_echo( 'var infowindow = new google.maps.InfoWindow({ content: contentString });' );
  bw_echo( 'infowindow.open( map, marker );' );
} 

/* 
 * Google Maps JavaScript API V3
 * Display a GoogleMap centred around the lat and long specified in oik options
 * zoomed to level 12 - which is good for local viewing
 * with a red marker centred at the lat,long and showing the postcode as a tool tip 
 * and an info window showing the title and postcode
 *
 * For programming details see http://code.google.com/apis/maps/documentation/javascript/basics.html#Welcome
 * Restrictions of this implementation
 * 1. Does not detect the user's location -> sensor=false
 * 2. Does not detect IPhone or Android devices 
 * 3. Does not perform language localization
 * 4. Region defaults to GB
 * 5. Does not add any additional libraries. not geometry, adsense nor panoramio
 * 6. Does not support loading the API over HTTPS
 * 7. Loads synchronously - rather than Asynchronously
 * 8. Does not specify the version. v=3 being the default
 *
 * If this doesn't work don't forget to set: #map_canvas { height: 100% } in oik.css
 * Note: the default height is 100%
*/
 
function bw_googlemap_v3(  $title, $lat, $lng, $postcode, $width, $height ) {

  $latlng = $lat . ',' . $lng ;

  bw_echo( '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;region=GB">' );
  bw_echo( '</script>' );
  bw_echo( '<script type="text/javascript">' );
  bw_echo( 'function initialize() {' );
  bw_echo( 'var latlng = new google.maps.LatLng('. $latlng .');' );
  
  // Choose from ROADMAP, SATELLITE, HYBRID, TERRAIN 
  bw_echo( 'var myOptions = { zoom: 12, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP };' );
  bw_echo( 'var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); ' );

  if ( $postcode ) {
    bw_gmap_marker( $postcode );
    bw_gmap_infowindow( $title, $postcode );
  }
  bw_echo( '}' );
  bw_echo( 'window.onload=initialize;');

  bw_echo( '</script>' );
  
  
  // Here we set the min-height so that the Google Map should at least be visible 
  
  if ( $height ) {
    $hv = ' height:'. $height; 
  } else {
    $hv = '';  
  }  
  bw_echo( '<div id="map_canvas" style="min-height: 200px; width:' . $width. ';' .$hv .';"></div>');


}

/* 
 * Fixed or percentage? 
 */
function bw_forp( $value, $append='px' ) {
  if ( is_numeric( $value ))
    $value .= $append;
  return( $value );   
}

/* 
 * show a googlemap - called from [bw_show_googlemap] 
 * The width may default to 100%, the height may default to 400px
 */
function bw_show_googlemap( $atts=NULL ) { 
  $a = extract(shortcode_atts(array(
		'company_override' => NULL,
                'width' => NULL,
                'height' => NULL,
                'lat' => NULL,
                'long' => NULL, 
                'postcode' => NULL,
	), $atts));
        
  //$isnull = is_null( $company_override );
  //p( "isnull:".$isnull.":" );
  //p( "company_override:".$company_override.":");     
  $company = bw_get_option( "company" );
  if ( $company_override === NULL )
    bw_echo( '<p>This Google map shows you where <strong>' . $company . '</strong> is located.</p>');
  else 
    bw_echo( '<p>This Google map should show you where <strong>' . $company_override . '</strong> is located.</p>');
 
  $width = bw_default_empty_att( $width, "width", "100%" );
  
  // The default height allows for the info window being opened above the marker which is centred in the map.
  // any less than this and the top of the info window gets cropped
  $height = bw_default_empty_att( $height, "height", "400px" );

  // Karen makemybizmobile suggested I try not even setting the height
  //$height = bw_default_empty_att( $height, "height", NULL );
  
  $height = bw_forp( $height );
  
  $lat = bw_default_empty_att( $lat, "lat", 50.887856 );
  $long = bw_default_empty_att( $long, "long", -0.965113 );
  $postcode = bw_default_empty_att( $postcode, "postal-code", NULL );
  

  bw_googlemap_v3( $company      
            , $lat
            , $long
            , $postcode
            , $width
            , $height
            );
  return( bw_ret() );
}

function bw_show_googlemap__example( $shortcode = "bw_show_googlemap" ) {
  p( "To display a Googlemap for your company location use [bw_show_googlemap]" );
  p( "Some of the default values are extracted from oik information:" );
  sul();
  li( "company - for the Company name" );
  li( "lat - for the latitude" );
  li( "long - for the longitude" );
  li( "width - map width (  100% )" );
  li( "height - map height ( 400px - to allow for the info window )" );
  eul();
  
  $example = "[$shortcode]";
  p ( $example );
  bw_add_shortcode_event( $shortcode, $shortcode, current_filter() );
  e( do_shortcode( $example ));
}


function bw_show_googlemap__syntax( $shortcode = "bw_show_googlemap" ) {
  $syntax = array( "company_override" => bw_skv( "", "company name", "type your company name" )
                 , "lat" => bw_skv( "<i>lat</i>", "latitude", "latitude" )
                 , "long" => bw_skv( "<i>long</i>", "longitude", "longitude" )
                 , "postcode" => bw_skv( "<i>postcode</i>", "postcode", "post code or zip code" )
                 , "width" => bw_skv( "100%", "width", "width of the Google map" )
                 , "height" => bw_skv( "400px", "height", "height of the map" )
                 );
  return( $syntax );
}  


