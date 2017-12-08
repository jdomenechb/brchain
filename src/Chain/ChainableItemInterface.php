<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Chain;

use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;

/**
 * Interface that must be implemented in all items that can be contained in a chain.
 */
interface ChainableItemInterface
{
    /**
     * Execute the operations this item performs on the given SourceItem.
     * @param SourceItemInterface $sourceItem
     */
    public function process(SourceItemInterface $sourceItem) : void;

    /**
     * Set options to the item.
     * @param array $options
     */
    public function setOptions(array $options) : void;
}