<?php

/**
 * @package           	Steemit-Scroller
 * @since				1.0.1
 *
 * @wordpress-plugin
 * Plugin Name:       	Steemit Scroller
 * Plugin URI:        	https://steemit.com/@wordpress-tips
 * Description:       	A responsive scroller that allows you to show Steemit posts with a set amount of scrolling items.
 * Version:           	1.0.1
 * Author: 				Minitek.gr
 * Author URI: 			https://www.minitek.gr/
 * License: 			GPLv3 or later
 * Text Domain: 		steemit-scroller
 * Domain Path:       	/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SSC__ADMIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ).'admin/' );
define( 'SSC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SSC__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_steemit_scroller() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-steemit-scroller-activator.php';
	Steemit_Scroller_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_steemit_scroller() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-steemit-scroller-deactivator.php';
	Steemit_Scroller_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_steemit_scroller' );
register_deactivation_hook( __FILE__, 'deactivate_steemit_scroller' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-steemit-scroller.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.0
 */
function run_steemit_scroller() {

	$plugin = new Steemit_Scroller();
	$plugin->run();

}
run_steemit_scroller();