<?php

namespace PDSTest;

class BloomTest extends \PHPUnit_Framework_TestCase
{

    private $bloom;

    protected function setUp()
    {
        $this->bloom = new \ganglio\PDS\Bloom\Bloom("md5", "sha1", "sha256");
    }

    protected function tearDown()
    {
        $this->bloom = null;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidConstructorArguments()
    {
        new \ganglio\PDS\Bloom\Bloom([1,2,3], [4,5,6]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidConstructorNumberOfArguments()
    {
        new \ganglio\PDS\Bloom\Bloom("md5");
    }

    public function testAdd()
    {
        $this->bloom->flush();

        $this->assertEquals(
            false,
            $this->bloom->add("test1")
        );
        $this->assertEquals(
            false,
            $this->bloom->add("test2")
        );
        $this->assertEquals(
            true,
            $this->bloom->add("test1")
        );
    }

    public function testTest()
    {
        $this->bloom->flush();

        $this->bloom->add("test1");

        $this->assertEquals(
            true,
            $this->bloom->test("test1")
        );
        $this->assertEquals(
            false,
            $this->bloom->test("test2")
        );
    }
}
