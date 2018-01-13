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

namespace Jdomenechb\BRChain\SourceItem;

use Jdomenechb\BRChain\Source\XML\NamespacePrefixesTrait;

/**
 * SourceItem that represents an XML node.
 */
class XMLSourceItem implements SourceItemInterface
{
    use NamespacePrefixesTrait;

    /**
     * @var \DOMNode
     */
    protected $data;

    /**
     * @var \DOMXPath
     */
    protected $domXPath;

    /**
     * XMLDataItem constructor.
     *
     * @param \DOMNode $data
     */
    public function __construct(\DOMNode $data = null)
    {
        if (null !== $data) {
            $this->setData($data);
        }
    }

    /**
     * Returns the data the item uses as reference.
     *
     * @return \DOMNode
     */
    public function getData(): \DOMNode
    {
        return $this->data;
    }

    /**
     * Sets the data the item will use as reference.
     *
     * @param \DOMNode $data
     */
    public function setData(\DOMNode $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $path
     *
     * @throws \RuntimeException
     *
     * @return SourceItemInterface|null
     */
    public function queryPath(string $path): array
    {
        $domXPath = $this->getDomXPath();
        $prefixes = $this->getNamespacePrefixes();

        $result = [];

        $matchedNodes = $domXPath->query($path);

        foreach ($matchedNodes as $matchedNode) {
            $created = new self($matchedNode);
            $created->setNamespacePrefixes($prefixes);
            $result[] = $created;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->data->nodeValue;
    }

    /**
     * @throws \RuntimeException
     *
     * @return \DOMXPath
     */
    protected function getDomXPath(): \DOMXPath
    {
        // Lazy creation of DOMXPath
        if (null === $this->domXPath) {
            if (null === $this->data) {
                throw new \RuntimeException('No DOMXPath nor data has been defined');
            }

            $this->domXPath = new \DOMXPath(
                !$this->data instanceof \DOMDocument ? $this->data->ownerDocument : $this->data
            );

            foreach ($this->getNamespacePrefixes() as $prefix => $namespace) {
                $this->domXPath->registerNamespace($prefix, $namespace);
            }
        }

        return $this->domXPath;
    }
}
