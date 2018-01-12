<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Jdomenechb\BRChain\Stub\Condition;

use Jdomenechb\BRChain\Condition\AbstractCondition;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Stub class for checking AbstractCondition.
 */
class AbstractConditionStub extends AbstractCondition
{
    /**
     * @var bool
     */
    protected $whatShouldReturnStubEvaluation;

    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        return $this->whatShouldReturnStubEvaluation;
    }

    /**
     * @param bool $whatShouldReturnStubEvaluation
     */
    public function setWhatShouldReturnStubEvaluation(bool $whatShouldReturnStubEvaluation): void
    {
        $this->whatShouldReturnStubEvaluation = $whatShouldReturnStubEvaluation;
    }
}
