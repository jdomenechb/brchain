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

use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\MethodNotFoundException;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Class that implements basic methods that almost all strings should follow.
 * @package Jdomenechb\BRChain\String
 */
abstract class AbstractString implements StringInterface
{
    use DynamicOptionsTrait;

    /**
     * AbstractString constructor.
     * @param array $options
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Magic method __call.
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