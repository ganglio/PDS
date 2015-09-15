<?php

namespace ganglio\PDS\Hash;

interface Hash {
	const UPPERBOUND = 0xffffffff;
	public function hash($str);
}