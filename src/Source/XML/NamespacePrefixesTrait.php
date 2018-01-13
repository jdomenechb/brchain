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

namespace Jdomenechb\BRChain\Source\XML;

/**
 * Trait for helping implementing namespace prefixes.
 */
trait NamespacePrefixesTrait
{
    /**
     * Given a prefix as key and a namespace as value, nodes in the namespace will be able to be accessed using in the
     * path the prefix given.
     *
     * @var string[]
     */
    protected $namespacePrefixes = [];

    /**
     * @return string[]
     */
    public function getNamespacePrefixes(): array
    {
        return $this->namespacePrefixes;
    }

    /**
     * @param string[] $namespacePrefixes
     */
    public function setNamespacePrefixes(array $namespacePrefixes): void
    {
        $this->namespacePrefixes = $namespacePrefixes;
    }
}
