<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Source\SourceItem;


interface SourceItemInterface
{
    /**
     * Returns the data the item uses as reference.
     * @return mixed
     */
    public function getData();

    /**
     * Sets the data the item will use as reference.
     * @param mixed $data
     */
    public function setData($data);

    /**
     * Given a path, tries to obtain the elements that match the path.
     * @param string $path
     * @return SourceItemInterface[]|null
     */
    public function queryPath(string $path): array;
}