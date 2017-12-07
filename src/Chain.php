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
 * Chain containing all items to be applied in the SourceItem processed by the parent Item.
 * @package Jdomenechb\BRChain
 */
class Chain implements ChainInterface, \Iterator
{
    /**
     * Items contained in the chain.
     * @var ChainableItemInterface[]
     */
    protected $chain = [];

    /**
     * Internal position of the iterator.
     * @var int
     */
    private $position = 0;

    /**
     * @inheritdoc
     */
    public function add(ChainableItemInterface $item): void
    {
        $this->chain[] = $item;
    }

    /**
     * @inheritdoc
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        foreach ($this->chain as $item) {
            $item->process($sourceItem);
        }
    }

    /*
     * Iterator methods
     */

    public function current()
    {
        return $this->chain[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->chain[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }


}