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
 * Executes the containing chain if the value starts with the given start.
 *
 * @method string strStart()
 */
class StartsWith extends AbstractCondition
{
    /**
     * (Required) Start used for the comparison.
     *
     * @var StringInterface
     */
    protected $start;

    /**
     * {@inheritdoc}
     */
    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        $value = $sourceItem->getValue();

        return 0 === \mb_strpos($value, $this->strStart());
    }

    /**
     * @return StringInterface
     */
    public function getStart(): StringInterface
    {
        return $this->start;
    }

    /**
     * @param StringInterface $start
     */
    public function setStart(StringInterface $start): void
    {
        $this->start = $start;
    }
}
