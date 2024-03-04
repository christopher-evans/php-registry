<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <cvns.github@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace West\Registry;

/**
 * @brief %Registry key wrapper.
 *
 * @details This interface is used to provide a key from the registry as the argument to
 * a class constructed by the registry. For example if the following configuration is passed to the registry:
 *
 * [
 *     'my\class' => [
 *         'parameter' => 'value'
 *     ],
 *     'my\other\class' => [
 *         'parameter' => new RegistryKey('my\class')
 *     ]
 * ]
 *
 * Then the 'parameter' argument of the `my\other\class` constructor will receive the instance of `my\class`
 * created.
 *
 * @author Christopher Evans <cvns.github@gmail.com>
 * @date 19 April 2017
 */
interface RegistryKeyInterface
{
    /**
     * @brief Get registry key
     *
     * @return string Registry key
     */
    public function getKey(): string;
}
