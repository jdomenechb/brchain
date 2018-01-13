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

namespace Jdomenechb\BRChain;

/**
 * Interface that all Items should implement.
 */
interface ItemInterface
{
    /**
     * Magic method __call.
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments);

    /**
     * Set options to the item.
     *
     * @param array $options
     */
    public function setOptions(array $options): void;
}
