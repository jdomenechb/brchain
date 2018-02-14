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
 * Transformation for transliterating SourceItem Values.
 *
 * @method string strIcuTransform()
 */
class Transliterate extends AbstractTransformation
{
    /**
     * ICU transform to apply to the value.
     *
     * @var StringInterface
     *
     * @see http://userguide.icu-project.org/transforms/general
     */
    protected $icuTransform;

    /**
     * @return StringInterface
     */
    public function getIcuTransform(): StringInterface
    {
        return $this->icuTransform;
    }

    /**
     * @param StringInterface $icuTransform
     */
    public function setIcuTransform(StringInterface $icuTransform): void
    {
        $this->icuTransform = $icuTransform;
    }

    protected function transform(SourceItemInterface $sourceItem): void
    {
        $string = $sourceItem->getValue();
        $string = \transliterator_transliterate($this->strIcuTransform(), $string);
        $sourceItem->setValue($string);
    }
}
