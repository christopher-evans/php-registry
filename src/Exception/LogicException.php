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

use LogicException as RootLogicException;

/**
 * @brief Logic exception for West::Registry namespace
 *
 * @details This class is to allow West::Registry exceptions to be caught
 * and does not define any functionality beyond that of
 * %LogicException.
 *
 * @author Christopher Evans <cvns.github@gmail.com>
 *
 * @see http://php.net/manual/en/class.domainexception.php %LogicException
 *
 * @date 09 April 2017
 */
final class LogicException extends RootLogicException
{

}
