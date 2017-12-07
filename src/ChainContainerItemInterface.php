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


use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;

/**
 * Interface that must be implemented in all items that can contain a chain.
 */
interface ChainContainerItemInterface
{
    /**
     * Returns the chain containing
     * @return Chain
     */
    public function getChain(): ChainInterface;
}