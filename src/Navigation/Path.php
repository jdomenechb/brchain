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

namespace Jdomenechb\BRChain\Navigation;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;

/**
 * Navigator that explores deep structures by providing a path.
 *
 * @method string strPath()
 */
class Path extends AbstractNavigation
{
    /**
     * Path to navigate to.
     *
     * @var StringInterface
     */
    protected $path;

    /**
     * @return StringInterface
     */
    public function getPath(): StringInterface
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
        $matches = $sourceItem->queryPath($this->strPath());

        foreach ($matches as $match) {
            $this->getChain()->process($match);
        }
    }
}
