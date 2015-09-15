<?php

namespace ganglio\PDS\Hash;

class FNVHash implements Hash {
	const FNV_offset_basis = 2166136261;

	public function hash($str) {
		$hash = self::FNV_offset_basis;

		foreach (str_split($str) as $c) {
			$hash = ($hash << 1) + ($hash << 4) + ($hash << 7) + ($hash << 8) + ($hash << 24) + $hash & Hash::UPPERBOUND;
			$hash = $hash ^ ord($c);
		}

		return $hash & Hash::UPPERBOUND;
	}
}