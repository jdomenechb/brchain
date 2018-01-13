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
use Jdomenechb\BRChain\Condition\Equals;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use PhpSpec\ObjectBehavior;

class EqualsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Equals::class);
    }

    public function it_is_a_common_Condition_item()
    {
        $this->shouldHaveType(AbstractCondition::class);
    }

    public function it_evaluates_by_getting_the_value_from_the_SourceItem(StringInterface $string, SourceItemInterface $item)
    {
        $string->__toString()->willReturn('valueToCompareTo');
        $this->setValue($string);

        $item->getValue()->shouldBeCalled();
        $this->evaluate($item);
    }

    public function it_evaluates_true_if_the_value_equals_a_given_value(StringInterface $string, SourceItemInterface $item, SourceItemInterface $child, StringInterface $path)
    {
        $string->__toString()->willReturn('valueToCompareTo');

        $item->getValue()->willReturn('valueToCompareTo');
        $this->setValue($string);

        $this->evaluate($item)->shouldBe(true);
    }

    public function it_evaluates_false_if_the_value_equals_a_given_value(StringInterface $string, SourceItemInterface $item)
    {
        $string->__toString()->willReturn('valueToCompareTo');

        $item->getValue()->willReturn('valueToCompareToDifferent');
        $this->setValue($string);

        $this->evaluate($item)->shouldBe(false);
    }
}
