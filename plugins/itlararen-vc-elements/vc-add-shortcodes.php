<?php
/*
Plugin Name: Itläraren Visual Composer Elements
Plugin URI: http://www.itlararen.se
Plugins and add-ons for Visual Composer elements
Version: 1.0
Author: Itläraren
Author URI: http://www.itlararen.se
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You shouldnt be here' );
}

/**
 * Function when plugin is activated
 *
 * @param void
 *
 * @return void
 */
function vcas_plugin_active(){
	// checking if visual composer is active
	if ( ! is_plugin_active( 'js_composer/js_composer.php' ) ) {
		wp_die( 'Please activate Visual Composer, and try again' );
	}
}
register_activation_hook( __FILE__ , 'vcas_plugin_active' );

//Including file that manages all template
require_once plugin_dir_path( __FILE__ ) . 'vcas-admin.php';