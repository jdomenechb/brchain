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

/**
 * Interface representing any Abstract Factory.
 */
interface AbsFactoryInterface
{
    /**
     * Checks if the given type and name can be created by the current AbstractFactory.
     *
     * @param string $type
     * @param string $name
     *
     * @return bool
     */
    public function canCreateItem(string $type, string $name): bool;
}
