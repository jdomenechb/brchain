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

namespace Jdomenechb\BRChain\Transformation;


use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Transformation for changing the value of a SourceItem.
 * @method string strValue()
 */
class Set extends AbstractTransformation
{
    /**
     * Value to set to the SourceItem.
     * @var StringInterface
     * @see http://userguide.icu-project.org/transforms/general
     */
    protected $value;

    protected function transform(SourceItemInterface $sourceItem): void
    {
        $sourceItem->setValue($this->strValue());
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