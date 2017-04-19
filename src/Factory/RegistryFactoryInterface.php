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

/**
 * @brief %Registry factory interface.
 *
 * @details Provides methods to create a registry from an unordered configuration array or an instance of
 * RegistryConfigurationInterface encapsulating the array of dependencies and providing an ordered configuration
 * (in the sense of dependencies appearing before their dependents).
 *
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 * @date 19 April 2017
 */
interface RegistryFactoryInterface
{
    /**
     * @brief Create a registry from an unordered array.
     *
     * @param array $containerConfig
     *
     * @return ContainerInterface Registry
     */
    public function createFromArray(array $containerConfig): ContainerInterface;

    /**
     * @brief Create a registry from an (ordered) registry configuration
     *
     * @param RegistryConfigurationInterface $orderedConfig
     *
     * @return ContainerInterface
     */
    public function createFromConfiguration(RegistryConfigurationInterface $orderedConfig): ContainerInterface;
}
