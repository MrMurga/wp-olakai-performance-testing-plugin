<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.olakaiconsulting.com/team
 * @since      1.0.0
 *
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 * @author     Olakai Consulting <contact@olakaiconsulting.com>
 */
class Wp_Olakai_Performance_Testing_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-olakai-performance-testing-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
