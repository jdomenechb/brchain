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
 * Transformation for replacing strings using to search a Regex expression.
 *
 * @method string strSearch()
 * @method string strReplacement()
 */
class RegexReplace extends AbstractTransformation
{
    /**
     * (Required) Regex that matches with the text to search for.
     *
     * @var StringInterface
     */
    protected $search;

    /**
     * (Required) Text replacement to apply.
     *
     * @var StringInterface
     */
    protected $replacement;

    /**
     * @return StringInterface
     */
    public function getSearch(): StringInterface
    {
        return $this->search;
    }

    /**
     * @param StringInterface $search
     */
    public function setSearch(StringInterface $search): void
    {
        $this->search = $search;
    }

    /**
     * @return StringInterface
     */
    public function getReplacement(): StringInterface
    {
        return $this->replacement;
    }

    /**
     * @param StringInterface $replacement
     */
    public function setReplacement(StringInterface $replacement): void
    {
        $this->replacement = $replacement;
    }

    protected function transform(SourceItemInterface $sourceItem): void
    {
        $string = $sourceItem->getValue();
        $string = \preg_replace($this->strSearch(), $this->strReplacement(), $string);
        $sourceItem->setValue($string);
    }
}
