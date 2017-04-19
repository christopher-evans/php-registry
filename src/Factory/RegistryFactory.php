<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <c.m.evans@gmx.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace West\Registry\Factory;

use Psr\Container\ContainerInterface;
use West\Registry\Exception\DomainException;
use West\Registry\Registry;
use West\Registry\RegistryKeyInterface;
use ReflectionClass;
use ReflectionException;

/**
 * @brief Implementation of RegistryFactoryInterface
 *
 * @see RegistryFactoryInterface
 *
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 * @date 19 April 2017
 */
final class RegistryFactory
{
    /**
     * @see RegistryFactoryInterface
     */
    public function createFromArray(array $containerConfig): ContainerInterface
    {
        $orderedConfig = $this->createRegistryConfiguration($containerConfig);

        return $this->createFromConfiguration($orderedConfig);
    }

    /**
     * @see RegistryFactoryInterface
     */
    public function createFromConfiguration(RegistryConfigurationInterface $orderedConfig): ContainerInterface
    {
        $objects = [];

        foreach ($orderedConfig->getConfigurationIterator() as $class => $arguments) {
            // grab object arguments from map
            foreach ($arguments as $parameter => $argument) {
                if ($argument instanceof RegistryKeyInterface) {
                    $arguments[$parameter] = $objects[$argument->getKey()];
                }
            }


            try {
                $reflectionClass = new ReflectionClass($class);
                $objects[$class] = $reflectionClass->newInstanceArgs($arguments);
            } catch (ReflectionException $exception) {
                throw new DomainException($exception->getMessage());
            }
        }

        return new Registry($objects);
    }

    /**
     * @brief Create a RegistryConfigurationInterface instance from a configuration array.
     *
     * @param array $containerConfig Registry configuration array
     *
     * @return RegistryConfigurationInterface
     */
    private function createRegistryConfiguration(array $containerConfig): RegistryConfigurationInterface
    {
        return new RegistryConfiguration($containerConfig);
    }
}
