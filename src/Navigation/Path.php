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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Navigator that explores depth structures by providing a path.
 * @package Jdomenechb\BRChain\Navigation
 * @method string strPath()
 */
class Path implements NavigationInterface
{
    use ChainContainerItemTrait;
    use DynamicOptionsTrait;
    use CallStringOptionTrait;

    /**
     * Path to navigate to.
     * @var StringInterface
     */
    protected $path;

    /**
     * @return StringInterface
     */
    public function getPath(): StringInterface
    {
        return $this->path;
    }

    /**
     * @param StringInterface $path
     */
    public function setPath(StringInterface $path): void
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        $matches = $sourceItem->queryPath($this->strPath());

        foreach ($matches as $match) {
            $this->getChain()->process($match);
        }
    }
}