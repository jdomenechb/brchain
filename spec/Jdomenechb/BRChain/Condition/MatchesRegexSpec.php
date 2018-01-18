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
use Jdomenechb\BRChain\Condition\MatchesRegex;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use PhpSpec\ObjectBehavior;

class MatchesRegexSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(MatchesRegex::class);
    }

    public function it_is_a_common_Condition_item()
    {
        $this->shouldHaveType(AbstractCondition::class);
    }

    public function it_evaluates_by_getting_the_value_from_the_SourceItem(StringInterface $string, SourceItemInterface $item)
    {
        $string->__toString()->willReturn('#a#');
        $this->setRegex($string);

        $item->getValue()->shouldBeCalled();
        $this->evaluate($item);
    }

    public function it_accepts_a_regex(StringInterface $regex)
    {
        $this->setRegex($regex);
        $this->getRegex()->shouldBe($regex);
    }

    public function it_evaluates_true_if_the_value_matches_the_regex(SourceItemInterface $item, StringInterface $regex)
    {
        $regex->__toString()->willReturn('#^[a-z]+$#');
        $this->setRegex($regex);

        $item->getValue()->willReturn('abc');
        $this->evaluate($item)->shouldBe(true);
    }

    public function it_evaluates_false_if_the_value_does_not_match_the_regex(SourceItemInterface $item, StringInterface $regex)
    {
        $regex->__toString()->willReturn('#^[a-z]+$#');
        $this->setRegex($regex);

        $item->getValue()->willReturn('a.c');
        $this->evaluate($item)->shouldBe(false);
    }
}
