<?php

include_once(__DIR__ . '/../SEO/authoring/keywords.php');

class AuthoringKeywordsTest extends PHPUnit_Framework_TestCase {

    public function testBase() {
        $o = new Sseo_AuthoringKeywords();

        $this->assertTrue($o instanceof Sseo_AuthoringKeywords);
    }

    public function testNothing() {

        $o = new Sseo_AuthoringKeywords();

        $title = '';
        $body = '';

        $this->assertTrue($o->inPost($title, $body) === -1);

    }

}
?>
