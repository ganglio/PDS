<?php

namespace PDSTest;

class GenericTest extends \PHPUnit_Framework_TestCase
{

    protected $hash;

    protected function setUp()
    {
        $this->hash = new \ganglio\PDS\Hash\Generic();
    }

    protected function tearDown()
    {
        $this->hash = null;
    }

    /**
     * @expectedException Exception
     */
    public function testWrongAlgorithm()
    {
        $this->hash->setAlgorithm("MD44");
    }

    public function testGetAlgorithm()
    {
        $this->assertEquals(
            "md5",
            $this->hash->getAlgorithm()
        );
    }

    public function testHash()
    {
        $hash = $this->hash->hash("teststring");
        $this->assertEquals(
            0xdef5e5f8,
            $hash
        );
    }
}
