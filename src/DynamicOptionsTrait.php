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

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Trait for dynamically setting options to objects, depending on the public getters.
 * @package Jdomenechb\BRChain
 */
trait DynamicOptionsTrait
{
    /**
     * Sets each option given to the object if its getter and the property exist.
     * @param array $options
     * @throws OptionDoesNotExistException
     */
    public function setOptions(array $options) : void
    {
        foreach ($options as $optionName => $optionValue) {
            $getterName = 'get' . ucfirst($optionName);

            if (!property_exists($this, $optionName) || !method_exists($this, $getterName)) {
                /** @var $this ChainableItemInterface */
                throw new OptionDoesNotExistException($optionName, \get_class($this));
            }

            $this->$optionName = $optionValue;
        }
    }
}