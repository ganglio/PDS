<?php

namespace ganglio\PDS\Storage;

class BitArray implements Storage {
  private $store = [];
  private $size = 0;

  public function set($key,$value=null)
  {
    if (!is_null($value))
      throw new \InvalidArgumentException("BitArray only allows to set a key to TRUE");
    if (!is_numeric($key))
      throw new \InvalidArgumentException("BitArray only allows numeric keys");

    $bucket = $key>>5;
    $bit = $key & ((1<<5)-1);

    if (!isset($this->store[$bucket]))
      $this->store[$bucket] = 0;

    if (($this->store[$bucket] & (1<<$bit)) == 0)
      $this->size++;

    $this->store[$bucket] |= (1<<$bit);
  }

  public function get($key)
  {
    if (!is_numeric($key))
      throw new \InvalidArgumentException("BitArray only allows numeric keys");

    $bucket = $key>>5;
    $bit = $key & ((1<<5)-1);

    if (isset($this->store[$bucket]))
      return (bool)($this->store[$bucket] & (1<<$bit));
    else
      return false;
  }

  public function flush()
  {
    $this->store = [];
    $this->size = 0;
  }

  public function size()
  {
    return $this->size;
  }
}
