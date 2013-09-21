<?php

class Sseo_Config {

    private $config = array();

    function __construct($config = array()) {

        if(is_array($config)) {
            $this->setAll($config);
        }

    }

    public function set($key, $value) {

        $this->config[$key] = $value;

    }

    public function setAll($arr) {

        $this->config = array_merge($this->config, $arr);

    }

    public function get($key) {

        return $this->config[$key];

    }

    public function getAll() {

        return $this->config;

    }

    public function setJSON($json) {

        $this->setAll(json_decode($json, TRUE));

    }

    public function setJSONFile($jsonFile) {

        $ok = true;

        try {
            $this->setJSON(file_get_contents($jsonFile));
        } catch (Exception $e) {
            $ok = false;
        }

        return $ok;
    }

}

?>
