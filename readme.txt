=== oik ===
Contributors: bobbingwide, vsgloik
Donate link: http://www.oik-plugins.com/oik/oik-donate/
Tags: shortcodes, oik, pages, posts, jQuery, contact form, PayPal, buttons, Artisteer, text widget, key information, trace, blocks, bookmarks, images, attachments, smart, lazy, pagelist, sitemap, tree, accordion, tabs, cycle, google map, countdown, shortcake
Requires at least: 3.9
Tested up to: 4.2
Stable tag: 2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Over 80 advanced, powerful shortcodes for displaying the content of your WordPress website.

== Description ==
The *oik base* plugin provides a series of advanced WordPress shortcodes that help you display dynamic content from your website's pages, posts, attachments, links and custom post types.
The OIK Information Kit uses lazy smart shortcode technology to display your WordPress website's content including your often included key-information. 
The functionality in the oik base plugin is used by over 40 other WordPress plugins, providing powerful facilities for an efficient, performant website.

At a glance changes in version 2.5

* Supports shortcode UI plugin
* noderef field type supports hierarchical post types


At a glance changes in version 2.4

* [bw_follow_me] and related shortcodes can now use genericons ( theme=gener parameter )
* Delivers genericons v3.2, in case not already provided by Jetpack
* oik.css provides some basic styling of dashicons, genericons and oik's own texticons
* [bw_logo] shortcode should not display a broken image when no image is defined
* [bw_show_googlemap] improved for use with oik-user
* [bw_show_googlemap] supports multiple Google Maps being displayed
* [bw_table] column titles improved
* [wp] shortcode can now display the current version of WordPress `[wp v]` and PHP `[wp v p]`
* Better support for shortcode expansion in post titles
* Improved support for styling output of [bw_pages]

For developers

* Class BW_List_Table, based on WP_List_table, with helper functions 
* Prototype code for working with WP-API ( WordPress REST API )
* bw-nav-tab.php to support implementation of tabs on admin pages.
* bw_query_field_label() which will get the title for the registered field
* Better support for styling images; added bw_thumbnail class to div surrounding images created using bw_format_thumbnail()


At a glance changes in version 2.3

* Now supports pagination when the shortcode output could be very large
* Supports pagination for multiple shortcodes being displayed on a page
* Allows shortcodes to list posts of multiple post types. e.g. post_type="post,page" 
* New option to display post IDs on admin pages
* Specify logo image by post ID, fully qualified file name, or file in the uploads directory.
* Specify oik custom image link by post ID or full qualified file name. 
* Changes required by the oik-fields plugin.

At a glance changes in version 2.2

* Supports WordPress 3.9 and TinyMCE v4.0
* Added link= parameter for [bw_tel] and related shortcodes
* Improved shortcodes: [bw_link], [bw_tel] and related shortcodes, [bw_cycle]
* Shortcodes not registered until required.
* Custom CSS edit button more consistent with WordPress 3.9
* Improved support for plugin and theme updates

At a glance changes in version 2.1

* Added: [bw_cycle] shortcode to display attachments or other content using jQuery cycle
* Added: [bw_pinterest] - follow me on Pinterest 
* Added: [bw_instagram] - follow me on Instagram 
* Added: Support for localization (l10n) through internationalization (i18n) of literal text fields
* Changed: [bw_login] shortcode can be used to protect content only visible to logged in users
* Various CSS changes for improved coexistance with themes and theme frameworks
* Many improvements to support oik-fields
* Many API and documentation improvements

At a glance changes in version 2.0

* Eleven (11) new shortcodes
* Improvements to many shortcodes - new parameter options
* Delivery of some common jQuery plugins
* Changes to support other oik plugins
* New and updated APIs, actions and filters
* Fully documented using oik's dynamic API documentation

oik now provides over 80 shortcodes including:

* [bw_pages], [bw_posts], [bw_thumbs], [bw_attachments], [bw_images], [bw_pdf] shortcodes to list subpages, posts, attachments or custom post types 
* [bw_cycle] to display content using jQuery cycle.
* [bw_list], [bw_tree] to display lists of links to pages, posts, attachments or custom post types 
* [bw_table] to tabulate pages, posts or custom post types
* [bw_bookmarks] to list links
* [paypal] shortcodes for PayPal buttons: Pay Now, Buy Now, Donate, Add to Cart, View Cart/Checkout
* [bw_block] & [bw_eblock], [div] & [ediv], [clear] - to create block structures within your pages, posts and even widgets
* [bw_button], [bw_contact_button] - to provide call-to-action button style links for Artisteer themes
* helper shortcodes for web designers and developers: [bw_editcss], [bwtrace], [bw_wpadmin], [bw_wtf], [stag] & [etag]

oik helps you to display information about you, your company, your social networking ids and your website using standard formats that search engines such as Google recognise.

* You enter your information once, then use oik shortcodes to display it wherever you want; in titles, post and page content, header, sidebar and footer widgets.
* Whenever you need to change a value you only need to update it in one place; and your website is updated instantly.
* Shortcodes to display often included key information include: [bw_contact], [bw_telephone], [bw_mobile], [bw_mailto], [bw_company], [bw_address], [bw_show_googlemap], [bw_directions], [bw_logo], [bw_qrcode], [bw_copyright]
* For your social networking use the [bw_follow_me] shortcode to display your links to Twitter, Facebook, LinkedIn, Google+, etcetera

Features: 

* oik provides buttons to help you write the shortcodes, showing you the parameters you can choose and default values 
* oik provides a shortcode discovery page where you can find out about every shortcode which is active in your site
* lazy programming means that code is only loaded when it's actually needed
* smart means that the shortcodes can recognise the content in which they're used and adjust their behaviour accordingly
* oik is extendable - plugin developers can build on the oik base functionality 
* using the oik API: help, syntax information, examples AND HTML snippets can be produced for any plugin or theme that provides shortcodes
* oik is theme independent; meaning that you can change your theme without having to worry about whether or not the shortcodes will still work.
* oik uses microformats so that Google and other search engines can understand your content.

