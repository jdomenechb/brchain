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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\PropertyItemInterface;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Abstract Condition class implementing the most common methods a Condition item must have.
 *
 * @method string strPath()
 */
abstract class AbstractCondition implements ConditionInterface
{
    use DynamicOptionsTrait;
    use ChainContainerItemTrait;
    use CallStringOptionTrait;

    /**
     * Determines if the condition evaluation must be negated.
     *
     * @var bool
     */
    protected $negated = false;

    /**
     * Optional path to use for evaluating the condition; otherwise, the condition will be evaluated on the current
     * processed path.
     *
     * @var StringInterface
     */
    protected $path;

    /**
     * {@inheritdoc}
     */
    public function isNegated(): bool
    {
        return $this->negated;
    }

    /**
     * {@inheritdoc}
     */
    public function setNegated(bool $negated): void
    {
        $this->negated = $negated;
    }

    /**
     * @return StringInterface
     */
    public function getPath(): ?StringInterface
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
     * {@inheritdoc}
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        $vars = \get_object_vars($this);

        foreach ($vars as $var) {
            if ($var instanceof PropertyItemInterface) {
                $var->setContext($sourceItem);
            }
        }

        if ($optionalPath = $this->strPath()) {
            $possibleSourceItem = $sourceItem->queryPath($optionalPath);

            if (!$possibleSourceItem) {
                return;
            }

            $evaluationSourceItem = \array_shift($possibleSourceItem);
        } else {
            $evaluationSourceItem = $sourceItem;
        }

        $evaluationResult = $this->evaluate($evaluationSourceItem);

        if ($this->isNegated()) {
            $evaluationResult = !$evaluationResult;
        }

        if ($evaluationResult) {
            $this->getChain()->process($sourceItem);
        }
    }
}
