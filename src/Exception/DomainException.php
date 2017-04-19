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

use DomainException as RootDomainException;

/**
 * @brief Domain exception for West::Registry namespace
 *
 * @details This class is to allow West::Registry exceptions to be caught
 * and does not define any functionality beyond that of
 * %DomainException.
 *
 * @author Christopher Evans <c.m.evans@gmx.co.uk>
 *
 * @see http://php.net/manual/en/class.domainexception.php %DomainException
 *
 * @date 09 April 2017
 */
final class DomainException extends RootDomainException
{

}
