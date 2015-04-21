<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Cover_Pages
 *
 * @wordpress-plugin
 * Plugin Name:       Cover Pages
 * Plugin URI:        http://pootlepress.com/cover-pages/
 * Description:       Cover pages is a plugin that can be used with any Wordpress theme. Users will install the plugin and be able to configure a page that sits above their current homepage. This page will be customisable using a replication of the native Wordpress Customizer.
 * Version:           1.0.0
 * Author:            PootlePress
 * Author URI:        http://pootlepress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cover-pages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cover-pages-activator.php
 */
function activate_cover_pages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cover-pages-activator.php';
	Cover_Pages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cover-pages-deactivator.php
 */
function deactivate_cover_pages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cover-pages-deactivator.php';
	Cover_Pages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cover_pages' );
register_deactivation_hook( __FILE__, 'deactivate_cover_pages' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cover-pages.php';

require_once plugin_dir_path( __FILE__ ) . '/admin/inc/customizer-classes.php';
require_once plugin_dir_path( __FILE__ ) . '/admin/inc/class-customizer-fields.php';
require_once plugin_dir_path( __FILE__ ) . '/admin/inc/variables-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cover_pages() {

	$plugin = new Cover_Pages();
	$plugin->run();

}
run_cover_pages();
