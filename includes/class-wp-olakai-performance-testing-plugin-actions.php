<?php

class Wp_Olakai_Performance_Testing_Actions {

    /**
     * @var      Wp_Olakai_Performance_Testing_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    public function __construct($loader) {
        $this->loader = $loader;
    }
}
