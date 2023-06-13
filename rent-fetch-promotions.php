<?php
/*
	Plugin Name: Rent Fetch Promotions
	Plugin URI: https://github.com/jonschr/rent-fetch-promotions
    Description: Just another promotions plugin
	Version: 0.2.4
    Author: Brindle Digital
    Author URI: https://brindledigital.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    
*/

/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Define the version of the plugin
define( 'RENTFETCH_PROMOTIONS_VERSION', '0.2.4' );

// Plugin directory
define( 'RENTFETCH_PROMOTIONS_URL', plugin_dir_url( __FILE__ ) );
define( 'RENTFETCH_PROMOTIONS_DIR', dirname( __FILE__ ) );

$directory = new RecursiveDirectoryIterator(RENTFETCH_PROMOTIONS_DIR . "/inc/");
$iterator = new RecursiveIteratorIterator($directory);
$phpFiles = new RegexIterator($iterator, '/\.php$/');

foreach ($phpFiles as $phpFile) {
    require_once $phpFile->getPathname();
}

//* Used for debugging
if ( !function_exists( 'console_log' ) ) {
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
}

//* Plugin Update Checker
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/rent-fetch-promotions',
	__FILE__,
	'rent-fetch-promotions'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');
