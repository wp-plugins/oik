=== oik ===
Contributors: bobbingwide
Donate link: http://www.bobbingwidewebdesign.com/oik/oik-donate/
Tags: shortcodes, PayPal, buttons, Artisteer, widget, bobbingwide
Requires: 3.0.4
Tested up to: 3.1.1
Stable tag: trunk

Often included key-information. 

== Description ==
oik is a set of plugins that ease the day to day creation of the very important but rather tedious content that is information about you, 
your company, your social networking ids and your website. 

There are a number of component modules which can be activated as and when you need them.

The oik base plugin provides a series of WordPress shortcodes that take the pain out of producing commonly used information.
You provide this information once on the oik options panel, then use shortcodes to include the information on your website; in pages, posts,
titles and widgets. 
Each of the shortcodes is prefixed bw_ (for Bobbing Wide) e.g. [ bw_mailto], which produces a "send email to" link.


Other plugins extend the functionality: 

* oik-paypal-shortcodes to provide PayPal buttons, 
* oik-button-shortcodes to provide call-to-action button links
* oik-sidebar gives you the ability to use Widget Wrangler with Artisteer v3 themes
* oik-bwtrace provides a rudimentary trace function, which logs trace information to a file, rather than including it within the web page output. 

The plugins are developed using a set of functions that can make PHP and HTML coding a bit easier. 

== Installation ==

1. Upload the contents of the oik plugin to the `/wp-content/plugins/oik' directory
1. Activate the oik base plugin through the 'Plugins' menu in WordPress
1. Go to Settings > oik options to fill in your **o**ften **i**ncluded **k**ey information
1. Activate other oik plugins when you need them


If you are a developer and want to try the oik-bwtrace plugin then you may find you need to add a line to your wp-config.php file.
Put this before the require_once for wp-settings.php

`require_once(ABSPATH . '/wp-content/plugins/oik/bwtrace.inc' );`

Don't forget to remove this line before deleting the plugin.

== Frequently Asked Questions ==
= Where is the FAQ? =
[oik FAQ](http://www.bobbingwidewebdesign.com/oik/oik-faq)

= Why isn't the FAQ here =
I want to get the plugin hosted first, then I'll get back to the FAQ.
 

== Screenshots ==
1. oik options (also known as bobbing wide shortcode options)
2. oik PayPal buttons and their shortcodes
3. oik button shortcodes - showing a Contact me button
4. base oik shortcodes and examples (part 1)
5. base oik shortcodes and examples (part 2)
6. oik button dialog
7. oik PayPal dialog
8. oik shortcode selection dialog

== Changelog ==
= 0.5 =
* Added: [bw_tel] and [bw_mob] - inline versions of [bw_telephone] and [bw_mobile]
* Fixed: plugin versions should be correct
= 0.4 = 
* Added: [bw_post] and [bw_page] buttons for easy creation of New Posts and Pages
* Changed: icons for TinyMCE
* Added parameter to pass CSS id field to alink()
* Added [bw_plug name="plugin-name" link="URL" info="y/n"] shortcode for displaying information about WordPress plugins
= 0.3 =
* Added: Tiny MCE button for entry of the [bw_button] shortcode parameters
* Added: Tiny MCE button to select an oik shortcode 
* Note: optional parameters to the oik shortcode button are not yet effective
* Added: [bw_email] for inline mailto: link. Use [bw_mailto] for a link with a prefix
* Fixed: attempted to correct problems in this file - my misunderstanding of how to do links
* Fixed: Added code to expand [bw_picasa] shortcode
* Added: [loik] shortcode - a link to the oik plugin
* Change: Moved art_button() to bobbfunc.inc so that it could be used on the oik options page
= 0.2 =
* Added shortcodes for [bw_flickr], [bw_youtube], [bw_picasa]
* renamed bwtrace.php to oik-bwtrace.php 
= 0.1 =
* initial version 

== Upgrade notice ==
= 0.01 =
Needed for Bobbing Wide's Wonder of WordPress websites 

== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](http://www.bobbingwidewebdesign.com/oik) 
**"the oik plugin - for often included key-information"**



