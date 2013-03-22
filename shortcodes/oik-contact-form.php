<?php // (C) Copyright Bobbing Wide 2013

/**
 * Implements the [bw_contact_form] shortcode
 * 
 * Creates/process an inline contact form for the user
 * 
 */
function bw_contact_form( $atts=null, $content=null, $tag=null ) {
  //oik_require( "shortcodes/oik-user.php", "oik-user" );
  //$id = bw_array_get_dcb( $atts, "user", false, "bw_default_user" );
  $email_to = bw_get_option_arr( "email", null, $atts );
  //$user = bw_get_user( $id );
  if ( $email_to ) { 
    // e( "Send email to " . $user->user_email );
    $atts['email'] = $email_to; 
    //$atts['form'] = bw_array_get( $atts, "form", "oik" );
    // $atts['text'] = bw_array_get_dcb( $atts, "text", "text", "oikifs_default" );
    bw_display_contact_form( $atts );
  } else { 
    e( "Cannot produce contact form for unknown user." );
  }  
  return( bw_ret() );
}

/**
 * Show the "oik" contact form
 * 
 * This is a simple contact form which contains: Name, Email, Subject, Message and a submit button
 * 
 *  
 */
function _bw_show_contact_form_oik( $atts ) {
  $me = bw_get_me( $atts );
  $email_to = bw_get_option_arr( "email", null, $atts );
  $text = sprintf( __( "Contact %s" ), $me ); 
  oik_require( "bobbforms.inc" );
  $class = bw_array_get( $atts, "class", "bw_contact_form" );
  sdiv( $class );
  bw_form();
  stag( "table" ); 
  bw_textfield( "oiku_name", 30, "Name *", null, "textBox", "required" );
  bw_emailfield( "oiku_email", 30, "Email *", null, "textBox", "required" );
  bw_textfield( "oiku_subject", 30, "Subject", null, "textBox" );
  bw_textarea( "oiku_text", 40, "Message", null, 10 );
  etag( "table" );
  e( ihidden( "oiku_email_to", $email_to ) );
  e( isubmit( "oiku_contact", $text, null ) );
  etag( "form" );
  ediv();
}  

/**
 * Show/process a contact form using oik
 */
function bw_display_contact_form( $atts, $user=null ) {
  $contact = bw_array_get( $_REQUEST, "oiku_contact", null );
  if ( $contact ) {
     $contact = _bw_process_contact_form_oik();
  }
  if ( !$contact ) { 
    _bw_show_contact_form_oik( $atts, $user );
  }
}
 
/**
 * Return the sanitized message subject 
 * @return string - sanitized value of the message subject ( oiku_subject )
 */ 
function bw_get_subject() {
  $subject = bw_array_get( $_REQUEST, "oiku_subject", null );
  // $subject = stripslashes( $subject );
  $subject = sanitize_text_field( $subject );
  $subject = stripslashes( $subject );
  return( $subject );
}

/**
 * Return the sanitized message text
 * 
 * Don't allow HTML, remove any unwanted slashes and remove % signs to prevent variable substitution from taking place unexpectedly.
 * @return string - sanitized value of the message text field ( oiku_text ) 
 */
function bw_get_message() {
  $message = bw_array_get( $_REQUEST, "oiku_text", null );
  $message = sanitize_text_field( $message );
  $message = stripslashes( $message );
  $message = str_replace( "%", "", $message );
  return( $message );
}

/**
 * Perform an akismet check on the message, if it's activated
 * @param array - name value pairs of fields
 * @return bool - whether or not to send the email message
 */
function bw_akismet_check( $fields ) {
  if ( function_exists( 'akismet_http_post' ) ) {
    $query_string = bw_build_akismet_query_string( $fields );
    $send = bw_call_akismet( $query_string );
  } else {
    $send = true;
  }
  return( $send );  
}

/**
 * Return true is the akismet call says the message is not spam
 * @param string $query_string - query string to pass to akismet
 * @return bool - true is the message is not spam 
 */
function bw_call_akismet( $query_string ) {
  global $akismet_api_host, $akismet_api_port;
  $response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );
  $result = false;
  $send = 'false' == trim( $response[1] ); // 'true' is spam, 'false' is not spam
  return( $send );
}

