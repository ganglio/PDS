<?php

namespace PDSTest;

use ganglio\PDS\Estimators\HyperLogLog;

class HyperLogLogTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $this->estimator = new HyperLogLog();
    }

    protected function tearDown()
    {
        $this->estimator = null;
    }

    public function testCount()
    {
        $this->assertEquals(
            0,
            $this->estimator->count()
        );

        $num_keys = 50000;
        for ($i=0; $i<$num_keys; $i++) {
            $this->estimator->add("first" . $i);
        }

        $counted = $this->estimator->count();
        $error = 100*abs($num_keys-$counted)/$num_keys;

        $this->assertLessThan(
            1,
            $error
        );
    }
}
