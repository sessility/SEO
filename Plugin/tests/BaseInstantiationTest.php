<?php
class BaseInstantiationTest extends PHPUnit_Framework_TestCase
{
    public function testOne()
    {
        $this->assertTrue(TRUE);
    }

    /**
     * @depends testOne
     */
    public function testTwo()
    {
        $this->assertTrue(TRUE);
    }
}
?>
