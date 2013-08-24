<?php
/*
Plugin Name: Sessility SEO
Plugin URI: http://sessility.com
Description: Sessility SEO
Author: Sessility
Version: 1
Author URI: http://sessility.com
*/

require_once(plugin_dir_path(__FILE__).'SSEO_Base.php');

foreach ( glob( plugin_dir_path( __FILE__ ).'admin/*.php' ) as $file )
    include_once $file;

$admin = new SSEO_Admin();

?>
