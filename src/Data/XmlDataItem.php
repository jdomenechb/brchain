<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Data;


class XmlDataItem implements DataItemInterface
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
     * @inheritdoc
     * @return \DOMNode
     */
    public function getData() : \DOMNode
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     * @param mixed $data
     * @return XMLDataItem
     */
    public function setData($data) : self
    {
        \assert($data instanceof \DOMNode, 'Parameter "data" should be an instance of DOMNode');

        $this->data = $data;

        return $this;
    }

    /**
     * @inheritdoc
     * @param string $path
     * @return DataItemInterface|null
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
     */
    protected function getDomXPath() : \DOMXPath
    {
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