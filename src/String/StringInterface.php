<?php

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
 * Interface to be implemented by all String items.
 * @package Jdomenechb\BRChain\String
 */
interface StringInterface
{
    /**
     * Get the string value of the item currently processed
     * @return string
     */
    public function __toString();

    /**
     * Set options to the item.
     * @param array $options
     */
    public function setOptions(array $options) : void;
}