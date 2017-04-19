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

use West\Registry\Exception\DomainException;
use West\Registry\Exception\InvalidArgumentException;
use West\Registry\Exception\LogicException;
use West\Registry\RegistryKeyInterface;
use ArrayIterator;
use ReflectionClass;
use ReflectionException;

/**
 * @brief %Registry configuration
 *
 * @see RegistryConfigurationInterface
 * @see https://en.wikipedia.org/wiki/Topological_sorting#Depth-first_search
 *
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 * @date 19 April 2017
 */
final class RegistryConfiguration implements RegistryConfigurationInterface
{
    /**
     * @var array Configuration
     */
    private $config;

    /**
     * @brief RegistryConfiguration constructor.
     *
     * @param array $containerConfig
     */
    public function __construct(array $containerConfig)
    {
        $this->config = $this->orderConfig($containerConfig);
    }

    /**
     * @see RegistryConfigurationInterface::getConfigurationIterator
     */
    public function getConfigurationIterator(): iterable
    {
        return new ArrayIterator($this->config);
    }

    /**
     * @brief Order the container configuration with dependents after dependencies.
     * Also validates constructor parameters.
     *
     * @param array $containerConfig Unordered container config.
     *
     * @return array Ordered container config.
     */
    private function orderConfig(array $containerConfig): array
    {
        $orderedConfig = [];

        foreach ($containerConfig as $class => $arguments) {
            $this->visit($class, $containerConfig, [], $orderedConfig);
        }

        return $orderedConfig;
    }

    /**
     * @brief Visit a configuration node (viewing the dependencies as a directed acyclic graph)
     *
     * @param string $class Class name
     * @param array $containerConfig Unordered container configuration
     * @param array $marks Marked nodes (used to identify cyclic dependencies)
     * @param array $orderedConfig Current ordered container config
     *
     * @throws DomainException
     * @throws LogicException
     */
    private function visit(string $class, array $containerConfig, array $marks, array &$orderedConfig)
    {
        if (in_array($class, $marks)) {
            // cyclic dependency
            throw new DomainException(sprintf('Cyclic dependency for class %s', $class));
        }

        if (array_key_exists($class, $orderedConfig)) {
            // dependency already in ordered list
            return;
        }

        // mark class
        array_push($marks, $class);

        // validate dependencies
        if (! is_array($containerConfig[$class])) {
            throw new DomainException(sprintf('Arguments not supplied as array for key %s', $class));
        }

        // loop through dependencies
        foreach ($containerConfig[$class] as $dependency) {
            if ($dependency instanceof RegistryKeyInterface) {
                $this->visit($dependency->getKey(), $containerConfig, $marks, $orderedConfig);
            }
        }

        // remove class from marks
        array_pop($marks);

        // append class to ordered dependencies
        if (! array_key_exists($class, $containerConfig)) {
            throw new LogicException(sprintf('Registry key not found for class %s', $class));
        }

        // validate constructor parameters
        $this->validateParameters($class, $containerConfig[$class]);

        // add class to config
        $orderedConfig[$class] = $containerConfig[$class];
    }

    /**
     * @brief Validate class parameters
     *
     * @param string $class Class name
     * @param array $arguments Constructor parameters
     *
     * @throws DomainException
     * @throws InvalidArgumentException
     */
    private function validateParameters(string $class, array $arguments)
    {
        try {
            $reflectionClass = new ReflectionClass($class);
        } catch (ReflectionException $exception) {
            throw new DomainException($exception->getMessage());
        }

        $contructorParameters = $reflectionClass->getConstructor()->getParameters();
        if (count($contructorParameters) !== count($arguments)) {
            throw new InvalidArgumentException(
                sprintf('Invalid parameter count for class: %s', $reflectionClass->getName())
            );
        }

        foreach ($contructorParameters as $parameter) {
            if (! array_key_exists($parameter->getName(), $arguments)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'Missing parameter %s for class: %s',
                        $parameter->getName(),
                        $reflectionClass->getName()
                    )
                );
            }
        }
    }
}
