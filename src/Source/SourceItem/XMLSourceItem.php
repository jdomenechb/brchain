<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Source\SourceItem;

class XMLSourceItem implements SourceItemInterface
{
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
     * @param \DOMNode $data
     */
    public function __construct(\DOMNode $data = null)
    {
        if ($data !== null) {
            $this->setData($data);
        }
    }

    /**
     * Returns the data the item uses as reference.
     * @return \DOMNode
     */
    public function getData() : \DOMNode
    {
        return $this->data;
    }

    /**
     * Sets the data the item will use as reference.
     * @param \DOMNode $data
     */
    public function setData(\DOMNode $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     * @param string $path
     * @return SourceItemInterface|null
     * @throws \RuntimeException
     */
    public function queryPath(string $path): array
    {
        $domXPath = $this->getDomXPath();

        $result = [];

        $matchedNodes = $domXPath->query($path);

        foreach ($matchedNodes as $matchedNode) {
            $result[] = new self($matchedNode);
        }

        return $result;
    }


    /**
     * @return \DOMXPath
     * @throws \RuntimeException
     */
    protected function getDomXPath() : \DOMXPath
    {
        // Lazy creation of DOMXPath
        if ($this->domXPath === null) {
            if ($this->data === null) {
                throw new \RuntimeException('No DOMXPath nor data has been defined');
            }

            $this->domXPath = new \DOMXPath(
                !$this->data instanceof \DOMDocument? $this->data->ownerDocument: $this->data
            );
        }

        return $this->domXPath;
    }

}