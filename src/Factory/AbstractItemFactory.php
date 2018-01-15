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

namespace Jdomenechb\BRChain\Factory;

use Jdomenechb\BRChain\AbstractFactory\AbsFactoryInterface;
use Jdomenechb\BRChain\AbstractFactory\ChainableItem\ChainableItemAbsFactoryInterface;
use Jdomenechb\BRChain\AbstractFactory\PropertyItem\PropertyItemAbsFactoryInterface;
use Jdomenechb\BRChain\Exception\Factory\MissingParameterException;

/**
 * Class that implements common and basic methods an ItemFactory should have.
 */
abstract class AbstractItemFactory implements ItemFactoryInterface
{
    /*
     * Constants
     */
    protected const DATA_TYPE = 'type';
    protected const DATA_NAME = 'name';
    protected const ABSTRACT_FACTORY_NAMES = [];

    /**
     * Initializes abstract factories from the list provided by ABSTRACT_FACTORY_NAMES.
     *
     * @var AbsFactoryInterface[]|ChainableItemAbsFactoryInterface[]|PropertyItemAbsFactoryInterface[]
     */
    protected $initializedAbstractFactories = [];

    /**
     * AbstractItemFactory constructor.
     */
    public function __construct()
    {
        foreach (static::ABSTRACT_FACTORY_NAMES as $abstractFactoryName) {
            $this->initializedAbstractFactories[] = new $abstractFactoryName();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function canCreate(array $data): bool
    {
        return isset($data[static::DATA_TYPE])
            && (
                isset($data[static::DATA_NAME])
                || (!isset($data[static::DATA_NAME]) && false !== \strpos($data[static::DATA_TYPE], '/'))
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
        $type = \str_replace('\\', '/', $data[static::DATA_TYPE]);
        unset($data[static::DATA_TYPE]);

        // Check if name is present
        if (!isset($data[static::DATA_NAME])) {
            if (false === ($lastPosBackslash = \mb_strrpos($type, '/'))) {
                throw new MissingParameterException(static::DATA_NAME, $data);
            }

            $name = \mb_substr($type, $lastPosBackslash + 1);
            $type = \mb_substr($type, 0, $lastPosBackslash);
        } else {
            // Get name and item class
            $name = $data[static::DATA_NAME];
            unset($data[static::DATA_NAME]);
        }

        return ['type' => $type, 'name' => $name];
    }
}
