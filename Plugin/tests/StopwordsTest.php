<?php

include_once(__DIR__ . '/../SEO/lib/lang/stopwords.php');

class StopwordsTest extends PHPUnit_Framework_TestCase {

    public function testBase() {
        $o = new Sseo_Stopwords();

        $this->assertTrue($o instanceof Sseo_Stopwords);

    }


    public function testBadLanguage() {

        $o = new Sseo_Stopwords('foo');

        $this->assertEmpty($o->get());
    }

    public function testBadLanguageStopWord() {

        $o = new Sseo_Stopwords('foo');

        $this->assertFalse($o->isStopWord('baz'));

    }

    public function testEnglishLanguageStopWord() {

        $o = new Sseo_Stopwords('en');

        $this->assertTrue($o->isStopWord('is'));
        $this->assertFalse($o->isStopWord('unittest'));

    }

}
?>
