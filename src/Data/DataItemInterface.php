<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Data;


interface DataItemInterface
{
    /**
     * Returns the data the item uses as reference.
     * @return mixed
     */
    public function getData();

    /**
     * Sets the data the item will use as reference.
     * @param mixed $data
     * @return self
     */
    public function setData($data);
}