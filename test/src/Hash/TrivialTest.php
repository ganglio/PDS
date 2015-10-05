<?php

namespace PDSTest;

class TrivialTest extends \PHPUnit_Framework_TestCase
{

    protected $hash;

    protected function setUp()
    {
        $this->hash = new \ganglio\PDS\Hash\Trivial();
    }

    protected function tearDown()
    {
        $this->hash = null;
    }

    public function testHash()
    {
        $hash = $this->hash->hash("teststring");
        $this->assertEquals(
            1953746146,
            $hash
        );
    }

}
