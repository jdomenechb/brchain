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
 * Exception to be thrown when the created content does not implement PropertyItemInterface.
 */
class NotAPropertyItemException extends FactoryException
{
    /**
     * NotAPropertyItemException constructor.
     *
     * @param string         $obj
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(string $obj, array $context, Throwable $previous = null)
    {
        $msg = 'The object ' . $obj . ' is not a property item';

        parent::__construct($msg, $context, $previous);
    }
}
