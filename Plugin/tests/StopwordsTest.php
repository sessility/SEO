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

    public function testBadLanguageStopword() {

        $o = new Sseo_Stopwords('foo');

        $this->assertFalse($o->is('baz'));

    }

    public function testEnglishStopword() {

        $o = new Sseo_Stopwords('en');

        $this->assertTrue($o->is('has'));
        $this->assertTrue($o->is('HaS'));

        $this->assertFalse($o->is('brown'));
        $this->assertFalse($o->is('fox'));

    }

    public function testNorwegianStopword() {

        $o = new Sseo_Stopwords('no');

        $this->assertTrue($o->is('er'));
        $this->assertFalse($o->is('unittest'));

    }

    public function testReduceEnglishText() {

        $o = new Sseo_Stopwords('en');

        $text = 'The brown fox jumps over the something brown thing';
        $targetText = 'brown fox jumps something brown thing';

        $this->assertEquals($targetText, $o->reduce($text));

    }

}
?>
