<?php

namespace spec\Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\Condition\AbstractCondition;
use Jdomenechb\BRChain\Condition\IsEmpty;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use PhpSpec\ObjectBehavior;

class IsEmptySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(IsEmpty::class);
    }

    public function it_is_a_common_Condition_item()
    {
        $this->shouldHaveType(AbstractCondition::class);
    }


    public function it_evaluates_by_getting_the_value_from_the_SourceItem(SourceItemInterface $item)
    {
        $item->getValue()->shouldBeCalled();
        $this->evaluate($item);
    }

    public function it_evaluates_true_if_the_value_is_empty(SourceItemInterface $item, SourceItemInterface $child, StringInterface $path)
    {
        $item->getValue()->willReturn('');
        $this->evaluate($item)->shouldBe(true);
    }

    public function it_evaluates_false_if_the_value_is_not_empty(SourceItemInterface $item)
    {
        $item->getValue()->willReturn('Not en empty value');
        $this->evaluate($item)->shouldBe(false);
    }
}
