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
 * Exception to be thrown when the given type and name is not known.
 */
class UnknownItemException extends FactoryException
{
    /**
     * UnknownTypeException constructor.
     *
     * @param string         $type
     * @param string         $name
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(string $type, string $name, array $context, Throwable $previous = null)
    {
        $msg = 'Unknown ' . $type . ' "' . $name . '"';

        parent::__construct($msg, $context, $previous);
    }
}
