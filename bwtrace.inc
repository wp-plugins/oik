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
  bw_trace_off();
  $bw_trace_options = array( 'file' => "bwtrace.log", 'trace' => 0, 'reset' => 0,  ); 

  //bw_trace_reset();
  //bw_trace_on();
  // bw_trace_errors( 3 );
  //echo "<p>BAT1 $bwapi_trace_test</p>";

  if (isset( $bwapi_trace_test )) {

    if ( $bwapi_trace_test <> 'bw_trace' ) { 
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



function bw_trace_on() {
  global $bw_trace_on;
  $bw_trace_on = TRUE;
}

function bw_trace_off() {
  global $bw_trace_on;
  $bw_trace_on = FALSE;
} 

function bw_getlocale($category=LC_ALL) {
  return setlocale($category, NULL);
}

function bw_trace_file_part( $file ) {
  global $bw_trace_anonymous;
  //$bw_trace_anonymous = TRUE;
  
  if ( $bw_trace_anonymous ) {
    $lose = str_replace( "/", "\\", ABSPATH );
    $file = str_replace( "/", "\\", $file );
    $fil = str_replace( $lose , '', $file );
  } 
  else
    $fil = $file; 
  return( $fil );
}



/**
 * Return the date for the trace record
 * 
 * Sometimes, when we want to compare trace output it helps if we eliminate dates from the trace output
 * This function allows that. 
 * $bw_trace_date is supposed to be an option field.
 */
function bw_trace_date( $format=DATE_W3C ) {
  global $bw_include_trace_date;
  
  // $bw_trace_date = FALSE;
  if ( $bw_include_trace_date )
    $ret = date( $format );
  else
    $ret = '';      
  return( $ret ) ;
}


/**
 * Return the trace record count if required
 * 
 * Sometimes, when we want to compare trace output it helps if we eliminate the trace counter from the trace output
 */
function bw_trace_count( $count ) {
  global $bw_include_trace_count;
  //$bw_include_trace_count = FALSE;
  
 if ( $bw_include_trace_count )
    $ret = $count;
  else
    $ret = '';      
  return( $ret ) ;
}


/**
 * Return TRUE if option is '1', FALSE otherwise
 */
function bw_torf( $array, $option ) {
  $opt = bw_array_get( $array, $option );
  $ret = $opt > '0';
  return $ret;
}



  
/* Format required for the trace record is something like this
 
C:\apache\htdocs\wordpress\wp-content\plugins\bwtrace\bwtrace.php(116:0)  1 2011-01-05T22:43:13+00:00
*/
function bw_flf( $function, $lineno, $file, $count,  $text, $text_label = NULL ) {
  $ref = bw_trace_file_part( $file );
  $ref .= '('.$lineno.':0) ';
  $ref .= bw_trace_date( DATE_W3C );
  $ref .= " ";
  $ref .= bw_trace_count( $count );
  $ref .= " ";
  $ref .= $function;
  $ref .= " ";
  $ref .= $text_label;
  $ref .= " ";
  $ref .= print_r( $text, TRUE );
  $ref .= "\n";
  return( $ref );
}   

  
function bw_trace( $text, $function=__FUNCTION__, $lineno=__LINE__, $file=__FILE__, $text_label=NULL) {
  global $oktop, $bw_trace_on, $bw_trace_count;
  $oktop = TRUE;
  
  if ($bw_trace_on)
  {
    if ( empty( $bw_trace_count ) )
      $bw_trace_count = 0;
    $bw_trace_count++;
    $line = bw_flf( $function, $lineno, $file, $bw_trace_count, $text, $text_label );  
    bw_trace_log( $line );  
      
  }  
  else { 
    // echo "<!--bw_trace_on is off -->" ;   
  }  
}  
  


function bw_trace_file() {   
  global $bw_trace_options;
  // $file = bw_get_docroot_suffix();
  
  if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
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


/* 
  write the trace line to the file
  if we can't open the file turn tracing off
  
  This is the sort of message we sometimes get.
  Not sure what's causing the error. It could be tailing the file.
   
  
Warning: fopen(C:\apache\htdocs\wordpress/bwtrace.log): 
failed to open stream: 
Permission denied in C:\apache\htdocs\wordpress\wp-content\plugins\oik\bwtrace.inc on line 148 
Call Stack: 
0.0018 467368 1. {main}() C:\apache\htdocs\wordpress\wp-admin\options-general.php:0 
0.0033 561816 2. require_once('C:\apache\htdocs\wordpress\wp-admin\admin.php') C:\apache\htdocs\wordpress\wp-admin\options-general.php:10 
0.0040 578248 3. require_once('C:\apache\htdocs\wordpress\wp-load.php') C:\apache\htdocs\wordpress\wp-admin\admin.php:30 
0.0047 595656 4. require_once('C:\apache\htdocs\wordpress\wp-config.php') C:\apache\htdocs\wordpress\wp-load.php:29 
0.0059 696120 5. require_once('C:\apache\htdocs\wordpress\wp-settings.php') C:\apache\htdocs\wordpress\wp-config.php:117 
0.2378 16843976 6. include_once('C:\apache\htdocs\wordpress\wp-content\plugins\oik\oik-bwtrace.php') C:\apache\htdocs\wordpress\wp-settings.php:192 
0.2428 17183640 7. bw_trace_plugin_startup() C:\apache\htdocs\wordpress\wp-content\plugins\oik\oik-bwtrace.php:59 
0.2431 17187240 8. bw_trace() C:\apache\htdocs\wordpress\wp-content\plugins\oik\oik-bwtrace.php:102 
0.2433 17187680 9. bw_trace_log() C:\apache\htdocs\wordpress\wp-content\plugins\oik\bwtrace.inc:93 
0.2433 17187760 10. bw_write() C:\apache\htdocs\wordpress\wp-content\plugins\oik\bwtrace.inc:129 
0.2433 17187840 11. fopen() C:\apache\htdocs\wordpress\wp-content\plugins\oik\bwtrace.inc:148 ? 

*/
function bw_write( $file, $line ) {
  // echo 'in bw_write';
  $handle = fopen( $file, "a" );
  // echo "<!-- $handle $file $line-->";
  if ( $handle === FALSE ) {
     bw_trace_off();
     // It would be nice to let them know... 
  }
  else {
    fwrite( $handle, $line );
    fclose( $handle );
  }
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
// bw_trace_on();


/** 
 * Return the array[index] or a default value if not set
 */
 
if ( !function_exists( 'bw_array_get' ) ) { 
  function bw_array_get( $array = array(), $index, $default=NULL ) {
    if ( isset( $array[$index] ) || ( is_array( $array) && array_key_exists( $index, $array ) ) )  {
      $value = $array[$index];
    } else {
      $value = $default;
    } 
    // bw_trace( $value, __FUNCTION__,  __LINE__, __FILE__, "value" ); 
    return( $value );
  }  
}


/** 
 * print a backtrace to help find out where something is called from and how to debug it
 *
 * The output from debug_backtrace() is an array - from 0 to n of the calls
 * [file] is the file name
 * [line] is the line number
 * [function] is the method used to get the file: include, require_once
 * [args] are parameters
 * [class]
 * [object]
 * [type] -> = method call,  :: = static method call, nothing for function call
 * 

 C:\apache\htdocs\wordpress\wp-content\themes\hsoh0922bp\functions.php(12:0) 2011-09-27T16:22:49+00:00   backtrace Array
(
    [0] => Array
        (
            [file] => C:\apache\htdocs\wordpress\wp-settings.php
            [line] => 280
            [function] => include
        )

    [1] => Array
        (
            [file] => C:\apache\htdocs\wordpress\wp-config.php
            [line] => 130
            [args] => Array
                (
                    [0] => C:\apache\htdocs\wordpress\wp-settings.php
                )

            [function] => require_once
        )

    [2] => Array
        (
            [file] => C:\apache\htdocs\wordpress\wp-load.php
            [line] => 29
            [args] => Array
                (
                    [0] => C:\apache\htdocs\wordpress\wp-config.php
                )

            [function] => require_once
        )

    [3] => Array
        (
            [file] => C:\apache\htdocs\wordpress\wp-blog-header.php
            [line] => 12
            [args] => Array
                (
                    [0] => C:\apache\htdocs\wordpress\wp-load.php
                )

            [function] => require_once
        )

    [4] => Array
        (
            [file] => C:\apache\htdocs\wordpress\index.php
            [line] => 17
            [args] => Array
                (
                    [0] => C:\apache\htdocs\wordpress\wp-blog-header.php
                )

            [function] => require
        )

)
*/
 
function bw_backtrace() {
  $backtrace = debug_backtrace();
  foreach ( $backtrace as $i => $call ) {
    $function = $call['function'];
    
    $file = bw_array_get( $call, 'file', NULL) ;
    $file = bw_trace_file_part( $file );
    $line = bw_array_get( $call, 'line', 0 );
    $args = $call['args'];
    $cargs = count( $args );
    switch ( $cargs ) {
      case 0: 
        $targs = NULL;
        break;
      case 1:
        $targs = $args[0]; 
        break;
      default:
        $targs = $args;
    }      
    bw_trace( $targs, $function, $line, $file, $i );
  }
}    
   

/**
 * Shortcode for togglingor setting trace options 
 * Provide a button for controlling trace
 *
 * @param $atts
 *  option= 
 *  
 */
function bw_trace_button( $atts = NULL ) {
  $text = bw_array_get( $atts, 'text', " " );
  $option = bw_array_get( $atts, 'option', NULL );
  
  $url = get_site_url( NULL, 'wp-admin/options-general.php?page=bw_trace_options' );
  
  //if ( bw_is_wordpress() )
  //   $url = site_url( "/wp-admin/post-new.php" );
  //else 
  //   $url = site_url( '' );   
  if ( $text ) {
    $text = "Trace options";
  }
  switch ( $option ) {
    case 'view':
      $bw_trace_url = bw_trace_url();
      alink( NULL, $bw_trace_url, "View trace log", "View trace output in your browser. $bw_trace_url");
      break; 
      
    default:   
      alink( "bwtrace", $url, $text, "Trace options", "" );
      break;
  }    
  return( bw_ret());  
}
