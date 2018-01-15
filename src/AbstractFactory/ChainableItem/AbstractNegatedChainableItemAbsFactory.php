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

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Exception\Factory\NotANegatedItemException;
use Jdomenechb\BRChain\NegatedItemInterface;

/**
 * Abstract class implementing a basic ChainableItemAbsFactoryInterface that is able to create ChainableItems with data
 * that indicate that they can be negated.
 */
abstract class AbstractNegatedChainableItemAbsFactory extends AbstractChainableItemAbsFactory
{
    /**
     * {@inheritdoc}
     */
    public function canCreateItem(string $type, string $name): bool
    {
        if ($this->isNegated($name)) {
            $name = \substr($name, 3);
        }

        return parent::canCreateItem($type, $name);
    }

    /**
     * {@inheritdoc}
     *
     * @throws NotANegatedItemException
     */
    public function create(string $type, string $name, array $data): ChainableItemInterface
    {
        $isNegated = false;

        if ($this->isNegated($name)) {
            $isNegated = true;
            $name = \substr($name, 3);
        }

        $obj = parent::create($type, $name, $data);

        if (!$obj instanceof NegatedItemInterface) {
            throw new NotANegatedItemException(\get_class($obj), $data);
        }

        // Set negated
        if ($isNegated) {
            $obj->setNegated(!$obj->isNegated());
        }

        return $obj;
    }

    protected function isNegated(string $name): bool
    {
        return 0 === \strpos($name, 'Not') && \preg_match('#^[A-Z]$#', $name[4]);
    }
}
