<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Illuminate\Support\Collection;
use Sfneal\Helpers\Arrays\ArrayHelpers;
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
                ['red', 'blue'],
            ],
            [
                [
                    ['green', 'yellow', 'blue', 'purple'],
                    ['yellow', 'green', 'black', 'purple'],
                ],
                ['blue'],
            ],
        ];
    }

    /**
     * @dataProvider diffFlatProvider
     * @param array $args
     * @param array $expected
     */
    public function test_diff_flat_array(array $args, array $expected)
    {
        $this->assertDiffFlat(
            $args,
            ArrayHelpers::from($args[0])->diffFlat($args[1])->get(),
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
            ArrayHelpers::from($args[0])->diffFlat($args[1])->collect(),
            $expected
        );
    }

    /**
     * @dataProvider diffFlatProvider
     * @param array $args
     * @param array $expected
     */
    public function test_diff_flat_helper(array $args, array $expected)
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
    public function test_diff_flat_collection_helper(array $args, array $expected)
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
        // Expect collection
        if (! is_array($diff)) {
            $this->assertInstanceOf(Collection::class, $diff);
            $expected = collect($expected);
        }

        $this->assertEquals($expected, $diff);
        foreach ($diff as $d) {
            $this->assertArrayHasValue($d, $args[0]);
            $this->assertArrayNotHasValue($d, $args[1]);
        }
    }
}
