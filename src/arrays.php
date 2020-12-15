<?php

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
function arrayChunks(array $array, $min = 0, $max = null, $no_remainders = false, $preserve_keys = true)
{
    $chunks = array_chunk($array, chunkSizer(count($array), $min, $max), $preserve_keys);

    // Check if the first chunk is the same length as the last chunk
    if ($no_remainders && count($chunks[0]) != count(array_reverse($chunks)[0])) {
        $remainder = array_pop($chunks);
        $last_chunk = array_pop($chunks);

        // Add the remainder chunk to the last equal sized chunk
        $chunks[] = array_merge($last_chunk, $remainder);
    }

    return $chunks;
}

/**
 * Flatten a multidimensional array into a 2D array without nested keys.
 *
 * @param $array
 * @param bool $nest_keys
 * @return array
 */
function arrayFlattenKeys($array, $nest_keys = true)
{
    $flat = [];
    foreach (array_keys($array) as $key) {
        if (is_array($array[$key])) {
            // If the key is an array, add each children keys to flattened array
            foreach ($array[$key] as $k => $v) {
                if ($nest_keys) {
                    $flat[$key.'_'.$k] = $v;
                } else {
                    $flat[$k] = $v;
                }
            }
        } else {
            $flat[$key] = $array[$key];
        }
    }

    return $flat;
}

/**
 * Remove particular keys from a multidimensional array.
 *
 * @param $array
 * @param $keys
 * @return array
 */
function arrayRemoveKeys($array, $keys)
{
    $all_keys = array_keys($array);
    foreach ((array) $keys as $key) {
        if (in_array($key, $all_keys)) {
            unset($array[$key]);
        }
    }

    return $array;
}

/**
 * Sum the values of two arrays.
 *
 * @param $array1
 * @param $array2
 * @return array
 */
function sumArrays($array1, $array2)
{
    $array = [];
    foreach ($array1 as $index => $value) {
        $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
    }

    return $array;
}

/**
 * Determine if all values in an array of key => value pairs are unique.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesUnique(array $array)
{
    // Count the number of unique array values
    // Check to see if there is more than unique array_value
    return count(array_unique(array_values($array))) > 1;
}

/**
 * Determine if all array_values are equal to a certain value.
 *
 * @param array $array
 * @param mixed $value
 * @return bool
 */
function arrayValuesEqual(array $array, $value)
{
    // Check if all array values are equal to a certain value
    return count(array_keys($array, $value)) == count($array);
}

/**
 * Determine if an array is multidimensional and has keys.
 *
 * @param array $array
 * @return bool
 */
function arrayHasKeys(array $array)
{
    return count($array) == count($array, COUNT_RECURSIVE);
}

if (! function_exists('array_except')) {
    /**
     * Remove specific arrays of keys without modifying the original array.
     *
     * @param array $original
     * @param array $except
     * @return array
     */
    function array_except(array $original, array $except)
    {
        return array_diff_key($original, array_flip((array) $except));
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
function chunkSizer($array_size, $min = 0, $max = null, $divisor = 2)
{
    // If the size of the array is a perfect square, return the square root
    if (gmp_perfect_square($array_size) == true) {
        return sqrt($array_size);
    }

    // If min and max are the same return that value
    elseif ($min == $max) {
        return $min;
    }

    $max = (isset($max) ? $max : $array_size);
    $sizes = [];
    while ($divisor < $max) {
        $sizes[$divisor] = [
            // Number of chunks
            'rows'=> floor($array_size / $divisor),

            // Items in each chunk
            'cols' => $divisor,

            // Left over items in last chunk
            'remainder' => $array_size % $divisor,
        ];
        $divisor++;
    }

    // Filter sizes by column values
    return min(array_filter(array_column($sizes, 'cols', 'cols'), function ($size) use ($min, $max, $sizes) {
        return
            // Check that the remainder is no more than half of the number of columns
            ($sizes[$size]['remainder'] == 0 || $sizes[$size]['remainder'] >= $size / 2) &&

            // Check that the number of columns is greater than or equal than min and less than or equal than max
            $min <= $size && $size <= $max;
    }
    ));
}

/**
 * Only declare function if Illuminate/Collection is installed.
 *
 * todo: add composer package suggestion
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

/**
 * Remove a key from an array & return the key's value.
 *
 * @param array $array
 * @param string $key
 * @return mixed
 */
function arrayUnset(array $array, $key)
{
    // Get the value
    try {
        $value = $array[$key];
    } catch (ErrorException $exception) {
        $value = null;
    }

    // Remove the value from the array
    unset($array[$key]);

    // Return the value
    return $value;
}

/**
 * Determine if all values in an array are null.
 *
 * @param array $array
 * @return bool
 */
function arrayValuesNull(array $array)
{
    return arrayValuesEqual($array, null);
}

/**
 * @deprecated
 *
 * Sum the values of two arrays
 *
 * @param $array1
 * @param $array2
 * @return array
 */
function sum_arrays($array1, $array2)
{
    return sumArrays($array1, $array2);
}

/**
 * @deprecated
 *
 * Remove a key from an array & return the key's value.
 *
 * @param array $array
 * @param string $key
 * @return mixed
 */
function array_unset(array $array, $key)
{
    return arrayUnset($array, $key);
}
