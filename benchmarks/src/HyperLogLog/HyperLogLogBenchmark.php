<?php

namespace Benchmarks\HyperLogLog;

use \Benchmarks\Benchmark;
use \ganglio\PDS\HyperLogLog\HyperLogLog;

class HyperLogLogBenchmark extends Benchmark {

	public function __construct($steps=1000) {
		parent::__construct($steps);
		$this->object = new HyperLogLog();
	}

	public function run($num_keys = 5000000) {
		for ($i=1; $i<=$num_keys; $i++)
			$this->object->add(md5($i));
	}
}