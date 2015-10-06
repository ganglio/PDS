# PDS
Probabilistic Data Structures to efficiently analyze and mine big datasets

[![Latest Stable Version](https://poser.pugx.org/ganglio/pds/v/stable)](https://packagist.org/packages/ganglio/pds)
[![Build Status](https://travis-ci.org/ganglio/PDS.svg?branch=master)](https://travis-ci.org/ganglio/PDS)
[![codecov.io](http://codecov.io/github/ganglio/PDS/coverage.svg?branch=master)](http://codecov.io/github/ganglio/PDS?branch=master)
[![Code Climate](https://codeclimate.com/github/ganglio/PDS/badges/gpa.svg)](https://codeclimate.com/github/ganglio/PDS)
[![License](https://poser.pugx.org/ganglio/pds/license)](https://packagist.org/packages/ganglio/pds)

This package contains a collection of data structures and tools to analyze big amounts of data in a memory efficient way.


## Table Of Content

1.   [Installation](#user-content-installation)
2.   [Namespaces](#user-content-namespaces)
3.   [Interfaces](#user-content-interfaces)
4.   [Classes](#user-content-classes)
5.   [Examples](#user-content-examples)

### Installation

Install via [Composer](https://getcomposer.org/) (make sure you have composer in your path or in your project).

Put the following in your package.json:

```JSON
{
    "require": {
        "ganglio/PDS": "*"
    }
}
```

and then run `composer install` or just run

    composer require ganglio/PDS

### Namespaces

A number of namespaces are defined in the library.

* \ganglio\PDS\Bloom
* \ganglio\PDS\Estimators
* \ganglio\PDS\Hash
* \ganglio\PDS\Storage

### Interfaces

#### Estimator

This interface is the basis for cardinality estimators.
It defines two methods:

* `add($key)` - adds a key to the estimator
* `count()` - returns the number of keys added to the estimator

Depending on the implementation the actual class might return an exact estimation, like the [`Exact`](#user-content-exact) class, or an approximation like the [`HyperLogLog`](#user-content-hyperloglog) class.

#### Hash

This interface is the basis for the various hashing classes offered by the package.
It defines one method and a constant:

* `hash($str)` - performs the actual hashing of the string provided
* `UPPERBOUND` - a 32-bit mask to be used by the hashing functions `0xffffffff`


#### Storage

This interface is the basis for the storage classes.
It defines four methods:

- `set($key, $value)` - sets a value to the key in the storage system
- `get($key)` - gets the value stored to the key
- `flush()` - flushes the storage system
- `size()` - returns the number of keys stored in the storage system

### Classes

#### BitArray (implements [`Storage`](#user-content-storage))

Implements a single bit array. It's used to implement the [`Bloob Filter`](#user-content-bloom) where the `set` method only accepts `Bool` as `$value`.

#### HyperLogLog (implements [`Estimator`](#user-content-estimator))

Implements the HyperLogLog cardinality estimator algorithm. The actual implementation uses HyperLogLog for big cardinalities and LinearCounting for small ones as it gives a better approximation.

#### Exact (implements [`Estimator`](#user-content-estimator))

Implement an exact counter. It's primarily a toy class to show how to use the [`Estimator`](#user-content-estimator) interface.

#### Trivial (implements [`Hash`](#user-content-hash))

Implements a trivial hashing algorithm. Basically adds the ASCII code shifted right by the character position for each characted of the input string and then takes the lower 32 bits. It's a toy class to show how to use the [`Hash`](#user-content-hash) interface.

#### Pearson (implements [`Hash`](#user-content-hash))

Implements the Pearson non-cryptographic hashing function.

#### FVNHash (implements [`Hash`](#user-content-hash))

Implements the Fowler-Noll-Vo non-cryptographic hashing function. The actual algorithm is the FNV-1 hash.

#### Generic (implements [`Hash`](#user-content-hash))

This class is basically a wrapper around the standard PHP hash function. The constructor accepts the algorithm name to use as from the PHP hash_algos() function. If an unknown algorithm is specified it raises an exception, if none is specified MD5 is selected as default.

#### MultiHash (implements [`Hash`](#user-content-hash))

This class calculates multiple hashes using different algorithms specified ad arguments of the constructor. It's primarily used in conjunction with the [`BitArray`](#user-content-bitarray) class to implement the [`Bloom Filter`](#user-content-bloom).

#### Bloom

This class implements a [Bloom Filter](https://en.wikipedia.org/wiki/Bloom_filter), a probabilistic data structure that allows to test if an element is a member of a set with a very small memory footprint.

### Examples

__TODO__