<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class SumTest extends TestCase
{
    // todo: add ability to pass more arrays
    public function sumArrayProvider(): array
    {
        $randArrays = function () {
            $a = [rand(0, 1000), rand(0, 1000), rand(0, 1000)];
            $b = [rand(0, 1000), rand(0, 1000), rand(0, 1000)];

            return [
                [$a, $b],
                [$a[0] + $b[0], $a[1] + $b[1], $a[2] + $b[2]],
            ];
        };

        return [
            $randArrays(),
            $randArrays(),
            $randArrays(),
            $randArrays(),
            $randArrays(),
        ];
    }

    /**
     * @dataProvider sumArrayProvider
     * @param array $array
     * @param array $expected
     */
    public function test_sum_arrays(array $array, array $expected)
    {
        $this->assertSumArrays(
            ArrayHelpers::sum($array[0], $array[1]),
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
            sumArrays($array[0], $array[1]),
            $expected
        );
    }

    public function assertSumArrays($sum, $expected)
    {
        $this->assertEquals($expected, $sum);
    }
}
