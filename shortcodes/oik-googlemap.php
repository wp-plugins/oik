<?php 
/*
    Copyright 2011-2015 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Insert multiple markers
 *
 * We accept a marker string like this:
 *
 * 0,1,2,lat:lng,lat2:lng2
 *
 * Where
 * - 0,1 and 2 - represent oik alternate locations
 * - lat:lng - is the latitude and longitude separated by colons
 *
 * @TODO - support infowindow 
 *
 * @param string|array $markers - the markers to display on the map
 */
function bw_gmap_markers( $markers ) {
  $marker_arr = bw_as_array( $markers );
  if ( count( $marker_arr ) ) {
    foreach ( $marker_arr as $marker ) {
      if ( $marker == absint( $marker ) ) {
        $alt = $marker;
        $set = "bw_options$alt"; 
        $lat = bw_default_empty_att( null, "lat", 50.887856, $set );
        $long = bw_default_empty_att( null, "long", -0.965113, $set );
        $latlng = "$lat,$long";
        $title = $latlng;
        bw_echo( 'latlng = new google.maps.LatLng('. $latlng .');' );
        bw_gmap_marker( $title );
      } elseif ( strpos( $marker, ":" ) ) {
        $latlng = str_replace( ":", ",", $marker );
        bw_echo( 'latlng = new google.maps.LatLng('. $latlng .');' );
        bw_gmap_marker( $latlng );
      } else {
        //bw_gmap_infowindow( $marker, "" );
      }
    }
  }
}

/*
 * Set the Google map marker
 *
 */
function bw_gmap_marker( $title ) {
  bw_echo( 'var marker = new google.maps.Marker({ position: latlng, title:"' . $title . '"});' );
  bw_echo( 'marker.setMap( map );' );
}

/*
 * Set the Google map Info Window
 *
 * @TODO Don't display anything if the contentString becomes null when you trim it.
 * 
 */
function bw_gmap_infowindow( $title, $postcode ) {
  bw_echo( "var contentString = '". $title . " " . $postcode . "';" );   
  bw_echo( 'var infowindow = new google.maps.InfoWindow({ content: contentString });' );
  bw_echo( 'infowindow.open( map, marker );' );
} 

/* 
 * Display a GoogleMap using Google Maps JavaScript API V3
 * 
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
 * If this doesn't work don't forget to set: #bw_map_canvas { height: 100% } in oik.css or your custom CSS file
 * Note: the default height is 100%
 *
 * 31 Oct 2014: Quick and Dirty fix to support the display of multiple Google maps on a page.
 * Each time the routine is invoked it increments the $map variable.
 * This is used to create multiple initialize functions. 
 * At the end of the initialize function, if the map is greater than one then
 * it invokes the previous initialize function.
 * So initialise1() will call initialize0()
 * This gets over the problem of only the last initialize function being called by window.onload=initialisen;
 *
 *
 * @param string $title - part of the infowindow
 * @param number $lat - latitude
 * @param number $lng - longitude
 * @param string $postcode - part of the infowindow
 * @param string $width - width in pixels or percentage  
 * @param string $height - height in pixels
 * @param string $markers - display multiple markers - for each alt number chosen. 
 */
function bw_googlemap_v3(  $title, $lat, $lng, $postcode, $width, $height, $markers=null, $zoom=12 ) {
  static $map = 0;
  

  $latlng = $lat . ',' . $lng ;
  
  if ( !$map ) {
    bw_echo( '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;region=GB">' );
    bw_echo( '</script>' );
  }
  bw_echo( '<script type="text/javascript">' );
  bw_echo( 'function initialize' . $map . '() {' );
  bw_echo( 'var latlng = new google.maps.LatLng('. $latlng .');' );
  
  // Choose from ROADMAP, SATELLITE, HYBRID, TERRAIN 
  bw_echo( "var myOptions = { zoom: $zoom, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP };" );
  bw_echo( 'var map = new google.maps.Map(document.getElementById("bw_map_canvas' . $map . '"), myOptions); ' );
  
  if ( $postcode ) {
    bw_gmap_marker( $postcode );
    bw_gmap_infowindow( $title, $postcode );
  }
  if ( $markers ) {
    bw_gmap_markers( $markers );
  }
  
  if ( $map ) {
    $previous = $map - 1;
    bw_echo( 'initialize' . $previous. '();' );
  }
  bw_echo( '}' );
  bw_echo( 'window.onload=initialize' . $map . ';');

  bw_echo( '</script>' );
  
  
  // Here we set the min-height so that the Google Map should at least be visible 
  
  if ( $height ) {
    $hv = ' height:'. $height; 
  } else {
    $hv = '';  
  }  
  bw_echo( '<div class="bw_map_canvas" id="bw_map_canvas' . $map . '" style="min-height: 200px; width:' . $width. ';' .$hv .';"></div>');
  $map++;

}

