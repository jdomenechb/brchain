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

namespace Jdomenechb\BRChain\Exception\Factory;

use Throwable;

/**
 * Exception to be thrown when a chain option is not an array.
 */
class ChainNotAnArrayException extends FactoryException
{
    /**
     * ChainNotAnArrayException constructor.
     *
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(array $context, Throwable $previous = null)
    {
        $msg = 'The chain parameter is not a list of chain items';

        parent::__construct($msg, $context, $previous);
    }
}
