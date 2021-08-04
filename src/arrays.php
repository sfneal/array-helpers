<?php

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Utils\ChunkSizer;

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
function arrayChunks(array $array,
                     int $min = 0,
                     int $max = null,
                     bool $no_remainders = false,
                     bool $preserve_keys = true): array
{
    return ArrayHelpers::from($array)->chunks($min, $max, $no_remainders, $preserve_keys)->get();
}

/**
 * Flatten a multidimensional array into a 2D array without nested keys.
 *
 * @param array $array
 * @param bool $nest_keys
 * @return array
 */
function arrayFlattenKeys(array $array, bool $nest_keys = true): array
{
    return ArrayHelpers::from($array)->flattenKeys($nest_keys)->get();
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
    return ArrayHelpers::from($array)->removeKeys($keys)->get();
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
    return ArrayHelpers::sum($array1, $array2);
}

/**
 * Determine if all values in an array of key => value pairs are unique.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesUnique(array $array): bool
{
    return ArrayHelpers::from($array)->valuesUnique();
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
    return ArrayHelpers::from($array)->valuesEqual($value);
}

/**
 * Determine if all array_values are NOT equal to a certain value.
 *
 * @param array $array
 * @param mixed $value
 * @return bool
 */
function arrayValuesNotEqual(array $array, $value): bool
{
    return ArrayHelpers::from($array)->valuesNotEqual($value);
}

/**
 * Determine if an array is multidimensional and has keys.
 *
 * @param array $array
 * @return bool
 */
function arrayHasKeys(array $array): bool
{
    return ArrayHelpers::from($array)->hasKeys();
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
        return ArrayHelpers::from($original)->except($except)->get();
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
 * @param int $array_size size of the array
 * @param int $min minimum chunk size
 * @param int|null $max maximum chunk size
 * @param int $divisor
 * @return int $remainder lowest calculated remainder
 */
function chunkSizer(int $array_size, int $min = 0, int $max = null, int $divisor = 2): int
{
    return (new ChunkSizer($array_size, $min, $max, $divisor))->execute();
}

/**
 * Remove a key from an array & return the key's value.
 *
 * @param array $array
 * @param string $key
 * @return mixed
 */
function arrayPop(array $array, string $key)
{
    return ArrayHelpers::from($array)->pop($key);
}

/**
 * Remove a key from an array & the new array without the key.
 *
 * @param array $array
 * @param array|string $keys
 * @return array
 */
function arrayUnset(array $array, $keys): array
{
    return ArrayHelpers::from($array)->unset($keys)->get();
}

/**
 * Determine if all values in an array are null.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesNull(array $array): bool
{
    return ArrayHelpers::from($array)->valuesNull();
}

if (! function_exists('arrayRandom')) {
    /**
     * Retrieve a random array of elements.
     *
     * @param array $array
     * @param int $items
     * @return array
     */
    function arrayRandom(array $array, int $items): array
    {
        return ArrayHelpers::from($array)->random($items)->get();
    }
}

/**
 * Only declare function if Illuminate/Collection is installed.
 */
if (function_exists('collect')) {
    /**
     * Return a flat array of values that were found in the $first array that are not found in the $second.
     *
     * @param array $first
     * @param array $second
     * @param bool $toArray
     * @return Illuminate\Support\Collection|array
     */
    function array_diff_flat(array $first, array $second, bool $toArray = true)
    {
        $diff = ArrayHelpers::from($first)->diffFlat($second);

        return $toArray ? $diff->get() : $diff->collect();
    }
}
