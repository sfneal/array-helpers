<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class UnsetTest extends TestCase
{
    public function arrayUnsetProvider(): array
    {
        return [
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                'green',
                ['red' => 22, 'blue' => 23, 'purple' => 23],
            ],
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                'blue',
                ['red' => 22, 'green' => 44, 'purple' => 23],
            ],
            [
                ['red' => 36, 'black' => 88, 'white' => 72, 'blue' => 4],
                'black',
                ['red' => 36, 'white' => 72, 'blue' => 4],
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                'red',
                ['green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                'blue',
                ['red' => 'Detroit', 'green' => 'Dallas', 'purple' => 'Los Angeles'],
            ],

            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['green', 'purple'],
                ['red' => 22, 'blue' => 23],
            ],
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['blue', 'red'],
                ['green' => 44, 'purple' => 23],
            ],
            [
                ['red' => 36, 'black' => 88, 'white' => 72, 'blue' => 4],
                ['black', 'white'],
                ['red' => 36, 'blue' => 4],
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                ['red', 'purple'],
                ['green' => 'Dallas', 'blue' => 'Vancouver'],
            ],
            [
                ['red' => 'Detroit', 'green' => 'Dallas', 'blue' => 'Vancouver', 'purple' => 'Los Angeles'],
                ['blue', 'green'],
                ['red' => 'Detroit', 'purple' => 'Los Angeles'],
            ],
        ];
    }

    /**
     * @dataProvider arrayUnsetProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_unset(array $array, $key, $expected)
    {
        $this->assertArrayUnset(
            (new ArrayHelpers($array))->arrayUnset($key),
            $expected,
            $key
        );
    }

    /**
     * @dataProvider arrayUnsetProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_unset_helper(array $array, $key, $expected)
    {
        $this->assertArrayUnset(
            arrayUnset($array, $key),
            $expected,
            $key
        );
    }

    public function assertArrayUnset($actual, $expected, $keys)
    {
        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        foreach ((array) $keys as $key) {
            $this->assertArrayNotHasKey($key, $actual);
        }
        $this->assertEquals($expected, $actual);
    }
}
