<?php 

function bwapi_trace_test( $text) {
  if ( function_exists( 'bw_trace' ) ) {
    bw_trace( $text, __FUNCTION__, __LINE__, __FILE__ );
  } 
  else {
    //Do nothing - tracing not yet enabled, loaded.
    function bw_trace( $text ) {
      // echo "<!-- bwapi bwtrace $text-->\n";
    }
    bw_trace( $text );  
  } 
  
}


function bw_trace_inc_init() {   
  global $bw_trace_options, $bwapi_trace_test;   
  $bw_trace_options = array( 'file' => "bwtrace.log" ); 
  bw_trace_off();
  // bw_trace_errors( 3 );
  //echo "<p>BAT1 $bwapi_trace_test</p>";

  if (isset( $bwapi_trace_test )) {

    if ( $bwapi_trace_test <> 'bwtrace' ) { 
      $bwapi_trace_test = 'bwapi_trace_test';
    }
    else {
      $bwapi_trace_test = 'bwapi_trace_test';
    }
  }
  else {
    $bwapi_trace_test = 'bwapi_trace_test';
  }     
  //echo "<p>BAT2 $bwapi_trace_test</p>";

}  



function bw_trace_on()
{
  global $bw_trace_on;
  $bw_trace_on = TRUE;
}

function bw_trace_off()
{
  global $bw_trace_on;
  $bw_trace_on = FALSE;
} 


function bw_getlocale($category=LC_ALL) {
  return setlocale($category, NULL);
}


/* Format required for the trace record is something like this
 
C:\apache\htdocs\wordpress\wp-content\plugins\bwtrace\bwtrace.php(116:0)  1 2011-01-05T22:43:13+00:00
*/
function bw_flf( $function, $lineno, $file, $level,  $text, $text_label = NULL ) {

  $ref = $file;
  $ref .= '('.$lineno.':0) ';
  $ref .= date( DATE_W3C );
  $ref .= " ";
  $ref .= $function;
  $ref .= " ";
  $ref .= $level;
  $ref .= " ";
  $ref .= $text_label;
  $ref .= " ";
  $ref .= print_r( $text, TRUE );
  $ref .= "\n";
  return( $ref );
}   

  
  function bw_trace( $text, $function=__FUNCTION__, $lineno=__LINE__, $file=__FILE__, $text_label=NULL) {
    global $oktop, $bw_trace_on, $bw_trace_level;
    $oktop = TRUE;
  
    if ($bw_trace_on)
    {
      $line = bw_flf( $function, $lineno, $file, $bw_trace_level, $text, $text_label );  
      bw_trace_log( $line );  
      
    }  
    else { 
      // echo "<!--bw_trace_on is off -->" ;   
    }  
  }  
  


function bw_trace_file() {   
  global $bw_trace_options;
  // $file = bw_get_docroot_suffix();
  if ( defined( ABSPATH ))
    $file = ABSPATH;
  else 
    $file = ABSPATH; 
     
  $file .= $bw_trace_options['file'];
  return( $file );
}
  
function bw_trace_batch() {   
  global $bw_trace_options;   
  $bw_trace_options = array( 'file' => "bwtrace.log" ); 
  // $bw_trace_options['file'] = "bwtrace.log";
  bw_trace_on();
  bw_trace_errors( 3 );
  bw_trace( $_GET, __FUNCTION__, __LINE__, __FILE__, "_GET" );
}  



function bw_trace_log( $line ) {
  // echo '<!--bw_trace_log '.$file.$line.'-->';
  $file = bw_trace_file();
  bw_write( $file, $line ); 
 
}

function bw_write( $file, $line ) {
  // echo 'in bw_write';
  $handle = fopen( $file, "a" );
  fwrite( $handle, $line );
  fclose( $handle );
} 

function bw_trace_reset()
{
  $file = bw_trace_file();
  // This file may not exist so we have two choices. 1. precede with an @, 2. test for it
  // but if $file is not set then we should test
  if ( is_file($file) )
    unlink( $file ); 
} 


function bw_trace_errors( $level ) {
  error_reporting( $level );
  
  @ini_set('display_errors', 1);
}

bw_trace_inc_init();  


