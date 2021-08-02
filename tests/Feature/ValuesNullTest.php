<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ValuesNullTest extends TestCase
{
    public function arrayValuesNullProvider(): array
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

    public function arrayValuesNotNullProvider(): array
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
     * @dataProvider arrayValuesNullProvider
     */
    public function test_array_values_are_null(array $array)
    {
        $this->assertValuesAreNull(
            $array,
            (new ArrayHelpers($array))->arrayValuesNull()
        );
    }

    /**
     * @dataProvider arrayValuesNotNullProvider
     */
    public function test_array_values_not_null(array $array)
    {
        $this->assertValuesNotNull(
            $array,
            (new ArrayHelpers($array))->arrayValuesNull()
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
