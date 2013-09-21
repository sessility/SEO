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

        $this->assertEmpty($o->getWords());
    }

    /* test spesific langs */

    public function testEnglishStopword() {

        $o = new Sseo_Stopwords('en');

        $this->assertTrue($o->isStopword('has'));
        $this->assertTrue($o->isStopword('HaS'));

        $this->assertFalse($o->isStopword('brown'));
        $this->assertFalse($o->isStopword('fox'));

    }

    public function testNorwegianStopword() {

        $o = new Sseo_Stopwords('no');

        $this->assertTrue($o->isStopword('på'));
        $this->assertFalse($o->isStopword('unittest'));

    }

    public function testDanishStopword() {

        $o = new Sseo_Stopwords('dk');

        $this->assertTrue($o->isStopword('den'));
        $this->assertFalse($o->isStopword('arbeid'));

    }

    public function testBulgarianStopword() {

        $o = new Sseo_Stopwords('bg');

        $this->assertTrue($o->isStopword('беше'));
        $this->assertFalse($o->isStopword('език'));

    }

    public function testGermanStopword() {

        $o = new Sseo_Stopwords('de');

        $this->assertTrue($o->isStopword('unter'));
        $this->assertFalse($o->isStopword('hitler'));

    }

    public function testSpanishStopword() {

        $o = new Sseo_Stopwords('es');

        $this->assertTrue($o->isStopword('que'));
        $this->assertFalse($o->isStopword('español'));

    }

    public function testFarsiStopword() {

        $o = new Sseo_Stopwords('fa');

        $this->assertTrue($o->isStopword('در'));
        $this->assertFalse($o->isStopword('فارسی'));

    }

    public function testFinishStopword() {

        $o = new Sseo_Stopwords('fi');

        $this->assertTrue($o->isStopword('olla'));
        $this->assertFalse($o->isStopword('perkele'));

    }

    public function testFrenchStopword() {

        $o = new Sseo_Stopwords('fr');

        $this->assertTrue($o->isStopword('aux'));
        $this->assertFalse($o->isStopword('viva'));

    }

    public function testHindiStopword() {

        $o = new Sseo_Stopwords('hi');

        $this->assertTrue($o->isStopword('पर'));
        $this->assertFalse($o->isStopword('अर्धतत्सम'));

    }

    public function testHungarianStopword() {

        $o = new Sseo_Stopwords('hu');

        $this->assertTrue($o->isStopword('ahogy'));
        $this->assertFalse($o->isStopword('magyar'));

    }

    public function testItalianStopword() {

        $o = new Sseo_Stopwords('it');

        $this->assertTrue($o->isStopword('ad'));
        $this->assertFalse($o->isStopword('fiat'));

    }

    public function testJapaneseStopword() {

        $o = new Sseo_Stopwords('jp');

        $this->assertTrue($o->isStopword('これ'));
        $this->assertFalse($o->isStopword('日本語'));

    }

    public function testDutchStopword() {

        $o = new Sseo_Stopwords('nl');

        $this->assertTrue($o->isStopword('de'));
        $this->assertFalse($o->isStopword('meneer'));

    }

    public function testPolishStopword() {

        $o = new Sseo_Stopwords('pl');

        $this->assertTrue($o->isStopword('ach'));
        $this->assertFalse($o->isStopword('foo'));

    }

    public function testPortugueseStopword() {

        $o = new Sseo_Stopwords('pt');

        $this->assertTrue($o->isStopword('que'));
        $this->assertFalse($o->isStopword('zoo'));

    }

    public function testRussianStopword() {

        $o = new Sseo_Stopwords('ru');

        $this->assertTrue($o->isStopword('и'));
        $this->assertFalse($o->isStopword('vodka'));

    }

    public function testSwedishStopword() {

        $o = new Sseo_Stopwords('se');

        $this->assertTrue($o->isStopword('och'));
        $this->assertFalse($o->isStopword('demokratarna'));

    }

    public function testArabicStopWord() {

        $o = new Sseo_Stopwords('ar');

        $this->assertTrue($o->isStopword('ب'));
        $this->assertFalse($o->isStopword('العربية'));

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

        $this->assertTrue($o->isStopword('Is'));
        $this->assertFalse($o->isStopword('IS'));

    }

    public function testNorwegianCaseSensitivity() {

        $o = new Sseo_Stopwords('no');

        $text = 'Jeg startet et selskap som heter DET. Jeg så ET da jeg var liten.';
        $targetText = 'startet selskap heter DET. ET liten.';

        $this->assertEquals($targetText, $o->reduce($text));

    }

}
?>
