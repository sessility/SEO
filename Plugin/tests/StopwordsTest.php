<?php

include_once(__DIR__ . '/../SEO/lib/lang/stopwords.php');

class StopwordsTest extends PHPUnit_Framework_TestCase {

    /* test api */

    public function testBase() {
        $o = new Sseo_Stopwords();

        $this->assertTrue($o instanceof Sseo_Stopwords);

    }

    public function testBadLanguage() {

        $o = new Sseo_Stopwords('foo');

        $this->assertEmpty($o->get());
    }

    /* test spesific langs */

    public function testEnglishStopword() {

        $o = new Sseo_Stopwords('en');

        $this->assertTrue($o->is('has'));
        $this->assertTrue($o->is('HaS'));

        $this->assertFalse($o->is('brown'));
        $this->assertFalse($o->is('fox'));

    }

    public function testNorwegianStopword() {

        $o = new Sseo_Stopwords('no');

        $this->assertTrue($o->is('på'));
        $this->assertFalse($o->is('unittest'));

    }

    public function testDanishStopword() {

        $o = new Sseo_Stopwords('dk');

        $this->assertTrue($o->is('den'));
        $this->assertFalse($o->is('arbeid'));

    }

    public function testBulgarianStopword() {

        $o = new Sseo_Stopwords('bg');

        $this->assertTrue($o->is('беше'));
        $this->assertFalse($o->is('език'));

    }

    public function testGermanStopword() {

        $o = new Sseo_Stopwords('de');

        $this->assertTrue($o->is('unter'));
        $this->assertFalse($o->is('hitler'));

    }

    public function testSpanishStopword() {

        $o = new Sseo_Stopwords('es');

        $this->assertTrue($o->is('que'));
        $this->assertFalse($o->is('español'));

    }

    public function testFarsiStopword() {

        $o = new Sseo_Stopwords('fa');

        $this->assertTrue($o->is('در'));
        $this->assertFalse($o->is('فارسی'));

    }

    public function testFinishStopword() {

        $o = new Sseo_Stopwords('fi');

        $this->assertTrue($o->is('olla'));
        $this->assertFalse($o->is('perkele'));

    }

    public function testFrenchStopword() {

        $o = new Sseo_Stopwords('fr');

        $this->assertTrue($o->is('aux'));
        $this->assertFalse($o->is('viva'));

    }

    public function testHindiStopword() {

        $o = new Sseo_Stopwords('hi');

        $this->assertTrue($o->is('पर'));
        $this->assertFalse($o->is('अर्धतत्सम'));

    }

    public function testHungarianStopword() {

        $o = new Sseo_Stopwords('hu');

        $this->assertTrue($o->is('ahogy'));
        $this->assertFalse($o->is('magyar'));

    }

    public function testItalianStopword() {

        $o = new Sseo_Stopwords('it');

        $this->assertTrue($o->is('ad'));
        $this->assertFalse($o->is('fiat'));

    }

    public function testJapaneseStopword() {

        $o = new Sseo_Stopwords('jp');

        $this->assertTrue($o->is('これ'));
        $this->assertFalse($o->is('日本語'));

    }

    public function testDutchStopword() {

        $o = new Sseo_Stopwords('nl');

        $this->assertTrue($o->is('de'));
        $this->assertFalse($o->is('meneer'));

    }

    public function testPolishStopword() {

        $o = new Sseo_Stopwords('pl');

        $this->assertTrue($o->is('ach'));
        $this->assertFalse($o->is('foo'));

    }

    public function testPortugueseStopword() {

        $o = new Sseo_Stopwords('pt');

        $this->assertTrue($o->is('que'));
        $this->assertFalse($o->is('zoo'));

    }

    public function testRussianStopword() {

        $o = new Sseo_Stopwords('ru');

        $this->assertTrue($o->is('и'));
        $this->assertFalse($o->is('vodka'));

    }

    public function testSwedishStopword() {

        $o = new Sseo_Stopwords('se');

        $this->assertTrue($o->is('och'));
        $this->assertFalse($o->is('demokratarna'));

    }

    public function testArabicStopWord() {

        $o = new Sseo_Stopwords('ar');

        $this->assertTrue($o->is('ب'));
        $this->assertFalse($o->is('العربية'));

    }


    /* test reduction */

    public function testReduceEnglishText() {

        $o = new Sseo_Stopwords('en');

        $text = 'The brown fox jumps over the something brown thing';
        $targetText = 'brown fox jumps something brown thing';

        $this->assertEquals($targetText, $o->reduce($text));

    }


    public function testRecucedNorwegianText() {

        $o = new Sseo_Stopwords('no');

        $text = 'Hvordan stjele kofferter fra butikker på vestkanten';
        $targetText = 'stjele kofferter butikker vestkanten';

        $this->assertEquals($targetText, $o->reduce($text));

    }

    public function testCaseSensitivity() {

        $o = new Sseo_Stopwords('en');

        $this->assertTrue($o->is('Is'));
        $this->assertFalse($o->is('IS'));

    }

    public function testNorwegianCaseSensitivity() {

        $o = new Sseo_Stopwords('no');

        $text = 'Jeg startet et selskap som heter DET. Jeg så ET da jeg var liten.';
        $targetText = 'startet selskap heter DET. ET liten.';

        $this->assertEquals($targetText, $o->reduce($text));

    }

}
?>
