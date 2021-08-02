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
        $this->assertRemoveKeys($args, $expected);
    }

    public function assertRemoveKeys(array $args, array $expected)
    {
        $newArray = (new ArrayHelpers($args['array']))->arrayRemoveKeys($args['keysToRemove']);

        $this->assertIsArray($newArray);
        $this->assertEquals($expected, $newArray);

        foreach ((array) $args['keysToRemove'] as $key) {
            $this->assertArrayNotHasKey($key, $expected);
        }

    }
}
