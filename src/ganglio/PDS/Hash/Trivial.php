<?php

namespace ganglio\PDS\Hash;

class Trivial implements Hash
{
    public function hash($str)
    {
        $hash = 0;
        $str = str_split($str);

        foreach ($str as $kk=>$vv)
            $hash += ord($vv)<<($kk*8);

        return $hash & Hash::UPPERBOUND;
    }
}
