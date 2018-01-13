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
 * Chain containing all items to be applied in the SourceItem processed by the parent Item.
 */
class Chain implements ChainInterface, \Iterator
{
    /**
     * Items contained in the chain.
     *
     * @var ChainableItemInterface[]
     */
    protected $items = [];

    /**
     * Internal position of the iterator.
     *
     * @var int
     */
    private $position = 0;

    /**
     * {@inheritdoc}
     */
    public function add(ChainableItemInterface $item): void
    {
        $this->items[] = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        foreach ($this->items as $item) {
            $item->process($sourceItem);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /*
     * Iterator methods
     */

    /**
     * Returns the current element of the iterator.
     *
     * @return ChainableItemInterface
     */
    public function current(): ChainableItemInterface
    {
        return $this->items[$this->position];
    }

    /**
     * Increases the iterator position by one.
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Returns the current iterator position.
     *
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * Checks if there is an element in the current iterator position.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    /**
     * Rewinds the iterator to the first element.
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}
