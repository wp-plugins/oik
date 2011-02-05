<?php // (C) Copyright Bobbing Wide 2010, 2011


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

function bw_show_googlemap( $atts)
{ 
  $a = extract(shortcode_atts(array(
		'company_override' => NULL,
	), $atts));
        
  //$isnull = is_null( $company_override );
  //p( "isnull:".$isnull.":" );
  //p( "company_override:".$company_override.":");     
  $company = bw_get_company( "company" );
  if ( $company_override === NULL )
    bw_echo( '<p>This Google map shows you where <strong>' . $company . '</strong> is located.</p>');
  else 
    bw_echo( '<p>This Google map should show you where <strong>' . $company_override . '</strong> is located.</p>');
 
  bw_googlemap( $company      
            , bw_get_company( "lat" )
            , bw_get_company( "long" )
            , bw_get_company( "postal-code" )
            );
  return( bw_ret() );
}  


