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


use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Abstract Condition class implementing the most common methods a Condition item must have.
 * @package Jdomenechb\BRChain\Condition
 */
abstract class AbstractCondition implements ConditionInterface
{
    use DynamicOptionsTrait;
    use ChainContainerItemTrait;
    use CallStringOptionTrait;

    /**
     * Determines if the condition evaluation must be negated.
     * @var bool
     */
    protected $negated = false;

    /**
     * @inheritdoc
     */
    public function isNegated(): bool
    {
        return $this->negated;
    }

    /**
     * @inheritdoc
     */
    public function setNegated(bool $negated): void
    {
        $this->negated = $negated;
    }

    /**
     * @inheritdoc
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        $evaluationResult = $this->evaluate($sourceItem);

        if ($this->isNegated()) {
            $evaluationResult = !$evaluationResult;
        }

        if ($evaluationResult) {
            $this->getChain()->process($sourceItem);
        }
    }

}