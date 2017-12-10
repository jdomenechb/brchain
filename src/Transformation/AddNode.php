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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\Exception\SourceItemNotProcessableExtension;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Source\SourceItem\XMLSourceItem;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Adds a node into an XML source.
 * @package Jdomenechb\BRChain\Transformation
 * @method string strNodeName()
 * @method string strValue()
 */
class AddNode implements TransformationInterface
{
    use DynamicOptionsTrait;
    use CallStringOptionTrait;

    /**
     * Name of the node to be created (required).
     * @var StringInterface
     */
    protected $nodeName;

    /**
     * Value of the node to be created
     * @var StringInterface
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
     * @throws SourceItemNotProcessableExtension
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        if (!$sourceItem instanceof XMLSourceItem) {
            throw new SourceItemNotProcessableExtension(\get_class($sourceItem), static::class);
        }

        $data = $sourceItem->getData();
        $doc = $data instanceof \DOMDocument? $data: $data->ownerDocument;

        $createdNode = $data->appendChild($doc->createElement($this->strNodeName()));

        if ($value = $this->strValue()) {
            $createdNode->nodeValue = $value;
        }
    }

    /**
     * @return StringInterface
     */
    public function getNodeName(): StringInterface
    {
        return $this->nodeName;
    }

    /**
     * @param StringInterface $nodeName
     */
    public function setNodeName(StringInterface $nodeName): void
    {
        $this->nodeName = $nodeName;
    }

    /**
     * @return StringInterface
     */
    public function getValue(): ?StringInterface
    {
        return $this->value;
    }

    /**
     * @param StringInterface $value
     */
    public function setValue(StringInterface $value): void
    {
        $this->value = $value;
    }
}