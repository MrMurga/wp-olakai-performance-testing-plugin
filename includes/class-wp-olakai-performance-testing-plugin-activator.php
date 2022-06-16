<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.olakaiconsulting.com/team
 * @since      1.0.0
 *
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 * @author     Olakai Consulting <contact@olakaiconsulting.com>
 */
class Wp_Olakai_Performance_Testing_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$url = apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_ENDPOINT_URL, null);
		Wp_Olakai_Performance_Testing_Network_Utilities::post($url, null);
	}

}
