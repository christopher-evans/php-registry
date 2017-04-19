<?php

namespace West\Registry\Factory;

use PHPUnit\Framework\TestCase;
use West\Registry\Exception\DomainException;
use West\Registry\Exception\InvalidArgumentException;
use West\Registry\RegistryKey;

class RegistryConfigurationTest extends TestCase
{
    public function testCyclicDependency()
    {
        $this->expectException(DomainException::class);

        new RegistryConfiguration(
            [
                'West\Registry\Service\Baz' => [
                    'parameter' => new RegistryKey('West\Registry\Service\Baz')
                ]
            ]
        );
    }

    public function testClassNotExists()
    {
        $this->expectException(DomainException::class);

        new RegistryConfiguration(
            [
                'West\Registry\Service\NoSuchClass' => []
            ]
        );
    }

    public function testNotArrayConfig()
    {
        $this->expectException(DomainException::class);

        new RegistryConfiguration(
            [
                'West\Registry\Service\Moo' => false
            ]
        );
    }

    /**
     *
     * @dataProvider providerTestInvalidParameters
     */
    public function testInvalidParameters($registryConfiguration)
    {
        $this->expectException(InvalidArgumentException::class);

        new RegistryConfiguration($registryConfiguration);
    }

    public function providerTestInvalidParameters()
    {
        return [
            // invalid parameter count
            [
                [
                    'West\Registry\Service\Foo' => [
                        'parameter' => false
                    ]
                ]
            ],
            // missing parameter
            [
                [
                    'West\Registry\Service\Foo' => [
                        'parameter' => false,
                        'wrongName' => false
                    ]
                ]
            ],
        ];
    }

    /**
     *
     * @dataProvider providerTestContainerOrder
     */
    public function testContainerOrder($configurationArray)
    {
        $configuration = new RegistryConfiguration($configurationArray);

        $iterator = $configuration->getConfigurationIterator();

        // check first class
        $this->assertEquals('West\Registry\Service\Foo', key($iterator));

        next($iterator);

        // check first class
        $this->assertEquals('West\Registry\Service\Bar', key($iterator));
    }

    public function providerTestContainerOrder()
    {
        return [
            [
                [
                    'West\Registry\Service\Foo' => [
                        'parameter' => false,
                        'anotherParameter' => false,
                    ],
                    'West\Registry\Service\Bar' => [
                        'parameter' => new RegistryKey('West\Registry\Service\Foo'),
                        'nextParameter' => false,
                    ]
                ]
            ],
            [
                [
                    'West\Registry\Service\Bar' => [
                        'parameter' => new RegistryKey('West\Registry\Service\Foo'),
                        'nextParameter' => false,
                    ],
                    'West\Registry\Service\Foo' => [
                        'parameter' => false,
                        'anotherParameter' => false,
                    ]
                ]
            ]
        ];
    }
}
