<?php

namespace ganglio\PDS\Estimators;

use ganglio\PDS\Estimators\Estimator;

class HyperLogLog implements Estimator
{

    const DEFAULT_REGISTERS = 16; // 2^16 registers
    const MASK_63 = 0x8000000000000000;

    private $registers;
    private $registers_size;
    private $alpha;
    private $isEmpty = true;

    private static function hash($key)
    {
        return crc32(md5($key));
    }

    public function __construct($num_registers = self::DEFAULT_REGISTERS)
    {

        $this->registers_size = 1<<$num_registers;
        $this->alpha = 0.7213 / (1 + 1.079 / $this->registers_size);
        $this->registers_mask = $this->registers_size - 1;

        $this->registers = new \SplFixedArray($this->registers_size);
        $this->reset();
    }

    public function reset()
    {
        for ($i=0; $i<$this->registers_size; $i++) {
            $this->registers[$i] = 0;
        }
    }

    public function count()
    {

        if ($this->isEmpty) {
            return 0;
        }

        $estimate = 0;
        $empty = 0;

        for ($i=0; $i<$this->registers_size; $i++) {
            if ($this->registers[$i] != 0) {
                $estimate += (1.0/pow(2, $this->registers[$i]));
            } else {
                $estimate += 1.0;
                $empty++;
            }
        }

        $estimate = (1.0/$estimate) * $this->alpha * $this->registers_size * $this->registers_size;

        // Use LinearCounting for small cardinalities
        if ($estimate < 2.5 * $this->registers_size && $empty!=0) {
            $estimate = $this->registers_size * log($this->registers_size / $empty);
        }

        return floor($estimate);
    }

    public function add($key)
    {

        $this->isEmpty = false;

        $hash = static::hash($key);
        $hash = $hash | self::MASK_63;

        $count = 1;
        $register_address = $this->registers_size;

        while (($hash & $register_address) == 0) {
            $count++;
            $register_address <<= 1;
        }

        $register_index = $hash & $this->registers_mask;
        if ($this->registers[$register_index] < $count) {
            $this->registers[$register_index] = $count;
            return true;
        }

        return false;
    }
}
