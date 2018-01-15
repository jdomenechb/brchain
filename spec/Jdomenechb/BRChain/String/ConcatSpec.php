<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\String;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\Concat;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class ConcatSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Concat::class);
    }

    public function it_is_a_String_item()
    {
        $this->shouldImplement(StringInterface::class);
    }

    public function it_accepts_options()
    {
        $this->setOptions(['strings' => ['hello', 'goodbye']]);
        $this->getStrings()->shouldBe(['hello', 'goodbye']);
    }

    public function it_accepts_options_via_constructor()
    {
        $this->beConstructedWith(['strings' => ['hello', 'goodbye']]);
        $this->getStrings()->shouldBe(['hello', 'goodbye']);
    }

    public function it_concatenates_list_of_strings()
    {
        $this->setOptions(['strings' => ['hello', ' ', 'and ', 'goodbye']]);
        $this->__toString()->shouldReturn('hello and goodbye');
    }

    public function it_concatenates_list_of_String_items(StringInterface $string1, StringInterface $string2, SourceItemInterface $context)
    {
        $string1->__toString()->willReturn('String1');
        $string2->__toString()->willReturn(' and String2');

        $string1->setContext($context)->shouldBeCalled();
        $string2->setContext($context)->shouldBeCalled();

        $this->setStrings([$string1, $string2]);
        $this->setContext($context);

        $this->__toString()->shouldReturn('String1 and String2');
    }
}
