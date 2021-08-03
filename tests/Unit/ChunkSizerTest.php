<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use Sfneal\Helpers\Arrays\Tests\TestCase;

class ChunkSizerTest extends TestCase
{
    /** @test */
    public function chunkSizer1()
    {
        $size = chunkSizer(9, 2, 3);
        $this->assertEquals(3, $size);
    }

    /** @test */
    public function chunkSizer2()
    {
        $size = chunkSizer(10, 2, 5);
        $this->assertEquals(2, $size);
    }

    /** @test */
    public function chunkSizer3()
    {
        $size = chunkSizer(12, 3, 4, 3);
        $this->assertEquals(3, $size);
    }
}
