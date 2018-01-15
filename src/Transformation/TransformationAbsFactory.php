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

namespace Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\AbstractFactory\ChainableItem\AbstractChainableItemAbsFactory;

class TransformationAbsFactory extends AbstractChainableItemAbsFactory
{
    protected static function getItemTypes(): array
    {
        return [
            'Transformation' => 'Jdomenechb\\BRChain\\Transformation',
            'Transformation/XML' => 'Jdomenechb\\BRChain\\Transformation\\XML',
        ];
    }
}
