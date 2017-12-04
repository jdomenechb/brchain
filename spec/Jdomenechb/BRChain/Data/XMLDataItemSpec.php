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

    public function it_accepts_XML_data(\DOMNode $dom)
    {
        $this->setData($dom)->shouldReturn($this);
        $this->getData()->shouldReturn($dom);
    }

    public function it_optionally_accepts_XML_data_when_creating_it(\DOMNode $dom)
    {
        $this->beConstructedWith($dom);
        $this->getData()->shouldReturn($dom);
    }
}
