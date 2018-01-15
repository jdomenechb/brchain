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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\PropertyItemInterface;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\AbstractString;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Stub\String\AbstractStringStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class AbstractStringSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AbstractStringStub::class);
    }

    public function its_stub_extends_the_abstract_class()
    {
        $this->shouldHaveType(AbstractString::class);
    }

    public function it_is_a_String_item()
    {
        $this->shouldImplement(StringInterface::class);
    }

    public function it_is_a_property_item()
    {
        $this->shouldImplement(PropertyItemInterface::class);
    }

    public function it_accepts_dynamic_options()
    {
        $this->shouldUseTrait(DynamicOptionsTrait::class);
    }

    public function it_can_return_properties_as_strings()
    {
        $this->shouldUseTrait(CallStringOptionTrait::class);
    }

    public function it_can_receive_a_context(SourceItemInterface $sourceItem)
    {
        $this->setContext($sourceItem);
        $this->getContext()->shouldBe($sourceItem);
    }
}
