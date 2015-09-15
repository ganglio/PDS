<?php

require_once __DIR__."/../vendor/autoload.php";

$hllb = new \Benchmarks\HyperLogLog\HyperLogLogBenchmark();
$hllb->run();