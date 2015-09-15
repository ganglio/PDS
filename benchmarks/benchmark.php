<?php

require_once __DIR__."/../vendor/autoload.php";

error_log("Starting benchmark");

for ($i=0; $i<100; $i++) {
	$hllb = new \Benchmarks\HyperLogLog\HyperLogLogBenchmark(1000000);
	$hllb->run();
	$hllb = null;
	unset($hllb);
}

for ($i=0; $i<100; $i++) {
	$hash = new \Benchmarks\Hashing\HashingBenchmark();
	$hash->run();
	$hllb = null;
	unset($hllb);
}