<?php
/*
 * This file is part of the West\\Registry package
 *
 * (c) Chris Evans <cvns.github@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace West\Registry\Exception;

use InvalidArgumentException as PHPInvalidArgumentException;

/**
 * @brief Invalid argument exception for West::Registry namespace
 *
 * @details This class is to allow West::Registry exceptions to be caught
 * and does not define any functionality beyond that of
 * %InvalidArgumentException.
 *
 * @author Christopher Evans <cvns.github@gmail.com>
 *
 * @see http://php.net/manual/en/class.invalidargumentexception.php %InvalidArgumentException
 *
 * @date 10 April 2017
 */
final class InvalidArgumentException extends PHPInvalidArgumentException
{

}