/* 
 * Fixed or percentage?
 * 
 * @param string $value - the value being tested
 * @param string $append - what to append if the value is numeric
 * @return string - the updated value
 *  
 */
function bw_forp( $value, $append='px' ) {
  if ( is_numeric( $value ))
    $value .= $append;
  return( $value );   
}

/* 
 * Implement [bw_show_googlemap] shortcode to display a Google Map
 *
 *
 * For oik 2.4-alpha.1001 this has been changed to work with oik-user
 * Also, any spaces in the post code are converted to &nbsp; 
 *
 * For oik 2.5-alpha.0203 we now support zoom=, and an improved solution for markers
 * 
 * The width may default to 100%, the height may default to 400px
 *
 * @param array $atts - shortcode attributes
 * @param string $content - not expected
 * @param string $tag - the shortcode 
 */
function bw_show_googlemap( $atts=null, $content=null, $tag=null ) {
  //$company = bw_array_get_dcb( $atts, "company", "company", "bw_get_option", "bw_options" );
  $company = bw_get_option_arr( "company", "bw_options", $atts );
  $width = bw_array_get( $atts, "width", null );
  $height = bw_array_get( $atts, "height", null );
  //$lat = bw_array_get( $atts, "lat", null );
  $lat = bw_get_option_arr( "lat", "bw_options", $atts );
  //$long = bw_array_get( $atts, "long", null );
  $long = bw_get_option_arr( "long", "bw_options", $atts );
  //$postcode = bw_array_get( $atts, "postcode", null );
  $postcode = bw_get_option_arr( "postcode", "bw_options", $atts );
  //e( "Postcode:$postcode:" );
  $markers = bw_array_get( $atts, "markers", null );
  $zoom = bw_array_get( $atts, "zoom", 12 ); 
      
  // $company = bw_get_option( "company" );
  $alt = bw_array_get( $atts, "alt", null );
  $alt = str_replace( "0", "", $alt );
  //$gmap_intro = bw_get_option( "gmap_intro", "bw_options$alt" );
  $gmap_intro = bw_get_option_arr( "gmap_intro", "bw_options", $atts );
  
  //$gmap_intro = bw_get_option_arr( "gmap_intro", "bw_options", $atts );
  if ( $gmap_intro ) {
    p( bw_do_shortcode( $gmap_intro ) );
    // bw_backtrace();
  }
  /*
  if ( $company_override === NULL )
    bw_echo( '<p>This Google map shows you where <strong>' . $company . '</strong> is located.</p>');
  else 
    bw_echo( '<p>This Google map should show you where <strong>' . $company_override . '</strong> is located.</p>');
  */  
  $set = "bw_options$alt"; 
 
  $width = bw_default_empty_att( $width, "width", "100%", $set);
  
  // The default height allows for the info window being opened above the marker which is centred in the map.
  // any less than this and the top of the info window gets cropped
  $height = bw_default_empty_att( $height, "height", "400px", $set );

  
  $height = bw_forp( $height );
  
  $lat = bw_default_empty_att( $lat, "lat", 50.887856, $set );
  $long = bw_default_empty_att( $long, "long", -0.965113, $set );
  
  if ( !$postcode ) {
    //$postcode = bw_default_empty_att( $postcode, "postal-code", NULL, $set );
    
    $postcode = bw_get_option_arr( "postal-code", "bw_options", $atts );
  }
  $postcode = str_replace( " ", "&nbsp;", $postcode );
 
  bw_googlemap_v3( $company      
            , $lat
            , $long
            , $postcode
            , $width
            , $height
            , $markers
            , $zoom
            );
  return( bw_ret() );
}

