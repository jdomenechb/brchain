<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Exception\SourceItemNotProcessable;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Source\SourceItem\XMLSourceItem;
use Jdomenechb\BRChain\Transformation\AddNode;
use Jdomenechb\BRChain\Transformation\TransformationInterface;
use PhpSpec\ObjectBehavior;

class AddNodeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(AddNode::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_is_a_transformation()
    {
        $this->shouldImplement(TransformationInterface::class);
    }

    public function it_accepts_options()
    {
        $this->setOptions(['nodeName' => 'testNodeName']);
        $this->getNodeName()->shouldBe('testNodeName');
    }

    public function it_accepts_options_via_constructor()
    {
        $this->beConstructedWith(['nodeName' => 'testNodeName']);
        $this->getNodeName()->shouldBe('testNodeName');
    }

    public function it_processes_only_XMLSourceItem(SourceItemInterface $sourceItem)
    {
        $this->shouldThrow(SourceItemNotProcessable::class)->during('process', [$sourceItem]);
    }

    public function it_adds_nodes_to_XMLSourceItems(XMLSourceItem $xmlSourceItem, \DOMElement $node, \DOMNodeList $childNodes)
    {
        // TODO: Could not find way to mock DOMNodes

    }
}