<?php

namespace ganglio\PDS\Hash;

class FNVHash implements Hash
{
    const FNV_OFFSET_BASIS = 2166136261;

    public function hash($str)
    {
        $hash = self::FNV_OFFSET_BASIS;

        foreach (str_split($str) as $c) {
            $hash = ($hash << 1) + ($hash << 4) + ($hash << 7) + ($hash << 8) + ($hash << 24) + $hash & Hash::UPPERBOUND;
            $hash = $hash ^ ord($c);
        }

        return $hash & Hash::UPPERBOUND;
    }
}
