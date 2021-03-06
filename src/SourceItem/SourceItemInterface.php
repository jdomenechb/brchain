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

namespace Jdomenechb\BRChain\SourceItem;

/**
 * Interface to be implemented by all SourceItems.
 */
interface SourceItemInterface
{
    /**
     * Given a path, tries to obtain the elements that match the path.
     *
     * @param string $path
     *
     * @return SourceItemInterface[]|null
     */
    public function queryPath(string $path): array;

    /**
     * Get the value or string representation of the SourceItem.
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Sets the value of the SourceItem.
     *
     * @param string $value
     */
    public function setValue(string $value): void;
}
