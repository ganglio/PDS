<?php

namespace ganglio\PDS\Bloom;

use \ganglio\PDS\Storage\BitArray;
use \ganglio\PDS\Hash\Generic;
use \ganglio\PDS\Hash\MultiHash;

class Bloom
{
    private $storage;
    private $hash;

    public function __construct()
    {
        $args = func_get_args();

        if (count($args)<2) {
            throw new \InvalidArgumentException("Please provide at least two hashing function names");
        }

        foreach ($args as $kk => $arg) {
            if (!is_string($arg)) {
                throw new \InvalidArgumentException("Please provide hashing function names as strings");
            } else {
                $args[$kk] = new Generic($arg);
            }
        }

        $this->storage = new BitArray();

        $hashReflection = new \ReflectionClass("\ganglio\PDS\Hash\MultiHash");
        $this->hash = $hashReflection->newInstanceArgs($args);

    }

    public function flush()
    {
        $this->storage->flush();
    }

    public function add($key)
    {
        $isNew = true;

        $keys = $this->hash->hash($key);

        foreach ($keys as $index) {
            $isNew &= $this->storage->get($index);
            $this->storage->set($index);
        }
        return $isNew;
    }

    public function test($key)
    {
        $isThere = true;

        $keys = $this->hash->hash($key);

        foreach ($keys as $index) {
            $isThere &= $this->storage->get($index);
        }

        return $isThere;
    }
}