== Installation ==
1. Upload the contents of the oik plugin to the `/wp-content/plugins/oik' directory
1. Activate the oik base plugin through the 'Plugins' menu in WordPress
1. Go to **oik options** > **options** to fill in your **o**ften **i**ncluded **k**ey information
1. Use the shortcodes when writing your content


== Frequently Asked Questions ==
= Where is the FAQ? =
[oik FAQ](http://www.oik-plugins.com/oik/oik-faq)

= Is there a support forum? =
Yes - please use the [oik plugin forum](http://wordpress.org/support/plugin/oik)

= Can I get support? = 
Yes - see above 

= Where are the shortcodes documented? =

[oik shortcodes](http://www.oik-plugins.com/shortcodes)

The shortcode reference also includes the standard WordPress shortcodes and help for other shortcodes provided WordPress and other selected plugins (e.g. Easy-Digital-Downloads)

= Where are the APIs documented? =
[oik APIs](http://www.oik-plugins.com/apis/oik-apis)

The Application Programming Interface (API) reference documents over 960 APIs, implemented in 86 files with 55 action hooks and filters.


== Screenshots ==
1. oik options - Options
2. Demonstrating [bw_pages] and [bw_thumbs] 
3. [bw_contact_form] - Contact form and [bw_show_googlemap] - Google Map
4. [bw_countdown] - Countdown timers
5. [bw_address] and shortcode snippets
6. oik button dialog - to create the [bw_button] shortcode
7. oik PayPal dialog - create PayPal buttons: Pay Now, Buy Now, Donate, Add to Cart and View Cart/Checkout
8. oik shortcodes dialog - showing syntax for [bw_block]
9. oik options - Shortcode help - lists ALL active shortcodes
10. oik options - Buttons
11. oik options - More options
12. oik options - More information for [bw_show_googlemap] 

== Upgrade Notice ==
= 2.5 =
Tested with WordPress 4.2 and WordPress MultiSite. Contains security fix for workaround for shortcode pagination problems.

= 2.5-beta.0409 =
Workaround for shortcode pagination problems. See WordPress TRAC #31939 

= 2.5-alpha.0204 =
Upgrade to fix problems with [bw_show_googlemap] 

= 2.5-alpha.0130
First version with support for the shortcake UI plugin

= 2.4 =
Needed to fix pagination problems with WordPress 4.1. Tested with WordPress 4.1 and WordPress MultiSite.

= 2.4-beta.1223 = 
Needed to fix pagination problems with WordPress 4.1. Tested with WordPress 4.1 and WordPress MultiSite.

= 2.4-beta.1222 = 
Tested with WordPress 4.1 and WordPress MultiSite

= 2.4-beta.1218 = 
Tested with WordPress 4.1 and WordPress MultiSite

= 2.4-alpha.1128 = 
Tested with WordPress 4.1 and WordPress MultiSite 

= 2.4-alpha.1112 =
Improvements for WP-a2z and oik-plugins

= 2.4-alpha.1031 = 
For Jeremy Davis - two googlemaps (or more) on one page.

= 2.4-alpha.1012 = 
Improvements for oik-plugins.com. Tested with WordPress 4.0

= 2.3 =
Official version on WordPress.org. Tested with WordPress 4.0 and WordPress Multi-Site

= 2.3-beta.0825 =
Improvements for oik-plugins.com. Tested with WordPress 4.0-RC1

= 2.3-alpha.0728 = 
Improvements for RNGS.org.uk 

= 2.3-alpha.0616 =
Improvements for wp-a2z.com and some minor fixes

= 2.3-alpha.0613 =
Now supports pagination of shortcode output using posts_per_page= parameter. Required for very long lists in wp-a2z.com
 
= 2.3-alpha.0604 =
Required for any site wanting a simpler/more advanced [bw_link]. Added help and syntax help for [playlist] 

= 2.3-alpha.0531 =
Needed by sites wanting to use [bw_count] shortcode or display [bw_list] output as a numbered list

= 2.3-alpha.0511 =
Fixes for sites using [bw_code] and improvements for taxonomy fields

= 2.3-alpha.0509 = 
Required for shortcode expansion when the current filter is not a standard one.
Tested with WordPress 3.9.1

= 2.3-alpha.0506 = 
Tested with WordPress 3.9 

= 2.2 =
Tested with WordPress 3.9

= 2.2-beta.0412 =
Tested with WordPress 3.9-RC1

= 2.2-alpha.0403 =
Improved shortcode processing. 

= 2.2-alpha.0326 =
Required for WordPress 3.9

= 2.2-alpha.0303 =
Upgrades for oik-plugins

= 2.2-alpha.0218 =
Changes to [bw_cycle] for RJD Technology Limited to use fx=scrollVert

= 2.2-alpha.0208 =
Required for oik-plugins.

= 2.1 =
Tested with WordPress 3.8.1. Please see the Changelog for the full set of changes between 2.0.1 and 2.1.

= 2.1-beta.0122 = 
Required for officialcaravan.co.uk

= 2.1-beta.0121 =
Upgrade in line with oik-fields v1.31

= 2.1-beta.0106 =
Upgrade if you need improved i18n/l10n support, improved styling for WordPress 3.8 admin pages or [bw_pinterest] or [bw_instagram] 

= 2.1-beta.0102 =
First version for 2014 contains improvements to [bw_contact_form]. Upgrade oik-fields before applying this version.

= 2.1-alpha.1231 =
Upgrade if you are having problems with [bw_contact_form] or want to use [bw_cycle] to display cycling images.

= 2.1-alpha.1204 =
Upgrade if you need a version of oik that does not deliver blueprint CSS as standard.

= 2.1-alpha.1107 = 
Upgrade if you installed 2.1-alpha.1103

= 2.1-alpha.1103 = 
Required for oik-shortcodes v1.4

= 2.1-alpha.1028 = 
Updates for oik-fields v1.19.1027 and oik-types v1.2

= 2.1-alpha.1003 =
Updates only required for oik-plugins and bobbingwide websites

= 2.1-alpha.0927 = 
Required for oik-plugins v1.4

= 2.1-alpha.0923 =
Update if you installed oik 2.1-alpha.0921

= 2.1-alpha.0921 =
Only required for more testing of i18n.

= 2.1-alpha.0917 =
Apply this upgrade if you use [bw_copyright] or [bw_show_googlemap] and have previously applied 2.1-alpha.0822 or later.

= 2.1-alpha.0905 =
Contains changes used by oik-fields

= 2.1-alpha.0822 = 
Primarily contains a fix for [bw_contact_form] email

= 2.1-alpha.0802 =
Includes changes required for the oik-plugins plugin and a fix for JavaScript that doesn't accept version information in the request

= 2.1-alpha.0718 =
Provides a fix to reclaim code that was inadvertently moved to the oik-fields plugin.
You can update the oik base plugin and oik-fields in either order.
You should not need to deactivate the oik-fields plugin before updating to this version.
If you are not using plugins which are dependent upon oik-fields then you should be able to deactivate the oik-fields plugin.

= 2.1-alpha.0705 =
Implement this version if you have experienced problems with nested shortcode expansion.

= 2.1-alpha.0701 =
Changes primarily for oik-nivo-slider. When finding full sized images to display with a post the Featured Image is now chosen in preference to a randomly selected attached image.
This will make the nivo shortcode more useful but could alter the results in some cases.

= 2.0.1 on 21 Sep 2013 =
Fixes a problem with oik-nivo-slider and a function naming conflict with the BookingWizz plugin

= 2.0 =
Version 2.0 contains significant enhancements to version 1.17. There have been many improvements but you should not have to make any changes to your current content.

= 2.0-beta.0610 = 
Changes to [bw_code] needed for documentation on oik-plugins.com

= 2.0-beta.0608 =
Required for theme replacement on yellowbrand.co.uk

= 2.0-beta.0604 =
Required for automatic updates of oik themes: oik2012, oik20120 and nivo2011 

= 2.0-beta.0510 =
Fix for displaying responsive images in IE9

= 2.0-beta.0509 =
Only required for use with oik-testimonials v0.2

= 2.0-beta.0508 =
Only required if you need to use [bw_list] with thumbnail images

= 2.0-beta.0502 =
Only required if you need [bw_jq src="http://example.com/some-javascript-or-something"]

= 2.0-beta.0421 =
Only required if you need [bw_countdown] or the improved [bw_wtf]

= 2.0-alpha.0329 =
Changes to allow oik-user to function without oik-plugins

= 2.0-alpha.0326 = 
Required for oik-user

= 2.0-alpha.0322 = 
Required for oik-user 

= 2.0-alpha.0315 =
Another alpha test version

= 2.0-alpha.0307 =
Alpha test version.

= 2.0-alpha.0304 =
Required for oik-tunes and oik-squeeze v0.2

= 2.0-alpha.0302 =
Required for oik-tunes. 

= 2.0-alpha.0222 =
Preparing for oik v2.0. Child plugins no longer delivered. See oik-plugins.com

= 1.17.1212 =
Version required for oik-squeeze v0.1.1212

= 1.17.1204 =
Specially for users with PHP 5.3.2 or less. 

= 1.17 =
This new version includes support for FREE and Premium oik plugins which are hosted on www.oik-plugins.com (or www.oik-plugins.co.uk) rather than WordPress.org
Child plugins relocate themselves when activated. Child plugins have a version number of 1.18 
WordPress Multi Site users should read the guidance at [oik base plugin v1.17 and WordPress Multi Site](http://www.oik-plugins.com/2012/11/oik-base-plugin-v1-17-and-wordpress-multi-site/) 

= 1.16 = 
Contains a fix for Fatal error: Call to undefined function oik_require() in oik\admin\oik-header.inc on line 2

= 1.15 =
Contains a bug fix preventing oik-nivo-slider working on admin pages: oik options > nivo settings

= 1.14 =
oik version 1.14 contains a fix for oik-nivo-slider on sites where jquery.js is not automatically loaded by the theme or other plugins
It also includes changes for the cookie-cat plugin and website.

= 1.13 = 
oik version 1.13 is required for the new oik-privacy-policy plugin. 

= 1.12 =
Upgrade oik to version 1.12 before updating oik-nivo-slider to version 1.2. For more information see:
[oik-nivo-slider-v1.2 for oik v1.12](http://www.oik-plugins.com/2012/04/oik-nivo-slider-v1-2-for-oik-v1-12-now-in-alpha-test/)

= 1.11 =
There are many changes in version 1.11 to support lazy invocation of code.  
Some plugins have been created as separate plugins (e.g. uk-tides). Others have been changed so that you can activate them by changing oik settings, so are no longer activatable.
 

== Changelog ==
= 2.5 = 
* Changed: Added esc_url() to workaround in bw_navi_paginate_links(). Security fix.
* Fixed: bw_build_url() tests the path is not empty before calling unltrim() 
* Changed: bw_retrieve_result() accepts 201 HTTP code as well as 200.

= 2.5-beta.0409 =
* Added: Now caters for "noderef" fields for hierarchical post types
* Added: includes/bw_noderef2.php
* Changed: Debug code in oik_require(). Attempting to track down a random problem with symlinked plugins
* Changed: More support for symlinks: bw_logo()
* Changed: bw_effort_meta_boxes() only creates a meta box for the current post type 
* Changed: bw_navi_paginate_links() to workaround WordPress TRAC #31939
* Changed: bw_sl() now supports definition lists
* Fixed: oik_checked_check_for_update() tests if $server_response is an array; it could be garbage

= 2.5-alpha.0204 = 
* Added: Help and syntax for [bw_count]
* Added: Temporary debug code for shortcake pre and post shortcode expansion actions 
* Added: Temporary debug code in oik_boot.inc to attempt to detect symlinks to missing files 
* Added: [bw_show_googlemap] zoom parameter. Default: 12
* Changed: Improved support for shortcake UI
* Changed: [bw_show_googlemap] markers parameter accepts "lat:lng" format for additional markers 
* Fixed: For shortcake, caption content field defined as textarea
* Fixed: More support for symlinks.
* Fixed: [bw_show_googlemap] control visibility problem ( GitHub Issue #1 )
 
= 2.5-alpha.0130
* Added: Action "wp_ajax_do_shortcode" supported by "oik_ajax_do_shortcode" - invokes "oik_add_shortcodes" 
* Added: oik-shortcake.php 'module' - enable by setting the checkbox on oik options > Buttons
* Changed: Commented out some calls to trace APIs
* Changed: Some PHPdoc improvements
* Changed: [bw_images] and related shortcodes now accept the id parameter as positional 
* Changed: oik_init() now wrapped in function_exists() test; to cater for weird invocation sequences and symlinked / non-symlinked plugins
* Fixed: Better support for symlinks; replaced plugin_dir_url( __FILE__ ) with call to oik_url()
* Fixed: Syntax help for [bw_bookmarks] shortcode 
* Fixed: Syntax help for [gallery] and [caption] WordPress supplied shortcodes
* Fixed: [bw_images] and related shortcodes forces post_status to 'inherit' 
* Fixed: bw_gallery() now wrapped in function_exists(); to cater for other plugins which declare this function
* Fixed: titles on [bw_tree] shortcode when shortcodes are expanded

= 2.4 = 
* Fixed: Version released to wordpress.org 

= 2.4-beta.1223 = 
* Fixed: Changed code to cater for WordPress 4.1 changes to paginate_links(). See TRAC #30831 

= 2.4-beta.1222 =
* Fixed: Undid the change in bw_get_attached_image() to. Does not access the given post if $post_id is set; uses 'post_parent', as before 2.4-beta.1218 
* Changed: Commented out some bw_trace() calls 

= 2.4-beta.1218 =
* Changed: Improved performance of plugin update checks.  
* Fixed: Changed bw_get_the_content() and bw_get_the_excerpt() to invoke do_shortcode() directly rather than using apply_filters()
* Changed: bw_get_attached_image() to access the given ID if $post_id set  

= 2.4-alpha.1128
* Changed: Added some debugging logic in bw_skv() to track problems noted in PHP 5.5(.18)
* Changed: Improved some more docblock comments for better formatting in the Dynamic API Reference
* Changed: `[wp]` shortcode can now display the current version of WordPress `[wp v]` and PHP `[wp v p]`
* Fixed: Support title links with expanded shortcode in shortcodes such as `[bw_pages]` and `[bw_related]` ( from oik-fields)
* Tested: Now tested with PHP 5.5
* Tested: With WordPress 4.1-beta2 and WordPress MultiSite

= 2.4-alpha.1112 =
* Changed: bw_get_posts() ensures the post_type parameter is set, even when query is for selected IDs
* Changed: bw_td() and bw_th() will now create empty cells. 
* Changed: bw_nav_tabs() sets the selected tab in $_REQUEST
* Changed: Some doc block improvements

= 2.4-alpha.1031 = 
* Changed: bw_show_googlemap() now supports multiple Google maps being displayed
* Changed: Improved BW_List_Table - see WordPress TRAC #30183

= 2.4-alpha.1028 = 
* Added: Class BW_List_Table - based on WP_List_Table class - to be used by extension plugins
* Added: Support for [bw_follow_me] and related shortcodes to use genericons. 
* Added: genericons v3.2: used when Jetpack is not activated
* Fixed: bw_get_slug() should not issue notify messages
* Fixed: Changed bw_get_the_content() to use "get_the_excerpt" instead of "the_content" - needs testing.
* Changed: Improved more docblocks
* Added: bw-nav-tab.php to support implementation of tabs on admin pages.
* Added: List table helper functions
* Changed: oik.css to support some basic styling of dashicons, genericons and oik's own texticons

= 2.4-alpha.1012 = 
* Changed: Improvements to [bw_table] column titles. bw_format_label() and bw_default_title_arr() call bw_query_field_label() 
* Added: bw_query_field_label() which will get the title for the registered field.
* Changed: Some more i18n changes.
* Changed: bw_label_from_key() is now equivalent to bw_titleify()
* Added: Prototype code for working with WP-API in includes/oik-remote.inc
* Changed: Improvements to [bw_show_googlemap] for use with oik-user
* Changed: Improve [bw_logo]. Should not display 'broken image' when no logo image is defined.  

= 2.3 = 
* Changed: oik now implements the "init" action with priority 11. This means "oik_loaded" will be fired after other plugins have registered post types and taxonomies.
* Changed: Updated readme.txt for official release of v2.3
* Tested: With WordPress 4.0 and WordPress Multi-Site
* Changed: Display of field labels is now optional, using #label arg.

= 2.3-beta.0825 =
* Added: [api bw_field_function_featured_image()] for format=F
* Added: [api bw_format_more()] for the inline read more link
* Added: oik-ids.php to implement optional display of post IDs on admin pages 
* Added: filters to allow other plugins to provide shortcode help and syntax
* Added: action [hook bw_sc_link] to allow other plugins to define the link to more shortcode help 
* Changed: Added bw_field_function_more() for format=M to display simpler "more" link - not styled as an Artisteer button.
* Changed: Added bw_query_shorten() and bw_shorten() to allow truncation of long option strings in select fields. Uses '#length' arg. 
* Changed: Commented out more calls to bw_trace2()
* Changed: For easier CSS styling, [bw_pdf] and [bw_images] set default classes; "bw_pdf" and "bw_images", instead of using "bw_attachments"
* Changed: Improved some more docblock commments
* Changed: Logo image can be defined using a post ID
* Changed: Shortcode syntax help now produces links to the definition of the shortcode and parameters at oik-plugins.com
* Changed: Removed "more oik help" column from the shortcode help table.
* Changed: Commented out some unused shortcodes from the default_help table. 
* Changed: Use format=R for a blocked read more link and format=M for an inline read more link.
* Changed: bw_format_label() supports '#label' option. Set to false when the label and separator are not required.
* Changed: bw_get_posts() now supports an "id" array with only one element for "post__in" processing. Required for oik-fields [bw_related] by= parameter.
* Changed: oik custom image link can be defined using a post ID
* Changed: [hook bw_syntax] now expects two parameters
* Fixed: Added missing function bw_field_function_anchor() for format=A
 
= 2.3-alpha.0728 =
* Added: Option to replace the "Howdy," prefix in admin menu; implements "admin_bar_menu" hook
* Added: Option to use the logo image as a login logo; implements "login_head" hook
* Added: Optional parameter $prefix to bw_navi_s2eofn()
* Added: bw_get_thumbnail_src()
* Changed: Disable 'wpmem_securify' filter on oik options page to avoid Notify messages
* Changed: Minor improvement to [bw_count] shortcode
* Changed: Tidied logic in bw_get_thumbnail()
* Changed: bw_load_shortcode_suffix() to cater for shortcodes containing hyphens
* Commented out: Some tracing calls
* Fixed: Initialise $title_arr in bw_default_title_arr() 
* Fixed: docblock comment for bw_pp_shortcodes()

= 2.3-alpha.0616 =
* Added: "start to end of count" for paginated shortcode output. e.g. 1 to 30 of 42
* Changed: table header now formatted usin th 
* Fixed: Null post titles displayed as "Post: id"
* Changed: bw_sl(), and bw_el() now handle comma separated as well as unordered and ordered list types
* Changed: added bw_simple_list() to better handle logic to produce "simple" lists of links to posts
* Fixed: Changed bw_inner_tag() and added bw_inner_tags() to support bw_simple_list()

= 2.3-alpha.0613 = 
* Added: bw_shortcode_event() now invokes "oik_shortcode_result" after shortcode expansion
* Added: bw_get_posts() now supports queries for multiple post types
* Added: [bw_navi] shortcode - Simple paginated list
* Added: oik_navi_shortcode_result() implements "oik_shortcode_result" filter to add pagination
* Added: oik_navi_shortcode_atts() implements "oik_shortcode_atts" filter to prepare for handling pagination 
* Changed: Commented out some calls to bw_trace2() / bw_backtrace()
* Changed: More documentation improvements
* Changed: [bw_link] with no parameters will produce a link to the current post
* Fixed: Shortcode help for [bw_list] thumbnail= parameter, default: none
* Fixed: bw_form_field_noderef() now caters for badly stored noderef; stored as serialised post rather than post->ID
* Fixed: bw_format_list() now displays a post with no title as "Post: id"

= 2.3-alpha.0604 = 
* Changed: [bw_link] shortcode no longer requires http:// prefix when linking to an external site. Prefix internal links with /. 
* Added: Help and syntax help for the WordPress [playlist] shortcode

= 2.3-alpha.0531 = 
* Added: uo= parameter for [bw_list]. Use uo=o for a numbered list.
* Added: [bw_count] shortcode
* Fixed: Notify message from bw_build_akismet_query_string() assignment of comment_content
* Changed: Minor changes to jquery.fancybox-1.3.4.js for problem determination

= 2.3-alpha.0511 =
* Added: Documented the unexpected gobang() function in deprecated.inc
* Added: Help description and syntax for Artisteer shortcodes, some of which appear fairly useless!
* Added: Help description and syntax for WordPress shortcodes: [audio] and [video]
* Added: Support for custom taxonomies registered as fields not being included in the Fields metabox
* Added: Virtual field callback function bw_get_shortcode_expands_in_titles()
* Changed: Improved formatting for custom taxonomy fields
* Changed: [bw_codes] now displays if the shortcode expands during 'the_title' filter processing
* Fixed: bw_get_shortcode_function() needs to check for the 'all' event, in addition to 'the_content'

= 2.3-alpha.0509 = 
* Changed: Shortcodes expansion now supports values for current filter, not just 'the_content', 'the_excerpt' and 'the_title'
* Changed: Expansion of shortcodes in 'the_title' is explicitly catered for with the bw_add_shortcode() $the_title parameter
* Changed: Some shortcode no longer allowed to expand during 'the_title' processing
* Changed: Improved some documentation
* Changed: [oik] shortcode now includes an abbr tag 
 
= 2.3-alpha.0506 =
* Changed: [bw_contact_form] upgraded for Akismet 3
* Changed: [bw_contact_form] email includes link to original page
* Changed: For 'the_content' filter 'oik_do_shortcode' is added with priority 2 - to allow other plugins to introduce shortcodes into the content 
* Fixed: [bw_logo] Add dependency upon 'jquery' 
* Fixed: Text fields call esc_attr() to correctly handle double quotes in content. See itext()
* Fixed: Titles call esc_attr to correctly handle double quotes. See atitle()
* Changed: screenshot-10.php for new TinyMCE buttons

= 2.2 =
* Tested with WordPress 3.9 

= 2.2-beta.0412 =
* Tested: With WordPress 3.9-RC1
* Fixed: oik options > Plugins - Check followed by Upgrade - improved likelihood of update being performed on request
* Fixed: oik options > Themes - Check followed by Upgrade - improved likelihood of update being performed on request
* Changed: set timeout on oik_check_for_update() and oik_check_for_theme_update() to 10 seconds.

= 2.2-alpha.0403 =
* Changed: shortcodes are not registered until we know they're needed
* Changed: shortcode are now registered in bw_oik_lazy_add_shortcodes() includes/oik-shortcodes.php
* Changed: oik_box() can now be used in OO code.
* Changed: [bw_link] accepts href= & link= for a named URL parameter
* Fixed: changed bw_get_posts() so that nested [bw_images] finds required images during [bw_pages] processing
* Changed: most functions for oik-bob-bing-wide plugin moved to that plugin.
* Changed: and some functions deprecated. 
* Note: You will need to upgrade oik-bob-bing-wide to continue to use all of its shortcodes.
* Changed: oik custom CSS button now a simple text link. [bw_editcss]
* Changed: AJAX logic now in includes/oik-ajax.php
* Changed: [bw_power] shortcode now in shortcodes/oik-power.php
* Added: New filter "oik_shortcode_atts" to allow other plugins to override shortcode $atts. Invoked by bw_shortcode_event()
* Changed: main plugin file slightly simpler.

= 2.2-alpha.0326 = 
* Changed: [bw_link] accepts URL as default parameter. Alternative to numeric ID. Also through src= or url=
* Changed: TinyMCE buttons are now styled similarly to WordPress's dashboard icons
* Changed: Added link= parameter to [bw_tel], [bw_mob] and other telephone related shortcodes

= 2.2-alpha.0303 =
* Changed: Improved bw_default_labels() for better handling of singular_name
* Changed: Improved loik, wp, lwp, lwpms and bw_power shortcode logic, used by oik-bob-bing-wide plugin
* Changed: Improve links produced for the bw_plug shortcode, oik-bob-bing-wide plugin

= 2.2-alpha.0218 =
* Changed: [bw_cycle] - added fit=1|0 parameter, added prevnext=y parameter, improved syntax help
* Changed: Follow me shortcodes - to set "bw_follow" class on images
* Changed: Added $text parmaeter to aname() 
* Added: Syntax help for [paypal] 
* Fixed: Minor error in icheckbox(). 
* Changed: Added some more docblock comments to bobbfunc.inc

= 2.2-alpha.0208 =
* Changed: Improve syntax help for id= parameter. It may be a list of post IDs
* Changed: Ensure [bw_fields] uses the correct post ID when invoked within [bw_accordion], [bw_tabs], [bw_table] and [bw_pages]
* Changed: [bw_code] will detect the current shortcode so that it can be used in a text widget to display shortcode syntax
* Changed: HTML for [bw_plug banner=y|j|p] to support improved styling when displaying a banner
* Changed: Added syntax help for [bw_wtf]
* Fixed: Styling problems when a jQuery nivo slider is used in a text widget. 

= 2.1 =
* Tested: with WordPress 3.8.1.
* See also: change log below.

= 2.1-beta.0122 =
* Added: Custom taxonomies are now registered as fields of type "taxonomy" 
* Fixed: reinstated some logic in [bw_field] shortcode as of oik-fields v1.18.0315
* Changed: [bw_field] can now be used to display post properties as well as registered fields
* Fixed: aname() - create an anchor tag for linking within a page

= 2.1-beta.0121 =
* Changed: includes/bw_fields.inc now matches the same file in oik-fields
* Changed: [bw_fields] now checks the version of oik-fields - for bw_theme_field()

= 2.1-beta.0106 = 
* Added: [bw_pinterest] - follow me on Pinterest 
* Added: [bw_instagram] - follow me on Instagram 
* Changed: [bw_follow_me] will also list Pinterest and Instagram
* Changed: Improved styling of form fields in WordPress 3.8 admin
* Changed: bw_textarea_cb_arr() performs the translation of $text parameter using bw_translate()

= 2.1-beta.0102 =
* Changed: Messages from [bw_contact_form] can now be styled
* Added: contact= parameter for [bw_contact_form]
* Added: Incorporated message related functions from oik-fields [bw_new] shotcode in bw_messages.inc

= 2.1-alpha.1231 =
* Added: [bw_cycle] shortcode now displays attachments ( images ) by default
* Added: _bw_tidy_response_xml() to cater for unrecognised HTML entities in XML data.
* Added: Added default styling for oik-rating stars
* Changed: bw_tablerow() can now display table head rows, using bw_th()
* Changed: iselect() now supports string or array format for args['#options'] 
* Changed: added bw_metadata_loaded() to assist with tracking action usage
* Fixed: Fatal error from [bw_contact_form] - cannot find bw_verify_nonce(). Problem introduced in oik version 2.1-alpha.1103; function moved to bobbforms.inc
* Fixed: Reduced notify messages from bw_build_akismet_query_string() 

= 2.1-alpha.1204 =
* Added: Styling for a field hint ( span.bw_hint )
* Changed: oik backronym is now "OIK Information Kit"
* Changed: reduced the amount of styling for oik-bob-bing-wide shortcodes
* Changed: Extracted blueprint-grid.css from oik.css
* Deleted: bwlink.css is no longer delivered
* Fixed: reduced chance of Fatal with duplicated functions in bw_fields.inc, delivered in oik and oik-fields 

= 2.1-alpha.1107 = 
* Deleted: Removed prototype logic specifically targetting wp-login.php
* Changed: Renamed blockquote() to _bw_blockquote()

= 2.1-alpha.1103 =
* Deprecated: image() and bw_image_link() APIs; use e(retimage()) or alink() 
* Changed: commented out some bw_backtrace() calls
* Changed: Altered if !defined testing in some (shared) trace files
* Changed: admin/oik-bwtrace.inc and admin/oik-bwaction.inc no longer delivered ( renamed to .inc_ so they are excluded from API parsing)
* Changed: Added some phpdoc block commments
* Changed: oik.css defines the menu image for oik-types
* Changed: multiple select fields define the number of rows to be displayed using the value of the "#multiple" option
* Changed: bw_translate() no longer calls translate(), to avoid calls to "gettext" filter
* Added: bw_is_loaded() - determine if a particular file is loaded. 
* Changed: oik_main_init() now checks for wp-login processing. Invokes "oik_login_only" if so, else "oik_loaded"  - THIS IS JUST A PROTOTYPE! 

= 2.1-alpha.1028 = 
* Added: bw_get_post_class() for including standard post classes to enhance styling capabilities
* Added: [bw_cycle] shortcode to simplify implementation of jQuery cycle logic
* Changed: [bw_login] shortcode extended to allow for protected content only visible to logged-in users
* Changed: [bw_contact_form] textarea width reduced to 30 characters.
* Changed: bw_format_skv() - to improve shortcode help display when there is a long list of values
* Changed: bw_format_meta() support theming of multiple select noderef fields
* Changed: More i18n changes. e.g. th() invokes bwt() to translate table headings
* Changed: More phpdoc blocks
* Changed: bw_update_post_meta() allows for no values
* Fixed: PayPal buttons not including currency - problem introduced in i18n work
* Fixed: bw_context() allows context values to be set to false

= 2.1-alpha.1003 =
* Changed: bw_plug output now wrapped in a span
* Fixed: Added bw_ucfirst() as part of i18n work 

= 2.1-alpha.0927 = 
* Changed: Changed "hint" appending logic in bw_form_field_title() to use deferred translatable text
* Added: More functions for deferred translatable text: bw_dtt(), bw_get_dtt() and bw_tt()
* Added: styling for span.bw_hint ( bwlink.css )

= 2.1-alpha.0923 =
* Fixed: Fatal error in oik options > options. Wrong function name used! 

= 2.1-alpha.0921 =
* Changed: Further work on Internationalization (i18n) 
* Added: _alink() - for translatable links
* Added: p_() - for non translatable paragraphs  
* Fixed: oik menu icon display in dashboard
* Added: bw_list_fields() to return a list of registered fields
* Added: support for displaying plugin banners [bw_plug name=plugin banner=y/j/p]
* Changed: [bw_code] handles unrecognised shortcodes - by not including the link

= 2.1-alpha.0917 = 
* Fixed: [bw_copyright] and [bw_show_googlemap] - incorrect due to i18n changes in bw_array_get_dcb(). 
* Changed: _bw_theme_field_default() will only display non-empty values. Note: 0 is considered empty.
* Added: bw_translate() function - similar to __() but for oik i18n/l10n 

= 2.1-alpha.0905 =
* Changed: bw_textarea() returns the current value when $value parameter is null
* Changed: bw_get_email_message() only calls bw_get_email_default() when $message is null
* Changed: bw_theme_field__title() will now output the title text if the post ID is not available

= 2.1-alpha.0822 =
* Fixed: [bw_contact_form] email fields were not being replaced correctly. Problem introduced in 2.1-alpha.0718
* Added: bw_remote_get2() - similar to bw_remote_get() but it DOESN'T json_decode() the result
* Changed: bw_jquery_src() sets the handle using sanitize_key() to avoid problems with query parms and version 
* Changed: Some more work on i18n

= 2.1-alpha.0802 =
* Changed: Added inline= parameter to [bw_jquery] shortcode
* Changed: Added caveat documentation for bw_get_plugin_name()
* Added: oik_boot.inc will now set ABSPATH if not defined
* Changed: Started Internationalization (i18n) work
* Added: first version of Localization l10n for the invented "bbboing" language ( locale "bb_BB" ) - now discovered to be called http://en.wikipedia.org/wiki/Typoglycemia
* Added: bw_form_field_email() 
* Added: Field title #hint: _bw_form_field_title() 

= 2.1-alpha.0718 =
* Fixed: [bw_table] shortcode no longer dependent upon the oik-fields plugin. Added includes/bw_fields.inc
* Changed: [bw_pages] and [bw_table] shortcodes now default numberposts=10
* Changed: Changed [bw_contact_form] logic to allow oik-fields to share the Akismet checking code
* Changed: Minor documentation improvements, including dummy functions for [bw_table] Syntax, Example and Snippet
* Changed: oik stylesheets are now enqueued after other stylesheets ( priority=11 )
* Added: bw_pre_form_field() invokes "oik_pre_form_field" action to allow extender plugins to load their field "form" functions
* Changed: Improved support for custom category and custom tags. See bw_register_custom_category(), bw_register_custom_tags()

= 2.1-alpha.0705 =
* Added: Support for "private" custom fields - not visible to end users when displayed in forms or theme ( used by oik-fields )
* Added: Logic to expand shortcodes in content when used in format=C parameter of bw_pages and related shortcodes.   
* Fixed: HTML was being output in the wrong order when nested shortcodes were being expanded
* Fixed: Correct post ID used when processing nested posts in shortcode expansion for content and excerpt

= 2.1-alpha.0701 =
* Changed: bw_get_fullimage() now attempts to load the featured image before choosing an attached image at random
* Added: bw_get_posts() now supports identification of multiple posts using id= parameter ( or post__in= or p= )
* Default orderby sort sequence when using "post__in" is "post__in"
* Fixed: Notify message from oik options > plugins when no plugins are registered
* Fixed: Added syntax help for read_more= parameter to [bw_pages] shortcode
* Fixed: Minor API documentation improvements
* Fixed: Enqueues jquery-ui-1.9.2.custom.css for date form fields

= 2.0.2 on 27 Oct 2013 =
* Added: [bw_cycle] shortcode
* Added: bw_get_post_class() for including standard post classes to enhance styling capabilities
* Changed: bw_format_skv() - to improve shortcode help display when there is a long list of values
* Changed: Add support for displaying multiple select noderef fields
* Changed: Improve bw_update_post_meta() to allow for no values
* Changed: Extend [bw_login] shortcode to support protected content which is only visible to logged in users
* Changed: Alter bw_login_shortcode() to cater for i18n changes
* Changed: bw_pp_shortcodes() to cater for i18n changes

= 2.0.1 on 21 Sep 2013 =
* Changed: Corrected test for defined constant in bw_jkv()
* Changed: Renamed bw_admin() to bw_admin_sc() to resolve function naming conflict with the BookingWizz plugin

= 2.0 =

oik version 2.0 adds 11 shortcodes:

* [bw_accordion] - Display content using jquery-ui-accordion jQuery 
* [bw_contact_form] - Display a contact form 
* [bw_countdown] - Countdown timer
* [bw_iframe] - Embed a page in an iframe 
* [bw_jq] - Perform a jQuery method
* [bw_link] - Display a link to a post
* [bw_login] - Display the login form
* [bw_loginout] - Display the Login or Logout link
* [bw_parent] - Display a link back to the parent page
* [bw_register] - Display a link to the Registration form
* [bw_tabs] - Display content in tabbed blocks, using jquery-ui-tabs jQuery

Other changes in version 2.0

* Many shortcodes have been improved: with new capability supported through new or changed parameter values. 
* Improved support for other plugins
* Inclusion of common jQuery plugins: used by [bw_jq]
* Many other technical improvements
* Improved documentation

For details see below or visit [oik plugin](http://www.oik-plugins.com/oik) 

= 2.0-beta.0610 = 
* Added: packed versions of jquery files: pullquote, target-blank
* Changed: [bw_jq] now supports src=ID parameter, script= parameter alone AND no parameters
* Changed: [bw_wtf] improved - better defense against wpautop()
* Changed: [bw_code] can now be used as a link to the shortcode e.g. [bw_code bw_pages] will produce a "[bw_pages]" link

= 2.0-beta.0608 =
* Added: Flexible formatting for the [bw_pages] shortcode using the format= parameter with multiple field choices

= 2.0-beta.0604 =
* Changed: Improved logic for oik options > plugins and oik-options > themes to list the programmatically registered plugins and themes
* Added: Early code to implement "themes_api" and "themes_api_result" filters.

= 2.0-beta.0510 =
* Changed: Removed the "avatar" and "alignleft" classes in [bw_pages], [bw_accordion] and [bw_tabs] to improve responsive image sizing in IE9

= 2.0-beta.0509 =
* Changed: Remove the 'read more' link from [bw_pages] using the read_more='' parameter 
* Changed: read_more="" also applies to [bw_tabs] and [bw_accordion]
* Changed: Added some basic responsive CSS for [bw_testimonials] ( oik-testimonials plugin )

= 2.0-beta.0508 =
* Added: [bw_list] can be used to list attachments with thumbnail images
* Fixed: Fixed notify message from oik theme server improvements

= 2.0-beta.0502 =
* Added: [bw_jq] src parameter to allow <script type="text/javascript" src="http://example.com/some-javascript-or-something"></script> ini posts/pages
* Added: First version of oik themes automatic update logic
* Added: oik_register_theme_server()
* Added: bw_jquery_af() - for jQuery anonymous functions
* Fixed: bw_countdown() requires bw_jquery.inc at start of function
* Added: CSS to support responsive [bw_video] shortcode.

= 2.0-beta.0421 =
* Added [bw_countdown] shortcode using jQuery countdown
* Added jQuery countdown version 1.6.1
* [bw_wtf] shortcode now supports slider effects on hover/click
* Added $json_options parameter to bw_jkv() 

= 2.0-alpha.0329 = 
* Added: oik-user requires bw_user_array() and bw_user_list() - originally in oik-plugins

= 2.0-alpha.0326 = 
* Added: oik options page now calls 'oik_menu_box' filter ( used by oik-user )
* Changed: When oik-user is activated display of oik-options requires alt=0 parameter
* Changed: [bw_show_googlemap] supports oik-user
* Changed: bw_get_option_arr() for backward compatibility alt= parameter overrides user= parameter

= 2.0-alpha.0322.1549 =
* Added: [bw_contact_form] with Akismet checking and copy email sent to visitor. Also includes nonce checking and unique form IDs
* Added: atdot=, at= and dot= parameters for email display obfuscation on [bw_mailto] and [bw_email]
* Added: bw_default_user() and bw_get_current_user_id() APIs for use by oik-user
* Changed: bw_get_option_arr() to determine how to support user= and alt= parameters if oik-user is active

= 2.0-alpha.0315 =
* Added: jquery.cycle.all.min.js - Minified jQuery cycle
* Added: support for multiple selection noderef fields - required by oik-shortcodes
* Added: atdot= parameter for [bw_email] and [bw_mailto] - converts "name@example.com" to "name at example dot com", or provide your own value
* Changed: Improved some comments for automatic documentation

= 2.0-alpha.0307 =
* Changed: bw_get_metakey_array() uses exclude=-1 to allow the current post to be included in the results
* Changed: Example for the [bw_accordion] shortcode
* Changed: Example for the [bw_tabs] shortcode
* Changed: bw_jkv() now uses the JSON_FORCE_OBJECT option in addition to JSON_NUMERIC_CHECK
* Added: jQuery fancybox-1.3.4 (incl. easing-1.3 and mousewheel-3.0.4), plus images and CSS

= 2.0-alpha.0304 =
* Added: jquery.cycle.all.js (latest version, but not a packed one).
* Changed: code for [bw_jq] shortcode will now attempt to find the jQuery script file in plugins it's aware of (prototype version)

= 2.0-alpha.0302 =
* Added: [bw_link] shortcode

= 2.0-alpha.0222 =
* Added: Support for the id=nn, parameter for ALL shortcodes listing posts, pages or custom post types
* Changed: oik version now determined from Template
* Changed: Allow for blank "date" fields. Needed for oik-batchmove plugin
* Changed: _bw_missing_shortcodefunc() now returns the message to the page

= 1.18.0219 = 
* Removed: The oik base plugin no longer delivers child plugins. These are now standalone.
* Added: oik user options - fields can now be set per user
* Added: Support for user=id|login|email|nicename parameter on: [bw_address], [bw_geo], [bw_telephone] and related shortcodes 
* Added: [bw_accordion] shortcode - display posts as an accordion
* Added: [bw_tabs] shortcode - display posts in tab blocks
* Added: [bw_jq] shortcode - perform a jQuery method. 
* Added: jQuery Flexslider v2.1 ( from Woo Themes )
* Added: [bw_login], [bw_loginout] and [bw_register] shortcodes
* Changed: Restructured include files - some shortcode functions moved to shortcodes folder

= 1.17.1212 =
* Added: [bw_iframe] shortcode
* Added: [bw_parent] shortcode
* Changed: bw_textfield() and bw_emailfield() use current $_REQUEST value if null passed
* Changed: iselect() identifies the selected item from the key or value

= 1.17.1204 =
* Fixed: replaced calls to is_int() with is_numeric() when checking for post_id rather than names
* Fixed: bw_array_get_dcb() checks the obtained value to be identical to the default before calling the deferred call back function
* Fixed: bw_load_noderef() sets the post_parent to 0 before calling bw_get_posts() 
* Added: phpdoc comments for some functions
* Added: bw_json_encode() to support users of oik-nivo-slider with PHP 5.3.2 or less
* Fixed: bw_jkv() uses bw_json_encode() - to avoid getting Warnings when using PHP 5.3.2 or less

= 1.17 =
* Added: bw_wp_error() and includes\bw_error.inc - wrapper to WP_error
* Added: support for plugin relocation during "pre_current_active_plugins"
* Added: support for receiving updates and plugin information from diverse plugin repositories (e.g. www.oik-plugins.com or www.oik-plugins.co.uk )
* Added: oik_register_plugin_server() to allow a plugin to specify its source repository for updates 
* Added: BW_OIK_PLUGINS_SERVER constant defaults to http://www.oik-plugins.com, if not defined in wp-config.php
* Added: admin\oik-relocate.inc to perform plugin relocation
* Changed: bw_thumbnail() and bw_get_thumbnail_size() to improve support for thumbnail image size selection
* Changed: bw_get_post() - add $atts parameter, allow $post_id to be either the post ID or name
* Added: Added bw_remote_post() to includes\oik-remote.inc. Used by oik_lazy_altapi_check()
* Changed: bw_invoke_shortcode() - make $text parameter optional
* Fixed: Use bw_thumbnail_full() to find the file name for the full size image attachment. No longer relies on $post->guid
* Changed: Improved some phpdoc comments - part of API documentation
* Added: bw_emailfield(), iemail() and isubmit()
* Changed: bw_textfield() and bw_textfield_arr() to support for HTML 5 input field parameters and jQuery validation
* Added: "oik_admin_menu" action, to allow dependent routines to know when oik has responded to "admin_menu".
* Added: Support for select fields in admin page lists (oik-fields plugin)
* Added: apikey support for premium plugins
* Added: Plugins menu item to define plugin settings ( server and API key ) and perform a manual check for updates
* Changed: readme.txt
* Added: bw_load_noderef() now supports multiple post_types
* Added: noderef meta field supports #optional parameter
* Added: iradio() and bw_radio() APIs in order to support the jQuery star rating plugin
* Added: OIK_FORCE_CHECK constant for use during debugging only
* Changed: ihidden() always produces a hidden input field regardless of the value
* Added: bw_current_url() - return the current URL
* Changed: Improved support for multisite requests to an oik plugins server
* Changed: started decoupling action trace from basic trace functions (oik-bwtrace plugin)
* Changed: [bw_pages] now supports custom text for "read more" links extracted from the <!--more custom read more text -->
* Changed: bw_excerpt() restructured to support shortcode expansion using the "get_the_excerpt" filter
* Changed: Inclusion of oik.css is now optional.
* Changed: oik.css should better respect your theme's styling. e.g. Attachment links now have class bw_attachment
* Changed: Altered generated HTML for a number of shortcodes in line with oik.css changes 
* Changed: bwlink.css is now only enqueued by the oik-bob-bing-wide plugin. Note: A lot of oik.css was moved to bwlink.css
* Deleted: deprecated; bw_add_ajaxurl(), bw_preload_button_options(), oik_optional_plugins()
* Fixed: Corrected syntax help for the [div] shortcode
* Fixed: bw_format_attachment() no longer produces an empty link when no image is required
* Changed: bw_array_get_dcb() will accept null parameters e.g. [bw_email prefix='' suffix='']
* Added: Syntax help for quite a few shortcodes where the parameters were previously undocumented: bw_address, bw_email and variations, bw_tel and variations, bw_copyright, bw_qrcode, bw_attachments, bw_pdf, bw_portfolio, bw_codes, sdiv, stag, etag
* Added: bw_emailfield_arr()
* Changed: Improved support for shortcode help
* Changed: bw_validate_torf() now accepts "on" as true 
* Changed: [bw_plug] (activated by oik-bob-bing-wide plugin) supports oik-plugins servers
* Added: includes/oik-filters.inc providing new functions to replace and restore filters 
* Changed: Wrapped the separator string for bw_telephone in a span, enabling it to be styled using custom CSS.
* Changed: All child plugins now use version 1.18
* Fixed: Comments should no longer be assigned to the wrong post. Calls to setup_postdata() eliminated.
* Added: [bw_list] and [bw_post] now support the thumbnail parameter - default "none"
* Added: Support for nivo jQuery 3.1 - by allowing the addition of the data-thumb attribute to img tags
* Added: Support for themes built using Artisteer 4.0
* Changed: [bw_block] and [bw_eblock] are much simpler for Artisteer 4.0 themes
* Changed: Removed [wp-1], [wp-2] and [wp-3] shortcodes - they were only used to test ticket #17657 

= 1.16 =
* Fixed: Fatal error: Call to undefined function oik_require() in oik\admin\oik-header.inc on line 2
* Added: CSS to disable the background image for links to .pdf files ( selector: div.noicon a )

= 1.15 =
* Fixed: New solution for bw_jquery() API broke oik-nivo-slider on admin pages
* Added: Support for [bw_table] shortcode

= 1.14 =
* Added: oik-options - use Google geocoding to find latitude and longitude if not specified
* Added: oik-fields plugin supports display of custom columns in admin list; currency, numeric, date, select and noderef 
* Added: API - bw_get_active_plugins() - to list active plugins for WordPress OR WordPress Multisite
* Added: API - bw_get_post() - wrapper to get_posts to load the post identified by ID $post_id AND $post_type
* Added: API - bw_get_theme() - wrapper to WordPress functions to get the current theme.
* Added: API - bw_remote_get() - wrapper to wp_remote_get(). Used in geocoding
* Added: Add support for textarea metadata for custom post types
* Changed: oik-header now works for child themes of "Twenty Eleven"
* Changed: oik options - PayPal currencies offered in a select list
* Changed: oik options - Artisteer versions offered in a select list
* Changed: [bw_editcss] support for WP 3.4 and above. 
* Changed: API - bw_trace2() supports a 3rd parameter $show_args. Default=true. Slightly easier than using bw_trace()
* Changed: API - bw_jquery() for oik-nivo-slider when jquery.js is not already included before </head>
* Changed: API - bw_format_attachment() - default 'n' for block parameter
* Fixed: API - bw_load_noderef() requires includes/bw_posts.inc
* Fixed: Renamed quote() to bw_quote() due to function naming conflict
* Fixed: Fixed more "Notices" messages for the [sediv] shortcode

= 1.13 = 
* Added: Support for oik-privacy-plugin - new APIs below 
* Added: Support for custom links on images. This change enhances [bw_images] and [nivo] (see the oik-nivo-slider plugin)
* Added: API - bw_image_get_link() - get the custom link or permalink for an attachment
* Added: API - bw_textarea_cb_arr() - displays an textarea matched with a checkbox
* Added: API - bw_recreate_options() - alter the value of "autoload" for a WordPress option fieldd
* Added: API - bw_term_array() - build a simple ID, title array from an array of $term objects
* Added: API - bw_datepicker_enqueue_script() - enqueue the jQuery UI datepicker
* Added: API - includes/oik-menus.inc for nav menu functions
* Added: API - bw_form_start() - start a WordPress form for options fields
* Added: API - bw_reset_options() - reset or initialise an options field to "latest" defaults 
* Changed: bw_jquery() - added $windowload parameter for jQuery(window).load (when true) or jQuery(document).ready (when false = default)
* Changed: bw_tablerow() doesn't produce a row if the $td_array is empty
* Changed: TinyMCE buttons now default to "on" when first displayed on the oik options > Buttons page 
* Fixed: Dependency checking didn't work in WordPress MultiSite installations.
* Fixed: Eliminated "Notices" displayed when oik options is first displayed.

= 1.12 =
* Added: oik extra shortcode options for shortcodes with alternative values ( alt=1 keyword )
* Added: shortcode help page - listing all current shortcodes
* Added: new function to assist in earlier detection of action or filter processing (oik trace actions)
* Added: support for dependent plugins to indicate the minimum required plugin version
* Added: link to "Getting started with oik plugins"
* Added: New functions to set jQuery JSON parms from WordPress options
* Added: License: and License URI: 
* Changed: Improved styling of admin pages
* Changed: Improved logic for the shortcodes that support the alt=1 keyword ( [bw_mailto], [bw_contact], [bw_telephone], [bw_mobile], [bw_address], [bw_show_googlemap], [bw_geo], [bw_directions] )
* Changed: User configurable Google Maps intro text replaces hardcoded version
* Changed: Improved "usage notes"
* Changed: Improved display of oik action options page
* Changed: Improved display of oik trace options page
* Changed: bw_backtrace() is now a lazy API
* Changed: Improved logic for producing shortcode examples and snippets, adding support for "oik generated examples"
* Changed: More help, syntax and example logic for shortcodes including: [bw_bookmarks], [bwtrace]
* Changed: [paypal] shortcode now accepts the country (default "GB") and currency (default "GBP")
* Changed: [bw_contact] now uses the microformat for an hCard (span classes are vcard and fn (full name))
* Changed: API changes to support alt=1 parameter: bw_default_empty_att() 
* Changed: Copyright statement suffix text now overrideable e.g. [bw_copyright suffix="copyright suffix"] 
* Changed: API changes in bobbforms.inc: iarea() - added rows parameter, icheckbox() - returns a value when checkbox is not selected
* Changed: added more bd-nnn class names for { min-height: nnnpx; } for non Artisteer themes
* Changed: optional plugins link to their own page on oik-plugins.com
* Fixed: some of the shortcode help one-liners. Also set default to '?' for unknown/undocumented shortcodes
* Fixed: Individual "follow me" shortcodes don't display the link address
* Fixed: [lxx] shortcodes should not expand in titles (oik-bob-bing-wide plugin)

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
* Added: shortcode quicktag (labelled [] ) with jQuery code shared with the existing TinyMCE buttons
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
* Added: [div]/[sdiv], [ediv] and [sediv] shortcodes for &lt;div&gt; tags
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

== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](http://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**

= Other plugins =

Other plugins which use the oik API are also available on WordPress.org: 

* [bbboing](http://www.wordpress.org/extend/plugins/bbboing) - obfuscate text but leave it readable
* [cookie-cat](http://www.wordpress.org/extend/plugins/cookie-cat) - [cookies] shortcode to list the cookies your website may use
* [oik-batchmove](http://www.wordpress.org/extend/plugins/oik-batchmove) - batch change post categories or published date
* [oik-css](http://www.wordpress.org/extend/plugins/oik-css) - [bw_css] for CSS styling per page
* [oik-nivo-slider](http://wordpress.org/extend/plugins/oik-nivo-slider/) - [nivo] shortcode for the jQuery "Nivo slider" for posts, pages, attachments and custom post types
* [oik-privacy-policy](http://www.wordpress.org/extend/plugins/oik-privacy-policy) - generate a privacy policy page, compliant with UK cookie law (EU cookie directive)
* [oik-read-more](https://wordpress.org/plugins/oik-read-more) - progressively reveal content by clicking on "read more" buttons
* [uk-tides](http://wordpress.org/extend/plugins/uk-tides/) - [bw_tides] shortcode for tide times and heights in the UK  (replaces oik-tides)

This plugin is not dependent upon oik.

* [oik-weightcountry-shipping](http://wordpress.org/plugins/oik-weightcountry-shipping) - Weight/Country Shipping for WooCommerce


More FREE and Premium plugins are available from [oik-plugins.com](http://www.oik-plugins.com/wordpress-plugins-from-oik-plugins/) including:

* [diy-oik](http://www.oik-plugins.com/oik-plugins/diy-oik) - Do-It-Yourself shortcodes
* [oik-External link warning jQuery](http://www.oik-plugins.com/oik-plugins/external-link-warning-jquery/) - Warns visitor about leaving your site
* [oik-fields](http://www.oik-plugins.com/oik-plugins/oik-fields-custom-post-type-field-apis) - custom post type field APIs
* [oik-ms](http://www.oik-plugins.com/oik-plugins/oik-ms-oik-multisite-shortcodes/) - oik MultiSite shortcodes
* [oik-mshot](http://www.oik-plugins.com/oik-plugins/oik-mshot) - Shortcode to display the "mshot" of an URL; oik-fields extension
* [oik-rating](http://www.oik-plugins.com/oik-plugins/oik-rating) - 5 star rating custom field; oik-fields extension
* [oik-testimonials](http://www.oik-plugins.com/oik-plugins/oik-testimonials) - Manage and display testimonials.
* [oik-todo](http://www.oik-plugins.com/oik-plugins/oik-todo-todo-list) - TO DO list
* [oik-types](http://www.oik-plugins.com/oik-plugins/oik-types) - custom content type, field and taxonomy manager
* [oik-user](http://www.oik-plugins.com/oik-plugins/oik-user) - display oik information for each site user
* [us-tides](http://www.oik-plugins.com/oik-plugins/us-tides) - US saltwater tide times and heights


= Removal of child plugins (version 2.0) =

Up to and including version 1.17 the oik plugin included a number of optional modules which could be activated as and when you needed them.

In oik version 1.17, any activated module automatically relocated itself to become a separately maintainable plugin.
Each individual plugin is supported from an oik-plugins server. 
The version number of child plugins delivered with oik v1.17 was v1.18.

In version 2.0 the child plugins were removed from the oik base package.

Plugins that were relocated and served from the oik-plugins servers were:

* [oik-bbpress](http://www.oik-plugins.com/oik-plugins/oik-bbpress-strip-tags-from-bbpress-forum-title-tooltips/) - to strip tags from bbPress forum title tooltips  
* [oik-bob-bing-wide](http://www.oik-plugins.com/oik-plugins/oik-bob-bing-wide-more-lazy-smart-shortcodes/) - to provide more lazy smart shortcodes: [bw_plug], bob/fob bing/bong wide/hide wow, oik and loik, wp, wpms, bp, artisteer, drupal
* [oik-bp-signup-email](http://www.oik-plugins.com/oik-plugins/oik-buddypress-signup-email/) - to intercept BuddyPress registration emails
* [oik-bwtrace](http://www.oik-plugins.com/oik-plugins/oik-bwtrace-debug-trace-for-wordpress/) - provides an advanced WordPress trace debug function, which logs trace information to a file, rather than including it within the web page output
* [oik-email-signature](http://www.oik-plugins.com/oik-plugins/oik-email-signature/) - to help generate an email signature file for all your email messages
* [oik-fields](http://www.oik-plugins.com/oik-plugins/oik-fields-custom-post-type-field-apis/) - custom post type field APIs 
* [oik-header](http://www.oik-plugins.com/oik-plugins/oik-header-custom-header-image/) - for custom page header image selection for pages, posts and custom post types
* [oik-sc-help](http://www.oik-plugins.com/oik-plugins/oik-sc-help-shortcode-help-shortcodes/) - shortcode help shortcodes: provides [bw_code] and [bw_codes] shortcodes
* [oik-sidebar](http://www.oik-plugins.com/oik-plugins/oik-sidebar-widget-wrangler-for-artisteer-themes/) - gives you the ability to use Widget Wrangler with Artisteer v3 themes

Note: For some of these plugins the oik base plugin still provides a certain amount of code.


oik plugins are suitable for:

* WordPress site owners
* WordPress site administrators
* WordPress designers
* WordPress web site developers 
* WordPress plugin developers

oik plugins are tested with: WordPress Multi Site.

ALL of the plugins are developed using a set of functions that can make PHP and HTML coding a bit easier. 
These are known as the [OIK Application Programming Interface (OIK API)](http://www.oik-plugins.com/apis/oik-apis)


