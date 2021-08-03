<?php

namespace Sfneal\Helpers\Arrays\Tests\Feature;

use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Helpers\Arrays\Tests\TestCase;

class HasKeysTest extends TestCase
{
    public function arrayHasKeysProvider(): array
    {
        return [
            [
                [
                    'red' => 22,
                    'green' => 22,
                    'blue' => 22,
                ],
            ],
            [
                [
                    'Marchand' => 63,
                    'Bergeron' => 37,
                    'Pastrnak' => 88,
                ],
            ],
            [
                [
                    'a' => 10,
                    'b' => 20,
                    'c' => 30,
                    'd' => 40,
                    'e' => 50,
                    'f' => 60,
                    'g' => 70,
                    'h' => 80,
                ],
            ],
        ];
    }

    public function arrayDoesntHaveKeysProvider(): array
    {
        return [
            [
                [
                    'red',
                    'green',
                    'blue',
                ],
            ],
            [
                [
                    'Marchand',
                    'Bergeron',
                    'Pastrnak',
                ],
            ],
            [
                [
                    'a',
                    'b',
                    'c',
                    'd',
                    'e',
                    'f',
                    'g',
                    'h',
                ],
            ],
        ];
    }

    /**
     * @dataProvider arrayHasKeysProvider
     */
    public function test_array_has_keys(array $array)
    {
        $this->assertHasKeys(
            $array,
            (new ArrayHelpers($array))->arrayHasKeys()
        );
    }

    /**
     * @dataProvider arrayDoesntHaveKeysProvider
     */
    public function test_doesnt_have_keys(array $array)
    {
        $this->assertDoesntHaveKeys(
            $array,
            (new ArrayHelpers($array))->arrayHasKeys()
        );
    }

    /**
     * @dataProvider arrayHasKeysProvider
     */
    public function test_array_has_keys_helper(array $array)
    {
        $this->assertHasKeys(
            $array,
            arrayHasKeys($array)
        );
    }

    /**
     * @dataProvider arrayDoesntHaveKeysProvider
     */
    public function test_doesnt_have_keys_helper(array $array)
    {
        $this->assertDoesntHaveKeys(
            $array,
            arrayHasKeys($array)
        );
    }

    public function assertHasKeys(array $array, $hasKeys)
    {
        $this->assertIsBool($hasKeys);
        $this->assertTrue($hasKeys);
    }

    public function assertDoesntHaveKeys(array $array, $hasKeys)
    {
        $this->assertIsBool($hasKeys);
        $this->assertFalse($hasKeys);
    }
}
