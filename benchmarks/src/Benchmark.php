<?php

namespace Benchmarks;

abstract class Benchmark {
	private $object;
	private $steps=1000;
	private $memory_before;
	private $start_time;

	public function __construct($steps = 1000) {
		$this->steps = $steps;
		$this->memory_before = memory_get_usage();
		$this->start_time = time();
	}

	public abstract function run($num_keys = 5000000);

	public function __destruct() {
		error_log(vsprintf("Report for %s %sb %ss", [
			end(explode('\\',get_class($this))),
			number_format(memory_get_usage()-$this->memory_before),
			number_format(time()-$this->start_time),
		]));

		$this->object = NULL;
		unset($this->object);
	}
}