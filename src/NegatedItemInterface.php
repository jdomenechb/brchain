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

namespace Jdomenechb\BRChain;

/**
 * Interface to be implemented by items that can be negated.
 */
interface NegatedItemInterface
{
    /**
     * Returns if the item is negated.
     *
     * @return bool
     */
    public function isNegated(): bool;

    /**
     * Sets if the item is negated.
     *
     * @param bool $negated
     */
    public function setNegated(bool $negated): void;
}
