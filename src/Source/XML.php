<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Source;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Source\SourceItem\XMLSourceItem;

/**
 * Source class for XML strings, to be able to process them using a chain.
 * @package Jdomenechb\BRChain\Source
 */
class XML implements ChainableItemInterface, SourceInterface, ChainContainerItemInterface
{
    use ChainContainerItemTrait;
    use DynamicOptionsTrait;

    /**
     * @inheritdoc
     * @param SourceItemInterface $sourceItem
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        // TODO: Implement process() method.
    }

    /**
     * @inheritdoc
     */
    public function processString(string $data): string
    {
        // Prepare the SourceItem
        $domDocument = new \DOMDocument();
        $domDocument->loadXML($data);

        $xmlSourceItem = new XMLSourceItem($domDocument);

        // Process it
        $this->process($xmlSourceItem);

        // Return result as string
        $resultData = $xmlSourceItem->getData();

        if ($resultData instanceof \DOMDocument) {
            return $resultData->saveXML();
        }

        return $domDocument->saveXML($resultData);
    }
}