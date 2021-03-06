<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Transformation\XML;

use Jdomenechb\BRChain\Exception\SourceItemNotProcessableExtension;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;
use Jdomenechb\BRChain\Transformation\XML\AddNode;

class AddNodeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(AddNode::class);
    }

    public function it_is_a_common_transformation_item()
    {
        $this->shouldImplement(AbstractTransformation::class);
    }

    public function it_accepts_a_namespace(StringInterface $string)
    {
        $string->__toString()->willReturn('http://url.com');

        $this->setNamespace($string);
        $this->getNamespace()->shouldBe($string);
    }

    public function it_accepts_options_via_constructor(StringInterface $string)
    {
        $string->__toString()->willReturn('testNodeName');

        $this->beConstructedWith(['nodeName' => $string]);
        $this->getNodeName()->shouldBe($string);
    }

    public function it_accepts_a_node_name(StringInterface $string)
    {
        $string->__toString()->willReturn('test');

        $this->setNodeName($string);
        $this->getNodeName()->shouldBe($string);
    }

    public function it_processes_only_XMLSourceItems(SourceItemInterface $sourceItem)
    {
        $this->shouldThrow(SourceItemNotProcessableExtension::class)->during('process', [$sourceItem]);
    }

//    public function it_adds_nodes_to_XMLSourceItems(XMLSourceItem $xmlSourceItem, \DOMElement $node, \DOMNodeList $childNodes)
//    {
//        // TODO: Could not find way to mock DOMNodes
//
//    }

//    public function it_adds_namespaced_nodes_to_XMLSourceItems(XMLSourceItem $xmlSourceItem, \DOMElement $node, \DOMNodeList $childNodes)
//    {
//        // TODO: Could not find way to mock DOMNodes
//
//    }
}
