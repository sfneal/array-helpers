<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class RemoveKeysTest extends TestCase
{
    public function removeKeysProvider(): array
    {
        return [
            [
                [
                    'array' => [
                        'red' => 36,
                        'black' => 88,
                        'white' => 72,
                        'blue' => 4,
                    ],
                    'keysToRemove' => 'red',
                ],
                [
                    'black' => 88,
                    'white' => 72,
                    'blue' => 4,
                ],
            ],
            [
                [
                    'array' => [
                        'red' => 36,
                        'black' => 88,
                        'white' => 72,
                        'blue' => 4,
                    ],
                    'keysToRemove' => ['red', 'black'],
                ],
                [
                    'white' => 72,
                    'blue' => 4,
                ],
            ],
        ];
    }

    /**
     * @dataProvider removeKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_remove_keys(array $args, array $expected)
    {
        $this->assertRemoveKeys(
            $args,
            $expected,
            (new ArrayHelpers($args['array']))->removeKeys($args['keysToRemove'])
        );
    }

    /**
     * @dataProvider removeKeysProvider
     * @param array $args
     * @param array $expected
     */
    public function test_remove_keys_helpers(array $args, array $expected)
    {
        $this->assertRemoveKeys(
            $args,
            $expected,
            arrayRemoveKeys($args['array'], $args['keysToRemove'])
        );
    }

    public function assertRemoveKeys(array $args, array $expected, $newArray)
    {
        $this->assertIsArray($newArray);
        $this->assertEquals($expected, $newArray);

        foreach ((array) $args['keysToRemove'] as $key) {
            $this->assertArrayNotHasKey($key, $expected);
        }
    }
}
