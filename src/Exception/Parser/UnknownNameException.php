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

namespace Jdomenechb\BRChain\Exception\Parser;

use Throwable;

/**
 * Exception to be thrown when the given type is not known.
 */
class UnknownNameException extends ParserException
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
