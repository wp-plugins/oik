<?php // (C) Copyright Bobbing Wide 2009, 2011
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
?>
