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

namespace Jdomenechb\BRChain\String;

/**
 * It evaluates as the value of the given path.
 *
 * @method string strPath()
 */
class PathValue extends AbstractString
{
    /**
     * Path to evaluate.
     *
     * @var StringInterface
     */
    protected $path;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $queriedPaths = $this->getContext()->queryPath($this->strPath());

        if (!\count($queriedPaths)) {
            return '';
        }

        return $queriedPaths[0]->getValue();
    }

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
}
