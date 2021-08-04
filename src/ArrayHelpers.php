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
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function sum(array $array1, array $array2): array
    {
        // todo: add ability to pass array of arrays
        $array = [];
        foreach ($array1 as $index => $value) {
            $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
        }

        return $array;
    }
}
