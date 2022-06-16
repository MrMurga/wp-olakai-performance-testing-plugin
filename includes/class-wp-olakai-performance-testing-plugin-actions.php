<?php

class Wp_Olakai_Performance_Testing_Actions {
    const OLAKAI_PLUGIN_INIT = 'OLAKAI_PLUGIN_INIT';

    // TRANSIENTS
    const WP_OLAKAI_PERFORMANCE_TESTING_TRANSIENT_SERVER = WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME . '-ping';
    const WP_OLAKAI_PERFORMANCE_TESTING_TRANSIENT_SERVER_TTL_SECS = 60 * 15;

    /**
     * @var      Wp_Olakai_Performance_Testing_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    public function __construct($loader) {
        $this->loader = $loader;
        $this->loader->add_action( self::OLAKAI_PLUGIN_INIT, $this, 'olakai_plugin_init');
    }

    public function olakai_plugin_init() {
        $last = get_transient( WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME );
        
        do {
            if ($last == 204) {
                // Break out of loop
                break;

            } else if ($last === false) {
                $response = Wp_Olakai_Performance_Testing_Network_Utilities::head(base64_decode(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_KILL_SWITCH));
                $last = $response['code'];
                set_transient(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME, $last, WP_OLAKAI_PERFORMANCE_TESTING_DEFAULT_TIMEOUT_MS / 1000);
                continue; // do another loop

            } else {
                // If the page is telling us to back off, then backoff!
                return false;
            }

        } while (false);
        
        new Wp_Olakai_Performance_Testing_Plugin_Admin_Tools();
        $this->olakai_plugin_ping();
        return true;
    }

    public function olakai_plugin_ping() {
        $ping = get_transient( self::WP_OLAKAI_PERFORMANCE_TESTING_TRANSIENT_SERVER );
		
		if( $ping !== false) {
			return false;
		}

		set_transient( self::WP_OLAKAI_PERFORMANCE_TESTING_TRANSIENT_SERVER, true, self::WP_OLAKAI_PERFORMANCE_TESTING_TRANSIENT_SERVER_TTL_SECS);
		Wp_Olakai_Performance_Testing_Network_Utilities::head(base64_decode(WP_OLAKAI_PERFORMANCE_TESTING_SERVER_URL), WP_OLAKAI_PERFORMANCE_TESTING_ULTRA_FAST_TIMEOUT_MS);
		return true;
    }
}
