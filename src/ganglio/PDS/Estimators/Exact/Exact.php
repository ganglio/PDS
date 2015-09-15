<?php

namespace ganglio\PDS\Estimators;

class Exact implements Estimator {

	private $hash = NULL;

	public function __construct() {
		$this->hash = [];
	}

	public function add($key) {
		$this->hash[$key]=1;
	}

	public function count() {
		return count($this->hash);
	}

	public function __destruct() {
		$this->hash = NULL;
		unset($this->hash);
	}
}