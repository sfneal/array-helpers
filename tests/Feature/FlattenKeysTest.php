<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class FlattenKeysTest extends TestCase
{
    // todo: add data providers with more levels of nesting
    public function flattenKeysProvider(): array
    {
        return [
            [
                [
                    'array' => [
                        ['green' => 22, 'blue' => 54],
                        ['red' => 36, 'purple' => 78],
                        ['black' => 88, 'white' => 72],
                    ],
                    'nest_keys' => true,
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
                    'array' => [
                        ['green' => 22, 'blue' => 54, 'red' => 36],
                        ['purple' => 78, 'black' => 88, 'white' => 72],
                    ],
                    'nest_keys' => true,
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
                    'array' => [
                        ['green' => 22, 'blue' => 54],
                        ['red' => 36],
                        ['purple' => 78],
                        ['black' => 88, 'white' => 72],
                    ],
                    'nest_keys' => true,
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
                    'array' => [
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
                    'nest_keys' => true,
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
            $expected,
            ArrayHelpers::from($args['array'])->flattenKeys($args['nest_keys'])
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
            $expected,
            arrayFlattenKeys($args['array'], $args['nest_keys'])
        );
    }

    public function assertFlattenKeys(array $args, array $expected, $flat)
    {
        $this->assertEquals($expected, $flat);
        $this->assertIsArray($flat);

        foreach ($args['array'] as $array) {
            foreach (array_values($array) as $value) {
                $this->assertTrue(in_array($value, array_values($flat)));
            }
        }
    }
}
