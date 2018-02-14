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

use Jdomenechb\BRChain\PropertyItemInterface;

/**
 * Interface representing an interface capable of creating PropertyItems.
 */
interface PropertyItemFactoryInterface extends ItemFactoryInterface
{
    /**
     * Creates a PropertyItem from the given array data.
     *
     * @param array $data
     *
     * @return PropertyItemInterface
     */
    public function create(array $data): PropertyItemInterface;
}
