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
        return $this->chain;
    }
}