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

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Trait for dynamically setting options to objects, depending on the public getters and setters. Provides also a
 * constructor that accepts options.
 */
trait DynamicOptionsTrait
{
    /**
     * DynamicOptionsTrait constructor provided to classes.
     *
     * @param array $options
     *
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        if ($options) {
            $this->setOptions($options);
        }
    }

    /**
     * Sets each option given to the object if its getter, setter and property exist.
     *
     * @param array $options
     *
     * @throws OptionDoesNotExistException
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $optionName => $optionValue) {
            $getterName = 'get' . \ucfirst($optionName);
            $isMethodName = 'is' . \ucfirst($optionName);
            $setterName = 'set' . \ucfirst($optionName);

            if (
                !\property_exists($this, $optionName)
                || !\method_exists($this, $setterName)
                || (!\method_exists($this, $getterName) && !\method_exists($this, $isMethodName))
            ) {
                /* @var $this ChainableItemInterface */
                throw new OptionDoesNotExistException($optionName, \get_class($this));
            }

            $this->{$setterName}($optionValue);
        }
    }
}