/**
 * bw_show_googlemap example
 * 
 * Note: This works on a normal page but not when invoked on the oik Shortcodes thickbox overlay
 * - probably something to do with the javascript not being processed by the .js
*/ 
function bw_show_googlemap__example( $shortcode = "bw_show_googlemap" ) {
  bw_invoke_shortcode( $shortcode, null, "To display a Googlemap for your company location" );    
  p( "Some of the default values are extracted from oik information:" );
  sul();
  li( "company - for the Company name" );
  li( "lat - for the latitude" );
  li( "long - for the longitude" );
  li( "width - map width (  100% )" );
  li( "height - map height ( 400px - to allow for the info window )" );
  eul();
}


function bw_show_googlemap__syntax( $shortcode = "bw_show_googlemap" ) {
  $syntax = array( "company" => bw_skv( "", "company name", "type your company name" )
                 , "lat" => bw_skv( "<i>lat</i>", "latitude", "latitude" )
                 , "long" => bw_skv( "<i>long</i>", "longitude", "longitude" )
                 , "postcode" => bw_skv( "<i>postcode</i>", "postcode", "post code or zip code" )
                 , "width" => bw_skv( "100%", "width", "width of the Google map" )
                 , "height" => bw_skv( "400px", "height", "height of the map" )
                 , "markers" => bw_skv( null, "marker1,marker2", "Additional markers" )
                 , "zoom" => bw_skv( 12, "number", "Zoom level" )
                 );
  return( $syntax );
}

/**
 * Update the input to the geocoded address 
 * @param array $input - the set of input fields that WordPress is managing
 * @param object $json - JSON object
 
 * First get status
 * then results[0]
 * 
 


stdClass Object
(
    [results] => Array
        (
            [0] => stdClass Object
                (
                    [address_components] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [long_name] => PO9 6DE
                                    [short_name] => PO9 6DE
                                    [types] => Array
                                        (
                                            [0] => postal_code
                                        )

                                )

                            [1] => stdClass Object
                                (
                                    [long_name] => Rowland's Castle
                                    [short_name] => Rowland's Castle
                                    [types] => Array
                                        (
                                            [0] => locality
                                            [1] => political
                                        )

                                )

                            [2] => stdClass Object
                                (
                                    [long_name] => Hampshire
                                    [short_name] => Hampshire
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_2
                                            [1] => political
                                        )

                                )

                            [3] => stdClass Object
                                (
                                    [long_name] => United Kingdom
                                    [short_name] => GB
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                            [4] => stdClass Object
                                (
                                    [long_name] => Rowland's Castle
                                    [short_name] => Rowland's Castle
                                    [types] => Array
                                        (
                                            [0] => postal_town
                                        )

                                )

                        )

                    [formatted_address] => Rowland's Castle, Hampshire PO9 6DE, UK
                    [geometry] => stdClass Object
                        (
                            [bounds] => stdClass Object
                                (
                                    [northeast] => stdClass Object
                                        (
                                            [lat] => 50.8879055
                                            [lng] => -0.9653666
                                        )

                                    [southwest] => stdClass Object
                                        (
                                            [lat] => 50.8865369
                                            [lng] => -0.9666216
                                        )

                                )

                            [location] => stdClass Object
                                (
                                    [lat] => 50.8869164
                                    [lng] => -0.9662886
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => stdClass Object
                                (
                                    [northeast] => stdClass Object
                                        (
                                            [lat] => 50.888570180292
                                            [lng] => -0.9646451197085
                                        )

                                    [southwest] => stdClass Object
                                        (
                                            [lat] => 50.885872219709
                                            [lng] => -0.9673430802915
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => postal_code
                        )

                )

        )

    [status] => OK
)

Extract from @link https://developers.google.com/maps/documentation/geocoding/#StatusCodes

Status Codes

The "status" field within the Geocoding response object contains the status of the request, and may contain debugging information to help you track down why Geocoding is not working. The "status" field may contain the following values:

"OK" indicates that no errors occurred; the address was successfully parsed and at least one geocode was returned.
"ZERO_RESULTS" indicates that the geocode was successful but returned no results. This may occur if the geocode was passed a non-existent address or a latlng in a remote location.
"OVER_QUERY_LIMIT" indicates that you are over your quota.
"REQUEST_DENIED" indicates that your request was denied, generally because of lack of a sensor parameter.
"INVALID_REQUEST" generally indicates that the query (address or latlng) is missing.

Extract from @link https://developers.google.com/maps/documentation/geocoding/#Types

Address Component Types

The types[] array within the returned result indicates the address type. These types may also be returned within address_components[] arrays to indicate the type of the particular address component. Addresses within the geocoder may have multiple types; the types may be considered "tags". For example, many cities are tagged with the political and locality type.

The following types are supported and returned by the HTTP Geocoder:

street_address indicates a precise street address.
route indicates a named route (such as "US 101").
intersection indicates a major intersection, usually of two major roads.
political indicates a political entity. Usually, this type indicates a polygon of some civil administration.
country indicates the national political entity, and is typically the highest order type returned by the Geocoder.
administrative_area_level_1 indicates a first-order civil entity below the country level. Within the United States, these administrative levels are states. Not all nations exhibit these administrative levels.
administrative_area_level_2 indicates a second-order civil entity below the country level. Within the United States, these administrative levels are counties. Not all nations exhibit these administrative levels.
administrative_area_level_3 indicates a third-order civil entity below the country level. This type indicates a minor civil division. Not all nations exhibit these administrative levels.
colloquial_area indicates a commonly-used alternative name for the entity.
locality indicates an incorporated city or town political entity.
sublocality indicates an first-order civil entity below a locality
neighborhood indicates a named neighborhood
premise indicates a named location, usually a building or collection of buildings with a common name
subpremise indicates a first-order entity below a named location, usually a singular building within a collection of buildings with a common name
postal_code indicates a postal code as used to address postal mail within the country.
natural_feature indicates a prominent natural feature.
airport indicates an airport.
park indicates a named park.
point_of_interest indicates a named point of interest. Typically, these "POI"s are prominent local entities that don't easily fit in another category such as "Empire State Building" or "Statue of Liberty."
In addition to the above, address components may exhibit the following types:

post_box indicates a specific postal box.
street_number indicates the precise street number.
floor indicates the floor of a building address.
room indicates the room of a building address.





*/

