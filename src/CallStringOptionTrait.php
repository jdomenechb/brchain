<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain;

use Jdomenechb\BRChain\Exception\MethodNotFoundException;

/**
 * Trait providing a __call magic method to the class in order to be able to access as string to every property.
 * @package Jdomenechb\BRChain
 */
trait CallStringOptionTrait
{
    /**
     * Magic method __call to be able to return as string any option.
     * @param $name
     * @param $arguments
     * @return string
     * @throws MethodNotFoundException
     */
    public function __call($name, $arguments)
    {
        if (!strpos($name, 'str') === 0) {
            throw new MethodNotFoundException($name, static::class);
        }

        $getter = 'get' . substr($name, 3);

        if (!method_exists($this, $getter)) {
            throw new MethodNotFoundException($getter, static::class);
        }

        return (string) $this->$getter(...$arguments);
    }
}