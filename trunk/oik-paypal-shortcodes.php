<?php
/*
Plugin Name: oik Paypal Shortcodes
Plugin URI: http://www.bobbingwidewebdesign.com/oik
Description: [oik] PayPal Shortcodes - Pay Now, Buy Now, Donate, Add to Cart and View Cart buttons
Version: 1.0
Author: bobbingwide
Author URI: http://www.bobbingwide.com/content/herb-miller

Notes & Limitations
- If the button that's generated doesn't fit your needs then you can go to 
  https://www.paypal.com/cgi-bin/webscr?cmd=_button-designer
  and generate the HTML directly
- This code assumes you are in the UK, taking Payments in pounds sterling 
- It assumes that you will not be adding Tax or Shipment costs
- The choice of images for the button are hard coded. 
- You can see a load of PayPal buttons at:
  http://members.cox.net/pptech/paypal_button_chart.htm   
- This code was based on the jw-paypal-shortcodes plugin (designed for use in the US)
- The plugins (this one and jw-paypal-shortcodes) should co-exist peacefully.
- I had no idea what the purpose of this image was https://www.paypal.com/en_GB/i/scr/pixel.gif
  but having read the forums I now see that it's not particularly important so I've eliminated it
  from the generated code.
- The generated code is for NonHostedGuest buttons - not buttons that are saved in your PayPal account.
  see https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_html_paypal_shopping_cart
  
This is an extract from PayPal button creation help...
  
By default, the button creation tool saves payment buttons in your PayPal account. 
The tool saves your button and generates the code when you click the Create Button. 
You must copy and paste the generated code onto your webpages, whether or not you save your button at PayPal. 
The generated code is shorter for saved buttons, because PayPal keeps most of the information about your button in your account,
instead of placing it in the code that you add to your website.

Saving your payment buttons in your PayPal account has these benefits:

Your payment buttons are more secure, because the generated code that add to your website contains no information that can be tampered with to produce fraudulent payments.
You can edit the details and options for your payment buttons in your PayPal account, without changing the button code that you added to your website.
NOTE: If you change product options, you must copy and paste the code newly generated by PayPal to replace the code that you pasted previously.
You can track inventory.
Use the Step 2 section of the button creation tool to control whether your button is saved in your PayPal account.

For more information, see Saving Payment Buttons in Your PayPal Account.  
https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_html_saving_buttons
  
  
*/

if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );
require_once( "bobbfunc.inc" );        

require_once( "oik-paypal-shortcodes.inc" );       

