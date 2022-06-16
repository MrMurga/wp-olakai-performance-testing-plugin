<?php

class Wp_Olakai_Performance_Testing_Filters {
	const OLAKAI_WEBSITE_LINK = 'olakai_website_link';
    const OLAKAI_TESTING_PLUGIN_RUN = 'page-wp-olakai-performance-testing-plugin-run';
    const OLAKAI_LINK_UTM_PARAMS = 'olakai_link_utm_params';
    const OLAKAI_CTA_HEADER = 'olakai_cta_header';
    const OLAKAI_CTA_FOOTER = 'olakai_cta_footer';

    /**
     * @var      Wp_Olakai_Performance_Testing_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    public function __construct($loader) {
        $this->loader = $loader;
        $this->addViewHelpers();
    }
    
    private function addViewHelpers() {
		$this->loader->add_filter( self::OLAKAI_WEBSITE_LINK, $this, 'add_oc_website' , 10, 3);
        $this->loader->add_filter( self::OLAKAI_TESTING_PLUGIN_RUN, $this, 'link_to_plugin_run', 10, 0);
        $this->loader->add_filter( self::OLAKAI_LINK_UTM_PARAMS, $this, 'link_utm_params', 10, 2);
        $this->loader->add_filter( self::OLAKAI_CTA_HEADER, $this, 'olakai_cta_header', 10, 0);
        $this->loader->add_filter( self::OLAKAI_CTA_FOOTER, $this, 'olakai_cta_footer', 10, 0);
	}

    public function olakai_cta_header() {
        require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/header.php');
    }
    
    public function olakai_cta_footer() {
        $url = apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_WEBSITE_LINK, base64_decode(WP_OLAKAI_WEBSITE_URL_AFFILIATE), 'footer');
        $response = Wp_Olakai_Performance_Testing_Network_Utilities::head($url);
        if ($response["code"] >= 200 && $response["code"] <= 400) {
            echo $response['content'];
        } else if ($response["code"] == 204) {
            require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/footer.php');
        }
    }

    public function add_oc_website($path, $utm_campaign = null, $utm_content = null) {
        return sprintf(
            "%s%s?%s",
            base64_decode(WP_OLAKAI_WEBSITE_URL),
            $path,
            $this->link_utm_params(
                $utm_campaign,
                $utm_content
            )
        );
    }

    public function link_to_plugin_run() {
        return sprintf("%s?page=%s", admin_url( 'tools.php'), self::OLAKAI_TESTING_PLUGIN_RUN);
    }

    public function link_utm_params($utm_campaign = null, $utm_content = null) {
        if ($utm_campaign) {
            $utm_campaign = "&utm_campaign=" . $utm_campaign;
        }

        if ($utm_content) {
            $utm_content = "&utm_content=" . $utm_content;
        }

        return sprintf(
            "utm_source=%s&utm_medium=%s%s%s&v=%s",
            $_SERVER['HTTP_HOST'],
            WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_NAME,
            $utm_campaign,
            $utm_content,
            WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_VERSION
        );
    }
}
