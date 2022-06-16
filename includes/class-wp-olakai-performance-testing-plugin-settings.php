<?php

// https://torquemag.io/2016/09/building-a-wordpress-plugin-part-five/ 

class Wp_Olakai_Performance_Testing_Plugin_Admin_Setting {
	public function __construct() {
		add_action( 'admin_menu', array($this, 'add_acme_options_page'));
		add_action( 'admin_init', array($this, 'acme_admin_init_one'));
		add_action( 'admin_init', array($this, 'acme_admin_init_two'));
	}
	
	function add_acme_options_page() {
		add_options_page(
			'Olakai Performance',
			'Olakai Performance Options',
			'manage_options',
			'olakai-options-page',
			array($this, 'display_acme_options_page')
		);

	}

	function display_acme_options_page() {

		echo '<h2>Olakai Performance Options</h2>';

		echo '<form method="post" action="options.php">';

		do_settings_sections( 'acme-options-page' );
		settings_fields( 'acme-settings' );

		submit_button();

		echo '</form>';

	}
	
	function acme_admin_init_one() {

		add_settings_section(
			'acme-settings-section-one',      
			'Acme Settings Part One',         
			array($this, 'display_acme_settings_message'), 
			'acme-options-page'               
		);

		add_settings_field(
			'acme-input-field',        
			'Acme Input Field',        
			array($this, 'render_acme_input_field'),  
			'acme-options-page',        
			'acme-settings-section-one' 
		);

		register_setting(
			'acme-settings',    
			'acme-input-field'    
		);

	}

	function display_acme_settings_message() {
		echo "This displays the settings message.";
	}

	function render_acme_input_field() {

		$input = get_option( 'acme-input-field' );
		echo '<input type="text" id="acme-input-field" name="acme-input-field" value="' . $input . '" />';

	}
	
	function acme_admin_init_two() {

		add_settings_section(
			'acme-settings-section-two',
			'Acme Settings Part Two',
			array($this, 'display_another_acme_settings_message'),
			'acme-options-page'
		);

		add_settings_field(
			'acme-input-field-two',
			'Acme Input Field Two',
			array($this, 'render_acme_input_field_two'),
			'acme-options-page',
			'acme-settings-section-two'
		);

		register_setting(
			'acme-settings',
			'acme-input-field-two'
		);

	}

	function display_another_acme_settings_message() {
		echo "This displays the second settings message.";
	}

	function render_acme_input_field_two() {

		$input = get_option( 'acme-input-field-two' );
		echo '<input type="text" id="acme-input-field-two" name="acme-input-field-two" value="' . $input . '" />';

	}
}
