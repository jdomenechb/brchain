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
 * @method string strPathToCheckExistance()
 */
class PathExists extends AbstractCondition
{
    /**
     * Path to check existance (required).
     *
     * @var StringInterface
     */
    protected $pathToCheckExistance;

    /**
     * {@inheritdoc}
     */
    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        $subItems = $sourceItem->queryPath($this->strPathToCheckExistance());

        return (bool) \count($subItems);
    }

    /**
     * @return StringInterface
     */
    public function getPathToCheckExistance(): StringInterface
    {
        return $this->pathToCheckExistance;
    }

    /**
     * @param StringInterface $pathToCheckExistance
     */
    public function setPathToCheckExistance(StringInterface $pathToCheckExistance): void
    {
        $this->pathToCheckExistance = $pathToCheckExistance;
    }
}
