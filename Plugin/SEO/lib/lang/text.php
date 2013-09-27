<?php

include_once(__DIR__ . '/../sseo.php');

class Sseo_Text extends Sseo_Base {

    private $text;

    function __construct($text) {

        parent::__construct();

        $this->text = $text;

    }

    public function getText($lc = false) {

        if($lc) {
            $text = mb_strtolower($this->text, $this->getConfig()->get('encoding'));
        } else {
            $text = $this->text;
        }

        return $text;

    }

    public function getLength() {

        return mb_strlen($this->getText());

    }

    public function getWithoutPunctation($lc = false) {

        return preg_replace('/\s+/u', ' ', preg_replace('/\p{P}/u', ' ', $this->getText($lc)));

    }

    public function getWords($lc = false) {

        return explode(' ', $this->getWithoutPunctation($lc));

    }

    public function getWordCount() {

        return count($this->getWords());

    }

    public function getWordFrequency($word) {

        $freq = 0.0;

        foreach($this->getWords(true) as $w) {

            $freq += $this->getLevenshtein($w, $word);

        }

        return $freq;

    }

    private function getLevenshtein($a, $b) {

        return levenshtein($a, $b);

    }

    public function needleInHaystack($haystack, $needle) {

        $needleLen = strlen($needle);
        $haystackLen = strlen($haystack);
        $pos = strpos($haystack, $needle);

        if($pos === false) {
            return false;
        }

        return ($needleLen + $pos) <= $haystackLen;

    }

    public function getPhraseFrequency($phrase) {

        return $this->calculateWordCmpScore($this->getText(), $phrase);

    }


}

?>
