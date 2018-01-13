<?php

declare(strict_types=1);

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Exception;

use Throwable;

/**
 * Exception thrown when a method has not been found.
 */
class MethodNotFoundException extends BRChainException
{
    /**
     * MethodNotFoundException constructor.
     *
     * @param string         $methodName
     * @param string         $className
     * @param Throwable|null $previous
     */
    public function __construct(string $methodName, string $className, Throwable $previous = null)
    {
        $msg = 'The method "' . $methodName . '" has not been found in "' . $className . '"';
        parent::__construct($msg, 0, $previous);
    }
}
