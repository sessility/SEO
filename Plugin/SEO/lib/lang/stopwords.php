<?php
class Sseo_Stopwords {

    private $path = '/../../config/stopwords/';
    private $lang = '';
    private $words;

    public function __construct($lang = 'en') {

        $this->lang = $lang;

        $json_file = __DIR__ . $this->path . $lang . '.json';
        $json = $this->getJSON($json_file);

        $this->set($this->parseWords($json)["words"]);

    }

    private function getJSON($file) {

        try {
            $json = file_get_contents($file);
        } catch (Exception $e) {
            $json = '{ "words": [] }';
        }

        return $json;

    }

    private function parseWords($json) {

        return json_decode($json, TRUE);

    }

    public function get() {

        return $this->words;

    }

    public function set($words) {

        $this->words = $words;

    }

    public function is($word) {

        return array_search(strtolower($word), $this->get(), true) !== false;

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
