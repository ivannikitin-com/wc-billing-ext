<?php
/*
Plugin Name: WooCoommerce Billing Extention
Plugin URI:  http://in-soft.pro/soft/wc-billing-ext/
Description: WooCoommerce Billing Extention by customer attibutes
Version:     1.0
Author:      IvanNikitin.com
Author URI:  https://ivannikitin.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wc-billing-ext
Domain Path: /lang
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'WCBE', 		'wc-billing-ext' );					// Text Domain
define( 'WCBE_FOLDER', 	plugin_dir_path( __FILE__ ) );		// Plugin folder
define( 'WCBE_URL', 	plugin_dir_url( __FILE__ ) );		// Plugin URL

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
{
	// Initializing plugin
	add_action('init', 'wcbe_init');
}

function wcbe_init()
{
    // Internationalizing Plugin
	load_plugin_textdomain( WCBE, false, basename( dirname( __FILE__ ) ) . '/lang' );
	
	// Plugin files
	require( WCBE_FOLDER . '/classes/plugin.php' );
	
	// Init
	new WCBE\Plugin( WCBE_FOLDER, WCBE_URL );
}
