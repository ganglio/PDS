<?php

namespace PDSTest;

use \ganglio\PDS\Hash\Generic;

class MultiHashTest extends \PHPUnit_Framework_TestCase
{

    protected $hash;

    protected function setUp()
    {
        $this->hash = new \ganglio\PDS\Hash\MultiHash(new Generic("md5"), new Generic("sha1"), new Generic("sha256"));
    }

    protected function tearDown()
    {
        $this->hash = null;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidConstructorArguments()
    {
        new \ganglio\PDS\Hash\MultiHash([1,2,3]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidConstructorArgumentsNumber()
    {
        new \ganglio\PDS\Hash\MultiHash(new Generic("md5"));
    }

    public function testHash()
    {
        $hash = $this->hash->hash("teststring");
        $this->assertEquals(
            [
                0xdef5e5f8,
                0x53e865c4,
                0x8882d111,
            ],
            $hash
        );
    }

}
