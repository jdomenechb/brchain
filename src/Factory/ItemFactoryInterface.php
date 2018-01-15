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

/**
 * Interface that represents a Factory capable of creating Items.
 */
interface ItemFactoryInterface
{
    /**
     * Checks if an Item could be created from the given data.
     *
     * @param array $data
     *
     * @return bool
     */
    public function canCreate(array $data): bool;
}
