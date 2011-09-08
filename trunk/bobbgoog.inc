<?php // (C) Copyright Bobbing Wide 2010, 2011


/* 
 * Google Maps JavaScript API V2 - now deprecated
*/
function bw_googlemap( $club, $lat, $lng, $postcode ) {
  $latlng = $lat . ',' . $lng ;
     
  //echo '<div class="sidebar-right">';
  //echo '<h2 class="bar-green-med-light">' . $club . '</a></h2>';
  //echo '<p>Use this button for ';
  //echo '<a href="http://maps.google.co.uk/maps?f=d&hl=en&daddr=' . $latlng . '" title="Google directions">Google directions</a></p>';
  //echo '</div>';
     
     
     bw_echo( '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=');
     bw_echo( bw_get_company( "google_maps_api_key" ));
     
     // ABQIAAAAEraXBMl-kX5b-Swk0AR98BQOEsTKtT06IEwsylb7Uz31uE8TkRRL_5k4o5givS__FLcKk7M8WMou8Q"');
     bw_echo( '" type="text/javascript"></script>');
     bw_echo( "<script type=\"text/javascript\">\n");

     bw_echo( "//<![CDATA[\n");
     bw_echo( "function load() {\n");
     bw_echo( 'if (GBrowserIsCompatible()) {');
     bw_echo( 'var map = new GMap2(document.getElementById("map"));');
     bw_echo( 'var point = new GLatLng( ' .  $latlng . ');');
     bw_echo( 'map.setCenter( point , 12);');
     bw_echo( 'map.addOverlay( new GMarker( point ));');
     bw_echo( 'map.openInfoWindow( point, document.createTextNode("' . $club . ' ' .  $postcode . '" ));');
     //map.setMapType( G_HYBRID_MAP); 
     bw_echo( 'var mapControl = new GMapTypeControl();');
     bw_echo( 'map.addControl( mapControl);');
     bw_echo( 'map.addControl( new GLargeMapControl());');
     bw_echo( '}');
     bw_echo( '}');
     bw_echo( '//]]>');
     bw_echo( '</script>');
     bw_echo( '<body onload="load()" onunload="GUnload()">');
     bw_echo( '<div id="map" style="width:' .bw_get_company( "width" ). 'px; height:'.bw_get_company( "height" ).'px"></div>');
     bw_echo( '</body>');
}
 

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

  bw_echo( '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=GB">' );
  bw_echo( '</script>' );
  bw_echo( '<script type="text/javascript">' );
  bw_echo( 'function initialize() {' );
  bw_echo( 'var latlng = new google.maps.LatLng('. $latlng .');' );
  
  // Choose from ROADMAP, SATELLITE, HYBRID, TERRAIN 
  bw_echo( 'var myOptions = { zoom: 12, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP };' );
  bw_echo( 'var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); ' );
  
  bw_gmap_marker( $postcode );
  bw_gmap_infowindow( $title, $postcode );
  
  bw_echo( '}' );

  bw_echo( '</script>' );
  
  bw_echo( '<body onload="initialize()">');
  
  // Here we set the min-height so that the Google Map should at least be visible 
  bw_echo( '<div id="map_canvas" style="min-height: 200px; width:' . $width. '; height:'. $height. ';"></div>');
  bw_echo( '</body>' );


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
  $company = bw_get_company( "company" );
  if ( $company_override === NULL )
    bw_echo( '<p>This Google map shows you where <strong>' . $company . '</strong> is located.</p>');
  else 
    bw_echo( '<p>This Google map should show you where <strong>' . $company_override . '</strong> is located.</p>');
 
  $width = bw_default_empty_att( $width, "width", "100%" );
  // The default height allows for the info window being opened above the marker which is centred in the map.
  // any less than this an the top of the info window gets cropped
  $height = bw_default_empty_att( $height, "height", "400px" );
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


