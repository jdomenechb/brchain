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

use Jdomenechb\BRChain\Exception\BRChainException;
use Throwable;

/**
 * Abstract parser exception to be extended by any parser exception.
 */
abstract class ParserException extends BRChainException
{
    /**
     * Context in which the exception happened.
     *
     * @var array
     */
    protected $context;

    /**
     * ParserException constructor.
     *
     * @param string         $message
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(string $message, array $context, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->context = $context;
    }

    /**
     * Get the context in which the exception happened.
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
