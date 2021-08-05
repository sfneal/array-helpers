<?php

namespace Sfneal\Helpers\Arrays\Utils;

use Illuminate\Support\Collection;

class ArrayUtility
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
     * Retrieve the $array property.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->array;
    }

    /**
     * Retrieve a collection instance of the $array property.
     *
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect($this->array);
    }

    /**
     * Set the $array property.
     *
     * @param array $array
     * @return $this
     */
    protected function set(array $array): self
    {
        $this->array = $array;

        return $this;
    }

    /**
     * Returns a chunked array with calculated chunk size.
     *
     * @param int $min
     * @param int|null $max
     * @param bool $no_remainders
     * @param bool $preserve_keys
     * @return self
     */
    public function chunks(int $min = 0, int $max = null, bool $no_remainders = false, bool $preserve_keys = true): self
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

        return $this->set($chunks);
    }

    /**
     * Flatten a multidimensional array into a 2D array without nested keys.
     *
     * @param bool $nest_keys
     * @param string $separator
     * @return self
     */
    public function flattenKeys(bool $nest_keys = true, string $separator = '_'): self
    {
        // todo: possible use while loop for multi level nesting?
        $flat = [];
        foreach (array_keys($this->array) as $key) {
            if (is_array($this->array[$key])) {
                // If the key is an array, add each children keys to flattened array
                foreach ($this->array[$key] as $k => $v) {
                    if ($nest_keys) {
                        $flat[$key.$separator.$k] = $v;
                    } else {
                        $flat[$k] = $v;
                    }
                }
            } else {
                $flat[$key] = $this->array[$key];
            }
        }

        return $this->set($flat);
    }

    /**
     * Remove particular keys from a multidimensional array.
     *
     * @param array|string $keys
     * @return self
     */
    public function removeKeys($keys): self
    {
        $all_keys = array_keys($this->array);
        foreach ((array) $keys as $key) {
            if (in_array($key, $all_keys)) {
                unset($this->array[$key]);
            }
        }

        return $this->set($this->array);
    }

    /**
     * Remove specific arrays of keys without altering the original $array.
     *
     * @param array $except
     * @return self
     */
    public function except(array $except): self
    {
        return new self(array_diff_key($this->array, array_flip((array) $except)));
    }

    /**
     * Retrieve an array with only the keys provided in the $only param.
     *
     * @param array $only
     * @return self
     */
    public function only(array $only): self
    {
        return $this->set(array_filter($this->array, function($key) use ($only) {
            return in_array($key, $only);
        }, ARRAY_FILTER_USE_KEY));
    }

    /**
     * Remove a key from an array & return the key's value.
     *
     * @param string $key
     * @return mixed
     */
    public function pop(string $key)
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
     * @return self
     */
    public function unset($keys): self
    {
        // Remove the values from the array
        foreach ((array) $keys as $key) {
            unset($this->array[$key]);
        }

        // Return the new array
        return $this->set($this->array);
    }

    /**
     * Return a flat array of values that were found in the $first array that are not found in the $second.
     *
     * @param array $array
     * @return self
     */
    public function diffFlat(array $array): self
    {
        $collection = collect($this->array)
            ->diff($array)
            ->flatten();

        return $this->set($collection->toArray());
    }

    /**
     * Retrieve a random array of elements.
     *
     * @param int $items
     * @return self
     */
    public function random(int $items): self
    {
        // Get a random array of keys
        $keys = array_rand($this->array, $items);

        // Return array with only the randomly selected keys
        return $this->set(
            array_filter(
                $this->array,
                function ($value, $key) use ($keys) {
                    return in_array($key, $keys);
                },
                ARRAY_FILTER_USE_BOTH
            )
        );
    }

    /**
     * Determine if all values in an array of key => value pairs are unique.
     *
     * @return bool
     */
    public function valuesUnique(): bool
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
    public function valuesEqual($value): bool
    {
        // Check if all array values are equal to a certain value
        return count(array_keys($this->array, $value)) == count($this->array);
    }

    /**
     * Determine if all array_values are NOT equal to a certain value.
     *
     * @param mixed $value
     * @return bool
     */
    public function valuesNotEqual($value): bool
    {
        return ! $this->valuesEqual($value);
    }

    /**
     * Determine if an array is multidimensional and has keys.
     *
     * @return bool
     */
    public function hasKeys(): bool
    {
        // Array doesn't have keys if the array is the same as the array values
        if ($this->array == array_values($this->array)) {
            return false;
        }

        return count($this->array) == count($this->array, COUNT_RECURSIVE);
    }

    /**
     * Determine if all values in an array are null.
     *
     * @return bool
     */
    public function valuesNull(): bool
    {
        return $this->valuesEqual(null);
    }
}
