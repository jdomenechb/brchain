<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Chain;

use Jdomenechb\BRChain\Chain\Chain;
use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainInterface;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use PhpSpec\ObjectBehavior;

class ChainSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Chain::class);
    }

    public function it_implements_a_Chain()
    {
        $this->shouldImplement(ChainInterface::class);
    }

    public function it_can_add_items(ChainableItemInterface $item1)
    {
        $this->getItems()->shouldBe([]);
        $this->add($item1);
        $this->getItems()->shouldBe([$item1]);
    }

    public function it_processes_SourceItems_by_executing_its_containing_items(ChainableItemInterface $item1,
       ChainableItemInterface $item2, SourceItemInterface $sourceItem)
    {
        $item1->process($sourceItem)->shouldBeCalled();
        $item2->process($sourceItem)->shouldBeCalled();

        $this->add($item1);
        $this->add($item2);
        $this->process($sourceItem);
    }

    public function it_is_iterable(ChainableItemInterface $item1, ChainableItemInterface $item2)
    {
        $reference = [$item1, $item2];

        $this->add($item1);
        $this->add($item2);

        foreach ($this->getWrappedObject() as $key => $item) {
            $this->current()->shouldBe($reference[$key]);
        }

        // DO it twice to test rewind
        foreach ($this->getWrappedObject() as $key => $item) {
            $this->current()->shouldBe($reference[$key]);
        }
    }


}