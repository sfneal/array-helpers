<?php

namespace Sfneal\Helpers\Arrays\Tests\Unit;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class ArrayHelpersTest extends TestCase
{
    /** @test */
    public function set_starting_lineup()
    {
        $available = [
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
        ];

        // Remove non-starters from array
        $starters = ArrayHelpers::from($available)->only([
            'marchand',
            'bergeron',
            'pastrnak',
            'grzelcyk',
            'mcavoy',
        ]);

        $this->assertIsArray($starters->get());
        $this->assertCount(5, $starters->get());
        $this->assertTrue($starters->hasKeys());
        $this->assertTrue($starters->valuesUnique());
        $this->assertEquals(
            [
                'marchand' => 63,
                'bergeron' => 37,
                'pastrnak' => 88,
                'grzelcyk' => 46,
                'mcavoy' => 73,
            ],
            $starters->get()
        );

        // Extract only starting forwards by removing starting defencemen
        $defencemen = [
            'grzelcyk',
            'mcavoy',
        ];
        $forwards = $starters->except($defencemen);

        $this->assertIsArray($forwards->get());
        $this->assertCount(3, $forwards->get());
        $this->assertTrue($forwards->valuesUnique());
        $this->assertEquals(
            [
                'marchand' => 63,
                'bergeron' => 37,
                'pastrnak' => 88,
            ],
            $forwards->get()
        );

        // Extract only starting defencemen
        $defense = $starters->only($defencemen);

        $this->assertIsArray($defense->get());
        $this->assertCount(2, $defense->get());
        $this->assertTrue($defense->valuesUnique());
        $this->assertEquals(
            [
                'grzelcyk' => 46,
                'mcavoy' => 73,
            ],
            $defense->get()
        );

        // Get players numbers (values)
        $this->assertEquals(88, $forwards->pop('pastrnak'));
        $this->assertEquals(73, $defense->pop('mcavoy'));
    }
}
