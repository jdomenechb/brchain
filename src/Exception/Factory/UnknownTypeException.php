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
 * Exception to be thrown when the given type is not known.
 */
class UnknownTypeException extends FactoryException
{
    /**
     * UnknownTypeException constructor.
     *
     * @param string         $type
     * @param string[]       $knownTypes
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(string $type, array $knownTypes, array $context, Throwable $previous = null)
    {
        $msg = 'Unknown item type "' . $type . '". Known types are: ' . \implode(', ', $knownTypes);

        parent::__construct($msg, $context, $previous);
    }
}
