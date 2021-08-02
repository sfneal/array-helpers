<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ValuesEqualTest extends TestCase
{
    public function arrayValuesEqualProvider(): array
    {
        return [
            [
                [
                    'red' => 22,
                    'green' => 22,
                    'blue' => 22
                ],
                22
            ],
            [
                [
                    'Marchand' => 'f',
                    'Bergeron' => 'f',
                    'Pastrnak' => 'f',
                ],
                'f'
            ],
        ];
    }

    public function arrayValuesNotEqualProvider(): array
    {
        return [
            [
                [
                    'red' => 22,
                    'green' => 23,
                    'blue' => 24
                ],
                22
            ],
            [
                [
                    'Marchand' => 'f',
                    'Bergeron' => 'f',
                    'McAvoy' => 'd',
                ],
                'f'
            ],
        ];
    }

    /**
     * @dataProvider arrayValuesEqualProvider
     */
    public function test_array_values_are_equal(array $array, $value)
    {
        $this->assertValuesAreEqual(
            $array,
            (new ArrayHelpers($array))->arrayValuesEqual($value)
        );
    }

    /**
     * @dataProvider arrayValuesNotEqualProvider
     */
    public function test_array_values_not_equal(array $array, $value)
    {
        $this->assertValuesNotEqual(
            $array,
            (new ArrayHelpers($array))->arrayValuesEqual($value)
        );
    }

    public function assertValuesAreEqual(array $array, $equal)
    {
        $this->assertIsBool($equal);
        $this->assertTrue($equal);
    }

    public function assertValuesNotEqual(array $array, $equal)
    {
        $this->assertIsBool($equal);
        $this->assertFalse($equal);
    }
}
