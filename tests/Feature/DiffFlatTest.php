<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Illuminate\Support\Collection;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class DiffFlatTest extends TestCase
{
    public function diffFlatProvider(): array
    {
        return [
            [
                [
                    ['red', 'green', 'blue', 'purple'],
                    ['yellow', 'green', 'black', 'purple'],
                ],
                ['red', 'blue']
            ],
            [
                [
                    ['green', 'yellow', 'blue', 'purple'],
                    ['yellow', 'green', 'black', 'purple'],
                ],
                ['blue']
            ],
//            [
//                [
//                    ['lime' => 42, 'blue' => 54, 'pink' => 37, 'purple' => 78, 'black' => 88, 'white' => 72],
//                    ['green' => 22, 'blue' => 54, 'red' => 36, 'purple' => 78, 'black' => 88, 'white' => 72],
//                ],
//                ['lime' => 42, 'pink' => 37]
//            ],
//            [
//                [
//                    ['Marchand' => 63, 'Bergeron' => 37, 'Pastrnak' => 88, 'Hall' => 71, 'McAvoy' => 73],
//                    ['Marchand' => 63, 'Bergeron' => 37, 'McAvoy' => 73, 'Carlo' => 25]
//                ],
//                ['Pastrnak' => 88, 'Hall' => 71, 'Carlo' => 25]
//            ],
        ];
    }

    /**
     * @dataProvider diffFlatProvider
     * @param array $args
     * @param array $expected
     */
    public function test_diff_flat_array(array $args, array $expected)
    {
        // Set $toArray param
        $args[2] = true;

        $this->assertDiffFlat(
            $args,
            array_diff_flat($args[0], $args[1], $args[2]),
            $expected
        );
    }

    /**
     * @dataProvider diffFlatProvider
     * @param array $args
     * @param array $expected
     */
    public function test_diff_flat_collection(array $args, array $expected)
    {
        // Set $toArray param
        $args[2] = false;

        $this->assertDiffFlat(
            $args,
            array_diff_flat($args[0], $args[1], $args[2]),
            $expected
        );
    }

    public function assertDiffFlat(array $args, $diff, array $expected)
    {
        // Expect array
        if ($args[2]) {
            $this->assertIsArray($diff);
        }

        // Expect collection
        else {
            $this->assertInstanceOf(Collection::class, $diff);
            $expected = collect($expected);
        }

        $this->assertEquals($expected, $diff);
        foreach ($diff as $d) {
            $this->assertArrayHasValue($d, $args[0]);
            $this->assertArrayNotHasValue($d, $args[1]);
        }
    }

    public function assertArrayHasValue($needle, array $haystack)
    {
        $this->assertTrue(
            in_array($needle, array_values($haystack)),
            "Could not find '{$needle}' in the array " . json_encode($haystack));
    }

    public function assertArrayNotHasValue($needle, array $haystack)
    {
        $this->assertFalse(
            in_array($needle, array_values($haystack)),
            "Could not find '{$needle}' in the array " . json_encode($haystack));
    }
}
