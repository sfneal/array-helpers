<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{
    // todo: refactor to use class

    /** @test */
    public function array_diff_flat()
    {
        if (function_exists('array_diff_flat')) {
            $first = ['red', 'green', 'blue', 'purple'];
            $second = ['yellow', 'green', 'black', 'purple'];

            $diff = array_diff_flat($first, $second);
            $expected = ['red', 'blue'];
            $this->assertEquals($expected, $diff);
        }
    }

    /** @test */
    public function random()
    {
        $items = 3;
        $array = [
            'sfneal/laravel-helpers',
            'symfony/console',
            'spatie/laravel-view-models',
            'webmozart/assert',
            'psr/http-message',
            'sebastian/global-state',
        ];

        $randoms = arrayRandom($array, $items);

        $this->assertNotNull($randoms);
        $this->assertCount($items, $randoms);

        foreach ($randoms as $random) {
            $this->assertTrue(in_array($random, $array));
        }
    }
}
