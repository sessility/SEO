<?php
class Sseo_Stopwords {

    private $path;
    private $lang;

    private $config;
    private $lang_config;

    private $words;


    public function __construct($lang = 'en', $path = '/../../config/stopwords/') {

        $this->lang = $lang;
        $this->path = $path;

        $this->getConfig();
        $this->getLang();
    }

    private function getConfig() {

        $config_file = __DIR__ . $this->path . 'main.json';
        $config_json = file_get_contents($config_file);
        $this->config = $this->parseJSON($config_json);

    }

    private function getLang() {

        $lang_file = __DIR__ . $this->path . $this->lang . '.json';
        $lang_json = $this->getLangJson($lang_file);

        $this->lang_config = $this->parseJSON($lang_json);
        $this->set($this->lang_config["words"]);

    }

    private function getLangJson($file) {

        try {
            $json = file_get_contents($file);
        } catch (Exception $e) {
            $json = '{ "words": [] }';
        }

        return $json;

    }

    private function parseJSON($json) {

        return json_decode($json, TRUE);

    }

    public function get() {

        return $this->words;

    }

    public function set($words) {

        $this->words = $words;

    }

    public function is($word) {

        $case = $this->lang_config['case'];
        $words = $this->get();

        // word is all upperacase, ignore it
        // lang has to have a concept of case
        if($this->config["ignore_uppercase"] && $case) {

            if($word === mb_strtoupper($word, $this->config['encoding']) && strlen($word) > 1 ) {
                return false;
            }

        }

        if($case) {

            return array_search(mb_strtolower($word, $this->config['encoding']), $this->get(), true) !== false;


        } else {

            return array_search($word, $words, true) !== false;

        }



    }

    public function reduce($text) {

        $arr = explode(' ', $text);
        $reduced = array();

        foreach($arr as $word) {
            if(!$this->is($word)) {
                $reduced[] = $word;
            }
        }

        return implode(' ', $reduced);

    }

}
?>
