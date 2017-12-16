<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Condition;


use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Executes the containing chain if the given path exists.
 * @package Jdomenechb\BRChain\Condition
 * @method string strPath()
 */
class PathExists extends AbstractCondition
{
    /**
     * Path to check existance (required).
     * @var StringInterface
     */
    protected $path;

    /**
     * @inheritdoc
     */
    public function evaluate(SourceItemInterface $sourceItem) : bool
    {
        $subItems = $sourceItem->queryPath($this->strPath());

        return (bool) \count($subItems);
    }

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
}