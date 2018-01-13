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

/**
 * Trait providing a ChainContainerItem the usual method that should be implemented already implemented.
 */
trait ChainContainerItemTrait
{
    /**
     * Chain contained in the item.
     *
     * @var Chain
     */
    protected $chain;

    /**
     * Returns the chain contained in the item.
     *
     * @return Chain
     */
    public function getChain(): ChainInterface
    {
        if (null === $this->chain) {
            $this->chain = new Chain();
        }

        return $this->chain;
    }

    /**
     * Sets the chain to be contained in the item.
     *
     * @param ChainInterface $chain
     */
    public function setChain(ChainInterface $chain): void
    {
        $this->chain = $chain;
    }
}
