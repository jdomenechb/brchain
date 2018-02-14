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

namespace Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Executes the containing chain if the given path exists.
 *
 * @method string strPathToCheckExistence()
 */
class PathExists extends AbstractCondition
{
    /**
     * (Required) Path to check existence.
     *
     * @var StringInterface
     */
    protected $pathToCheckExistence;

    /**
     * {@inheritdoc}
     */
    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        $subItems = $sourceItem->queryPath($this->strPathToCheckExistence());

        return (bool) \count($subItems);
    }

    /**
     * @return StringInterface
     */
    public function getPathToCheckExistence(): StringInterface
    {
        return $this->pathToCheckExistence;
    }

    /**
     * @param StringInterface $pathToCheckExistence
     */
    public function setPathToCheckExistence(StringInterface $pathToCheckExistence): void
    {
        $this->pathToCheckExistence = $pathToCheckExistence;
    }
}
