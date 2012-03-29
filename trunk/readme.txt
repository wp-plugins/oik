=== oik ===
Contributors: bobbingwide
Donate link: http://www.oik-plugins.com/oik/oik-donate/
Tags: shortcodes, PayPal, buttons, Artisteer, widget, bobbingwide, key information, tide, trace, blocks, buddypress, pages, bookmarks, 
Requires: 3.0.4
Tested up to: 3.3.1
Stable tag: 1.10

Lazy smart shortcodes for often included key-information

== Description ==
oik is a set of plugins that ease the day to day creation of the very important but rather tedious content that is information about you, 
your company, your social networking ids and your website. 

There are a number of component modules which can be activated as and when you need them.

The oik base plugin provides a series of WordPress shortcodes that take the pain out of producing commonly used information.
You provide this information once on the oik options panel, then use shortcodes to include the information on your website; in pages, posts,
titles, widgets and the footer.
Most of the shortcodes are prefixed bw_ (for Bobbing Wide) e.g. [ bw_mailto], which produces a "send email to" link.


Other plugins extend the functionality: 

For general use:

* oik-blocks to create Artisteer style blocks within your pages, posts and even widgets
* oik-button-shortcodes to provide call-to-action button style links for Artisteer themes
* oik-email-signature to help generate an email signature file for all your email messages
* oik-header for custom header images by page or post
* oik-pages to list subpages, post or custom post types - [bw_pages] or [bw_list] shortcodes
* oik-paypal-shortcodes to provide PayPal buttons
* oik-sidebar gives you the ability to use Widget Wrangler with Artisteer v3 themes
* oik-tides - shortcode for tide times in the UK

For WordPress plugin developers:

* oik-bob-bing-wide to provide easy to use shortcode macros for bob/fob bing/bong wide/hide wow, WoW and WOW, oik and loik, bw_plug, bw_module
* oik-bwtrace provides an advanced trace function, which logs trace information to a file, rather than including it within the web page output. 
* oik-fields to display custom fields within the content

For use in BuddyPress sites:
* oik-bp-signup-email to intercept BuddyPress registration emails

For use in bbPress sites:
* oik-bbpress to strip tags from bbPress forum title tooltips

ALL of the plugins are developed using a set of functions that can make PHP and HTML coding a bit easier. 
These are known as the bobbing wide application programming interface (bw API).