function bw_set_geocoded_address( $input, $json ) {
  bw_trace2();
  $status = bw_array_get( $json, "status", null );
  if ( $status == "OK" ) {
    $lat = $json->results[0]->geometry->location->lat;
    $long = $json->results[0]->geometry->location->lng;
    
    /* We can't map these by number as the results vary depending on what we got
       ALSO we may get more than one result! SO... how do we tell what's correct
       **?** Future enhancement
    $postal_code = $json->results[0]->address_components[0]->long_name;
    $locality =  $json->results[0]->address_components[1]->long_name;
    $region = $json->results[0]->address_components[2]->long_name;
    $country_name = $json->results[0]->address_components[3]->long_name;  
    $country_abbr =  $json->results[0]->address_components[3]->short_name; 
    */
  }
  $input['lat'] = $lat;
  $input['long'] = $long;
  
  
  return( $input );
} 


/**
 * Geocode the given address to return the lat and long 
 
  bw_textfield_arr( $option, "Extended-address [bw_address alt=1]", $options, 'extended-address', 50 );
  bw_textfield_arr( $option, "Street-address", $options, 'street-address', 50 );
  bw_textfield_arr( $option, "Locality", $options, 'locality', 50 );
  bw_textfield_arr( $option, "Region", $options, 'region', 50 );
  bw_textfield_arr( $option, "Post Code", $options, 'postal-code', 50 );
  bw_textfield_arr( $option, "Country name", $options, 'country-name', 50 );
 */

function bw_geocode_googlemap( $input ) {
  $extended_address = bw_array_get( $input, 'extended-address', "" );
  $street_address = bw_array_get( $input, 'street-address', "" );
  $locality = bw_array_get( $input, 'locality', "" );
  $region = bw_array_get( $input, 'region', "" );
  $postal_code = bw_array_get( $input, 'postal-code', "" );
  $country_name = bw_array_get( $input, 'country-name', "" );
  
  $address = bw_append( $extended_address, null );
  $address .= bw_append( $street_address );
  $address .= bw_append( $locality );
  $address .= bw_append( $region );
  $address .= bw_append( $postal_code );
  $address .= bw_append( $country_name );
  $address = urlencode( $address );
  
  if ( $address ) {
  
    $map_url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";
    // Google's documentation recommends using JSON since it's smaller than the XML output.
    // $map_url = "http://maps.google.com/maps/api/geocode/xml?sensor=false&address=";
    $map_url .= $address;
  
    oik_require( "includes/oik-remote.inc" );
  
    $json = bw_remote_get( $map_url );
    if ( $json ) {
      $input = bw_set_geocoded_address( $input, $json );
   }
  }    
  return( $input );
  

} 





