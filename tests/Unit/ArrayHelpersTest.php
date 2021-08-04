<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ArrayHelpersTest extends TestCase
{
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

        $randoms = ArrayHelpers::from($array)->random($items)->get();

        $this->assertNotNull($randoms);
        $this->assertCount($items, $randoms);

        foreach ($randoms as $random) {
            $this->assertTrue(in_array($random, $array));
        }
    }
}
