<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class MergeTest extends TestCase
{
    // todo: add data providers with more levels of nesting
    public function mergeProvider(): array
    {
        return [
            [
                [
                    ['green' => 22, 'blue' => 54],
                    ['red' => 36, 'purple' => 78],
                    ['black' => 88, 'white' => 72],
                ],
                [
                    'green' => 22,
                    'blue' => 54,
                    'red' => 36,
                    'purple' => 78,
                    'black' => 88,
                    'white' => 72,
                ],
            ],

            [
                [
                    [
                        'marchand' => 63,
                        'bergeron' => 37,
                        'pastrnak' => 88,
                    ],
                    [
                        'hall' => 71,
                        'coyle' => 13,
                        'haula' => 56,
                    ],
                    [
                        'grzelcyk' => 46,
                        'mcavoy' => 73,
                    ],
                    [
                        'forbert' => 24,
                        'carlo' => 25,
                    ],
                ],
                [
                    'marchand' => 63,
                    'bergeron' => 37,
                    'pastrnak' => 88,
                    'hall' => 71,
                    'coyle' => 13,
                    'haula' => 56,
                    'grzelcyk' => 46,
                    'mcavoy' => 73,
                    'forbert' => 24,
                    'carlo' => 25,
                ],
            ],

            [
                [
                    ['green' => 22, 'blue' => 54, 'red' => 36],
                    ['purple' => 78, 'black' => 88, 'white' => 72],
                ],
                [
                    'green' => 22,
                    'blue' => 54,
                    'red' => 36,
                    'purple' => 78,
                    'black' => 88,
                    'white' => 72,
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
                    'green' => 22,
                    'blue' => 54,
                    'red' => 36,
                    'purple' => 78,
                    'black' => 88,
                    'white' => 72,
                ],
            ],
        ];
    }

    /**
     * @dataProvider mergeProvider
     * @param array $args
     * @param array $expected
     */
    public function test_from_merge(array $args, array $expected)
    {
        $this->assertMerge(
            $args,
            $expected,
            ArrayHelpers::fromMerge(...$args)->get()
        );
    }

    /**
     * @dataProvider mergeProvider
     * @param array $args
     * @param array $expected
     */
    public function test_merge(array $args, array $expected)
    {
        $first = array_shift($args);

        $this->assertMerge(
            $args,
            $expected,
            ArrayHelpers::from($first)->merge(...$args)->get()
        );
    }

    public function assertMerge(array $args, array $expected, $flat)
    {
        $this->assertIsArray($flat);
        $this->assertEquals($expected, $flat);

        foreach ($args as $array) {
            foreach (array_values($array) as $value) {
                $this->assertTrue(in_array($value, array_values($flat)));
            }

            foreach (array_keys($array) as $key) {
                $this->assertTrue(in_array($key, array_keys($flat)));
            }
        }
    }
}
