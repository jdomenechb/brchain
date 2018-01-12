<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Jdomenechb\BRChain\Exception;

use Throwable;

/**
 * Exception thrown when an object is given an option that does not recognise.
 */
class OptionDoesNotExistException extends BRChainException
{
    /**
     * OptionDoesNotExistException constructor.
     *
     * @param string $option
     * @param $className
     * @param Throwable|null $previous
     */
    public function __construct(string $option, string $className, Throwable $previous = null)
    {
        parent::__construct('The option "' . $option . '" does not exist in ' . $className, 0, $previous);
    }
}
