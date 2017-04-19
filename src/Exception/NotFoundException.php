<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <c.m.evans@gmx.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace West\Registry\Exception;

use Psr\Container\NotFoundExceptionInterface;
use OutOfBoundsException;

/**
 * @brief Not found exception for West::Registry namespace
 *
 * @details This class is to allow West::Registry exceptions to be caught
 * and does not define any functionality beyond that of
 * %OutOfBoundsException.
 *
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 *
 * @see http://php.net/manual/en/class.outofboundsexception.php %OutOfBoundsException
 *
 * @date 10 April 2017
 */
final class NotFoundException extends OutOfBoundsException implements NotFoundExceptionInterface
{

}
