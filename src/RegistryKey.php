<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <c.m.evans@gmx.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace West\Registry;

/**
 * @brief %Registry key wrapper.
 *
 * @see RegistryKeyInterface
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 * @date 19 April 2017
 */
final class RegistryKey implements RegistryKeyInterface
{
    /**
     * @var string Registry key
     */
    private $key;

    /**
     * @brief RegistryKey constructor.
     *
     * @param string $key Registry key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @see RegistryKeyInterface
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
