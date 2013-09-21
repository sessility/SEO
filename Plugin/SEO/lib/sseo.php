<?php

include_once(__DIR__ . '/config.php');

class Sseo_Base {

    private $config;

    function __construct() {

        $this->config = new Sseo_Config();

        $this->config->setJSONFile(__DIR__ . '/../config/main.json');

    }

    public function getConfig() {

        return $this->config;

    }

}
?>
