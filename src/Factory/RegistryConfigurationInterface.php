<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <cvns.github@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace West\Registry\Factory;

/**
 * @brief %Registry configuration interface.
 *
 * @details Implementations of this interface MUST provide an iterator over the registry array that hits a dependency
 * before any of it's dependents.  It SHOULD check for cyclic dependencies and missing dependencies (east resulting
 * in a West::Registry::DomainException).
 *
 * An implementation SHOULD verify that all expected parameters are provided for a class.
 *
 * @author Christopher Evans <cvns.github@gmail.com>
 * @date 19 April 2017
 */
interface RegistryConfigurationInterface
{
    /**
     * @brief Get an iterator for the registry configuration array.
     *
     * @return iterable
     */
    public function getConfigurationIterator(): iterable;
}
