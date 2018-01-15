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

namespace Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\AbstractFactory\ChainableItem\AbstractNegatedChainableItemAbsFactory;

class ConditionAbsFactory extends AbstractNegatedChainableItemAbsFactory
{
    protected static function getItemTypes(): array
    {
        return [
            'Condition' => 'Jdomenechb\\BRChain\\Condition',
        ];
    }
}
