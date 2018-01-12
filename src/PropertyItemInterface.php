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
 * Interface to be implemented by all items that belong to a property of another item.
 */
interface PropertyItemInterface extends ItemInterface
{
    /**
     * Get the string value of the item currently processed.
     *
     * @return string
     */
    public function __toString();
}
