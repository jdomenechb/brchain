<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;

/**
 * Abstract Transformation class implementing the most common methods a Transformation item must have.
 */
abstract class AbstractTransformation implements TransformationInterface
{
    use DynamicOptionsTrait;
    use CallStringOptionTrait;
    use ChainContainerItemTrait;
}
