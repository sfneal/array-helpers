<?php

namespace Sfneal\Helpers\Arrays\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Assert that an array has a value.
     *
     * @param $needle
     * @param array $haystack
     */
    public function assertArrayHasValue($needle, array $haystack)
    {
        $this->assertTrue(
            in_array($needle, array_values($haystack)),
            "Could not find '{$needle}' in the array ".json_encode($haystack));
    }

    /**
     * Assert that an array does not have a value.
     *
     * @param $needle
     * @param array $haystack
     */
    public function assertArrayNotHasValue($needle, array $haystack)
    {
        $this->assertFalse(
            in_array($needle, array_values($haystack)),
            "Could not find '{$needle}' in the array ".json_encode($haystack));
    }
}
