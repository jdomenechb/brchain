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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\SourceItemNotProcessableExtension;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Source\SourceItem\XMLSourceItem;

/**
 * Source class for XML strings, to be able to process them using a chain.
 * @package Jdomenechb\BRChain\Source
 */
class XML implements SourceInterface
{
    use ChainContainerItemTrait;
    use DynamicOptionsTrait;
    use CallStringOptionTrait;

    /**
     * @inheritdoc
     * @param SourceItemInterface $sourceItem
     * @throws SourceItemNotProcessableExtension
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        if (!$sourceItem instanceof XMLSourceItem) {
            throw new SourceItemNotProcessableExtension(\get_class($sourceItem), static::class);
        }

        $this->getChain()->process($sourceItem);
    }

    /**
     * @inheritdoc
     * @throws SourceItemNotProcessableExtension
     */
    public function processFromString(string $data): string
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