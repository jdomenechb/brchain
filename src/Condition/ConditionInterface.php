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

namespace Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\NegatedItemInterface;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Interface to be implemented by all Condition items.
 */
interface ConditionInterface extends ChainableItemInterface, ChainContainerItemInterface, NegatedItemInterface
{
    /**
     * Checks if the current SourceItem satisfies the condition.
     *
     * @param SourceItemInterface $sourceItem
     *
     * @return bool
     */
    public function evaluate(SourceItemInterface $sourceItem): bool;
}
