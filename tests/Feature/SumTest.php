<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class SumTest extends TestCase
{
    // todo: add ability to pass more arrays
    public function sumArrayProvider(): array
    {
        return [
            [
                [
                    [22, 14, 14],
                    [15, 4, 6]
                ],
                [37, 18, 20]
            ],
            [
                [
                    [22, 14, 14],
                    [10, 20, 14]
                ],
                [32, 34, 28]
            ],
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
            (new ArrayHelpers($array[0]))->sumArrays($array[1]),
            $expected
        );
    }

    public function assertSumArrays($sum, $expected)
    {
        $this->assertEquals($expected, $sum);
    }
}
