<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ChunksTest extends TestCase
{
    public function arrayChunksProvider(): array
    {
        $array = [
            'a' => 10,
            'b' => 20,
            'c' => 30,
            'd' => 40,
            'e' => 50,
            'f' => 60,
            'g' => 70,
            'h' => 80,
        ];

        return [
            [
                ['array' => $array, 'min' => 2, 'max' => 2, 'no_remainders' => true],
                [
                    ['a' => 10, 'b' => 20],
                    ['c' => 30, 'd' => 40],
                    ['e' => 50, 'f' => 60],
                    ['g' => 70, 'h' => 80],
                ],
            ],
            [
                ['array' => $array, 'min' => 4, 'max' => 4, 'no_remainders' => true],
                [
                    ['a' => 10, 'b' => 20, 'c' => 30, 'd' => 40],
                    ['e' => 50, 'f' => 60, 'g' => 70, 'h' => 80],
                ],
            ],
            [
                ['array' => $array, 'min' => 6, 'max' => 6, 'no_remainders' => false],
                [
                    ['a' => 10, 'b' => 20, 'c' => 30, 'd' => 40, 'e' => 50, 'f' => 60],
                    ['g' => 70, 'h' => 80],
                ],
            ],
        ];
    }

    /**
     * @dataProvider arrayChunksProvider
     * @param array $args
     * @param array $expected
     */
    public function test_array_chunks(array $args, array $expected)
    {
        $this->assertArrayChunks($args, $expected);
    }

    public function assertArrayChunks(array $args, array $expected)
    {
        $chunked = (new ArrayHelpers($args['array']))->arrayChunks($args['min'], $args['max'], $args['no_remainders']);

        $this->assertIsArray($chunked);
        $this->assertEquals($expected, $chunked);
        foreach ($chunked as $chunk) {
            if ($args['no_remainders']) {
                $this->assertLessThanOrEqual(count($chunk), $args['max']);
            }
            $this->assertGreaterThanOrEqual(count($chunk), $args['min']);

            foreach (array_values($chunked)  as $value) {
                foreach (array_keys($value) as $key) {
                    $this->assertArrayHasKey($key, $args['array']);
                }
            }
        }
    }
}
