<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class SumTest extends TestCase
{
    /**
     * Generate a random test array.
     *
     * @param int $numberOfArrays
     * @param int $arrayDepth
     * @return array[]
     */
    private function randomArray(int $numberOfArrays = 2, int $arrayDepth = 4): array
    {
        $array = [];
        $expected = [];

        foreach (range(0, $numberOfArrays) as $index) {
            $set = [];
            foreach (range(0, $arrayDepth) as $i) {
                $set[$i] = rand(0, 1000);

                if (! array_key_exists($i, $expected)) {
                    $expected[$i] = 0;
                }
                $expected[$i] += $set[$i];
            }
            $array[$index] = $set;
        }

        return [$array, $expected];
    }

    public function sumArrayProvider(): array
    {
        $array = [];
        foreach (range(0, 5) as $index) {
            $array[] = $this->randomArray(2, 4);
            $array[] = $this->randomArray(3, 5);
            $array[] = $this->randomArray(4, 5);
            $array[] = $this->randomArray(7, 9);
        }

        return $array;
    }

    /**
     * @dataProvider sumArrayProvider
     * @param array $array
     * @param array $expected
     */
    public function test_sum_arrays(array $array, array $expected)
    {
        $this->assertSumArrays(
            ArrayHelpers::sum(...$array),
            $expected
        );
    }

    /**
     * @dataProvider sumArrayProvider
     * @param array $array
     * @param array $expected
     */
    public function test_sum_arrays_helper(array $array, array $expected)
    {
        $this->assertSumArrays(
            sumArrays(...$array),
            $expected
        );
    }

    public function assertSumArrays($sum, $expected)
    {
        $this->assertEquals($expected, $sum);
    }
}
