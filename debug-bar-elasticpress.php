<?php
/*
 Plugin Name: Debug Bar ElasticPress
 Plugin URI: http://wordpress.org/plugins/debug-bar-elasticpress
 Description: Extends the debug bar plugin for ElasticPress queries.
 Author: 10up
 Version: 1.3
 Author URI: http://10up.com
 */

define( 'EP_DEBUG_VERSION', '1.2' );
define( 'EPT_PATH', plugin_dir_path( __FILE__ ) . '/' );
define( 'EPT_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register panel
 *
 * @param array $panels
 * @return array
 */
function ep_add_debug_bar_panel( $panels ) {
	require_once( dirname( __FILE__ ) . '/classes/class-ep-debug-bar-elasticpress.php' );
	$panels[] = EP_Debug_Bar_ElasticPress::factory();
	return $panels;
}

add_filter( 'debug_bar_panels', 'ep_add_debug_bar_panel' );

/**
 * Add explain=true to elastic post query
 *
 * @param array $formatted_args
 * @param array $args
 * @return array
 */
function ep_add_explain_args( $formatted_args, $args ) {
	if( isset( $_GET['explain'] ) ){
		$formatted_args['explain'] = true;
	}
	return $formatted_args;
}
add_filter( 'ep_formatted_args', 'ep_add_explain_args', 10, 2 );

/**
 * EP Troubleshoot
 */
require_once( EPT_PATH . '/classes/class-ep-troubleshoot.php' );
$EP_Troubleshoot = new EP_Troubleshoot();
$EP_Troubleshoot->hooks();
unset( $EP_Troubleshoot );