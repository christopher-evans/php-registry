<?php

namespace West\Registry;

use PHPUnit\Framework\TestCase;

class RegistryKeyTest extends TestCase
{
    /**
     *
     * @dataProvider providerTestKeyUnchanged
     */
    public function testKeyUnchanged($key)
    {
        $registryKey = new RegistryKey($key);

        $this->assertEquals($key, $registryKey->getKey());
    }

    public function providerTestKeyUnchanged()
    {
        return [
            ['some-key'],
            ['!"£$%^&*()']
        ];
    }
}
