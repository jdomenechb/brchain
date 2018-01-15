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

namespace Jdomenechb\BRChain;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

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

    /**
     * Get the context in which the property should evaluate.
     *
     * @return SourceItemInterface
     */
    public function getContext(): SourceItemInterface;

    /**
     * Set the context in which the property should evaluate.
     *
     * @param SourceItemInterface $context
     */
    public function setContext(SourceItemInterface $context): void;
}
