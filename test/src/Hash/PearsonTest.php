<?php

namespace PDSTest;

class PearsonTest extends \PHPUnit_Framework_TestCase
{

    protected $hash;

    protected function setUp()
    {
        $this->hash = new \ganglio\PDS\Hash\Pearson();
    }

    protected function tearDown()
    {
        $this->hash = null;
    }

    public function testHash()
    {
        $hash = $this->hash->hash("teststring");
        $this->assertEquals(
            2969475059,
            $hash
        );
    }

}
