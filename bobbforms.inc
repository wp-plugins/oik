<?php // (C) Copyright Bobbing Wide 2009-2012
function label( $name, $text )
{
   $lab = "<label for=\"";
   $lab.= $name;
   $lab.= "\">";
   $lab.= $text;
   $lab.= "</label>";
   return( $lab );
}

function ihidden( $name, $value ) {
  $it = "";
  if ( $value != "" ) {
    $it = "<input type=\"hidden\" ";
    $it.= "name=\"";
    $it.= $name;
    $it.= "\" value=\"";
    $it.= $value;
    $it.= "\" />"; 
  }  
  return $it;
}  

function itext( $name, $len, $value )
{
  $width = ($len * 20) ;
  $it = "<input type=\"text\" size=\"";
  $it.= $len;
  $it.= "\" ";
  //$it.= "width=\"".$width;
  //$it.= "\" 
  $it.= "name=\"";
  $it.= $name;
  $it.= "\" id=\"";
  $it.= $name;
  $it.= "\" value=\"";
  $it.= $value;
  $it.= "\" />"; 
  return $it;
}  

function iarea( $name, $len, $value )
{
  $it = "<textarea rows=\"10\" cols=\"";
  $it.= $len;
  $it.= "\" name=\"";
  $it.= $name;
  $it.= "\" id=\"";
  $it.= $name;
  $it.= "\">";   
  $it.= $value;
  $it.= "</textarea>";

  return $it;
}  


function tablerow( $td1, $td2 )
{  
   echo '<tr>';
   echo '<td>'.$td1.'</td>';
   echo '<td>'.$td2.'</td>';
   echo '</tr>';
   return 0;
}

function bw_td( $text=NULL, $class=NULL, $id=NULL ) {
  if ( $text ) {
    stag( "td", $class, $id );
    e( $text );
    etag( "td");
  }
}

function bw_tablerow( $td_array= array() ) {
  stag( "tr" );
  foreach ( $td_array as $td ) {
    bw_td( $td );
  }
  etag( "tr"); 
}

function textfield($name, $len, $text, $value )
{
  $lab = label( $name, $text );
  $itext = itext( $name, $len, $value ); 
  tablerow( $lab, $itext );
  return;
}

function textarea( $name, $len, $text, $value )
{
  $lab = label( $name, $text );
  $itext = iarea( $name, $len, $value ); 
  tablerow( $lab, $itext );
  return;
}


function bw_textfield( $name, $len, $text, $value ) {
  $lab = label( $name, $text );
  $itext = itext( $name, $len, $value ); 
  bw_tablerow( array( $lab, $itext ) );
  return;
}

function bw_textarea( $name, $len, $text, $value ) {
  $lab = label( $name, $text );
  $itext = iarea( $name, $len, $value ); 
  bw_tablerow( array( $lab, $itext) );
  return;
}


function iselect( $name, $value, $args ) {
  $iselect = "<select name=\"$name\">" ;
  $options = $args['#options'];
  foreach ( $options as $option_key => $option_value ) {
    $selected = selected( $option_key, $value, false );
    $option = "<option value=\"$option_key\" $selected>$option_value</option>";
    $iselect .= $option; 
  }
  $iselect .= "</select>" ;
  return( $iselect );
} 

function bw_select( $name, $text, $value, $args ) {
  $lab = label( $name, $text );
  $iselect = iselect( $name, $value, $args ); 
  bw_tablerow( array( $lab, $iselect ) );
  return;
}
 
