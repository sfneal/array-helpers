<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ValuesUniqueTest extends TestCase
{
    public function valuesUniqueProvider(): array
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

    public function valuesNotUniqueProvider(): array
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
     * @dataProvider valuesUniqueProvider
     */
    public function test_values_are_unique(array $array)
    {
        $this->assertValuesAreUnique(
            $array,
            (new ArrayHelpers($array))->valuesUnique()
        );
    }

    /**
     * @dataProvider valuesNotUniqueProvider
     */
    public function test_values_not_unique(array $array)
    {
        $this->assertValuesNotUnique(
            $array,
            (new ArrayHelpers($array))->valuesUnique()
        );
    }

    /**
     * @dataProvider valuesUniqueProvider
     */
    public function test_values_are_unique_helper(array $array)
    {
        $this->assertValuesAreUnique(
            $array,
            arrayValuesUnique($array)
        );
    }

    /**
     * @dataProvider valuesNotUniqueProvider
     */
    public function test_values_not_unique_helper(array $array)
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
