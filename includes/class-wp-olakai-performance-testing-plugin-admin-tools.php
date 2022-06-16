<?php
class Wp_Olakai_Performance_Testing_Plugin_Admin_Tools {
	private $action_lighthouse_run;
	private $action_report;

	public function __construct() {
		$this->action_lighthouse_run = sprintf("page-%s-run", "wp-olakai-performance-testing-plugin");
		$this->action_report = sprintf("page-%s-run", "report");
		$this->action_json_parser = sprintf("%s-%s", "wp-olakai-performance-testing-plugin", "json_parser");

		$this->addTestPage();
		$this->addReportPage();
	}

	private function triggerPerformanceTest() {
		$url = base64_decode(WP_OLAKAI_PERFORMANCE_TESTING_SERVER_URL);
		$fields = array(
			'preset' => $_POST['olakai']['preset'],
			'url' => $_POST['olakai']['url']
		);
		
		$response = Wp_Olakai_Performance_Testing_Network_Utilities::post($url, $fields);
		http_response_code($response['code']);
		return $response['content'];
	}

	private function addReportPage() {
		add_action( 
			'admin_action_' . $this->action_report,
			function () {
				$url = $_REQUEST['html'];
				$response = Wp_Olakai_Performance_Testing_Network_Utilities::get($url);
				http_response_code($response['code']);
				echo $response['content'];
			}
		);
	}

	private function addTestPage() {
		add_action( 
			'admin_action_' . $this->action_lighthouse_run,
			function () {	
				// Do your stuff here
				echo $this->triggerPerformanceTest();
			}
		);

		add_action('admin_menu', 
			function () {
				add_management_page( 
					'Olakai Performance Tools',
					'Olakai Performance Tools', 
					'edit_posts', 
					$this->action_lighthouse_run, 
					function () {
						require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/page.php');
					});
			}
		);
	}
}
