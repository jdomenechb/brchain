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

namespace Jdomenechb\BRChain\Chain;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Interface that will implement all classes referring to a Chain.
 */
interface ChainInterface
{
    /**
     * Adds an item to the chain.
     *
     * @param ChainableItemInterface $item
     */
    public function add(ChainableItemInterface $item): void;

    /**
     * Execute all the operations of the items contained in this chain on the given SourceItem.
     *
     * @param SourceItemInterface $sourceItem
     */
    public function process(SourceItemInterface $sourceItem): void;

    /**
     * Returns the list of items currently in the Chain.
     *
     * @return ChainableItemInterface[]
     */
    public function getItems(): array;
}
