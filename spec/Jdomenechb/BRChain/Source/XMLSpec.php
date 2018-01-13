<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Source;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainInterface;
use Jdomenechb\BRChain\Exception\SourceItemNotProcessableExtension;
use Jdomenechb\BRChain\Source\SourceInterface;
use Jdomenechb\BRChain\Source\XML;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\SourceItem\XMLSourceItem;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class XMLSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XML::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_is_a_source_item()
    {
        $this->shouldImplement(SourceInterface::class);
    }

    public function it_contains_a_chain()
    {
        $this->shouldImplement(ChainContainerItemInterface::class);
        $this->getChain()->shouldReturnAnInstanceOf(ChainInterface::class);
    }

    public function it_processes_from_strings()
    {
        // FIXME: Might be improved more
        $this->processFromString('<a/>')->shouldBeString();
    }

    public function it_processes_only_XMLSourceItems(SourceItemInterface $sourceItem)
    {
        $this->shouldThrow(SourceItemNotProcessableExtension::class)->during('process', [$sourceItem]);
    }

    public function it_executes_the_contained_chain_on_the_XMLSourceItem(XMLSourceItem $sourceItem, ChainInterface $chain)
    {
        $chain->process($sourceItem)->shouldBeCalled();
        $this->setChain($chain);

        $this->process($sourceItem);
    }

    public function it_accepts_namespace_prefixes()
    {
        $this->shouldUseTrait(XML\NamespacePrefixesTrait::class);
    }

    public function it_passes_the_namespace_prefixes_it_contains_to_the_processed_source_item(XMLSourceItem $sourceItem, ChainInterface $chain)
    {
        $prefixes = ['n' => 'http://uri.com'];

        $this->setNamespacePrefixes($prefixes);

        $sourceItem->setNamespacePrefixes($prefixes)->shouldBeCalled();
        $this->process($sourceItem);
    }
}
