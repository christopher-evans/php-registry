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

use Psr\Container\ContainerInterface;
use West\Registry\Exception\NotFoundException;
use West\Registry\Exception\InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @brief PSR-11 %Registry implementation.
 *
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md PSR-11 recomendation
 *
 * @author Christopher Evans <cvns.github@gmail.com>
 * @date 10 April 2017
 */
final class Registry implements ContainerInterface
{
    /**
     * @brief Objects array
     *
     * @var array
     */
    private $objects = [];

    /**
     * @brief Registry constructor
     *.
     * @param array $objects
     */
    public function __construct(array $objects)
    {
        foreach ($objects as $id => $object) {
            if (! is_object($object)) {
                throw new InvalidArgumentException(sprintf('Invalid object with key: %s', $id));
            }
        }

        $this->objects = $objects;
    }

    /**
     * @brief Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     *
     * @return object Entry.
     */
    public function get($id)
    {
        if (! $this->has($id)) {
            throw new NotFoundException(sprintf('Object not found at key: %s', $id));
        }

        return $this->objects[$id];
    }

    /**
     * @brief Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @details `has($id)` means that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->objects);
    }
}
