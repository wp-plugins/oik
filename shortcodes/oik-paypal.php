<?php
if ( defined( 'OIK_PAYPAL_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_PAYPAL_SHORTCODES_INCLUDED', true );
/*

    Copyright 2011-2013 Bobbing Wide (email : herb@bobbingwide.com )

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

oik_require( "bobbforms.inc" );


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
  
  Note: Image locations are currently hardcoded for en_GB
*/

function bw_pp_shortcodes( $atts = NULL) {
  $bw_paypal_email = bw_array_get_dcb( $atts, "email", "paypal-email" , "bw_get_option", "bw_options"  );        
  $atts['location'] = bw_array_get_dcb( $atts, "location", 'paypal-country', "bw_get_option", "bw_options" );  
  $bw_paypal_location = bw_array_get( $atts, "location", "GB" );
  $atts['currency'] = bw_array_get_dcb( $atts, "currency", 'paypal-currency', "bw_get_option", "bw_options" );  
  $bw_paypal_currency = bw_array_get( $atts, "currency", 'GBP' ); // hardcoded at present
  $atts['productname'] = bw_array_get( $atts, "productname", "oik-plugin" );
  $atts['sku'] = bw_array_get( $atts, "sku", "oik" );
                
  $shipadd = bw_array_get( $atts, 'shipadd', 2 );
  if (!is_numeric($shipadd)) 
    $shipadd = '2';
                
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
                        
                        
                        $code .= ihidden( "weight", bw_array_get( $atts, 'weight', null ) ); 
			$code .= ihidden( "shipping", bw_array_get( $atts, 'shipcost', null) );
                        $code .= ihidden( "shipping2", bw_array_get( $atts, 'shipcost2', null) );
                        
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
