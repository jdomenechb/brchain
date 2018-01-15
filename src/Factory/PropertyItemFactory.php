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

use Jdomenechb\BRChain\Exception\Factory\MissingParameterException;
use Jdomenechb\BRChain\Exception\Factory\UnknownItemException;
use Jdomenechb\BRChain\PropertyItemInterface;
use Jdomenechb\BRChain\String\StringAbsFactory;

/**
 * Factory capable of creating PropertyItems.
 */
class PropertyItemFactory extends AbstractItemFactory implements PropertyItemFactoryInterface
{
    /*
     * Constants
     */
    protected const ABSTRACT_FACTORY_NAMES = [
        StringAbsFactory::class,
    ];

    /**
     * {@inheritdoc}
     *
     * @throws UnknownItemException
     * @throws MissingParameterException
     */
    public function create(array $data): PropertyItemInterface
    {
        ['type' => $type, 'name' => $name] = $this->obtainTypeAndName($data);

        foreach ($this->initializedAbstractFactories as $initializedAbstractFactory) {
            if ($initializedAbstractFactory->canCreateItem($type, $name)) {
                return $initializedAbstractFactory->create($type, $name, $data);
            }
        }

        throw new UnknownItemException($type, $name, $data);
    }
}
