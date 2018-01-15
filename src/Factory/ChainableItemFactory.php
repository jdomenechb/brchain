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

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Condition\ConditionAbsFactory;
use Jdomenechb\BRChain\Exception\Factory\MissingParameterException;
use Jdomenechb\BRChain\Exception\Factory\UnknownItemException;
use Jdomenechb\BRChain\Navigation\NavigationAbsFactory;
use Jdomenechb\BRChain\Source\SourceAbsFactory;
use Jdomenechb\BRChain\Transformation\TransformationAbsFactory;

/**
 * Factory capable of creating ChainableItems.
 */
class ChainableItemFactory extends AbstractItemFactory implements ChainableItemFactoryInterface
{
    /*
     * Constants
     */
    protected const ABSTRACT_FACTORY_NAMES = [
        NavigationAbsFactory::class,
        SourceAbsFactory::class,
        ConditionAbsFactory::class,
        TransformationAbsFactory::class,
    ];

    /**
     * {@inheritdoc}
     *
     * @throws UnknownItemException
     * @throws MissingParameterException
     */
    public function create(array $data): ChainableItemInterface
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
