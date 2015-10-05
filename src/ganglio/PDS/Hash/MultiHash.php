<?php

namespace ganglio\PDS\Hash;

class MultiHash implements Hash {
	private $hashes = [];

	public function __construct() {
		$args = func_get_args();

		if (count($args)<2)
			throw new \InvalidArgumentException("Please provide at least two hashing classes");

		foreach ($args as $hash)
			if ($hash instanceof Hash)
				$this->hashes[] = $hash;
			else
				throw new \InvalidArgumentException("All parameters need to be hashing classes");
	}

	public function hash($str) {
		$out = [];
		foreach ($this->hashes as $hash)
			$out[] = $hash->hash($str) & Hash::UPPERBOUND;
		return $out;
	}

}
