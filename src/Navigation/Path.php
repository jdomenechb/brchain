<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Navigation;

use Jdomenechb\BRChain\ChainableItemInterface;
use Jdomenechb\BRChain\ChainContainerItemInterface;
use Jdomenechb\BRChain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;

class Path implements ChainableItemInterface, ChainContainerItemInterface
{
    use ChainContainerItemTrait;
    use DynamicOptionsTrait;

    /**
     * Path to navigate to.
     * @var string
     */
    protected $path;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Path
     */
    public function setPath(string $path): Path
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        $matches = $sourceItem->queryPath($this->getPath());

        foreach ($matches as $match) {
            $this->getChain()->process($match);
        }
    }
}