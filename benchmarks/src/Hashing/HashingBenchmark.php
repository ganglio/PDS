<?php

namespace Benchmarks\Hashing;

use \Benchmarks\Benchmark;

class HashingBenchmark extends Benchmark {

	public function __construct($steps=1000) {
		parent::__construct($steps);
		$this->object = [];
	}

	public function run($num_keys = 5000000) {
		for ($i=1; $i<=$num_keys; $i++)
			$this->hash[md5($i)]=1;
	}
}