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

    public function isStopWord($word) {

        return array_search($word, $this->get()) !== false;

    }


    // foreach ($jsonIterator as $key => $val) {
    //     if(is_array($val)) {
    //         echo "$key:\n";
    //     } else {
    //         echo "$key => $val\n";
    //     }
    // }

}
?>
