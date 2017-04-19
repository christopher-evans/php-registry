<?php

namespace West\Registry;

use PHPUnit\Framework\TestCase;
use West\Registry\Exception\DomainException;
use West\Registry\Factory\RegistryFactory;

class RegistryFactoryTest extends TestCase
{
    /** @var $factory RegistryFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new RegistryFactory();
    }

    /**
     *
     */
    public function testConstruction()
    {
        $configuration = [
            'West\Registry\Service\Foo' => [
                'parameter' => false,
                'anotherParameter' => false,
            ]
        ];

        $registry = $this->factory->createFromArray($configuration);
        $service = $registry->get('West\Registry\Service\Foo');

        $this->assertEquals('West\Registry\Service\Foo', get_class($service));
    }

    public function testPrivateConstructor()
    {
        $this->expectException(DomainException::class);

        $configuration = [
            'West\Registry\Service\Moo' => []
        ];

        $this->factory->createFromArray($configuration);
    }
}
