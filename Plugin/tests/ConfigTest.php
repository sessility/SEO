<?php

include_once(__DIR__ . '/../SEO/lib/config.php');

class ConfigTest extends PHPUnit_Framework_TestCase {

    /* test api */

    public function testBase() {

        $o = new Sseo_Config();

        $this->assertTrue($o instanceof Sseo_Config);

    }

    public function testOverwrite() {

        $o = new Sseo_Config(array('foo' => 'baz' ));
        $o->set('foo', 'bar');

        $this->assertEquals('bar', $o->get('foo'));

    }

    public function testOverwrites() {

        $o = new Sseo_Config(array( 'foo' => 'baz', 'bar' => 2 ));

        $o->setAll(array( 'foo' => 'faa', 'bar' => 3));

        $this->assertEquals(3, $o->get('bar'));
        $this->assertEquals('faa', $o->get('foo'));

    }

    public function testJSON() {

        $o = new Sseo_Config(array( 'path' => '/etc/sseo', 'active' => true ));

        $o->setJSON('{ "path": "/home/jonas/sseo", "active": false }');

        $this->assertEquals('/home/jonas/sseo', $o->get('path'));
        $this->assertEquals(false, $o->get('active'));


    }

    public function testWildCascade() {

        $o = new Sseo_Config(array( 'owner' => 'world', 'area' => 999 ));

        $o->setAll(array( 'owner' => 'norway', 'area' => 99));

        $o->setAll(array( 'owner' => 'county', 'area' => 9));

        $o->setAll(array( 'owner' => 'municipality', 'area' => 5));

        $o->setAll(array( 'owner' => 'person', 'area' => 2));

        $this->assertEquals('person', $o->get('owner'));
        $this->assertEquals(2, $o->get('area'));

    }

    // public function testJSON() {

    //     $o = new Sseo_Config();

    //     $json = '{ "foo": true, "bar": 1 }';

    //     $o->addJSON($json);

    //     $this->assertTrue($o->get('foo'));

    // }
}

?>
