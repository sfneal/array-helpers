<?php

namespace Sfneal\Helpers\Arrays;

class ArrayHelpers
{
    // todo: remove 'array' prefix from method names

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
    public function arrayChunks(int $min = 0, int $max = null, bool $no_remainders = false, bool $preserve_keys = true): array
    {
        $chunks = array_chunk(
            $this->array,
            (new ChunkSizer(count($this->array), $min, $max))->execute(),
            $preserve_keys
        );

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
    public function arrayFlattenKeys(bool $nest_keys = true): array
    {
        // todo: possible use while loop for multi level nesting?
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
        // todo: add ability to pass array of arrays
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
        try {
            // Count the number of unique array values
            // Check to see if there is more than unique array_value
            return count(array_unique(array_values($this->array))) >= count(array_values($this->array));
        }

        // Handle nested arrays by comparing number unique keys
        catch (\ErrorException $exception) {
            $values = [];
            $valueCount = 0;
            foreach (array_values($this->array) as $value) {
                $values = array_merge($values, $value);
                $valueCount += count($value);
            }

            return count($values) == $valueCount;
        }
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
        // Array doesn't have keys if the array is the same as the array values
        if ($this->array == array_values($this->array)) {
            return false;
        }

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
    public function arrayPop(string $key)
    {
        // Get the value
        $value = $this->array[$key];

        // Remove the value from the array
        unset($this->array[$key]);

        // Return the value
        return $value;
    }

    /**
     * Remove a key from an array & the new array without the key.
     *
     * @param array|string $keys
     * @return array
     */
    public function arrayUnset($keys): array
    {
        // Remove the values from the array
        foreach ((array) $keys as $key) {
            unset($this->array[$key]);
        }

        // Return the new array
        return $this->array;
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

    /**
     * Retrieve a random array of elements.
     *
     * @param int $items
     * @return array
     */
    public function random(int $items): array
    {
        // Get a random array of keys
        $keys = array_rand($this->array, $items);

        // Return array with only the randomly selected keys
        return array_filter(
            $this->array,
            function ($value, $key) use ($keys) {
                return in_array($key, $keys);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
