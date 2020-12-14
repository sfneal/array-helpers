<?php

namespace Sfneal\Helpers\Arrays\Tests;

use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{
    /** @test */
    public function arrayChunks()
    {
        // Array to chunk
        $array = [
            'a' => 10,
            'b' => 20,
            'c' => 30,
            'd' => 40,
            'e' => 50,
            'f' => 60,
            'g' => 70,
            'h' => 80,
        ];

        // Chunk the array
        $chunked = arrayChunks($array, 2, 2, true);

        // Expected chunked array
        $expected = [
            0 => [
                'a' => 10,
                'b' => 20,
            ],
            1 => [
                'c' => 30,
                'd' => 40,
            ],
            2 => [
                'e' => 50,
                'f' => 60,
            ],
            3 => [
                'g' => 70,
                'h' => 80,
            ],
        ];

        // Assert chunk array is as expected
        $this->assertTrue($chunked === $expected);
    }

    /** @test */
    public function arrayFlattenKeys()
    {
        $array = [
            [
                'green' => 22,
                'blue' => 54,
            ],
            [
                'red' => 36,
                'purple' => 78,
            ],
            [
                'black' => 88,
                'white' => 72,
            ],
        ];

        // Flatten the array
        $flat = arrayFlattenKeys($array);

        // Expected flattened array
        $expected = [
            '0_green' => 22,
            '0_blue' => 54,
            '1_red' => 36,
            '1_purple' => 78,
            '2_black' => 88,
            '2_white' => 72,
        ];

        $this->assertTrue($flat === $expected);
    }

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

        $this->assertTrue($newArray === $expected);
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

        $this->assertTrue($sum === $expected);
    }

    /** @test */
    public function arrayValuesUnique()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function arrayValuesEqual()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function arrayHasKeys()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function array_map_assoc()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function array_except()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function chunkSizer()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function array_diff_flat()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function arrayUnset()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function arrayValuesNull()
    {
        $this->assertTrue(true);
    }
}
