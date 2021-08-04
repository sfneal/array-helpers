<?php

namespace Sfneal\Helpers\Arrays;

use Sfneal\Helpers\Arrays\Utils\ArrayUtility;

class ArrayHelpers
{
    /**
     * Instantiate a `ArrayUtility` instance by passing an $array to the constructor.
     *
     * @param array $array
     * @return ArrayUtility
     */
    public static function from(array $array): ArrayUtility
    {
        return new ArrayUtility($array);
    }

    /**
     * Sum the values of two arrays.
     *
     * @param array $arrays
     * @return array
     */
    public static function sum(...$arrays): array
    {
        $sum = [];

        foreach ($arrays as $array)
        {
            foreach ($array as $index => $value) {
                if (! array_key_exists($index, $sum)) {
                    $sum[$index] = $value;
                }

                else {
                    $sum[$index] += $value;
                }
            }
        }

        return $sum;
    }
}
