<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.olakaiconsulting.com/team
 * @since      1.0.0
 *
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Olakai_Performance_Testing_Plugin
 * @subpackage Wp_Olakai_Performance_Testing_Plugin/includes
 * @author     Olakai Consulting <contact@olakaiconsulting.com>
 */
class Wp_Olakai_Performance_Testing_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$url = apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_ENDPOINT_URL, null);
		Wp_Olakai_Performance_Testing_Network_Utilities::delete($url);
	}

}
