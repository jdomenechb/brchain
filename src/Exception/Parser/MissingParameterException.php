<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Exception\Parser;
use Throwable;

/**
 * Exception to be thrown when a parameter is missing-
 * @package Jdomenechb\BRChain\Exception\Parser
 */
class MissingParameterException extends ParserException
{
    /**
     * MissingParameterException constructor.
     * @param string $parameter
     * @param array $context
     * @param Throwable|null $previous
     */
    public function __construct(string $parameter, array $context, Throwable $previous = null)
    {
        parent::__construct('Parameter "' . $parameter . '" missing', $context, $previous);
    }
}