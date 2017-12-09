<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\Exception\SourceItemNotProcessable;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Source\SourceItem\XMLSourceItem;

/**
 * Adds a node into an XML source.
 * @package Jdomenechb\BRChain\Transformation
 */
class AddNode implements TransformationInterface
{
    use DynamicOptionsTrait;

    /**
     * Name of the node to be created (required).
     * @var string
     */
    protected $nodeName;

    /**
     * Value of the node to be created
     * @var string
     */
    protected $value;

    /**
     * AddNode constructor.
     * @param array $options
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @inheritdoc
     * @throws SourceItemNotProcessable
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        if (!$sourceItem instanceof XMLSourceItem) {
            throw new SourceItemNotProcessable(\get_class($sourceItem), static::class);
        }

        $data = $sourceItem->getData();
        $doc = $data instanceof \DOMDocument? $data: $data->ownerDocument;

        $createdNode = $data->appendChild($doc->createElement((string) $this->getNodeName()));

        if ($value = $this->getValue()) {
            $createdNode->nodeValue = (string) $value;
        }
    }

    /**
     * @return string
     */
    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    /**
     * @param string $nodeName
     */
    public function setNodeName(string $nodeName): void
    {
        $this->nodeName = $nodeName;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}