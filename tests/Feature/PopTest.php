<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class PopTest extends TestCase
{
    public function arrayPopProvider(): array
    {
        return [
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                'green',
                44,
            ],
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                'blue',
                23,
            ],
            [
                ['red' => 36, 'black' => 88, 'white' => 72, 'blue' => 4],
                'black',
                88,
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                'red',
                'Detroit',
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                'blue',
                'Vancouver',
            ],
        ];
    }

    /**
     * @dataProvider arrayPopProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_pop_unset(array $array, $key, $expected)
    {
        $this->assertPopUnset(
            (new ArrayHelpers($array))->pop($key),
            $expected
        );
    }

    /**
     * @dataProvider arrayPopProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_pop_helper(array $array, $key, $expected)
    {
        $this->assertPopUnset(
            arrayPop($array, $key),
            $expected
        );
    }

    public function assertPopUnset($actual, $expected)
    {
        $this->assertNotNull($actual);
        $this->assertEquals($expected, $actual);
    }
}