== Installation ==
1. Upload the contents of the oik plugin to the `/wp-content/plugins/oik' directory
1. Activate the oik base plugin through the 'Plugins' menu in WordPress
1. Go to Settings > oik options to fill in your **o**ften **i**ncluded **k**ey information
1. Use the shortcodes when writing your content
1. Activate other oik plugins when you need them

If you are a developer and want to try the oik-bwtrace plugin then you may find you need to add a line to your wp-config.php file.
Put this before the require_once for wp-settings.php

`require_once(ABSPATH . '/wp-content/plugins/oik/bwtrace.inc' );`

If you also want to track action and filter processing then you should precede that line with:

`define( 'BW_TRACE_CONFIG_STARTUP', true );`


Don't forget to remove this code before deleting the plugin.

== Frequently Asked Questions ==
= Where is the FAQ? =
[oik FAQ](http://www.oik-plugins.com/oik/oik-faq)

= Is there a forum? =
Yes - see above - plus the standard WordPress forum - http://wordpress.org/tags/oik?forum_id=10

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


== Upgrade Notice ==

= 1.11 =
There are many changes in version 1.11 to support lazy invocation of code.  
Some plugins have been created as separate plugins (uk-tides), others have been changed
so that you can activate them by changing oik settings, so are no longer activatable.
 

== Changelog ==
= 1.11 = 
* Added: "oik_loaded" actions for lazy initialisation of dependent plugins.
* Added: AJAX enabled dialog for listing shortcodes, showing syntax and providing further information online
* Added: CSS support for responsive images
* Added: Improved support for nested shortcodes being expanded in excerpts
* Added: [bw_code] shortcode to display help, syntax, example, live example and snippet for a shortcode
* Added: [bw_codes] table to summarise active shortcodes
* Added: [bw_power] shortcode for "Proudly powered by WordPress" link to WordPress.org
* Added: [bw_thumbs] shortcode - shows the thumbnail images as links
* Added: action and filter logging, an optional addition to tracing (for developers)
* Added: edit custom CSS button (for developers and designers) 
* Added: files for deprecated functions - but these are TOTALLY lazy
* Added: help and syntax information for (some) NextGEN and Portfolio slideshow shortcodes
* Added: help and syntax information for the NextGEN [nggallery] shortcode
* Added: shortcode quicktag (labelled [] ) with jQuery code shared with th existing TinyMCE buttons
* Added: shortcodes can now provide: help, syntax, examples, live examples and snippets
* Added: trace options, trace actions and trace reset buttons
* Changed: Improved API for form fields
* Changed: PayPal shortcodes support currency (e.g. 'GBP') and location (e.g. 'GB') parameters
* Changed: TinyMCE button selection is now part of the oik settings menu
* Changed: [bw_logo] now includes jQuery code to automatically resize the image when displayed in a text widget in an Artisteer header
* Changed: [bw_wtf] now prints the raw content of the post 
* Changed: added shortcodes folder where the lazy shortcode logic is implemented
* Changed: code only needed for admin pages has been made lazy
* Changed: oik options is now in its own submenu with a dashboard like overview page
* Changed: restructured to make shortcodes lazy
* Changed: trace functions are very lazy
* Fixed: CSS to fix a problem with GoogleMap's images on "responsive" sites
* Fixed: Changed CSS fix for Artisteer nested blocks; original solution broke hmenus
* Fixed: edit custom CSS links works on Multisite
* Fixed: elimination of as many "Notice" messages as possible 
= 1.10 =
* Added: [bw_attachments] for listing attachments 
* Added: [bw_pdf] for .pdf type attachments
* Added: [bw_tree] for producing a hierarchical tree of children of a 'page'
* Added: [bw_posts] for producing a simple list of posts
* Added: [bw_copyright] for use in footers
* Added: Introduced support for lazy shortcodes - where the shortcode function is not loaded until it's needed
* Added: [stag] and [etag] shortcodes to use when using the HTML doesn't seem to work
* Added: oik-boot.inc and changed oik_path to accept $file parameter
* Added: [bwtrace] button for easier access to trace reset
* Changed: better array/object detection in bw_array_get() 
* Changed: added bw_array_get_dcb() where dcb = deferred callback. It only calls the callback function for the default when needed.
* Changed: default function for bw_array_get_dcb is __() - to allow for i18n 
* Changed: Update Copyright years throughout
* Changed: alter custom header background image styling so that it does not repeat 
* Changed: oik.css - added some additional styling - early support for responsive blocks
* Fixed: Fixed problem where shortcode escaping did not work. [[oik]] will now become [oik] 
* Fixed: Added missing shortcode function for [bw_picasa]
* Fixed: Added missing bw_block_25.inc - even though it may not be correct for Artisteer 2.5 
= 1.9 =
* Added: oik-bbpress to cater for expanded shortcodes in titles used as text attributes
* Added: oik-header support for custom header background images with the Twenty Eleven theme
* Changed: [bw_wtf] now prints the post or page id (only works for the main post, not nested posts)
* Changed: wrote a brief comment about ticket #17567 and shortcodes with hyphens
= 1.8 = 
* Added: [bw_blockquote] and [bw_cite} shortcode - to overcome problems with wpautop()
* Added: cite() function for bw API
* Changed: Improved default processing for [bw_pages] and [bw_list] when used without parameters in a 'post' or a 'page' 
* Changed: stylesheets enqueued during the 'wp_enqueue_scripts' action hook (change for WP 3.3)
= 1.7 =
* Added: extra parameter to alink() to support additional fields in the anchor (<a>) tag
* Added: oik-bp-signup-email - to direct the verification email to the site admin rather than the registrant
* Added: oik-fields plugin - for [bw_field] (alias [bw_fields]) shortcode - display custom fields within the content
* Added: oik-header plugin - custom header images for pages or posts
* Added: oik_path() and oik_require() functions
* Changed: image/retimage API: title defaults to NULL - so can be omitted
* Fixed: [bw_pages] if the post_type is page, no longer set post_parent automatically 
= 1.6 =
* Added: [bw_bookmarks] shortcode - equivalent to the Links widget
* Added: [bw_list] shortcode - a simple list of links for any post type
* Added bw_trace2() function - improved (easier to code) wrapper to bw_trace()
* Changed: custom.css should be embedded after style.css (and other stylesheets. e.g. buddypress stylesheets)
* Changed add parameters ( me and url) to the "follow me" shortcodes - to set values for 'me' and the social media url
* Changed: oik-bwtrace. The notes suggest .loh for a the log file extension. 
* Changed: [bw_plug] tries to help with plugin names
* Fixed: bw_backtrace() first checks if trace is enabled.
* Fixed: ability to specify a custom image size for [bw_pages]  e.g. [bw_pages thumbnail=80] or [bw_pages thumbnail="120x80"]
* Fixed: more clearly shows where the customCSS file will reside... in the current theme directory
= 1.5 = 
* Changed: [clear] now expands to two classes: clear and cleared
* Fixed: reduced more warnings that were produced when WP_DEBUG is set
* Added: bw_wp_title() - use to return a nice SEO title when WordPress SEO may or may not be activated
* Added: options to tracing to include or exclude information that can help or hinder problem determination
* Changed: Default to not showing the address type as Work - hidden by CSS
* Added: Option to edit the custom CSS file using standard WordPress functions
* Changed: Custom CSS file now expected to be in the stylesheet directory.
* Added: Dummy custom CSS file created in stylesheet diretory, if defined but not already present
* Added: Initial support for selecting custom post types in [bw_pages] shortcode, restricting by category 
* Fixed: [bw_pages] shortcode excludes the current post. Needed to prevent recursion in strange scenarios
* Changed: update [bw_tides] to reflect changes to the XML in the RSS feed from http://www.tidetimes.org.uk
= 1.4 =
* Added: oik-pages plugin for [bw_pages] shortcode to list subpages, optionally within [bw_block]s
* Added: [bw_block]/[bw_eblock] now supports themes generated with Artisteer 3.1 beta versions ( v3.1.0.44079 and v3.1.0.42580 )
* Added: option to specify which version of Artisteer was used to generate your theme: 31, 30, 25, or na
* Added: Basic support for using [bw_block] when NOT using an Artisteer theme
* Changed: Documentation has been migrated to www.oik-plugins.com/oik
* Changed: some improvements to the bw API
* Fixed: reduced some warnings that were produced when WP_DEBUG is set
* Changed: oik-bwtrace changes to aid problem determination after a change has been made
* Changed: Added support for BuddyPress filter - bp_screens 
= 1.3.1 =
* Changed: Lost another fight with SVN :-( 
= 1.3 = 
* Changed: [bw_show_googlemap] now uses V3 of the GoogleMap API so a GoogleMap API key is no longer needed
* Added: Parameters to [bw_show_googlemap] allowing more than one GoogleMap. 
* Added: [div]/[sdiv], [ediv] and [sediv] shortcodes for <div> tags
* Added: support for Artisteer art-blockcontent and heading background images
* Added: [bw_emergency] for Emergency phone number
* Added: [bw_abbr] for company abbreviation e.g. bw = bobbing wide
* Fixed: [gpslides] - safer invocation of Slideshow Gallery Pro
* Fixed: bw_shortcode_event() will only call the shortcode expansion and post processing function if it exists
* Added: [art] and [lart] shortcodes for Artisteer
* Added: [bp] and [lbp] shortcodes for BuddyPress
* Fixed: includes the emergency fix applied to oik version 1.2
* Added: Styling for [wp], [bp], [drupal] and [art] shortcodes
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
[oik plugin](http://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**
If you're interested in the Drupal version then please visit the 
[oik module](http://www.bobbingwidewebdevelopment.com/content/often-included-key-information-oik-drupal-module



