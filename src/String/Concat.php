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
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Concatenates the given list of strings.
 * @package Jdomenechb\BRChain\String
 */
class Concat implements StringInterface
{
    use DynamicOptionsTrait;

    /**
     * List of strings to concatenate.
     * @var string[]|StringInterface[]
     */
    protected $strings;

    /**
     * Concat constructor.
     * @param array $options
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return implode('', $this->getStrings());
    }

    /**
     * @return StringInterface[]|string[]
     */
    public function getStrings() : array
    {
        return $this->strings;
    }

    /**
     * @param StringInterface[]|string[] $strings
     */
    public function setStrings(array $strings): void
    {
        $this->strings = $strings;
    }
}