<?php

include_once(__DIR__ . '/../SEO/SSEO_Base.php');
include_once(__DIR__ . '/../SEO/admin/SSEO_Admin.php');

class BaseInstantiationTest extends PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $b = new SSEO_Base();

        $this->assertTrue($b instanceof SSEO_Base);
    }

    public function testAdmin()
    {
        $a = new SSEO_Admin();

        $this->assertTrue($a instanceof SSEO_Admin);
    }
}
?>
