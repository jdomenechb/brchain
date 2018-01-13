<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Jdomenechb\BRChain;

use Jdomenechb\BRChain\Chain\Chain;
use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\Exception\Parser\MissingParameterException;
use Jdomenechb\BRChain\Exception\Parser\NotASourceException;
use Jdomenechb\BRChain\Exception\Parser\UnknownNameException;
use Jdomenechb\BRChain\Exception\Parser\UnknownTypeException;
use Jdomenechb\BRChain\Source\SourceInterface;
use Jdomenechb\BRChain\String\Value;

/**
 * Takes an array of data potentially translatable to a chain definition, and returns the resulting chain.
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
     *
     * @var string[]
     */
    protected static $itemTypes = [
        'Condition' => 'Jdomenechb\\BRChain\\Condition',
        'Navigation' => 'Jdomenechb\\BRChain\\Navigation',
        'Source' => 'Jdomenechb\\BRChain\\Source',
        'Transformation' => 'Jdomenechb\\BRChain\\Transformation',
        'Transformation/XML' => 'Jdomenechb\\BRChain\\Transformation\\XML',
        'Validator' => 'Jdomenechb\\BRChain\\Validator',
    ];

    /**
     * Types of PropertyItems available for processing.
     *
     * @var string[]
     */
    protected static $propertyItemTypes = [
        'String' => 'Jdomenechb\\BRChain\\String',
    ];

    /**
     * Checks if the array could be parsed as a ChainableItem.
     *
     * @param array $data
     *
     * @return bool
     */
    public function isParseableChainableItem(array $data): bool
    {
        return isset($data[static::DATA_TYPE], $data[static::DATA_NAME], static::$itemTypes[$data[static::DATA_TYPE]]);
    }

    /**
     * Parse the given Source data array to create a SourceInterface object from the information.
     *
     * @param array $data
     *
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws UnknownNameException
     * @throws NotASourceException
     * @throws OptionDoesNotExistException
     *
     * @return SourceInterface
     */
    public function parseSource(array $data): SourceInterface
    {
        $obj = $this->parseChainableItem($data);

        if (!$obj instanceof SourceInterface) {
            throw new NotASourceException($data);
        }

        return $obj;
    }

    /**
     * Parse the given data array to create a ChainableItem from the information.
     *
     * @param array $data
     *
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws UnknownNameException
     * @throws OptionDoesNotExistException
     *
     * @return ChainableItemInterface
     */
    public function parseChainableItem(array $data): ChainableItemInterface
    {
        ['type' => $type, 'name' => $name] = $this->obtainTypeAndName($data);

        // Check if type is known
        if (!isset(static::$itemTypes[$type])) {
            throw new UnknownTypeException($type, array_keys(static::$itemTypes), $data);
        }

        $typeNamespace = static::$itemTypes[$type];

        $itemClass = $typeNamespace . '\\' . $name;
        $isNegated = false;

        // Check class existance
        if (!class_exists($itemClass)) {
            if (!preg_match('#^Not(.*)$#', $name, $match)) {
                throw new UnknownNameException($type, $name, $data);
            }

            $itemClass = $typeNamespace . '\\' . $match[1];
            $isNegated = true;

            if (
                !class_exists($itemClass)
            ) {
                throw new UnknownNameException($type, $name, $data);
            }
        }

        // Create instance of item object
        /** @var ChainableItemInterface $obj */
        $obj = new $itemClass();

        if (!$obj instanceof ChainableItemInterface) {
            throw new UnknownNameException($type, $name, $data);
        }

        // Parse chain
        if ($obj instanceof ChainContainerItemInterface) {
            $this->parseChain($obj, $data);
        }

        // Parse objects in properties
        foreach ($data as &$dataValue) {
            if (\is_string($dataValue)) {
                $dataValue = new Value(['value' => $dataValue]);
                continue;
            }

            if (\is_array($dataValue) && $this->isParseablePropertyItem($dataValue)) {
                $dataValue = $this->parsePropertyItem($dataValue);
                continue;
            }
        }

        unset($dataValue);

        // Set negated
        if ($isNegated) {
            /* @var NegatedItemInterface $itemClass */
            $itemClass->setNegated(!$itemClass->isNegated());
        }

        // Set options to item object
        $obj->setOptions($data);

        return $obj;
    }

    /**
     * Parses the chain contained in data array to the object that can contain a chain.
     *
     * @param ChainContainerItemInterface $obj
     * @param array                       $data
     *
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws OptionDoesNotExistException
     * @throws UnknownNameException
     */
    protected function parseChain(ChainContainerItemInterface $obj, array &$data): void
    {
        if (empty($data[static::DATA_CHAIN])) {
            unset($data[static::DATA_CHAIN]);

            return;
        }

        $chain = new Chain();

        /** @var array[] $chainData */
        $chainData = &$data[static::DATA_CHAIN];

        foreach ($chainData as $chainItem) {
            $chain->add($this->parseChainableItem($chainItem));
        }

        $obj->setChain($chain);
        unset($data[static::DATA_CHAIN]);
    }

    /**
     * Parse the given data array to create a PropertyItem from the information.
     *
     * @param array $data
     *
     * @throws MissingParameterException
     * @throws UnknownTypeException
     * @throws UnknownNameException
     * @throws OptionDoesNotExistException
     *
     * @return PropertyItemInterface
     */
    protected function parsePropertyItem(array $data): PropertyItemInterface
    {
        ['type' => $type, 'name' => $name] = $this->obtainTypeAndName($data);

        // Check if type is known
        if (!isset(static::$propertyItemTypes[$type])) {
            throw new UnknownTypeException($type, array_keys(static::$itemTypes), $data);
        }

        $typeNamespace = static::$propertyItemTypes[$type];

        $itemClass = $typeNamespace . '\\' . $name;

        // Check class existance
        if (!class_exists($itemClass)) {
            throw new UnknownNameException($type, $name, $data);
        }

        // Create instance of item object
        /** @var PropertyItemInterface $obj */
        $obj = new $itemClass();

        if (!$obj instanceof PropertyItemInterface) {
            throw new UnknownNameException($type, $name, $data);
        }

        // Parse chain
        if ($obj instanceof ChainContainerItemInterface) {
            $this->parseChain($obj, $data);
        }

        // Parse objects in properties
        foreach ($data as &$dataValue) {
            if (\is_string($dataValue)) {
                $dataValue = new Value(['value' => $dataValue]);
                continue;
            }

            if (\is_array($dataValue) && $this->isParseablePropertyItem($dataValue)) {
                $dataValue = $this->parsePropertyItem($dataValue);
                continue;
            }
        }

        unset($dataValue);

        // Set options to item object
        $obj->setOptions($data);

        return $obj;
    }

    /**
     * Checks if the array could be parsed as a PropertyItem.
     *
     * @param array $data
     *
     * @return bool
     */
    protected function isParseablePropertyItem(array $data): bool
    {
        return isset($data[static::DATA_TYPE])
            && (
                isset($data[static::DATA_NAME], static::$propertyItemTypes[$data[static::DATA_TYPE]])
                || (
                    !isset($data[static::DATA_NAME])
                    && isset(static::$propertyItemTypes[substr($data[static::DATA_TYPE], 0, strrpos($data[static::DATA_TYPE], '/'))])
                )
            );
    }

    /**
     * From the given array of information, obtains the type and the name, and deletes them from the source array.
     *
     * @param array $data
     *
     * @throws MissingParameterException
     *
     * @return string[]
     */
    protected function obtainTypeAndName(array &$data): array
    {
        // Check if type is present
        if (!isset($data[static::DATA_TYPE])) {
            throw new MissingParameterException(static::DATA_TYPE, $data);
        }

        // Get type
        $type = str_replace('\\', '/', $data[static::DATA_TYPE]);
        unset($data[static::DATA_TYPE]);

        // Check if name is present
        if (!isset($data[static::DATA_NAME])) {
            if (($lastPosBackslash = strrpos($type, '/')) === false) {
                throw new MissingParameterException(static::DATA_NAME, $data);
            }

            $name = substr($type, $lastPosBackslash + 1);
            $type = substr($type, 0, $lastPosBackslash);

        } else {
            // Get name and item class
            $name = $data[static::DATA_NAME];
            unset($data[static::DATA_NAME]);
        }

        return ['type' => $type, 'name' => $name];
    }
}
