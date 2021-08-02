<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{
    // todo: refactor to use class

    /** @test */
    public function array_diff_flat()
    {
        if (function_exists('collect')) {
            $first = ['red', 'green', 'blue', 'purple'];
            $second = ['yellow', 'green', 'black', 'purple'];

            $diff = array_diff_flat($first, $second);
            $expected = ['red', 'blue'];
            $this->assertEquals($expected, $diff);
        } else {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function arrayUnset()
    {
        $array = [
            'red' => 'Detroit',
            'green' => 'Dallas',
            'blue' => 'Vancouver',
            'purple' => 'Los Angeles',
        ];

        $red = arrayUnset($array, 'red');
        $this->assertEquals('Detroit', $red);

        $blue = arrayUnset($array, 'blue');
        $this->assertEquals('Vancouver', $blue);
    }

    /** @test */
    public function arrayValuesNull()
    {
        $array = [
            'red' => 'Detroit',
            'green' => 'Dallas',
            'blue' => 'Vancouver',
            'purple' => 'Los Angeles',
        ];

        $isNotNull = arrayValuesNull($array);
        $this->assertFalse($isNotNull);

        $array2 = [
            'red' => null,
            'green' => null,
            'blue' => null,
            'purple' => null,
        ];

        $isNull = arrayValuesNull($array2);
        $this->assertTrue($isNull);
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
