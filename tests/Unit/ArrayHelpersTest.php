<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{
    // todo: refactor to use class

    /** @test */
    public function arrayRemoveKeys()
    {
        $array = [
            'red' => 36,
            'black' => 88,
            'white' => 72,
        ];

        // Remove a key from the array
        $keyToRemove = 'red';
        $newArray = arrayRemoveKeys($array, $keyToRemove);

        // Expected array without 'red' key
        $expected = [
            'black' => 88,
            'white' => 72,
        ];

        $this->assertEquals($expected, $newArray);
    }

    /** @test */
    public function sumArrays()
    {
        $array1 = [22, 14, 14];
        $array2 = [15, 4, 6];

        // Sum the values of the array
        $sum = sumArrays($array1, $array2);

        // Expected sum array
        $expected = [37, 18, 20];

        $this->assertEquals($expected, $sum);
    }

    /** @test */
    public function arrayValuesUnique()
    {
        $unique = [
            'red' => 22,
            'green' => 44,
            'blue' => 23,
        ];

        // Determine if the array values are unique
        $this->assertTrue(arrayValuesUnique($unique));
    }

    /** @test */
    public function arrayValuesEqual()
    {
        $value = 22;
        $values = [
            'red' => $value,
            'green' => $value,
            'blue' => $value,
        ];

        // Determine if the array values are unique
        $this->assertTrue(arrayValuesEqual($values, $value));
    }

    /** @test */
    public function arrayHasKeys()
    {
        $values = [
            'red' => 22,
            'green' => 22,
            'blue' => 22,
        ];

        // Determine if the array values are unique
        $hasKeys = arrayHasKeys($values);
        $this->assertTrue($hasKeys);
    }

    /** @test */
    public function array_except()
    {
        // Array of values
        $array = [
            'red' => 22,
            'green' => 44,
            'blue' => 23,
            'purple' => 23,
        ];

        // Keys to remove
        $except = ['red', 'green'];

        // Array without exception keys
        $new = array_except($array, $except);

        $expected = [
            'blue' => 23,
            'purple' => 23,
        ];

        $this->assertEquals($expected, $new);
    }

    /** @test */
    public function array_diff_flat()
    {
        if (function_exists('collect')) {
            $first = ['red', 'green', 'blue', 'purple'];
            $second = ['yellow', 'green', 'black', 'purple'];

            $diff = array_diff_flat($first, $second);
            $expected = ['red', 'blue'];
            $this->assertEquals($expected, $diff);
        } else {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function arrayUnset()
    {
        $array = [
            'red' => 'Detroit',
            'green' => 'Dallas',
            'blue' => 'Vancouver',
            'purple' => 'Los Angeles',
        ];

        $red = arrayUnset($array, 'red');
        $this->assertEquals('Detroit', $red);

        $blue = arrayUnset($array, 'blue');
        $this->assertEquals('Vancouver', $blue);
    }

    /** @test */
    public function arrayValuesNull()
    {
        $array = [
            'red' => 'Detroit',
            'green' => 'Dallas',
            'blue' => 'Vancouver',
            'purple' => 'Los Angeles',
        ];

        $isNotNull = arrayValuesNull($array);
        $this->assertFalse($isNotNull);

        $array2 = [
            'red' => null,
            'green' => null,
            'blue' => null,
            'purple' => null,
        ];

        $isNull = arrayValuesNull($array2);
        $this->assertTrue($isNull);
    }

    /** @test */
    public function random()
    {
        $items = 3;
        $array = [
            'sfneal/laravel-helpers',
            'symfony/console',
            'spatie/laravel-view-models',
            'webmozart/assert',
            'psr/http-message',
            'sebastian/global-state',
        ];

        $randoms = arrayRandom($array, $items);

        $this->assertNotNull($randoms);
        $this->assertCount($items, $randoms);

        foreach ($randoms as $random) {
            $this->assertTrue(in_array($random, $array));
        }
    }
}
