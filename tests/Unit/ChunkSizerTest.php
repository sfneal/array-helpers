<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use Sfneal\Helpers\Arrays\ChunkSizer;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ChunkSizerTest extends TestCase
{
    public function chunkSizerProvider(): array
    {
        return [
            [['size' => 9, 'min' => 2, 'max' => 3, 'divisor' => 2], 3],
            [['size' => 10, 'min' => 2, 'max' => 5, 'divisor' => 2], 2],
            [['size' => 12, 'min' => 3, 'max' => 4, 'divisor' => 3], 3],
        ];
    }

    /**
     * @dataProvider chunkSizerProvider
     * @param array $args
     * @param int $expected
     */
    public function test_chunk_sizer(array $args, int $expected)
    {
        $this->assertChunkSizer(
            (new ChunkSizer($args['size'], $args['min'], $args['max'], $args['divisor']))->execute(),
            $expected
        );
    }

    /**
     * @dataProvider chunkSizerProvider
     * @param array $args
     * @param int $expected
     */
    public function test_chunk_sizer_helper(array $args, int $expected)
    {
        $this->assertChunkSizer(
            chunkSizer($args['size'], $args['min'], $args['max'], $args['divisor']),
            $expected
        );
    }

    public function assertChunkSizer($size, int $expected)
    {
        $this->assertIsInt($size);
        $this->assertEquals($expected, $size);
    }
}
