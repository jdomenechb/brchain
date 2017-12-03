<?php

namespace spec\Jdomenechb\BRChain\Data;

use Jdomenechb\BRChain\Data\DataItemInterface;
use Jdomenechb\BRChain\Data\XMLDataItem;
use PhpSpec\ObjectBehavior;

class XMLDataItemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XMLDataItem::class);
    }

    public function it_is_a_data_item()
    {
        $this->shouldImplement(DataItemInterface::class);
    }

    public function it_accepts_DOMNode_data()
    {
        $dom = new \DOMDocument();

        $this->setData($dom)->shouldReturn($this);
        $this->getData()->shouldReturn($dom);
    }

    public function it_optionally_accepts_DOMNode_data_through_the_constructor()
    {
        $dom = new \DOMDocument();

        $this->beConstructedWith($dom);
        $this->getData()->shouldReturn($dom);
    }
}
