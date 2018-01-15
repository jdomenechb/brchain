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

namespace Jdomenechb\BRChain\AbstractFactory\ChainableItem;

use Jdomenechb\BRChain\AbstractFactory\AbsFactoryInterface;
use Jdomenechb\BRChain\Chain\ChainableItemInterface;

/**
 * Interface for representing Abstract Factories that can create ChainableItems.
 */
interface ChainableItemAbsFactoryInterface extends AbsFactoryInterface
{
    /**
     * Creates a ChainableItem by the given type, name and data.
     *
     * @param string $type
     * @param string $name
     * @param array  $data
     *
     * @return ChainableItemInterface
     */
    public function create(string $type, string $name, array $data): ChainableItemInterface;
}
