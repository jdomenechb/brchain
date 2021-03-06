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
 * Exception to be thrown when the type parameter is missing-.
 */
class MissingTypeParameterException extends MissingParameterException
{
    /**
     * MissingParameterException constructor.
     *
     * @param array          $context
     * @param Throwable|null $previous
     */
    public function __construct(array $context, Throwable $previous = null)
    {
        parent::__construct('type', $context, $previous);
    }
}
