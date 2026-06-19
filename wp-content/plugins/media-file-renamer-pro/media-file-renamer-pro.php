<?php
/*
Plugin Name: Media File Renamer: Rename Files (Manual, Auto, AI) (Pro)
Plugin URI: https://meowapps.com
Description: Rename and move files directly from the dashboard, either individually or in bulk. You can even set it to automatically rename your files for you! Nicer SEO, tidier WordPress, better life.
Version: 5.8.3
Author: Jordy Meow
Author URI: https://meowapps.com
Text Domain: media-file-renamer
Domain Path: /languages

Originally developed for two of my websites:
- Jordy Meow (https://offbeatjapan.org)
- Haikyo (https://haikyo.org)
*/

if ( !defined( 'MFRH_VERSION' ) ) {
  define( 'MFRH_VERSION', '5.8.3' );
  define( 'MFRH_PREFIX', 'mfrh' );
  define( 'MFRH_DOMAIN', 'media-file-renamer' );
  define( 'MFRH_ENTRY', __FILE__ );
  define( 'MFRH_PATH', dirname( __FILE__ ) );
  define( 'MFRH_URL', plugin_dir_url( __FILE__ ) );
  define( 'MFRH_ITEM_ID', 2188 );
}

require_once( 'classes/init.php');

?>