<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ValuesUniqueTest extends TestCase
{
    public function arrayValuesUniqueProvider(): array
    {
        return [
            [
                    [
                    'red' => 22,
                    'green' => 44,
                    'blue' => 23,
                ]
            ]
        ];
    }

    public function arrayValuesNotUniqueProvider(): array
    {
        return [
            [
                    [
                    'red' => 22,
                    'green' => 44,
                    'blue' => 22,
                ]
            ]
        ];
    }

    /**
     * @dataProvider arrayValuesUniqueProvider
     */
    public function test_array_values_are_unique(array $array)
    {
        $this->assertValuesAreUnique($array);
    }

    /**
     * @dataProvider arrayValuesNotUniqueProvider
     */
    public function test_array_values_not_unique(array $array)
    {
        $this->assertValuesNotUnique($array);
    }

    public function assertValuesAreUnique(array $array)
    {
        $unique = (new ArrayHelpers($array))->arrayValuesUnique();

        $this->assertIsBool($unique);
        $this->assertTrue($unique);
    }

    public function assertValuesNotUnique(array $array)
    {
        $unique = (new ArrayHelpers($array))->arrayValuesUnique();

        $this->assertIsBool($unique);
        $this->assertFalse($unique);
    }
}
