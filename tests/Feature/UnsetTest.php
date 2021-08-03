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
        ];
    }

    /**
     * @dataProvider arrayUnsetProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_array_unset(array $array, $key, $expected)
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
    public function test_array_unset_helper(array $array, $key, $expected)
    {
        $this->assertArrayUnset(
            arrayUnset($array, $key),
            $expected,
            $key
        );
    }

    public function assertArrayUnset($actual, $expected, $key)
    {
        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        $this->assertArrayNotHasKey($key, $actual);
        $this->assertEquals($expected, $actual);
    }
}
