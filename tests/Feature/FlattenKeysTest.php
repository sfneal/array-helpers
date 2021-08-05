<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class FlattenKeysTest extends TestCase
{
    // todo: add data providers with more levels of nesting
    // todo: add providers without nest_keys param
    public function flattenKeysProvider(): array
    {
        return [
            [
                [
                    ['green' => 22, 'blue' => 54],
                    ['red' => 36, 'purple' => 78],
                    ['black' => 88, 'white' => 72],
                ],
                [
                    '0_green' => 22,
                    '0_blue' => 54,
                    '1_red' => 36,
                    '1_purple' => 78,
                    '2_black' => 88,
                    '2_white' => 72,
                ],
            ],

            [
                [
                    'f1' => [
                        'marchand' => 63,
                        'bergeron' => 37,
                        'pastrnak' => 88,
                    ],
                    'f2' => [
                        'hall' => 71,
                        'coyle' => 13,
                        'haula' => 56,
                    ],
                    'd1' => [
                        'grzelcyk' => 46,
                        'mcavoy' => 73,
                    ],
                    'd2' => [
                        'forbert' => 24,
                        'carlo' => 25,
                    ],
                ],
                [
                    'f1_marchand' => 63,
                    'f1_bergeron' => 37,
                    'f1_pastrnak' => 88,
                    'f2_hall' => 71,
                    'f2_coyle' => 13,
                    'f2_haula' => 56,
                    'd1_grzelcyk' => 46,
                    'd1_mcavoy' => 73,
                    'd2_forbert' => 24,
                    'd2_carlo' => 25,
                ],
            ],

            [
                [
                    ['green' => 22, 'blue' => 54, 'red' => 36],
                    ['purple' => 78, 'black' => 88, 'white' => 72],
                ],
                [
                    '0_green' => 22,
                    '0_blue' => 54,
                    '0_red' => 36,
                    '1_purple' => 78,
                    '1_black' => 88,
                    '1_white' => 72,
                ],
            ],

            [
                [
                    ['green' => 22, 'blue' => 54],
                    ['red' => 36],
                    ['purple' => 78],
                    ['black' => 88, 'white' => 72],
                ],
                [
                    '0_green' => 22,
                    '0_blue' => 54,
                    '1_red' => 36,
                    '2_purple' => 78,
                    '3_black' => 88,
                    '3_white' => 72,
                ],
            ],

            [
                [
                    [
                        'green' => [
                            22,
                            22 * 2,
                        ],
                        'blue' => [
                            54,
                            54 * 2,
                        ],
                    ],
                    [
                        'red' => [
                            36,
                            36 * 2,
                        ],
                        'purple' => [
                            78,
                            78 * 2,
                        ],
                    ],
                    [
                        'black' => [
                            88,
                            88 * 2,
                        ],
                        'white' => [
                            72,
                            72 * 2,
                        ],
                    ],
                ],
                [
                    '0_green' => [
                        22,
                        22 * 2,
                    ],
                    '0_blue' => [
                        54,
                        54 * 2,
                    ],
                    '1_red' => [
                        36,
                        36 * 2,
                    ],
                    '1_purple' => [
                        78,
                        78 * 2,
                    ],
                    '2_black' => [
                        88,
                        88 * 2,
                    ],
                    '2_white' => [
                        72,
                        72 * 2,
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider flattenKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_flatten_keys(array $args, array $expected)
    {
        $this->assertFlattenKeys(
            $args,
            $this->getExpectedNotNested($expected),
            ArrayHelpers::from($args)->flattenKeys(false)->get()
        );
    }

    /**
     * @dataProvider flattenKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_flatten_keys_nested(array $args, array $expected)
    {
        $this->assertFlattenKeys(
            $args,
            $expected,
            ArrayHelpers::from($args)->flattenKeys(true)->get()
        );
    }

    /**
     * @dataProvider flattenKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_flatten_keys_helper(array $args, array $expected)
    {
        $this->assertFlattenKeys(
            $args,
            $this->getExpectedNotNested($expected),
            arrayFlattenKeys($args, false)
        );
    }

    /**
     * @dataProvider flattenKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_flatten_keys_helper_nested(array $args, array $expected)
    {
        $this->assertFlattenKeys(
            $args,
            $expected,
            arrayFlattenKeys($args, true)
        );
    }

    public function assertFlattenKeys(array $args, array $expected, $flat)
    {
        $this->assertEquals($expected, $flat);
        $this->assertIsArray($flat);

        foreach ($args as $array) {
            foreach (array_values($array) as $value) {
                $this->assertTrue(in_array($value, array_values($flat)));
            }
        }
    }

    /**
     * Remove the "{$index}_" prefix from expected keys.
     *
     * @param array $expected
     * @return array
     */
    private function getExpectedNotNested(array $expected): array
    {
        return collect($expected)->mapWithKeys(function($value, $key) {
            return [substr($key, strpos($key, '_') + 1) => $value];
        })->toArray();
    }
}
