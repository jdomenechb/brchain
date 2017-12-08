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


/**
 * Interface that must be implemented in all items that can contain a chain.
 */
interface ChainContainerItemInterface
{
    /**
     * Returns the chain contained in the item.
     * @return Chain
     */
    public function getChain(): ChainInterface;

    /**
     * Sets the chain to be contained in the item.
     * @param ChainInterface $chain
     */
    public function setChain(ChainInterface $chain);
}