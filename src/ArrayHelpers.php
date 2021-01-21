<?php

namespace Sfneal\Helpers\Arrays;

use ErrorException;

class ArrayHelpers
{
    /**
     * @var array
     */
    private $array;

    /**
     * ArrayHelpers constructor.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * Returns a chunked array with calculated chunk size.
     *
     * @param int $min
     * @param int|null $max
     * @param bool $no_remainders
     * @param bool $preserve_keys
     * @return array
     */
    public function arrayChunks($min = 0, $max = null, $no_remainders = false, $preserve_keys = true): array
    {
        $chunks = array_chunk($this->array, chunkSizer(count($this->array), $min, $max), $preserve_keys);

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
     * @param bool $nest_keys
     * @return array
     */
    public function arrayFlattenKeys($nest_keys = true): array
    {
        $flat = [];
        foreach (array_keys($this->array) as $key) {
            if (is_array($this->array[$key])) {
                // If the key is an array, add each children keys to flattened array
                foreach ($this->array[$key] as $k => $v) {
                    if ($nest_keys) {
                        $flat[$key.'_'.$k] = $v;
                    } else {
                        $flat[$k] = $v;
                    }
                }
            } else {
                $flat[$key] = $this->array[$key];
            }
        }

        return $flat;
    }

    /**
     * Remove particular keys from a multidimensional array.
     *
     * @param array|string $keys
     * @return array
     */
    public function arrayRemoveKeys($keys): array
    {
        $all_keys = array_keys($this->array);
        foreach ((array) $keys as $key) {
            if (in_array($key, $all_keys)) {
                unset($this->array[$key]);
            }
        }

        return $this->array;
    }

    /**
     * Sum the values of two arrays.
     *
     * @param array $array2
     * @return array
     */
    public function sumArrays(array $array2): array
    {
        $array = [];
        foreach ($this->array as $index => $value) {
            $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
        }

        return $array;
    }

    /**
     * Determine if all values in an array of key => value pairs are unique.
     *
     * @return bool
     */
    public function arrayValuesUnique(): bool
    {
        // Count the number of unique array values
        // Check to see if there is more than unique array_value
        return count(array_unique(array_values($this->array))) > 1;
    }

    /**
     * Determine if all array_values are equal to a certain value.
     *
     * @param mixed $value
     * @return bool
     */
    public function arrayValuesEqual($value): bool
    {
        // Check if all array values are equal to a certain value
        return count(array_keys($this->array, $value)) == count($this->array);
    }

    /**
     * Determine if an array is multidimensional and has keys.
     *
     * @return bool
     */
    public function arrayHasKeys(): bool
    {
        return count($this->array) == count($this->array, COUNT_RECURSIVE);
    }

    /**
     * Remove specific arrays of keys without modifying the original array.
     *
     * @param array $except
     * @return array
     */
    public function array_except(array $except): array
    {
        return array_diff_key($this->array, array_flip((array) $except));
    }

    /**
     * Remove a key from an array & return the key's value.
     *
     * @param string $key
     * @return mixed
     */
    public function arrayUnset(string $key)
    {
        // Get the value
        try {
            $value = $this->array[$key];
        } catch (ErrorException $exception) {
            $value = null;
        }

        // Remove the value from the array
        unset($this->array[$key]);

        // Return the value
        return $value;
    }

    /**
     * Determine if all values in an array are null.
     *
     * @return bool
     */
    public function arrayValuesNull(): bool
    {
        return $this->arrayValuesEqual(null);
    }
}
