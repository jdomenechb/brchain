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

namespace Jdomenechb\BRChain\Chain;

use Jdomenechb\BRChain\Exception\Factory\ChainNotAnArrayException;
use Jdomenechb\BRChain\Factory\ChainableItemFactory;

class ChainFactory
{
    /*
     * Constants
     */
    public const DATA_CHAIN = 'chain';

    /**
     * Parses the chain contained in data array to the object that can contain a chain.
     *
     * @param array $data
     *
     * @throws ChainNotAnArrayException
     *
     * @return Chain
     */
    public function create(array $data): ChainInterface
    {
        if (empty($data[static::DATA_CHAIN])) {
            throw new ChainNotAnArrayException($data);
        }

        $chain = new Chain();

        /** @var array[] $chainData */
        $chainData = &$data[static::DATA_CHAIN];

        if (!\is_array($chainData)) {
            throw new ChainNotAnArrayException($data);
        }

        $factory = new ChainableItemFactory();

        foreach ($chainData as $chainItem) {
            $chain->add($factory->create($chainItem));
        }

        return $chain;
    }
}
