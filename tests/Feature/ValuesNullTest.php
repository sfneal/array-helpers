<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ValuesNullTest extends TestCase
{
    public function valuesNullProvider(): array
    {
        return [
            [
                [
                    'red' => null,
                    'green' => null,
                    'blue' => null,
                ],
            ],
            [
                [
                    'Marchand' => null,
                    'Bergeron' => null,
                    'Pastrnak' => null,
                ],
            ],
        ];
    }

    public function valuesNotNullProvider(): array
    {
        return [
            [
                [
                    'red' => 22,
                    'green' => 23,
                    'blue' => 25,
                ],
            ],
            [
                [
                    'Marchand' => 'f',
                    'Bergeron' => 'f',
                    'Pastrnak' => 'f',
                ],
            ],
        ];
    }

    /**
     * @dataProvider valuesNullProvider
     */
    public function test_values_are_null(array $array)
    {
        $this->assertValuesAreNull(
            $array,
            ArrayHelpers::from($array)->valuesNull()
        );
    }

    /**
     * @dataProvider valuesNotNullProvider
     */
    public function test_values_not_null(array $array)
    {
        $this->assertValuesNotNull(
            $array,
            ArrayHelpers::from($array)->valuesNull()
        );
    }

    /**
     * @dataProvider valuesNullProvider
     */
    public function test_values_are_null_helper(array $array)
    {
        $this->assertValuesAreNull(
            $array,
            arrayValuesNull($array)
        );
    }

    /**
     * @dataProvider valuesNotNullProvider
     */
    public function test_values_not_null_helper(array $array)
    {
        $this->assertValuesNotNull(
            $array,
            arrayValuesNull($array)
        );
    }

    public function assertValuesAreNull(array $array, $equal)
    {
        $this->assertIsBool($equal);
        $this->assertTrue($equal);
    }

    public function assertValuesNotNull(array $array, $equal)
    {
        $this->assertIsBool($equal);
        $this->assertFalse($equal);
    }
}
