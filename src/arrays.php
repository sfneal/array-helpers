<?php

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\ChunkSizer;

/**
 * Returns a chunked array with calculated chunk size.
 *
 * @param array $array
 * @param int $min
 * @param int|null $max
 * @param bool $no_remainders
 * @param bool $preserve_keys
 * @return array
 */
function arrayChunks(array $array, $min = 0, $max = null, $no_remainders = false, $preserve_keys = true): array
{
    return (new ArrayHelpers($array))->arrayChunks($min, $max, $no_remainders, $preserve_keys);
}

/**
 * Flatten a multidimensional array into a 2D array without nested keys.
 *
 * @param array $array
 * @param bool $nest_keys
 * @return array
 */
function arrayFlattenKeys(array $array, $nest_keys = true): array
{
    return (new ArrayHelpers($array))->arrayFlattenKeys($nest_keys);
}

/**
 * Remove particular keys from a multidimensional array.
 *
 * @param array $array
 * @param array|string $keys
 * @return array
 */
function arrayRemoveKeys(array $array, $keys): array
{
    return (new ArrayHelpers($array))->arrayRemoveKeys($keys);
}

/**
 * Sum the values of two arrays.
 *
 * @param array $array1
 * @param array $array2
 * @return array
 */
function sumArrays(array $array1, array $array2): array
{
    return (new ArrayHelpers($array1))->sumArrays($array2);
}

/**
 * Determine if all values in an array of key => value pairs are unique.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesUnique(array $array): bool
{
    return (new ArrayHelpers($array))->arrayValuesUnique();
}

/**
 * Determine if all array_values are equal to a certain value.
 *
 * @param array $array
 * @param mixed $value
 * @return bool
 */
function arrayValuesEqual(array $array, $value): bool
{
    return (new ArrayHelpers($array))->arrayValuesEqual($value);
}

/**
 * Determine if an array is multidimensional and has keys.
 *
 * @param array $array
 * @return bool
 */
function arrayHasKeys(array $array): bool
{
    return (new ArrayHelpers($array))->arrayHasKeys();
}

if (! function_exists('array_except')) {
    /**
     * Remove specific arrays of keys without modifying the original array.
     *
     * @param array $original
     * @param array $except
     * @return array
     */
    function array_except(array $original, array $except): array
    {
        return (new ArrayHelpers($original))->array_except($except);
    }
}

/**
 * Return a best fit chunk size to be passed to array_chunks functions.
 *
 * Calculates the remainder of array sizes divided by the divisor
 * using modulus division.  Continues to calculate remainders until
 * the remainder is zero, signifying evenly sized chunks, or the
 * divisor is equal to the array size.  If a remainder of zero is not
 * found the lowest remainder is returned.
 *
 * @param int $array_size
 * @param int $min minimum chunk size
 * @param null $max maximum chunk size
 * @param int $divisor
 * @return int $remainder lowest calculated remainder
 */
function chunkSizer(int $array_size, $min = 0, $max = null, $divisor = 2): int
{
    return ChunkSizer::execute($array_size, $min, $max, $divisor);
}

/**
 * Remove a key from an array & return the key's value.
 *
 * @param array $array
 * @param string $key
 * @return mixed
 */
function arrayUnset(array $array, string $key)
{
    return (new ArrayHelpers($array))->arrayUnset($key);
}

/**
 * Determine if all values in an array are null.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesNull(array $array): bool
{
    return (new ArrayHelpers($array))->arrayValuesNull();
}

/**
 * Only declare function if Illuminate/Collection is installed.
 */
if (function_exists('collect')) {
    /**
     * Return a flat array of values found in the $first array that are not found in the $second.
     *
     * @param array $first
     * @param array $second
     * @param bool $toArray
     * @return Illuminate\Support\Collection|array
     */
    function array_diff_flat(array $first, array $second, bool $toArray = true)
    {
        $collection = collect($first)
            ->diff($second)
            ->flatten();

        // Return as array
        if ($toArray) {
            return $collection->toArray();
        }

        // Return as Collection
        return $collection;
    }
}
