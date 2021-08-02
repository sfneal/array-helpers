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
                44
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
     * @dataProvider arrayUnsetProvider
     * @param array $array
     * @param $key
     * @param $expected
     */
    public function test_array_unset(array $array, $key, $expected)
    {
        $this->assertArrayUnset(
            (new ArrayHelpers($array))->arrayUnset($key),
            $expected
        );
    }

    public function assertArrayUnset($actual, $expected)
    {
        $this->assertNotNull($actual);
        $this->assertEquals($expected, $actual);
    }
}
