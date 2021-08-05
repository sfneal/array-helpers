<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class OnlyTest extends TestCase
{
    public function onlyProvider(): array
    {
        return [
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['red', 'green'],
                ['red' => 22, 'green' => 44],
            ],
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['blue'],
                ['blue' => 23],
            ],
            [
                ['red' => 36, 'black' => 88, 'white' => 72, 'blue' => 4],
                ['black', 'white'],
                ['black' => 88, 'white' => 72],
            ],
        ];
    }

    /**
     * @dataProvider onlyProvider
     * @param array $array
     * @param array $only
     * @param array $expected
     */
    public function test_only(array $array, array $only, array $expected)
    {
        $this->assertArrayOnly(
            ArrayHelpers::from($array)->only($only)->get(),
            $expected
        );
    }

    /**
     * @dataProvider onlyProvider
     * @param array $array
     * @param array $only
     * @param array $expected
     */
    public function test_only_helper(array $array, array $only, array $expected)
    {
        $this->assertArrayOnly(
            arrayOnly($array, $only),
            $expected
        );
    }

    public function assertArrayOnly($actual, $expected)
    {
        $this->assertIsArray($actual);
        $this->assertEquals($expected, $actual);
    }
}
