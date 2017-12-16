<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace spec\Jdomenechb\BRChain\SourceItem;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\SourceItem\XMLSourceItem;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class XMLSourceItemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XMLSourceItem::class);
    }

    public function it_is_a_data_item()
    {
        $this->shouldImplement(SourceItemInterface::class);
    }

    public function it_accepts_XML_data(\DOMNode $dom)
    {
        $this->setData($dom);
        $this->getData()->shouldReturn($dom);
    }

    public function it_optionally_accepts_XML_data_when_creating_it(\DOMNode $dom)
    {
        $this->beConstructedWith($dom);
        $this->getData()->shouldReturn($dom);
    }

    public function it_does_not_accept_other_data_than_XML()
    {
        $this->shouldThrow(\TypeError::class)
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
            ->shouldBeSameXMLDataItemArray([new XMLSourceItem($nodeA), new XMLSourceItem($nodeC)]);
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
                        !$subjectValue instanceof XMLSourceItem
                        || !isset($value[$subjectKey])
                        || !$value[$subjectKey] instanceof XMLSourceItem
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
