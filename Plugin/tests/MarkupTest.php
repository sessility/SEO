<?php

include_once(__DIR__ . '/../SEO/lib/lang/markup.php');

class MarkupTest extends PHPUnit_Framework_TestCase {

    /* test api */

    public function testBase() {
        $o = new Sseo_Markup();

        $this->assertTrue($o instanceof Sseo_Markup);

    }

    public function testGetCanonicalUrl() {

        $o = new Sseo_Markup();

        $a = 'http://example.org/foo/bar?foo=bar';

        $this->assertEqual();

    }

}
?>
