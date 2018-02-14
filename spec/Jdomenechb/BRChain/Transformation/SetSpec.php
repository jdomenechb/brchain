<?php

namespace spec\Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;
use Jdomenechb\BRChain\Transformation\Set;

class SetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Set::class);
    }

    public function it_is_a_common_transformation_item()
    {
        $this->shouldImplement(AbstractTransformation::class);
    }

    public function it_accepts_a_value(StringInterface $string)
    {
        $string->__toString()->willReturn('a string');

        $this->setValue($string);
        $this->getValue()->shouldBe($string);
    }

    public function it_sets_the_value_of_the_SourceItem_to_the_value_given(SourceItemInterface $sourceItem, StringInterface $valueToSet)
    {
        $sourceItem->setValue('value to set')->shouldBeCalled();

        $valueToSet->__toString()->willReturn('value to set');
        $valueToSet->setContext($sourceItem)->shouldBeCalled();

        $this->setValue($valueToSet);

        $this->process($sourceItem);
    }
}
