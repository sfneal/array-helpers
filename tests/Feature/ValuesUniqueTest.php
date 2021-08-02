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
                ],
            ],
            [
                [
                    'Marchand' => 63,
                    'Bergeron' => 37,
                    'Pastrnak' => 88,
                ],
            ],
            [
                [
                    'f1' => [
                        'Marchand' => 63,
                        'Bergeron' => 37,
                        'Pastrnak' => 88,
                    ],
                    'f2' => [
                        'Hall' => 71,
                        'Coyle' => 13,
                        'Foligno' => 71,
                    ],
                ],
            ],
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
                ],
            ],
            [
                [
                    'Marchand' => 63,
                    'Bergeron' => 37,
                    'Pastrnak' => 37,
                ],
            ],
            [
                [
                    'd1' => [
                        'McAvoy' => 73,
                        'Grzelcyk' => 48,
                    ],
                    'd2' => [
                        'McAvoy' => 73,
                        'Carlo' => 25,
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider arrayValuesUniqueProvider
     */
    public function test_array_values_are_unique(array $array)
    {
        $this->assertValuesAreUnique(
            $array,
            (new ArrayHelpers($array))->arrayValuesUnique()
        );
    }

    /**
     * @dataProvider arrayValuesNotUniqueProvider
     */
    public function test_array_values_not_unique(array $array)
    {
        $this->assertValuesNotUnique(
            $array,
            (new ArrayHelpers($array))->arrayValuesUnique()
        );
    }

    /**
     * @dataProvider arrayValuesUniqueProvider
     */
    public function test_array_values_are_unique_helper(array $array)
    {
        $this->assertValuesAreUnique(
            $array,
            arrayValuesUnique($array)
        );
    }

    /**
     * @dataProvider arrayValuesNotUniqueProvider
     */
    public function test_array_values_not_unique_helper(array $array)
    {
        $this->assertValuesNotUnique(
            $array,
            arrayValuesUnique($array)
        );
    }

    public function assertValuesAreUnique(array $array, $unique)
    {
        $this->assertIsBool($unique);
        $this->assertTrue($unique);
    }

    public function assertValuesNotUnique(array $array, $unique)
    {
        $this->assertIsBool($unique);
        $this->assertFalse($unique);
    }
}
