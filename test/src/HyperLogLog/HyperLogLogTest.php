<?php

namespace PDSTest;

class HyperLogLogTest extends \PHPUnit_Framework_TestCase {

	protected function setUp() {
		$this->hll = new \ganglio\PDS\HyperLogLog\HyperLogLog();
	}

	protected function tearDown() {
		$this->hll = null;
	}

	public function testCount() {
		$this->assertEquals(
			0,
			$this->hll->count()
		);

		$num_keys = 5000000;
		for ($i=0; $i<$num_keys; $i++)
			$this->hll->add("first".$i);

		$counted = $this->hll->count();
		$error = 100*abs($num_keys-$counted)/$num_keys;

		error_log($counted." ".$num_keys." ".$error);

		$this->assertLessThan(
			3,
			$error
		);
	}
}