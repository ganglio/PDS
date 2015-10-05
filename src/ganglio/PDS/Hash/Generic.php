<?php

namespace ganglio\PDS\Hash;

class Generic implements Hash
{

    private $alg = "md5";

    public function __construct($alg="md5")
    {
        $this->setAlgorithm($alg);
    }

    public function setAlgorithm($alg)
    {
        if (!in_array($alg,hash_algos()))
            throw new \Exception("Invalid algorithm");
        $this->alg = $alg;
    }

    public function getAlgorithm()
    {
        return $this->alg;
    }

    public function hash($str)
    {
        return hexdec(
            substr(
                hash($this->alg,$str, FALSE),
                -8
            )
        );
    }

}
