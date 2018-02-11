<?php

namespace spec\Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;
use Jdomenechb\BRChain\Transformation\Transliterate;

class TransliterateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Transliterate::class);
    }

    public function it_is_a_common_transformation_item()
    {
        $this->shouldImplement(AbstractTransformation::class);
    }

    public function it_accepts_an_ICU_transform(StringInterface $string)
    {
        $string->__toString()->willReturn('Any-Latin; Latin-ASCII; Lower()');

        $this->setIcuTransform($string);
        $this->getIcuTransform()->shouldBe($string);
    }

    public function it_processes_the_value_of_the_SourceItem_according_to_the_ICU_transform_given(SourceItemInterface $sourceItem, StringInterface $icuTransform)
    {
        $sourceItem->getValue()->willReturn('Ελευθερία');
        $sourceItem->setValue('eleutheria')->shouldBeCalled();

        $icuTransform->__toString()->willReturn('Any-Latin; Latin-ASCII; Lower()');
        $icuTransform->setContext($sourceItem)->shouldBeCalled();

        $this->setIcuTransform($icuTransform);

        $this->process($sourceItem);
    }
}
