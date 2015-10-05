<?php

namespace PDSTest;

use ganglio\PDS\Estimators\Exact;

class ExactTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $this->estimator = new Exact();
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

        $this->assertEquals(
            $num_keys,
            $counted
        );
    }
}
