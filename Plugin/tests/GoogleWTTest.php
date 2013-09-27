<?php

require_once(__DIR__ . '/../SEO/lib/google.php');

class ConfigTest extends PHPUnit_Framework_TestCase {

    /* test api */

    public function testBase() {

        $o = new Sseo_Google();

        $this->assertTrue($o instanceof Sseo_Google);

    }

}

?>
