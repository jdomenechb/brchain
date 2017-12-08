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

use Jdomenechb\BRChain\Chain\Chain;
use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Exception\Parser\MissingParameterException;
use Jdomenechb\BRChain\Exception\Parser\UnknownNameException;
use Jdomenechb\BRChain\Exception\Parser\UnknownTypeException;

/**
 * Takes an array of data potentially translatable to a chain definition, and returns the resulting chain.
 * @package Jdomenechb\BRChain
 */
class Parser
{
    /*
     * Constants
     */
    protected const DATA_TYPE = 'type';
    protected const DATA_NAME = 'name';
    protected const DATA_CHAIN = 'chain';

    /**
     * Types of items available for processing.
     * @var string[]
     */
    protected static $itemTypes = [
        'Condition' => 'Jdomenechb\\BRChain\\Condition',
        'Navigation' => 'Jdomenechb\\BRChain\\Navigation',
        'Source' => 'Jdomenechb\\BRChain\\Source',
        'Transformation' => 'Jdomenechb\\BRChain\\Transformation',
        'Validator' => 'Jdomenechb\\BRChain\\Validator',
    ];

    /**
     * Checks if the array could be parsed.
     * @param array $data
     * @return bool
     */
    public function isParseable(array $data) : bool
    {
        return isset($data[static::DATA_TYPE], $data[static::DATA_NAME]);
    }

    /**
     * Parse the given data array to create an object from the information
     * @param array $data
     * @return ChainableItemInterface
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws UnknownNameException
     */
    public function parse(array $data) : ChainableItemInterface
    {
        // Check if type is present
        if (!isset($data[static::DATA_TYPE])) {
            throw new MissingParameterException(static::DATA_TYPE, $data);
        }

        // Check if name is present
        if (!isset($data[static::DATA_NAME])) {
            throw new MissingParameterException(static::DATA_NAME, $data);
        }

        // Get type
        $type = $data[static::DATA_TYPE];
        unset($data[static::DATA_TYPE]);

        // Check if type is known
        if (!isset(static::$itemTypes[$type])) {
            throw new UnknownTypeException($type, array_keys(static::$itemTypes), $data);
        }

        $typeNamespace = static::$itemTypes[$type];

        // Get name and item class
        $name = $data[static::DATA_NAME];
        unset($data[static::DATA_NAME]);

        $itemClass = $typeNamespace . '\\' . $name;

        // Check class existance
        if (!class_exists($itemClass) || !class_implements($itemClass, ChainableItemInterface::class)) {
            throw new UnknownNameException($type, $name, $data);
        }

        // Create instance of item object
        /** @var ChainableItemInterface $obj */
        $obj = new $itemClass;

        // Parse chain
        if ($obj instanceof ChainContainerItemInterface) {
            $this->parseChain($obj, $data);
        }

        // Parse objects in properties
        $newData = [];

        foreach ($data as &$dataValue) {
            if (!\is_array($dataValue)) {
                continue;
            }

            if ($this->isParseable($dataValue)) {
                $dataValue = $this->parse($dataValue);
                continue;
            }
        }

        unset($dataValue);

        // Set options to item object
        $obj->setOptions($newData);

        return $obj;
    }

    /**
     * Parses the chain contained in data array to the object that can contain a chain.
     * @param ChainContainerItemInterface $obj
     * @param array $data
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws UnknownNameException
     */
    protected function parseChain(ChainContainerItemInterface $obj, array &$data) : void
    {
        if (empty($data[static::DATA_CHAIN])) {
            unset($data[static::DATA_CHAIN]);
            return;
        }

        $chain = new Chain();

        /** @var array[] $chainData */
        $chainData = &$data[static::DATA_CHAIN];

        foreach ($chainData as $chainItem) {
            $chain->add($this->parse($chainItem));
        }

        $obj->setChain($chain);
        unset($data[static::DATA_CHAIN]);
    }
}