<?php

declare(strict_types=1);

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Transformation\XML;

use Jdomenechb\BRChain\Exception\SourceItemNotProcessableExtension;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\SourceItem\XMLSourceItem;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;

/**
 * Adds a node into an XML source.
 *
 * @method string strNodeName()
 * @method string strValue()
 * @method string strNamespace()
 */
class AddNode extends AbstractTransformation
{
    /**
     * (Required) Name of the node to be created.
     *
     * @var StringInterface
     */
    protected $nodeName;

    /**
     * (Optional) Value of the node to be created.
     *
     * @var StringInterface
     */
    protected $value;

    /**
     * (Optional) Namespace of the node to be created.
     *
     * @var StringInterface
     */
    protected $namespace;

    /**
     * {@inheritdoc}
     *
     * @throws SourceItemNotProcessableExtension
     */
    public function transform(SourceItemInterface $sourceItem): void
    {
        if (!$sourceItem instanceof XMLSourceItem) {
            throw new SourceItemNotProcessableExtension(\get_class($sourceItem), static::class);
        }

        $data = $sourceItem->getData();
        $doc = $data instanceof \DOMDocument ? $data : $data->ownerDocument;

        if ($namespace = $this->strNamespace()) {
            $element = $doc->createElementNS($namespace, $this->strNodeName());
        } else {
            $element = $doc->createElement($this->strNodeName());
        }

        $createdNode = $data->appendChild($element);

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

    /**
     * @return StringInterface
     */
    public function getNamespace(): ?StringInterface
    {
        return $this->namespace;
    }

    /**
     * @param StringInterface $namespace
     */
    public function setNamespace(StringInterface $namespace): void
    {
        $this->namespace = $namespace;
    }
}
