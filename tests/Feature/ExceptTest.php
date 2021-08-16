<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ExceptTest extends TestCase
{
    public function arrayExceptProvider(): array
    {
        return [
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['red', 'green'],
                ['blue' => 23, 'purple' => 23],
            ],
            [
                ['red' => 22, 'green' => 44, 'blue' => 23, 'purple' => 23],
                ['blue'],
                ['red' => 22, 'green' => 44, 'purple' => 23],
            ],
            [
                ['red' => 36, 'black' => 88, 'white' => 72, 'blue' => 4],
                ['black', 'white'],
                ['red' => 36, 'blue' => 4],
            ],
        ];
    }

    /**
     * @dataProvider arrayExceptProvider
     * @param array $array
     * @param array $except
     * @param array $expected
     */
    public function test_except(array $array, array $except, array $expected)
    {
        $this->assertArrayExcept(
            ArrayHelpers::from($array)->except($except)->get(),
            $expected
        );
    }

    /**
     * @dataProvider arrayExceptProvider
     * @param array $array
     * @param array $except
     * @param array $expected
     */
    public function test_except_helper(array $array, array $except, array $expected)
    {
        $this->assertArrayExcept(
            arrayExcept($array, $except),
            $expected
        );
    }

    public function assertArrayExcept($actual, $expected)
    {
        $this->assertIsArray($actual);
        $this->assertEquals($expected, $actual);
    }
}
