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
 * Exception to be thrown when the parsed content does not implement SourceInterface.
 */
class NotASourceException extends FactoryException
{
    /**
     * NotASourceException constructor.
     *
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(array $context, Throwable $previous = null)
    {
        $msg = 'The data given to parse should start by a Source item.';

        parent::__construct($msg, $context, $previous);
    }
}
