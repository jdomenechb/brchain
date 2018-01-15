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

namespace Jdomenechb\BRChain\AbstractFactory\PropertyItem;

use Jdomenechb\BRChain\AbstractFactory\AbstractAbsFactory;
use Jdomenechb\BRChain\Exception\Factory\ChainNotAnArrayException;
use Jdomenechb\BRChain\Exception\Factory\MissingParameterException;
use Jdomenechb\BRChain\Exception\Factory\NotAChainableItemException;
use Jdomenechb\BRChain\Exception\Factory\UnknownItemException;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\PropertyItemInterface;

/**
 * Abstract class implementing a basic ChainableItemAbsFactoryInterface that is able to create ChainableItems.
 */
abstract class AbstractPropertyItemAbsFactory extends AbstractAbsFactory implements PropertyItemAbsFactoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws ChainNotAnArrayException
     * @throws MissingParameterException
     * @throws UnknownItemException
     * @throws OptionDoesNotExistException
     * @throws NotAChainableItemException
     */
    public function create(string $type, string $name, array $data): PropertyItemInterface
    {
        $obj = $this->createItem($type, $name, $data);

        if (!$obj instanceof PropertyItemInterface) {
            throw new NotAChainableItemException(\get_class($obj), $data);
        }

        return $obj;
    }
}
