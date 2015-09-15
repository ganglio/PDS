<?php

namespace Benchmarks\HyperLogLog;

use \ganglio\PDS\HyperLogLog;

class HyperLogLogBenchmark {

	private $hll;

	public function __construct() {
		$this->hll = new HyperLogLog();
	}

	public function run() {
		$num_keys = 5000000;

		for ($i=1; $i<=$num_records) {
			$this->hll->add(md5($i));

			if ($i%1000 == 0) {
				$counted = $this->hll->count();
				$error = 100*abs($i-$counted)/$i;
				printf("%d\t%d\t%f\n",$i,$counted,$error);
			}
		}
	}

	public function __destruct() {
		$this->hll = NULL;
		unset($this->hll);
	}
}