<?php // (C) Copyright Bobbing Wide 2011,2012
// Implementation of the BWPayPal class for oik PayPal shortcodes on WordPress and Drupal
// 
require_once( "bobbforms.inc" );
class BWPaypal
{
	function __construct() {
		// add_action('admin_menu', array($this, 'bw_pp_create_menu'));
		add_action('admin_init', array($this, 'bw_pp_admin_init'));
		add_shortcode('paypal', array($this, 'bw_pp_shortcodes'));
	}
	
	function bw_pp_admin_init() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'filter_mce_button'));
			add_filter('mce_external_plugins', array($this, 'filter_mce_plugin'));
		}
	}
	
	function filter_mce_button($buttons) {
		array_push($buttons, '|', 'bwpaypal_button' );
		return $buttons;
	}
	
	function filter_mce_plugin($plugins) {
		$plugins['bwpaypal'] = plugin_dir_url( __FILE__ ) . 'oik_paypal_plugin.js';
		return $plugins;
	}
        
/* PayPal generated code for the buttons was
   
   Pay now - rather than Buy Now
                            
   <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
     <input type="hidden" name="cmd" value="_xclick">
     <input type="hidden" name="business" value="herb@bobbingwide.com">
     <input type="hidden" name="lc" value="GB">
     
     <input type="hidden" name="item_name" value="An evening to Enjoy Discovering Wine">
     <input type="hidden" name="item_number" value="EDW0128">
     <input type="hidden" name="amount" value="25.00">
     <input type="hidden" name="currency_code" value="GBP">
     <input type="hidden" name="button_subtype" value="services">
     <input type="hidden" name="no_note" value="0">
     <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHostedGuest">
     <input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
     <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
   </form>
                         
   Donate
   
   <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
   <input type="hidden" name="cmd" value="_donations">
   <input type="hidden" name="business" value="herb@bobbingwide.com">
   <input type="hidden" name="lc" value="GB">
   <input type="hidden" name="item_name" value="Bobbing Wide">
   <input type="hidden" name="item_number" value="oik">
   <input type="hidden" name="no_note" value="0">
   <input type="hidden" name="currency_code" value="GBP">
   <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
   <input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
   <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
   </form>
   
   Add to cart
   
  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="herb@bobbingwide.com">
  <input type="hidden" name="lc" value="GB">
  <input type="hidden" name="item_name" value="Find a ball tees">
  <input type="hidden" name="item_number" value="FABT">
  <input type="hidden" name="amount" value="4.99">
  <input type="hidden" name="currency_code" value="GBP">
  <input type="hidden" name="button_subtype" value="products">
  <input type="hidden" name="no_note" value="0">
  <input type="hidden" name="tax_rate" value="0.000">
  <input type="hidden" name="shipping" value="0.00">
  <input type="hidden" name="add" value="1">
  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
  <input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
  <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
  </form>
*/

	function bw_pp_shortcodes($atts) {
	
		// $email = get_option('bw-pp-email');
                $bw_paypal_email =  bw_get_company( 'paypal-email' );
                
                $bw_paypal_location = 'GB';  // hardcoded at present
                $bw_paypal_currency = 'GBP'; // hardcoded at present
                
		$shipadd = $atts['shipadd'];
		if(!is_numeric($shipadd)) $shipadd = '2';
                
                // set up the common fields for the form
                
                $code  = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
                $code .= ihidden( "business", $bw_paypal_email );
                $code .= ihidden( "lc", $bw_paypal_location );
                $code .= ihidden( "currency_code", $bw_paypal_currency );
                $code .= ihidden( "item_name", $atts['productname'] );
                $code .= ihidden( "item_number", $atts['sku'] );
                
		switch($atts['type']):
                  case "pay": 
                         
                         $code .= ihidden( "cmd", "_xclick" );
                         $code .= ihidden( "amount", $atts['amount'] );
                         $code .= ihidden( "button_subtype", "services" );
                         $code .= ihidden( "no_note", "0" );
                         $code .= ihidden( "bn", "PP-BuyNowBF:btn_paynowCC_LG.gif:NonHostedGuest" );
                         $code .= '<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">';
                           
                         // <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">    
                         // $code .= retimage( NULL, "https://www.paypal.com/en_GB/i/scr/pixel.gif", "", 1, 1 );

                         $code .= retetag( "form" );
                  break;
                  
                  case "buy":
                         /* Buy Now and Pay Now are very similar except for the buttons. This one doesn't show the CC (credit cards)
                         */
                         $code .= ihidden( "cmd", "_xclick" );
                         $code .= ihidden( "amount", $atts['amount'] );
                         $code .= ihidden( "button_subtype", "services" );
                         $code .= ihidden( "no_note", "0" );
                         $code .= ihidden( "bn", "PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" );
                         $code .= '<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">';
                           
                         // <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">    
                         // $code .= retimage( NULL, "https://www.paypal.com/en_GB/i/scr/pixel.gif", "", 1, 1 );

                         $code .= retetag( "form" );
                  break;
                  

                         

                  case "donate":
                          $code .= ihidden( "cmd", "_donations" );
                          $code .= ihidden( "no_note", "0" );
                          
                          $code .= ihidden( "bn", "PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest" );
                          $code .= '<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">';
                          
                          //$code .= retimage( NULL, "https://www.paypal.com/en_GB/i/scr/pixel.gif", "", 1, 1 );

                          $code .= retetag( "form" );
                  break;
                  

		  case "add":
			$code .= ihidden( "cmd", "_cart" );
                        $code .= ihidden( "amount", $atts['amount'] );
                        $code .= ihidden( "button_subtype", "products" );
                        $code .= ihidden( "no_note", "0" );
                        $code .= ihidden( "tax_rate", "0.000" );
                        $code .= ihidden( "shipping", "0.00" );
                        
                        $code .= ihidden( "add", "1");
                        $code .= ihidden( "noshipping", $shipadd );
                        
                        
                        $code .= ihidden( "weight", $atts['weight']  ); 
			$code .= ihidden( "shipping", $atts['shipcost'] );
                        $code .= ihidden( "shipping2", $atts['shipcost2'] );
                        
                        /* Don't want extra info yet 
                        
			if($atts['extra'] != '') {
                           $code .= 
				$code.='<table><tr>';
				$code.='<td><input type="hidden" name="on0" value="'.$atts['extra'].'">'.$atts['extra'].':</td><td><input type="text" name="os0" maxlength="60"></td>';
				$code.= '<td><input type="submit" class="pp-button" value="Add to Cart" name="submit" alt="PayPal - The safer, easier way to pay online!"></td></tr>
			</table>';
			} else {
			$code.= '<input type="submit" class="pp-button" value="Add to Cart" name="submit" alt="PayPal - The safer, easier way to pay online!">';
			}
                        */
                        
                        
                        $code .= ihidden( "bn", "PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest" );
                        $code .= '<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">';
                        // $code .= retimage( NULL, "https://www.paypal.com/en_GB/i/scr/pixel.gif", "", 1, 1 );
                        $code .= retetag( "form" );
                        
                  break;  
                  
/*
<form name="_xclick" target="paypal" action="https://www.paypal.com/uk/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/view_cart.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="display" value="1">
</form>

<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="herb@bobbingwide.com">
<input type="hidden" name="display" value="1">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_viewcart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

*/    
                        
			case "view":
                          $code .= ihidden( "cmd", "_cart" );
                          $code .= ihidden( "display", "1" );
                          $code .= '<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_viewcart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">';
                          // $code .= retimage( NULL, "https://www.paypal.com/en_GB/i/scr/pixel.gif", "", 1, 1 );
                          $code .= retetag( "form" );


			
			break;	
		endswitch;
                
		return $code;	
	}
	
}

$bwpaypal = new BWPaypal();


