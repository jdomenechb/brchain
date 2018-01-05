<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Source;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;

/**
 * Interface implemented by all Source elements.
 */
interface SourceInterface extends ChainableItemInterface, ChainContainerItemInterface
{
    /**
     * Execute the operations this item performs on the given string, and returns the result.
     *
     * @param string $data
     *
     * @return string
     */
    public function processFromString(string $data): string;
}
