# Changelog
======
1.3.9
======
- NEW:	Variation Support
		https://imgur.com/a/8cvLOBe
- NEW:	Added an option to set custom product tabs amount
		https://imgur.com/a/nCkxVpt
- NEW:	Added PHP 8.2 support
- FIX:	Removed Woo 2.0 support
- FIX:	Removed file_write in exchange with style css
- FIX: 	Performance improvements
- FIX:	Removed custom CSS & JS options

======
1.3.8
======
- NEW:	Use custom functions as Callback 
		https://imgur.com/a/9Lgx1dF
- NEW:	Set Tab name separately
		https://imgur.com/a/0yUr0x2
- NEW:	Hide tab title (h2)
- FIX:	PHP Notice

======
1.3.7
======
- NEW:	Set internal names for global tabs
		https://imgur.com/a/elHeIlf
- NEW:	Added support for our HelpDesk Plugin TotalDesk
		https://imgur.com/a/C6zr900

======
1.3.6
======
- NEW:	Custom tab editor in backend uses full editor now (teeny disabled)

======
1.3.5
======
- NEW:	Admin Menu Section now show the Tab Title
		https://imgur.com/a/M9TE2ei
- NEW:	Minor settings panel adjustments
- FIX:	Added wpautop to global tabs editor content

======
1.3.4
======
- NEW:	Built in vertical navigation
		https://imgur.com/a/pFERYRV

======
1.3.3
======
- NEW:	Dropped Redux Framework support and added our own framework 
		Read more here: https://www.welaunch.io/en/2021/01/switching-from-redux-to-our-own-framework
		This ensure auto updates & removes all gutenberg stuff
		You can delete Redux (if not used somewhere else) afterwards
		https://www.welaunch.io/updates/welaunch-framework.zip
		https://imgur.com/a/BIBz6kz

======
1.3.2
======
- FIX:	Added wpautop to custom product tabs

======
1.3.1
======
- FIX:	Elementor support for global tabs
- FIX:	Code improvements

======
1.3.0
======
- NEW:	Performance increase in admin panel through AJAX loading
		!! MAKE SURE YOU ARE ON LATEST VERSION OF REDUX FRAMEWORK !!

- FIX:	Default amount of global tabs set to 5
		-> remember -> the lower the faster
- FIX:	Update Docs

======
1.2.2
=====
- FIX:	Custom  8th tab missing on single product
- FIX:	Removed "the_content" filter from custom tab content (Elementor Support)

======
1.2.1
=====
- FIX:	After 16 tabs callback not working

======
1.2.0
======
- NEW:	Increased the amount of tabs to 40
- NEW:	Added apply for product transient cache in admin panel for performance

======
1.1.8
======
- FIX:	Additional Tab was always on first position

======
1.1.7
======
- FIX:	Additional information not able to remove
- FIX:	Added product is object checks
- FIX:	Updated Docs

======
1.1.6
======
- NEW:	Added support for our print products plugin:
		https://codecanyon.net/item/woocommerce-print-products-pdf/14890964

======
1.1.5
======
- NEW:	Added an option to set the amount of global tabs
		This reduces admin panel load time
- FIX:	Added support for Arabic Language
- FIX:	Updated Translations
- FIX:	Removed TGM Plugin

======
1.1.4
======
- FIX: Custom Tabs not saved

======
1.1.3
======
- NEW: Increased custom tab limit to 7

======
1.1.2
======
- NEW: Added tinymce editor for custom tabs content

======
1.1.1
======
- FIX: Invalid argument in admin class

======
1.1.0
======
- NEW: WPML Support (see string translations > admin_texts_woocommerce_ultimate_tabs_options)

======
1.0.11
======
- FIX: "PHP Notice: id was called incorrectly"
- FIX: Backend Custom Tabs style

======
1.0.10
======
- FIX: WooCommerce 3.0 compatibility

======
1.0.9
======
- FIX: Plugin activation check

======
1.0.8
======
- NEW: You can now add up to 5 custom product tabs for each product

======
1.0.7
======
- NEW: Better plugin activation
- FIX: Better advanced settings page (ACE Editor for CSS and JS )
- FIX: array key exists

======
1.0.6
======
- FIX: Redux error

======
1.0.5
======
- NEW: Removed the embedded Redux Framework for update consistency
//* PLEASE MAKE SURE YOU INSTALL THE REDUX FRAMEWORK PLUGIN *//

======
1.0.4
======
- FIX: End of Line bug

======
1.0.3
======
- NEW: Custom tab per product now available

======
1.0.2
======
- Fixed Styling issues with tabs

======
1.0.1
======
- Fixed PHP 5.2 Errors

======
1.0
======
- Inital release