/**
 * Return the query_string to pass to akismet given the fields in $fields and $_SERVER
 * 
 * @link http://akismet.com/development/api/#comment-check
 * blog (required) -The front page or home URL of the instance making the request. 
 *                  For a blog or wiki this would be the front page. Note: Must be a full URI, including http://.
 * user_ip (required) - IP address of the comment submitter.
 * user_agent (required) - User agent string of the web browser submitting the comment - typically the HTTP_USER_AGENT cgi variable. 
 *                          Not to be confused with the user agent of your Akismet library.
 * referrer (note spelling) - The content of the HTTP_REFERER header should be sent here.
 * permalink - The permanent location of the entry the comment was submitted to.
 * comment_type - May be blank, comment, trackback, pingback, or a made up value like "registration".
 * comment_author - Name submitted with the comment
 * Use "viagra-test-123" to always get a spam response
 * comment_author_email - Email address submitted with the comment
 * comment_author_url - URL submitted with comment
 * comment_content - The content that was submitted. 
 * Note: $fields['message'] is the sanitized version of the user's input
 */
function bw_build_akismet_query_string( $fields ) {
  $form = $_SERVER;
  $form['blog'] = get_option( 'home' );
  $form['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
  $form['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
  $form['referrer'] = $_SERVER['HTTP_REFERER'];
  $form['permalink'] =  get_permalink();
  $form['comment_type'] = 'oik-contact-form';
  $form['comment_author'] = $fields['contact'];
  $form['comment_author_email'] = $fields['from'];
  //$form['comment_author_url'] = $author_url;
  $form['comment_content'] = $fields['message'];  
  unset( $form['HTTP_COOKIE'] ); 
  $query_string = http_build_query( $form );
  return( $query_string );
}

/**
 * Display a "thank you" message
 * 
 * @param array $fields - in case we need them
 * @param bool $send - whether or not we were going to send the email
 * @param bool $sent - whether or not the email was sent
 */
function bw_thankyou_message( $fields, $send, $sent ) {
  if ( $send ) {
    if ( $sent ) {
      p( "Thank you for your submission." );
    } else {
      p( "Thank you for your submission. Something went wrong. Please try again." );
    }
  } else { 
    p( "Thank you for your submission." ); // spammer
  }
}

/**
 * Process a contact form submission
 *
 * Handle the contact form submission
 * 1. Check fields
 * 2. Perform spam checking
 * 3. Send email, copying user if required
 * 4. Display "thank you" message
 *  
 */
function _bw_process_contact_form_oik() {
  $email_to = bw_array_get( $_REQUEST, "oiku_email_to", null );
  $message = bw_get_message();
  if ( $email_to && $message ) {
    oik_require( "includes/oik-contact-form-email.inc" );
    $fields = array();
    $subject = bw_get_subject();
    $fields['message'] = $message;
    $fields['contact'] = bw_array_get( $_REQUEST, "oiku_name", null );
    $fields['from'] = bw_array_get( $_REQUEST, "oiku_email", null );
    $send = bw_akismet_check( $fields );
    if ( $send ) {
      $sent = bw_send_email( $email_to, $subject, $message, null, $fields );
    } else {
      $sent = true; // Pretend we sent it.
    }
    bw_thankyou_message( $fields, $send, $sent );
  } else {
    $sent = false; 
    p( "Invalid. Please corrrect and retry." );
  }
  return( $sent );
}

/**
 * Implement help hook for bw_contact_form
 */
function bw_contact_form__help( $shortcode="bw_contact_form" ) {
  return( "Display a contact form for the specific user" );
}

/**
 * Syntax hook for bw_contact_form
 */
function bw_contact_form__syntax( $shortcode="bw_contact_form" ) {
  //oik_require( "shortcodes/oik-user.php", "oik-user" );
  $syntax = array( "user" =>  bw_skv( bw_default_user(), "<i>id</i>|<i>email</i>|<i>slug</i>|<i>login</i>", "Value to identify the user" )  
                 //, "form" => bw_skv( "oik", "<i>plugin name</i>", "Name of the contact form plugin" )
                 //, "text" => bw_skv( "Contact me",  
                 );
  $syntax += _sc_classes();
  return( $syntax );
}

/**
 * Implement example hook for [bw_user] 
 *
 */
function bw_contact_form__example( $shortcode="bw_contact_form" ) {
  //oik_require( "shortcodes/oik-user.php", "oik-user" );
  $id = bw_default_user( true ); 
  $example = "user=$id"; 
  $text = __( "Display a contact form for user: $id " );
  bw_invoke_shortcode( $shortcode, $example, $text );
}

/**
 * Implement snippet hook for [bw_user] 
 */
function bw_contact_form__snippet( $shortcode="bw_contact_form" ) {
  
  $contact = bw_array_get( $_REQUEST, "oiku_contact", null );
  if ( $contact ) {
    p( "Note: If the form is submitted from Shortcode help then two emails would be sent." );
    p( "So the normal snippet code is not invoked in this case." );
  } else {  
    //oik_require( "shortcodes/oik-user.php", "oik-user" );
    $id = bw_default_user( true ); 
    $example = "user=$id"; 
    _sc__snippet( $shortcode, $example );
  }   
}

