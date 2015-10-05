<?php

namespace PDSTest;

use ganglio\PDS\Storage\BitArray;

class BitArrayTest extends \PHPUnit_Framework_TestCase
{

    private $storage;

    protected function setUp()
    {
        $this->storage = new BitArray();
    }

    protected function tearDown()
    {
        $this->storage = null;
    }

    public function testSetGet()
    {
        $this->storage->flush();

        $randPos = mt_rand();

        $this->storage->set($randPos);

        $this->assertTrue(
            $this->storage->get($randPos)
        );
    }

    public function testCount()
    {
        $this->storage->flush();

        $numElem = 50;
        for ($i=0; $i<$numElem; $i++) {
            $this->storage->set(mt_rand());
        }

        $this->assertLessThanOrEqual(
            $numElem,
            $this->storage->size()
        );
    }

    public function testFlush()
    {
        $this->storage->flush();

        $this->assertEquals(
            0,
            $this->storage->size()
        );
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionsSetNonNumericKey()
    {
        $this->storage->flush();
        $this->storage->set("test");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionsSetWithValue()
    {
        $this->storage->flush();
        $this->storage->set(0x22, "test");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionsGet()
    {
        $this->storage->flush();
        $this->storage->get("test");
    }
}
