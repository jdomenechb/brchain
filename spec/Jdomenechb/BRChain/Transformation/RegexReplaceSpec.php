<?php

namespace spec\Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;
use Jdomenechb\BRChain\Transformation\RegexReplace;

class RegexReplaceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RegexReplace::class);
    }

    public function it_is_a_common_transformation_item()
    {
        $this->shouldImplement(AbstractTransformation::class);
    }

    public function it_accepts_a_search(StringInterface $string)
    {
        $string->__toString()->willReturn('#/s+#i');

        $this->setSearch($string);
        $this->getSearch()->shouldBe($string);
    }

    public function it_accepts_a_replacement(StringInterface $string)
    {
        $string->__toString()->willReturn('a replacement');

        $this->setReplacement($string);
        $this->getReplacement()->shouldBe($string);
    }

    public function it_processes_the_value_of_the_SourceItem_by_replacing_the_search_with_the_replacement(SourceItemInterface $sourceItem, StringInterface $search, StringInterface $replacement)
    {
        $search->__toString()->willReturn('#[a-z]#');
        $search->setContext($sourceItem)->shouldBeCalled();

        $replacement->__toString()->willReturn('a');
        $replacement->setContext($sourceItem)->shouldBeCalled();

        $sourceItem->getValue()->willReturn('abcde');
        $sourceItem->setValue('aaaaa')->shouldBeCalled();

        $this->setSearch($search);
        $this->setReplacement($replacement);

        $this->process($sourceItem);
    }
}
