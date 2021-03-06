<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\Condition\AbstractCondition;
use Jdomenechb\BRChain\Condition\PathExists;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use PhpSpec\ObjectBehavior;

class PathExistsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PathExists::class);
    }

    public function it_is_a_common_Condition_item()
    {
        $this->shouldHaveType(AbstractCondition::class);
    }

    public function it_accepts_a_path(StringInterface $path)
    {
        $path->__toString()->willReturn('test/path');

        $this->setPathToCheckExistence($path);
        $this->strPathToCheckExistence()->shouldReturn('test/path');
    }

    public function it_evaluates_by_querying_the_path_from_the_SourceItem(SourceItemInterface $item, StringInterface $path)
    {
        $item->queryPath('test/path')->shouldBeCalled();

        $path->__toString()->willReturn('test/path');

        $this->setPathToCheckExistence($path);
        $this->evaluate($item);
    }

    public function it_evaluates_true_if_the_given_path_exists(SourceItemInterface $item, SourceItemInterface $child, StringInterface $path)
    {
        $item->queryPath('test/path')->willReturn([$child]);

        $path->__toString()->willReturn('test/path');

        $this->setPathToCheckExistence($path);
        $this->strPathToCheckExistence()->shouldReturn('test/path');

        $this->evaluate($item)->shouldBe(true);
    }

    public function it_evaluates_false_if_the_given_path_does_not_exist(SourceItemInterface $item, StringInterface $path)
    {
        $item->queryPath('test/path')->willReturn([]);

        $path->__toString()->willReturn('test/path');

        $this->setPathToCheckExistence($path);
        $this->strPathToCheckExistence()->shouldReturn('test/path');

        $this->evaluate($item)->shouldBe(false);
    }
}
