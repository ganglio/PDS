<?php

namespace ganglio\PDS\Estimators;

interface Estimator {
    public function add($key);
    public function count();
}
