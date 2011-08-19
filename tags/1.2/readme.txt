=== oik ===
Contributors: bobbingwide
Donate link: http://www.bobbingwidewebdesign.com/oik/oik-donate/
Tags: shortcodes, PayPal, buttons, Artisteer, widget, bobbingwide
Requires: 3.0.4
Tested up to: 3.2.1
Stable tag: trunk

Often Included Key-information. 

== Description ==
oik is a set of plugins that ease the day to day creation of the very important but rather tedious content that is information about you, 
your company, your social networking ids and your website. 

There are a number of component modules which can be activated as and when you need them.

The oik base plugin provides a series of WordPress shortcodes that take the pain out of producing commonly used information.
You provide this information once on the oik options panel, then use shortcodes to include the information on your website; in pages, posts,
titles, widgets and the footer.
Most of the shortcodes are prefixed bw_ (for Bobbing Wide) e.g. [ bw_mailto], which produces a "send email to" link.


Other plugins extend the functionality: 

* oik-paypal-shortcodes to provide PayPal buttons, 
* oik-button-shortcodes to provide call-to-action button style links for Artisteer themes
* oik-sidebar gives you the ability to use Widget Wrangler with Artisteer v3 themes
* oik-bwtrace provides a rudimentary trace function, which logs trace information to a file, rather than including it within the web page output. 
* oik-tides - shortcode for tide times in the UK
* oik-bob-bing-wide to provide easy to use shortcode macros for bob/fob bing/bong wide/hide wow, WoW and WOW, oik and loik, bw_plug, bw_module
* oik-email-signature to help generate an email signature file for all your email messages
* oik-blocks to create Artisteer style blocks within your pages, posts and even widgets

The plugins are developed using a set of functions that can make PHP and HTML coding a bit easier. These are known as the bw API.

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

= Is there a forum? =
Yes - see above

= Can I get support? = 
Yes - see above 

= Do you know the screenshots are out of date? =
Yes. I'm concentrating on getting version 1.x properly released.

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
= 1.2 =
* Added: oik-blocks - [bw_block] and [bw_eblock] shortcodes for creating Artisteer style blocks within your content
* Added: [bw_logo] and [bw_qrcode] shortcodes - to include your logo image and QR code images on your pages.
* Added: [lbw] shortcode - Links to various Bobbing Wide websites
* Added: [wp] [wpms] and [drupal] shortcodes - for WordPress, WordPress Multisite and Drupal 
* Added: [lwp] [lwpms] and [ldrupal] shortcodes - links to WordPress.org and Drupal.org
= 1.1 =
* Added: Safe shortcode expansion. Shortcode expansion is now sensitive to the current filter. 
* Added: Dummy handling of wp_footer when current_filter() does not return a filter name
* Added: cacheing of plugin information pulled from WordPress.org
* Added: [bw_plug] supports multiple plugin names to automatically create a table of different WordPress plugins
* Added: [bw_plug option='active_plugins'] to list active plugins
* Added: [OIK] expands to Often Included Key-information
* Fixed: Problem with missing bw_oik() function 
* Fixed: Renamed "oik-bwtrace" to "oik bwtrace" to allow "oik" to be the plugin that gets activated by default
= 1.0 =
* Fixed: Hopefully this contains what should have been in 0.9
= 0.9 =
* Added: oik-email-signature to help you generate an email signature file for your email client
* Added: [bw_follow_me] shortcode for easy to include Follow me links for Twitter, Facebook, LinkedIn, GooglePlus, YouTube, Flickr
* Added: bw_gallery() function for use in customised themes 
= 0.8 =
* Added: [bw_googleplus] shortcode - follow me on GooglePlus
* Added: [bw_contact_button] shortcode - for Contact me buttons
* Added: [gpslides] 
= 0.7 = 
* Added: [bw_skype] shortcode to display your skype name
* Added: [bw_tides] shortcode - tide times in the UK
* Added: [bw_directions] shortcode - get Google directions to your chosen location
* Added: [ngslideshow] shortcode for co-existence of NextGen gallery and Slideshow Gallery Pro
* Fixed: invalid XHTML generated for fob, bong hide shortcodes
* Added: Support for Drupal versions of Add post and Add page buttons
= 0.6 =
* Added: Ability to select [bw_tel] and [bw_mob] from the oik shortcode button in Tiny MCE
* Added: [bw_module] shortcode - similar to [bw_plugin] but for Drupal modules
* Fixed: Correct version numbers for the Drupal module version
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
If you're interested in the Drupal version then please visit the 
[oik module](http://www.bobbingwidewebdevelopment.com/content/often-included-key-information-oik-drupal-module



