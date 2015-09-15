<?php

namespace PDSTest;

class FNVHashTest extends \PHPUnit_Framework_TestCase {

	protected $hash;

	protected function setUp() {
		$this->hash = new \ganglio\PDS\Hash\FNVHash();
	}

	protected function tearDown() {
		$this->hash = null;
	}

	public function testHash() {
		$this->assertEquals(
			3617007866,
			$this->hash->hash("teststring")
		);
	}

	public function testZero() {
		$tests = ["3d7A5K", "9q6Mq3", "HHYSLE", "TrLdZ1", "VL3BqC", "WAd2`W", "YUo19l", "Yf6hP6", "hIrjFj", "n`bv3R", "plIzl`", "uMk`9Q", "ysopHl", "zcIkCe"];
		foreach ($tests as $string)
			$this->assertEquals(0,$this->hash->hash($string));
	}

}