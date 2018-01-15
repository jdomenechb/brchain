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

namespace Jdomenechb\BRChain\AbstractFactory;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainFactory;
use Jdomenechb\BRChain\Exception\Factory\ChainNotAnArrayException;
use Jdomenechb\BRChain\Exception\Factory\MissingParameterException;
use Jdomenechb\BRChain\Exception\Factory\UnknownItemException;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\Factory\PropertyItemFactory;
use Jdomenechb\BRChain\ItemInterface;
use Jdomenechb\BRChain\String\Value;

/**
 * Abstract class implementing most common methods used in AbsFactories.
 */
abstract class AbstractAbsFactory implements AbsFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function canCreateItem(string $type, string $name): bool
    {
        $itemTypes = static::getItemTypes();

        // Check if the type is defined
        if (!isset($itemTypes[$type])) {
            return false;
        }

        // Check if the class exists
        $typeNamespace = $itemTypes[$type];
        $itemClass = $typeNamespace . '\\' . $name;

        return \class_exists($itemClass);
    }

    /**
     * Method for internal use of the factories, in order to create Items from the given type, name and data.
     *
     * @param string $type
     * @param string $name
     * @param array  $data
     *
     * @throws ChainNotAnArrayException
     * @throws MissingParameterException
     * @throws UnknownItemException
     * @throws OptionDoesNotExistException
     *
     * @return ItemInterface
     */
    protected function createItem(string $type, string $name, array $data): ItemInterface
    {
        $typeNamespace = static::getItemTypes()[$type];
        $itemClass = $typeNamespace . '\\' . $name;

        // Create instance of item object
        /** @var ChainableItemInterface $obj */
        $obj = new $itemClass();

        // Parse chain
        if ($obj instanceof ChainContainerItemInterface) {
            $chainFactory = new ChainFactory();

            $chain = $chainFactory->create($data);
            $obj->setChain($chain);

            unset($data[ChainFactory::DATA_CHAIN]);
        }

        // Parse objects in properties
        $propertyItemFactory = new PropertyItemFactory();

        foreach ($data as &$dataValue) {
            if (\is_string($dataValue)) {
                $dataValue = new Value(['value' => $dataValue]);
                continue;
            }

            if (\is_array($dataValue)) {
                if ($propertyItemFactory->canCreate($dataValue)) {
                    $dataValue = $propertyItemFactory->create($dataValue);
                } else {
                    foreach ($dataValue as &$subDataValue) {
                        if (\is_array($subDataValue) && $propertyItemFactory->canCreate($subDataValue)) {
                            $subDataValue = $propertyItemFactory->create($subDataValue);
                        }
                    }

                    unset($subDataValue);
                }
            }
        }

        unset($dataValue);

        // Set options to item object
        $obj->setOptions($data);

        return $obj;
    }

    /**
     * Returns the types of items this AbstractFactory supports, related to their namespaces.
     *
     * @return string[]
     */
    abstract protected static function getItemTypes(): array;
}
