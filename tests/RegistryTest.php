<?php

namespace West\Registry;

use West\Registry\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use West\Registry\Exception\NotFoundException;

class RegistryTest extends TestCase
{
    private $object;

    private $container;

    public function setUp()
    {
        $this->object = new \stdClass();
        $this->container = new Registry(
            [
                'object' => $this->object
            ]
        );
    }

    public function testInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        new Registry(
            [
                'object' => 'non-object'
            ]
        );
    }

    public function testNotFound()
    {
        $this->expectException(NotFoundException::class);

        $this->container->get('another-object');
    }

    public function testFound()
    {
        $stdClass = $this->container->get('object');

        $this->assertEquals($this->object, $stdClass);
    }

    /**
     *
     * @dataProvider providerTestHas
     */
    public function testHas($id, $exists)
    {
        $this->assertEquals($exists, $this->container->has($id));
    }

    public function providerTestHas()
    {
        return [
            ['object', true],
            ['another-object', false]
        ];
    }
}
