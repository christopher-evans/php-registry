<?php
/*
 * This file is part of the West\\Log package
 *
 * (c) Chris Evans <c.m.evans@gmx.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace West\Log;

use West\Registry\Factory\RegistryConfiguration;
use West\Registry\Factory\RegistryConfigurationInterface;
use West\Registry\Factory\RegistryFactory;
use West\Registry\RegistryKey;

/**
 * @Revs({1, 8, 64, 4096})
 * @Iterations(10)
 * @BeforeMethods({"setUp"})
 */
class RegistryBench
{
    /** @var $registryConfiguration RegistryConfigurationInterface Registry configuration */
    private $registryConfiguration;

    /** @var $registryConfiguration array Registry configuration array */
    private $configurationArray;

    /** @var $factory RegistryFactory Registry factory */
    private $factory;

    public function setUp()
    {
        $this->configurationArray = [
            'West\Registry\Service\Bar' => [
                'parameter' => new RegistryKey('West\Registry\Service\Foo'),
                'nextParameter' => false,
            ],
            'West\Registry\Service\Foo' => [
                'parameter' => false,
                'anotherParameter' => false,
            ]
        ];

        $this->registryConfiguration = new RegistryConfiguration($this->configurationArray);

        $this->factory = new RegistryFactory();
    }

    public function benchFromArray()
    {
        $this->factory->createFromArray($this->configurationArray);
    }

    public function benchFromConfiguration()
    {
        $this->factory->createFromConfiguration($this->registryConfiguration);
    }
}
