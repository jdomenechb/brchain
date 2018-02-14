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
 * Executes the containing chain if the value matches the regex.
 *
 * @method string strRegex()
 */
class MatchesRegex extends AbstractCondition
{
    /**
     * (Required) Regex to compare the value against.
     *
     * @var StringInterface
     */
    protected $regex;

    /**
     * {@inheritdoc}
     */
    public function evaluate(SourceItemInterface $sourceItem): bool
    {
        $value = $sourceItem->getValue();

        return (bool) \preg_match($this->strRegex(), $value);
    }

    /**
     * @return StringInterface
     */
    public function getRegex(): StringInterface
    {
        return $this->regex;
    }

    /**
     * @param StringInterface $regex
     */
    public function setRegex(StringInterface $regex): void
    {
        $this->regex = $regex;
    }
}
