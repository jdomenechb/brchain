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
 * Executes the containing chain if the value equals the given value.
 *
 * @method string strValue()
 */
class Equals extends AbstractCondition
{
    /**
     * Value use for the comparison (required).
     *
     * @var StringInterface
     */
    protected $value;

    /**
     * {@inheritdoc}
     */
    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        $value = $sourceItem->getValue();

        return $this->strValue() === $value;
    }

    /**
     * @return StringInterface
     */
    public function getValue(): StringInterface
    {
        return $this->value;
    }

    /**
     * @param StringInterface $value
     */
    public function setValue(StringInterface $value): void
    {
        $this->value = $value;
    }
}
