<?php 
class Wp_Olakai_Performance_Testing_Network_Utilities {
	private static function common($url, $timeout = WP_OLAKAI_PERFORMANCE_TESTING_DEFAULT_TIMEOUT_MS) {
		//open connection
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$headers = array(
			"X-OLAKAI-CONSULTING-CUSTOMER: {$_SERVER['HTTP_HOST']}",
			"accept: */*",
			"user-agent: ". WP_OLAKAI_PERFORMANCE_TESTING_USER_AGENT,
		);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);    // we don't want to output headers
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

		return $ch;
	}

    public static function head($url, $timeout = WP_OLAKAI_PERFORMANCE_TESTING_HEAD_TIMEOUT_MS) {
		$ch = self::common($url, $timeout);
		
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		return ["code" => $httpcode, "content" => $result];
	}

	public static function get($url) {
		$ch = self::common($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);

		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		return ["code" => $httpcode, "content" => $result];
	}

	public static function post($url, $fields) {
		$ch = self::common($url);

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);

		if ($fields != null) {
			//url-ify the data for the POST
			$fields_string = http_build_query($fields);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		}
		
		//execute post
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		return ["code" => $httpcode, "content" => $result];
	}
}
