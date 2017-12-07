<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain;


trait ChainContainerItemTrait
{
    /**
     * Chain contained in the item.
     * @var Chain
     */
    protected $chain;


    /**
     * Returns the chain contained in the item.
     * @return Chain
     */
    public function getChain() : ChainInterface
    {
        if ($this->chain === null) {
            $this->chain = new Chain();
        }

        return $this->chain;
    }

    /**
     * Sets the chain to be contained in the item.
     * @param ChainInterface $chain
     */
    public function setChain(ChainInterface $chain)
    {
        $this->chain = $chain;
    }
}