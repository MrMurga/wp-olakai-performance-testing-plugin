<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.olakaiconsulting.com/
 * @since             1.0.0
 * @package           Wp_Olakai_Performance_Testing_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Olakai Performance Testing
 * Plugin URI:        https://www.olakaiconsulting.com/
 * Description:       This plugin helps you run Google Lighthouse and monitor website performance which is known to improve conversion rate and revenue derived from user traffic and search engines
 * Version:           1.0.0
 * Author:            Olakai Consulting
 * Author URI:        https://www.olakaiconsulting.com/team
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-olakai-performance-testing-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_VERSION', '1.0.0' );
define( 'WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME', 'wp-olakai-performance-testing-plugin' );
define( 'WP_OLAKAI_PERFORMANCE_TESTING_USER_AGENT', sprintf('%s-bot/%s', WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME, WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_VERSION));
define( 'WP_OLAKAI_PERFORMANCE_TESTING_ULTRA_FAST_TIMEOUT_MS', 200);
define( 'WP_OLAKAI_PERFORMANCE_TESTING_HEAD_TIMEOUT_MS', 2000);
define( 'WP_OLAKAI_PERFORMANCE_TESTING_DEFAULT_TIMEOUT_MS', 15000);
define( 'WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'WP_OLAKAI_PERFORMANCE_TESTING_SERVER_URL', "aHR0cHM6Ly93d3cub2xha2FpY29uc3VsdGluZy5jb20vYXBpL2xpZ2h0aG91c2U=" );
define( 'WP_OLAKAI_PERFORMANCE_TESTING_SERVER_REGISTER_URL', "aHR0cHM6Ly93d3cub2xha2FpY29uc3VsdGluZy5jb20vYXBpL2xpZ2h0aG91c2UvZW5kcG9pbnQ=" );
define( 'WP_OLAKAI_WEBSITE_URL', "aHR0cHM6Ly93d3cub2xha2FpY29uc3VsdGluZy5jb20v" );
define( 'WP_OLAKAI_WEBSITE_URL_AFFILIATE', 'YWZmaWxpYXRlL3dwLW9sYWthaS1wZXJmb3JtYW5jZS10ZXN0aW5nLXBsdWdpbi1hZmZpbGlhdGU=');
define( 'WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_KILL_SWITCH', WP_OLAKAI_PERFORMANCE_TESTING_SERVER_URL);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-olakai-performance-testing-plugin-activator.php
 */
function activate_wp_olakai_performance_testing_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-olakai-performance-testing-plugin-activator.php';
	Wp_Olakai_Performance_Testing_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-olakai-performance-testing-plugin-deactivator.php
 */
function deactivate_wp_olakai_performance_testing_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-olakai-performance-testing-plugin-deactivator.php';
	Wp_Olakai_Performance_Testing_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_olakai_performance_testing_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_wp_olakai_performance_testing_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-olakai-performance-testing-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_olakai_performance_testing_plugin() {

	$plugin = new Wp_Olakai_Performance_Testing_Plugin();
	$plugin->run();

}
run_wp_olakai_performance_testing_plugin();
