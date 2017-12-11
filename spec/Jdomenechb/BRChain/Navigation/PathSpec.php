<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Navigation;

use Jdomenechb\BRChain\Chain\Chain;
use Jdomenechb\BRChain\Navigation\AbstractNavigation;
use Jdomenechb\BRChain\Navigation\Path;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class PathSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Path::class);
    }

    public function it_is_a_common_Navigation_item()
    {
        $this->shouldHaveType(AbstractNavigation::class);
    }

    public function it_accepts_a_path(StringInterface $path)
    {
        $path->__toString()->willReturn('test/path');

        $this->setPath($path);
        $this->strPath()->shouldReturn('test/path');
    }

    public function it_executes_chain_on_elements_matching_the_path(
        StringInterface $path, SourceItemInterface $sourceItem, SourceItemInterface $si1,
        SourceItemInterface $si2, Chain $chain)
    {
        $path->__toString()->willReturn('/a/b');
        $sourceItem->queryPath('/a/b')->willReturn([$si1, $si2]);

        $chain->process($si1)->shouldBeCalled();
        $chain->process($si2)->shouldBeCalled();

        $this->setChain($chain);
        $this->setPath($path);
        $this->process($sourceItem);
    }
}