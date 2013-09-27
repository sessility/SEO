<?php

include_once(__DIR__ . '/../SEO/lib/lang/text.php');

class TextTest extends PHPUnit_Framework_TestCase {

    protected $text;
    protected $longText;

    protected $sentence;
    protected $sentenceText;

    protected function setUp() {

        $this->text = "Tomorrow, and tomorrow, and tomorrow, Creeps in this petty pace from day to day, To the last syllable of recorded time; And all our yesterdays have lighted fools The way to dusty death. Out, out, brief candle! Life's but a walking shadow, a poor player That struts and frets  is hour upon the stage, And then is heard no more. It is a tale Told by an idiot, full of sound and fury, Signifying nothing. Porter: Drink, sir, is a great provoker of three things. Macduff: What three things does drink especially provoke? Porter: Marry, sir, nose-painting, sleep, and urine. Lechery, sir, it provokes, and unprovokes; it provokes the desire, but it takes away the performance: therefore, much drink may be said to be an equivocator with lechery: it makes him, and it mars him; it sets him on, and it takes him off; it persuades him, and disheartens him; makes him stand to, and not stand to; in conclusion, equivocates him in a sleep, and, giving him the lie, leaves him.";
        $this->longText = new Sseo_Text($this->text);

        $this->sentence = "I am god-man.   However; --__--_- but, for ?????? the Sëissels' are in _deep_. Alas! ^Up, *Star";
        $this->sentenceText = new Sseo_Text($this->sentence);


    }

    public function testBase() {

        $this->assertTrue($this->longText instanceof Sseo_Text);
    }

    public function testLetterCount() {

        $this->assertEquals(966, $this->longText->getLength());

    }

    public function  testRemovePunctation() {

        $this->assertEquals("I am god man However but for the Sëissels are in deep Alas ^Up Star", $this->sentenceText->getWithoutPunctation());

    }

    public function testGetWords() {

        $this->assertEquals(array(
            'I',
            'am',
            'god',
            'man',
            'However',
            'but',
            'for',
            'the',
            'Sëissels',
            'are',
            'in',
            'deep',
            'Alas',
            '^Up',
            'Star'
        ), $this->sentenceText->getWords());

    }

    public function testGetWordCount() {

        $this->assertEquals(15, $this->sentenceText->getWordCount());

    }

    public function testGetWordFrequency() {

        $this->assertEquals(1277.0, $this->longText->getWordFrequency('tomorrow'));

        $this->assertEquals(657.0, $this->longText->getWordFrequency('in'));

        $this->assertEquals(939.0, $this->longText->getWordFrequency('things'));

    }

    public function testFullNeedleInHaystack() {

        $this->assertFalse($this->sentenceText->needleInHaystack('thing', 'things'));
        $this->assertFalse($this->sentenceText->needleInHaystack('thing', 'something'));
        $this->assertTrue($this->sentenceText->needleInHaystack('something', 'thing'));
        $this->assertTrue($this->sentenceText->needleInHaystack('something', 'some'));

    }

}

?>
