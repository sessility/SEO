<?php

include_once(__DIR__ . '/../sseo.php');

class Sseo_Stopwords extends Sseo_Base {

    private $path;
    private $lang;

    private $lang_config;

    private $words;


    function __construct($lang = 'en', $path = '/../../config/stopwords/') {

        parent::__construct();

        $this->lang = $lang;
        $this->path = $path;

        $this->initLangConfig();

    }

    private function initLangConfig() {

        $lang_file = __DIR__ . $this->path . $this->lang . '.json';

        $ok = $this->getConfig()->setJSONFile($lang_file);

        if($ok) {
            $this->setWords($this->getConfig()->get("words"));
        } else {
            $this->setWords(array());
        }

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

    public function getWords() {

        return $this->words;

    }

    public function setWords($words) {

        $this->words = $words;

    }

    public function isStopword($word) {

        $case = $this->getConfig()->get('case');
        $words = $this->getWords();

        // word is all upperacase, ignore it
        // lang has to have a concept of case
        if($this->getConfig()->get('ignore_uppercase') && $case) {

            if($word === mb_strtoupper($word, $this->getConfig()->get('encoding')) && strlen($word) > 1 ) {
                return false;
            }

        }

        if($case) {

            return array_search(mb_strtolower($word, $this->getConfig()->get('encoding')), $this->getWords(), true) !== false;


        } else {

            return array_search($word, $words, true) !== false;

        }



    }

    public function reduce($text) {

        $arr = explode(' ', $text);
        $reduced = array();

        foreach($arr as $word) {
            if(!$this->isStopword($word)) {
                $reduced[] = $word;
            }
        }

        return implode(' ', $reduced);

    }

}
?>
