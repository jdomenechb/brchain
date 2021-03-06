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

namespace Jdomenechb\BRChain\String;

use Jdomenechb\BRChain\PropertyItemInterface;

/**
 * Concatenates the given list of strings.
 */
class Concat extends AbstractString
{
    /**
     * List of strings to concatenate.
     *
     * @var StringInterface[]
     */
    protected $strings;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        foreach ($this->getStrings() as $string) {
            if ($string instanceof PropertyItemInterface) {
                $string->setContext($this->getContext());
            }
        }

        return \implode('', $this->getStrings());
    }

    /**
     * @return StringInterface[]
     */
    public function getStrings(): array
    {
        return $this->strings;
    }

    /**
     * @param StringInterface[] $strings
     */
    public function setStrings(array $strings): void
    {
        $this->strings = $strings;
    }
}
