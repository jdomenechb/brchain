<?php

namespace spec\Jdomenechb\BRChain\Data;

use Jdomenechb\BRChain\Data\DataItemInterface;
use Jdomenechb\BRChain\Data\XmlDataItem;
use PhpSpec\ObjectBehavior;

class XmlDataItemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XmlDataItem::class);
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

    public function it_does_not_accept_other_data_than_XML()
    {
        $this->shouldTrigger(E_WARNING, 'assert(): Parameter "data" should be an instance of DOMNode')
            ->during('setData', ['Other data']);
    }

    public function it_can_query_XML_xPaths()
    {
        $xml = new \DOMDocument();

        $nodeA = $xml->appendChild($xml->createElement('a'));
        $nodeB = $nodeA->appendChild($xml->createElement('b'));
        $nodeB->appendChild($xml->createElement('d'));
        $nodeC = $nodeB->appendChild($xml->createElement('c'));

        $this->beConstructedWith($xml);

        $this->queryPath('/a/b/c | /a')
            ->shouldBeSameXMLDataItemArray([new XmlDataItem($nodeA), new XmlDataItem($nodeC)]);
    }

    public function getMatchers(): array
    {
        return [
            'beSameXMLDataItemArray' => function ($subject, $value) {
                if (!\is_array($subject) || !\is_array($value) || \count($subject) !== \count($value)) {
                    return false;
                }

                foreach ($subject as $subjectKey => $subjectValue) {
                    if (
                        !$subjectValue instanceof XmlDataItem
                        || !isset($value[$subjectKey])
                        || !$value[$subjectKey] instanceof XmlDataItem
                    ) {
                        return false;
                    }

                    if (!$subjectValue->getData()->isSameNode($value[$subjectKey]->getData())) {
                        return false;
                    }
                }

                return true;
            }
        ];
    }
}
