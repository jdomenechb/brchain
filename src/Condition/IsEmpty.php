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

/**
 * Executes the containing chain if the value is empty.
 * @package Jdomenechb\BRChain\Condition
 * @method string strPath()
 */
class IsEmpty extends AbstractCondition
{

    /**
     * @inheritdoc
     */
    public function evaluate(SourceItemInterface $sourceItem) : bool
    {
        $value = $sourceItem->getValue();

        return $value === '';
    }
}