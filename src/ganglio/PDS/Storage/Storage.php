<?php

namespace ganglio\PDS\Storage;

interface Storage
{
    public function set($key,$value);
    public function get($key);
    public function flush();
    public function size();
}
